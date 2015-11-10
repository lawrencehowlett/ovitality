<?php
class MemberExtension extends DataExtension {

	private static $db = array(
		'FreeTrialStartDate' => 'Date', 
		'Address' => 'Text', 
		'ReasonForJoining' => 'Text'
	);

	private static $has_one = array(
		'ProfileImage' => 'Image'
	);

	private static $belongs_many_many = array(
		'Teams' => 'Team'
	);

	public function updateMemberFormFields(FieldList $fields) {
		$fields->push(new TextareaField('Address', 'Address'));
		$fields->push(new TextareaField('ReasonForJoining', 'Reason for joining'));

		$fields->push(UploadField::create('ProfileImage', 'Profile image')->setFolderName('Members/ProfileImages'));
	}

	public function getFullName() {
		return $this->owner->FirstName . ' ' . $this->owner->Surname;
	}
}