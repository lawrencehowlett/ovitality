<?php
class MemberJoinChallengePage extends MemberPage {

	private static $icon = 'mysite/images/signing-icon.png';
}

class MemberJoinChallengePage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'Form', 'GetTeams', 'SelectChallenge'
	);

	public function init() {
		parent::init();

		Requirements::javascript('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/3.1.1/bootstrap3-typeahead.min.js');
		Requirements::javascript(THEMES_DIR . '/ovitality_members/js/join-challenge.js');
	}

	public function SelectChallenge(SS_HTTPRequest $request) {
		Session::set('JoinChallenge', serialize(new ArrayData(array(
			'IndividualOrTeam' => $request->param('ID'),
			'ChallengeID' => $request->param('OtherID')
		))));

		$reference = MemberChallengeReference::get()->filter(array(
			'ChallengeID' => $request->param('OtherID'), 
			'MemberID' => Member::currentUserID()
		))->First();

		if ($reference) {
			$reference->delete();
		}

		return $this->redirect($this->Link());
	}

	public function GetTeams(SS_HTTPRequest $request) {
		$result = array();
		$teams = $this->getChallenge()->getAvailableTeams($request->param('ID'));
		foreach ($teams as $team) {
			array_push($result, array('id' => $team->ID, 'name' => $team->Title));
		}

		return Convert::array2json($result);
	}

	public function Form() {
		$reference = ($this->getReference()) ? $this->getReference() : singleton('MemberChallengeReference');

		$fields = $reference->getReferenceFields();

        if ($this->getSesJoinChallenge()->IndividualOrTeam == 'team') {

        	$suggestTeamField = TextField::create(
        		'SuggestTeam', 
        		'Start typing the team name below to find the join your team')
    			->setAttribute('autocomplete', 'off');
        	$teamIDField = HiddenField::create('TeamID', false);
        	$teamNameField = TextField::create('TeamName', 'Team name');
        	$teamNumberField = TextField::create('TeamLimit', 'Number of members');

        	if ($reference) {
        		$teamIDField->setValue($reference->TeamID);
        		
        		if ($reference->JoinExistingTeam) {
	        		$suggestTeamField->setValue($reference->Team()->Title);
        		}

        		if ($reference->CreateNewTeam) {
	        		$teamNameField->setValue($reference->Team()->Title);
        		}
        	}

        	$fields->push($teamIDField);
        	$fields->push($suggestTeamField);
        	$fields->push($teamNameField);
        	$fields->push($teamNumberField);
        	$fields->push(TextField::create('TeamMemberName[]', 'Name'));
        	$fields->push(EmailField::create('TeamMemberEmail[]', 'Email'));
        } else {
        	$fields->removeByName('JoinExistingTeam');
        }

        $actions = new FieldList(
            FormAction::create("doSubmit")
            	->setTitle("Proceed to next step")
        );

        $required = new RequiredFields('Category');
        $form = new Form($this, 'Form', $fields, $actions, $required);
        $form->setTemplate('ChallengeTeamForm');

        if ($reference) {
	        $form->loadDataFrom($reference);
        }

        return $form;	
	}

	public function doSubmit($data, Form $form) {
		if ($this->getSesJoinChallenge()->ChallengeReferenceID) {
			$reference = MemberChallengeReference::get()->byID($this->getSesJoinChallenge()->ChallengeReferenceID);
		} else {
			$reference = new MemberChallengeReference();
			$reference->MemberID = Member::currentUserID();
			$reference->ChallengeID = $this->getChallenge()->ID;
		}

		$form->saveInto($reference);

		try {
			if (isset($data['AutoAssignTeam']) && $data['AutoAssignTeam']) {
				$reference->CreateNewTeam = false;
				$autoTeam = $this->getChallenge()->getAutoTeamAllocation($data['Category']);
				if ($autoTeam) {
					$reference->TeamID = $autoTeam->ID;
				} else {
					$form->sessionMessage('All teams are full. Join as individual', 'bad');
					return $this->redirectBack();
				}
				$reference->write();
			} elseif (isset($data['JoinExistingTeam']) && $data['JoinExistingTeam']) {
				$reference->CreateNewTeam = false;
				$reference->TeamID = $data['TeamID'];
				$reference->write();
			} else {
				if (isset($data['TeamName']) && $data['TeamName']) {
					$reference->CreateNewTeam = true;
					$team = new Team();
					$team->TeamLeaderID = Member::currentUserID();
					$team->Title = $data['TeamName'];
					$team->Title = $data['TeamLimit'];
					$team->write();

					$team->Members()->add(Member::currentUser());

					$this->getChallenge()->Teams()->add($team);

					$reference->TeamID = $team->ID;
					$reference->write();

					if (count($data['TeamMemberName']) > 0) {
						for ($i=0; $i < count($data['TeamMemberName']); $i++) { 
							$email = new Email();
							$email
								->setFrom('no-reply@ovitality.com')
								->setTo($data['TeamMemberEmail'][$i])
								->setSubject('You are invited to join the ' . $this->getChallenge()->Title)
								->setTemplate('TeamInvitationEmail')
								->populateTemplate(new ArrayData(array(
					        		'Logo' => SiteConfig::current_site_config()->Logo(),
					            	'Name' => $data['TeamMemberName'][$i], 
					            	'Challenge' => $this->getChallenge()->Title,
					            	'Member' => Member::currentUser(), 
					            	'Link' => $reference->getReferralSignupLink()
					            )));

							$email->send();
						}
					}
				}
			}

			$sesJoinChallenge = $this->getSesJoinChallenge();
			$sesJoinChallenge->ChallengeReferenceID = $reference->ID;
			Session::set('JoinChallenge', serialize($sesJoinChallenge));

			if ($reference->TeamID) {
				$team = Team::get()->byID($reference->TeamID);
				if ($team) {
					$team->Members()->add(Member::currentUser());
					if ($reference->CreateNewTeam) {
						$team->TeamLeaderID = Member::currentUserID();
						$team->write();
					}
				}
			}

			if ($reference->IsJoiningIndividual()) {
				$reference->Challenge()->Members()->add(Member::currentUser());
			}

		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect(MemberJoinChallengePlanPage::get()->First()->Link());
	}

	public function getChallenge() {
		return Challenge::get()->byID($this->getSesJoinChallenge()->ChallengeID);
	}

	public function getSesJoinChallenge() {
		return unserialize(Session::get('JoinChallenge'));
	}

	public function getReference() {
		$sesJoinChallenge = $this->getSesJoinChallenge();
		if ($sesJoinChallenge->ChallengeReferenceID) {
			return MemberChallengeReference::get()->byID($sesJoinChallenge->ChallengeReferenceID);
		}

		return null;
	}
}