<?php
class MemberJoinChallengePage extends MemberPage {

	private static $icon = 'mysite/images/signing-icon.png';
}

class MemberJoinChallengePage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'team', 'individual', 'Form'
	);

	public function init() {
		parent::init();
	}

	public function Form() {
        $fields = new FieldList(
			DropdownField::create(
				'Motivation', 
				'What is your motivation', 
				array(
					'Abundant Choices' => 'Abundant Choices', 
					'Fear of Failure' => 'Fear of Failure', 
					'Fear of Success' => 'Fear of Success', 
					'Lack of Clarity' => 'Lack of Clarity', 
					'Exhaustion' => 'Exhaustion', 
					'Comparison' => 'Comparison', 
					'Excuses' => 'Excuses', 
					'Drudgery' => 'Drudgery', 
					'Patience' => 'Patience', 
					'Distractions' => 'Distractions'
				)
			)->setEmptyString('Motivation'), 
			CheckboxField::create('AutoAssignTeam', 'Yes please automatically assign me to a team.')
        );

        if ($this->IsTeam()) {
        	$fields->push(CheckboxField::create('JoinExistingTeam', 'Yes I want to join an existing team'));
        	$fields->push(AutoCompleteField::create('TeamID', 'Team', '', null, null, 'Team', 'Title'));
        	$fields->push(TextField::create('TeamName', 'Team name'));
        	$fields->push(TextField::create('TeamMemberName[]', 'Name'));
        	$fields->push(EmailField::create('TeamMemberEmail[]', 'Email'));
        }

        $actions = new FieldList(
            FormAction::create("doSubmit")
            	->setTitle("Proceed to next step")
        );

        $form = new Form($this, 'Form', $fields, $actions);
        return $form;		
	}

	public function doSubmit($data, Form $form) {
		$reference = new MemberChallengeReference();

		if (isset($data['AutoAssignTeam']) && $data['AutoAssignTeam']) {
			$reference->TeamAssignment = 'Auto';
			$team = Team::getAutoAllocationTeam();
			if ($team) {
				$reference->TeamID = $team->ID;
			}
		}

		$form->saveInto($reference);

		try {
			$reference->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		exit();

		return $this->redirect(MemberStartPage::get()->First()->Link());		
	}

	public function team(SS_HTTPRequest $request) {
		Session::set('EnteredChallenge', $this->getChallenge()->ID);
		return $this->renderWith(array('MemberJoinChallengePage_team', 'Page'));
	}

	public function individual(SS_HTTPRequest $request) {
		Session::set('EnteredChallenge', $this->getChallenge()->ID);
		return $this->renderWith(array('MemberJoinChallengePage_individual', 'Page'));
	}

	public function getChallenge() {
		return Challenge::get()->byID($this->request->param('ID'));
	}

	public function IsTeam() {
		if ($this->request->param('Action') == 'team') {
			return true;
		}

		return false;
	}

	public function IsIndividual() {
		if ($this->request->param('Action') == 'individual') {
			return true;
		}

		return false;		
	}
}