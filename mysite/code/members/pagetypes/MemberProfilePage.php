<?php
class MemberProfilePage extends MemberPage {

	private static $icon = 'mysite/images/profile-icon.png';
}

class MemberProfilePage_Controller extends MemberPage_Controller {
	
	private static $allowed_actions = array(
		'ProfileForm', 
		'ProfilePasswordForm', 
		'ProfileNotificationForm'
	);

	public function init() {
		parent::init();
	}

	public function ProfileForm() {
		$member = Member::currentUser(); 
		$form = new Form (
			$this,
			'ProfileForm',
			$member->getProfileFields(),
			new FieldList(
				new FormAction('updateProfile', 'Save Profile Changes')
			)
		);
		$form->loadDataFrom($member);

		return $form;		
	}

	public function updateProfile($data, Form $form) {
		$member = Member::currentUser();

		$form->saveInto($member);

		try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		$form->sessionMessage (
			'Your profile has been updated.',
			'good'
		);

		return $this->redirectBack();	
	}

	public function ProfilePasswordForm() {
		$member = Member::currentUser(); 
		$form = new Form (
			$this,
			'ProfilePasswordForm',
			$member->getProfilePasswordFields(),
			new FieldList(
				new FormAction('updatePassword', 'Save password')
			)
		);

		$form->loadDataFrom($member);

		return $form;		
	}

	public function updatePassword($data, Form $form) {
		$member = Member::currentUser();

		$form->saveInto($member);

		try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		$form->sessionMessage (
			'Your password has been updated.',
			'good'
		);

		return $this->redirectBack();	
	}

	public function ProfileNotificationForm() {
		$member = Member::currentUser(); 
		$form = new Form (
			$this,
			'ProfileNotificationForm',
			$member->getProfileNotificationFields(),
			new FieldList(
				new FormAction('updatePreferences', 'Save Preferences')
			)
		);
		$form->loadDataFrom($member);

		return $form;		
	}

	public function updatePreferences($data, Form $form) {
		$member = Member::currentUser();

		$form->saveInto($member);

		try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		$form->sessionMessage (
			'Your preferences has been updated.',
			'good'
		);

		return $this->redirectBack();	
	}
} 