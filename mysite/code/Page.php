<?php
/**
 * Represents the page
 * 
 * @author Julius <julius.caamic@yahoo.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Page extends SiteTree {}

/**
 * Represents the page controller
 * 
 * @author Julius <julius.caamic@yahoo.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Page_Controller extends ContentController implements PermissionProvider {

	private static $allowed_actions = array(
		'RegisterForm'
	);

	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();
	}

	/**
	 * Provide permission
	 * 
	 * @return array
	 */
	public function providePermissions() {
		return array(
			'COACH' => 'Can be part of one team, and be a team leader of that team. Can also coach many teams.', 
			'TEAM_LEADER' => 'Can create a team & nominate new team leader', 
			'LEVEL_1' => 'Limited content access', 
			'LEVEL_2' => 'Points + Recipes', 
			'LEVEL_3' => 'Points + Recipes + Workout videos'
		);
	}

	public function RegisterForm() {
		$form = new Form (
			$this,
			'RegisterForm',
			singleton('Member')->getRegisterFields(),
			new FieldList(
				new FormAction('register', 'Join Now')
			)
		);

		return $form;		
	}

	public function register($data, Form $form) {
		$member = new Member();
		$form->saveInto($member);

		try {
			$member->write();
			$member->login();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirect(MemberStartPage::get()->First()->Link());	
	}	
}
