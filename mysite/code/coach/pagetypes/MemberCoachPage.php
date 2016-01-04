<?php
class MemberCoachPage extends MemberPage {

	private static $icon = 'mysite/images/whistle-icon.png';
}

class MemberCoachPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'ManageTeams', 'CreateTeam', 'TeamForm', 'InviteMembers', 'InviteTeamMemberForm', 'TeamsPoints'
	);

	public function init() {
		parent::init();

		Requirements::javascript(THEMES_DIR . '/ovitality/js/Chart.min.js');
		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){

					var lineChartData = {
						labels : ["January","February","March","April","May","June","July"],
						datasets : [
							{
								label: "My First dataset",
								fillColor : "rgba(151,187,205,0.2)",
								strokeColor : "rgba(151,187,205,1)",
								pointColor : "rgba(151,187,205,1)",
								pointStrokeColor : "#fff",
								pointHighlightFill : "#fff",
								pointHighlightStroke : "rgba(151,187,205,1)",
								data : [10,50,40,30,1,65,90]
							}
						]
					}

					window.onload = function(){
						var ctx = document.getElementById("canvas").getContext("2d");
						window.myLine = new Chart(ctx).Line(lineChartData, {
							responsive: true
						});
					}
			    });
			})(jQuery);
JS
		);
	}

	public function ManageTeams() {
		return $this->renderWith(array('MemberCoachPage_manage', 'Page'));
	}

	public function CreateTeam() {
		return $this->renderWith(array('MemberCoachPage_create', 'Page'));
	}

	public function InviteMembers() {
		$teamID = $this->request->param('ID');
		$team = Team::get()->byID($teamID);
		if ($team) {
			Session::set('TeamID', $team->ID);
		}

		return $this->renderWith(array('MemberCoachPage_invite', 'Page'));
	}	

	public function TeamsPoints() {
		return $this->renderWith(array('MemberCoachPage_points', 'Page'));
	}

	public function TeamForm() {
		$fields = singleton('Team')->getTeamFormFields();

        $actions = new FieldList(
            FormAction::create("doSave")
            	->setTitle("Save")
        );

        $required = new RequiredFields('Title', 'Description', 'Type');
        $form = new Form($this, 'TeamForm', $fields, $actions, $required);
        $form
        	->setTemplate('TeamForm');
        	//->loadDataFrom($this->getTeam());

        return $form;
	}

	public function doSave(Array $data, Form $form) {
		$team = new Team();
		$form->saveInto($team);

		try {
			$team->write();
			$team->Members()->add(Member::currentUser());
			$team->Coaches()->add(Member::currentUser());
			Session::set('FeedbackMessage', 'We have successfully created: ' . $team->Title);
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link() . 'ManageTeams');	
	}

	public function InviteTeamMemberForm() {
		$fields = new Fieldlist(
			TextField::create('Name[]', 'Name'), 
			EmailField::create('Email[]', 'Email')
		);

		$actions = new FieldList(
            FormAction::create("doInvite")
            	->setTitle("Invite new team members")
		);

        $form = new Form($this, 'InviteTeamMemberForm', $fields, $actions);
        $form->setTemplate('TeamInviteForm');

        return $form;
	}

	public function doInvite(Array $data, Form $form) {
		try {
			$teamID = Session::get('TeamID');
			if ($teamID) {
				$team = Team::get()->byID($teamID);
				if ($team) {
					if (count($data['Name']) > 0) {
						for ($i=0; $i < count($data['Name']); $i++) {
							$email = new Email();
							$email
								->setFrom('no-reply@ovitality.com')
								->setTo($data['Email'][$i])
								->setSubject('You have been invited to join ' . Member::currentUser()->FullName . ' team: ' . $team->Title)
								->setTemplate('CoachInvitationEmail')
								->populateTemplate(new ArrayData(array(
					        		'Logo' => SiteConfig::current_site_config()->Logo(),
					            	'Name' => $data['Name'][$i], 
					            	'Team' => $team,
					            	'Member' => Member::currentUser(), 
					            	'Link' => Member::currentUser()->getActiveChallengeReference()->getReferralSignupLink()
					            )));

							$email->send();
						}

						Session::set('SesFeedbackMessage', 'We have successfully sent your team invitation');
					}
				}
			}
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link() . 'ManageTeams');	
	}	

	public function FeedbackMessage() {
		$message = Session::get('FeedbackMessage');
		Session::clear('FeedbackMessage');
		return $message;
	}
}