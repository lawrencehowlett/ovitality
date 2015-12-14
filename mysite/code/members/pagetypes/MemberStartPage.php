<?php
class MemberStartPage extends MemberPage {

	private static $db = array(
		'FeaturedVideo' => 'Varchar'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab(
			'Root.Main', 
			TextField::create('FeaturedVideo')
		);

		return $fields;
	}
}

class MemberStartPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'ProfileImageForm'
	);

	public function init() {
		parent::init();
	}

	public function ProfileImageForm() {
		$member = Member::currentUser(); 
		$form = new Form (
			$this,
			'ProfileImageForm',
			$member->getProfileImageFields(),
			new FieldList(
				new FormAction('updateImage', 'Save and upload')
			)
		);
		$form->loadDataFrom($member);
		$form->setTemplate('ProfileImageForm');

		return $form;		
	}

	public function updateImage($data, Form $form) {
		if (!$data['ProfileImage']['size']['Uploads'][0]) {
			$form->Fields()->removeByName('ProfileImage');
		}

		$member = Member::currentUser();

		$form->saveInto($member);

		try {
			$member->write();
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		$form->sessionMessage (
			'Your profile image has been updated.',
			'good'
		);

		return $this->redirectBack();	
	}

	public function getChallenges() {
		return Challenge::getInProgressChallenges();
	}
} 