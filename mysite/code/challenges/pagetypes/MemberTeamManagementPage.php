<?php
class MemberTeamManagementPage extends MemberPage {

	private static $icon = 'mysite/images/leadership-icon.png';
}

class MemberTeamManagementPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'TeamForm', 'invite'
	);

	public function init() {
		parent::init();

		if (!$this->getTeam()) {
			$this->redirectBack();
		}
	}

	public function invite() {
		return $this->renderWith(array('MemberTeamManagementPage_invite', 'Page'));
	}

	public function remove() {
		
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
			$team->write();
			$form->sessionMessage('Your team details have been updated.', 'good');
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirectBack();	
	}

	public function getTeam() {
		return Member::currentUser()->getActiveTeam();
	}
}