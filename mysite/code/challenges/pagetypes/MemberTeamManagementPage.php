<?php
class MemberTeamManagementPage extends MemberPage {

	private static $icon = 'mysite/images/leadership-icon.png';
}

class MemberTeamManagementPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'TeamForm', 'SelectTeamMember', 'DeleteConfirmationForm', 'InviteTeamMemberForm', 'remove', 'leader', 'invite'
	);

	public function init() {
		parent::init();

		if (!$this->getTeam() || !Member::currentUser()->LeaderActiveTeam()) {
			$this->redirectBack();
		}
	}

	public function invite() {
		return $this->renderWith(array('MemberTeamManagementPage_invite', 'Page'));
	}

	public function leader(SS_HTTPRequest $request) {
		if ($request->param('ID') == 'nominate') {
			$teamMember = $this->getTeam()->Members()->filter('ID', $request->param('OtherID'));
			if ($teamMember->exists()) {
				$this->getTeam()->Leaders()->add($teamMember->First());
			}
		}

		if ($request->param('ID') == 'unassign') {

			$teamMember = $this->getTeam()->Leaders()->filter('ID', $request->param('OtherID'));
			if ($teamMember->exists()) {
				$this->getTeam()->Leaders()->removeByID($teamMember->First()->ID);
			}
		}

		return $this->renderWith(array('MemberTeamManagementPage_nominate', 'Page'));
	}

	public function remove(SS_HTTPRequest $request) {
		if ($request->param('ID') == 'confirm') {

			$teamMember = $this->getTeam()->Members()->filter('ID', $request->param('OtherID'));
			if ($teamMember->exists()) {
				Session::set('TeamMemberID', $teamMember->First()->ID);
			}

			return $this->renderWith(array('MemberTeamManagementPage_remove', 'Page'));
		}
	}

	public function TeamForm() {
		$fields = $this->getTeam()->getTeamFormFields();

        $actions = new FieldList(
            FormAction::create("doSave")
            	->setTitle("Save changes")
        );

        $required = new RequiredFields('Title', 'FacebookURL');
        $form = new Form($this, 'TeamForm', $fields, $actions, $required);
        $form
        	->setTemplate('TeamForm')
        	->loadDataFrom($this->getTeam());

        return $form;
	}

	public function doSave(Array $data, Form $form) {
		$team = $this->getTeam();
		$form->saveInto($team);

		try {
			if ($data['Limit'] < $team->Members()->Count()) {
				$form->sessionMessage('Number of members of the team should always be greater than or equal to current number of members', 'bad');
				return $this->redirectBack();
			} else {
				$team->write();
				$form->sessionMessage('Your team details have been updated.', 'good');
			}
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirectBack();	
	}

	public function DeleteConfirmationForm() {
		$fields = new FieldList(
			CheckboxField::create('RemoveTeamMemberConfirmation', "I understand this action can't be undone and our team will loose all this members points from our current challenge.")
		);

        $actions = new FieldList(
            FormAction::create("doRemove")
            	->setTitle("Yes, remove this member from my team.")
        );

        $required = new RequiredFields('RemoveTeamMemberConfirmation');
        $form = new Form($this, 'DeleteConfirmationForm', $fields, $actions, $required);

        return $form;
	}

	public function doRemove(Array $data, Form $form) {
		try {
			$this->getTeam()->Members()->removeByID(Session::get('TeamMemberID'));
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link());	
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
			if (count($data['Name']) > 0) {
				for ($i=0; $i < count($data['Name']); $i++) {
					$email = new Email();
					$email
						->setFrom('no-reply@ovitality.com')
						->setTo($data['Email'][$i])
						->setSubject('You have been invited to join the ' . Member::currentUser()->getActiveChallenge()->Title)
						->setTemplate('TeamInvitationEmail')
						->populateTemplate(new ArrayData(array(
			        		'Logo' => SiteConfig::current_site_config()->Logo(),
			            	'Name' => $data['Name'][$i], 
			            	'Challenge' => Member::currentUser()->getActiveChallenge()->Title,
			            	'Member' => Member::currentUser(), 
			            	'Link' => Member::currentUser()->getActiveChallengeReference()->getReferralSignupLink()
			            )));

					$email->send();
				}
			}
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect($this->Link());	
	}

	public function getTeam() {
		$member = Member::currentUser();
		if ($member) {
			return $member->getActiveTeam();
		}

		return null;
	}

	public function getTeamMember() {
		$id = Session::get('TeamMemberID');
		if ($id) {
			return Member::get()->byID($id);
		}

		return null;
	}
}