<?php
class MemberExtension extends DataExtension {

	private static $db = array(
		'FreeTrialStartDate' => 'Date', 
		'Phone' => 'Varchar', 
		'Address' => 'Text', 
		'ReasonForJoining' => 'Enum(array("On Radio", "Seminar", "Google / Web Search", "Television", "Other"))', 
		'ActivityNotification' => 'Boolean', 
		'NewsNotification' => 'Boolean'
	);

	private static $has_one = array(
		'ProfileImage' => 'Image'
	);

	private static $belongs_many_many = array(
		'Teams' => 'Team', 
		'Challenges' => 'Challenge'
	);

	public function updateMemberFormFields(FieldList $fields) {
		$fields->push(new TextareaField('Address', 'Address'));

		$fields->push(UploadField::create('ProfileImage', 'Profile image')->setFolderName('Members/' .$this->owner->ID. '/ProfileImages'));
	}

	public function getFullName() {
		return $this->owner->FirstName . ' ' . $this->owner->Surname;
	}

	public function getProfileFields() {
		$fields = new Fieldlist();
		$memberFields = $this->owner->getMemberFormFields();

		$fields->push($memberFields->dataFieldByName('FirstName'));
		$fields->push($memberFields->dataFieldByName('Surname'));
		$fields->push($memberFields->dataFieldByName('Email'));
		$fields->push($memberFields->dataFieldByName('Phone'));

		$uploadField = $memberFields->dataFieldByName('ProfileImage');
		$uploadField->canPreviewFolder = false;
		$fields->push($uploadField);

		return $fields;
	}

	public function getProfilePasswordFields() {
		$fields = new Fieldlist();
		$memberFields = $this->owner->getMemberFormFields();
		
		$password = $memberFields->dataFieldByName('Password');
		if ($password) {
			$password->setCanBeEmpty(false);
			$password->setValue(null);
			$password->setCanBeEmpty(true);
			$password->showOnClick = false;

			$fields->push($password);
		}

		return $fields;		
	}

	public function getProfileNotificationFields() {
		$fields = new Fieldlist();
		$memberFields = $this->owner->getMemberFormFields();

		$fields->push(
			$memberFields
				->dataFieldByName('ActivityNotification')
				->setTitle('Send me activity notification')
		);
		$fields->push(
			$memberFields
				->dataFieldByName('NewsNotification')
				->setTitle('Keep me up to date with new content')
		);

		return $fields;		
	}

	public function getRegisterFields() {
		$fields = new Fieldlist();
		$memberFields = $this->owner->getMemberFormFields();

		$fields->push($memberFields->dataFieldByName('FirstName'));
		$fields->push(
			$memberFields
				->dataFieldByName('Surname')
				->setTitle('Last Name')
		);
		$fields->push($memberFields->dataFieldByName('Email'));
		$fields->push(
			$memberFields
				->dataFieldByName('Phone')
				->setTitle('Phone Number (preferably a mobile phone)')
		);

		$fields->push(
			$memberFields
				->dataFieldByName('ReasonForJoining')
				->setTitle('How did you hear about us?')
				->setEmptyString('Select one')
		);

		$password = $memberFields->dataFieldByName('Password');
		if ($password) {
			$password->setCanBeEmpty(false);
			$password->setValue(null);
			$password->setCanBeEmpty(true);
			$password->showOnClick = false;

			$fields->push($password);
		}

		$fields->push(EmailField::create('EmailConfirm', 'Email (Again)'));
		
		return $fields;		
	}

	public function getProfileImageFields() {
		$fields = new Fieldlist();
		$memberFields = $this->owner->getMemberFormFields();
		
		$uploadField = $memberFields->dataFieldByName('ProfileImage');
		$uploadField->canPreviewFolder = false;
		$fields->push($uploadField);

		return $fields;		
	}

	public function IsFreeTrial() {
		$member = Member::currentUser();
		$freeTrialDate = new DateTime($member->FreeTrialStartDate);
		$nowDate = new DateTime();
		$difference = $nowDate->diff($freeTrialDate);

		if ($difference->format('%a') < 7) {
			return true;
		}

		return false;
	}

	public function HasCurrentChallenge() {
		return true;
	}

	public function sendWelcomeEmail($optionalData = null) {
		$email = new Email('no-reply@ovitality.com', $this->owner->Email, 'Welcome to OVitality', null);
		$email->setTemplate('WelcomeEmail');
		$email->populateTemplate($this->owner);
		$email->populateTemplate(array(
			'BaseURL' => Director::absoluteBaseURL(),
			'Logo' => SiteConfig::current_site_config()->Logo(), 
			'ContactNumber' => SiteConfig::current_site_config()->ContactNumber, 
			'DashboardPage' => MemberDashboardPage::get()->First()
		));

		if (count($optionalData)) {
			$email->populateTemplate($optionalData);
		}

		$email->send();
	}
}