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
			'ChallengeID' => 4, 
			'MemberID' => 10
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
		foreach ($fields as $field) {
			if ($field->Title() == 'Category') {
				Debug::dump($field);
			}
		}

		exit();
		$fields->push(
			DropdownField::create(
				'Category', 
				'What is your motivation', 
				array(
					'Competitive' => 'Competitive', 
					'Motivation' => 'Motivation', 
				)
			)->setEmptyString('Select one')				
		);

		$fields->push(
			CheckboxField::create(
				'AutoAssignedTeam', 
				'Yes please automatically assign me to a team.'
			)				
		);

        if ($this->getSesJoinChallenge()->IndividualOrTeam == 'team') {
        	$fields->removeByName('AutoAssignedTeam');
        	$fields->push(
        		OptionsetField::create(
        			'TeamAssignment', 
        			false, 
        			array(
        				'AutoAssignedTeam' => 'Automatically assign me to a team', 
        				'JoinExistingTeam' => 'Join an existing team', 
        				'CreateNewTeam' => 'Create a new team and invite members'
        			), 
        			'AutoAssignedTeam'
        		)
        	);
        	$fields->push(
        			TextField::create('SuggestTeam', 'Start typing the team name below to find the join your team')
        				->setAttribute('autocomplete', 'off')
        	);

        	$fields->push(HiddenField::create('TeamID', false));
        	$fields->push(TextField::create('TeamName', 'Team name'));
        	$fields->push(TextField::create('TeamMemberName[]', 'Name'));
        	$fields->push(EmailField::create('TeamMemberEmail[]', 'Email'));
        }

        $actions = new FieldList(
            FormAction::create("doSubmit")
            	->setTitle("Proceed to next step")
        );

        $required = new RequiredFields('Category');

        $form = new Form($this, 'Form', $fields, $actions, $required);
        $form->setTemplate('ChallengeTeamForm');

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

		if (isset($data['TeamAssignment'])) {
			if ($data['TeamAssignment'] == 'AutoAssignedTeam') {
				$reference->TeamID = $this->getChallenge()->getAutoTeamAllocation($data['Category'])->ID;
			}

			if ($data['TeamAssignment'] == 'JoinExistingTeam') {
				$reference->TeamID = $data['TeamID'];
			}

			if ($data['TeamAssignment'] == 'CreateNewTeam') {
				$team = new Team();
				$team->Title = $data['TeamName'];
				$team->write();

				$this->getChallenge()->Teams()->add($team);

				$reference->TeamID = $team->ID;

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
				            	'Link' => 'http://www.facebook.com'
				            )));

						$email->send();
					}
				}
			}
		} else {
			if (isset($data['AutoAssignedTeam']) && $data['AutoAssignedTeam']) {
				$reference->TeamID = $this->getChallenge()->getAutoTeamAllocation($data['Category'])->ID;
			} else {
				$this->getChallenge()->Members()->add(Member::currentUser());
			}
		}

		$form->saveInto($reference);

		try {
			$reference->write();
			
			$sesJoinChallenge = $this->getSesJoinChallenge();
			$sesJoinChallenge->ChallengeReferenceID = $reference->ID;
			Session::set('JoinChallenge', serialize($sesJoinChallenge));

			if ($reference->TeamID) {
				$team = Team::get()->byID($reference->TeamID);
				if ($team) {
					$team->Members()->add(Member::currentUser());
				}
			}

		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}
		return $this->redirectBack();
		//return $this->redirect(MemberJoinChallengePlanPage::get()->First()->Link());
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