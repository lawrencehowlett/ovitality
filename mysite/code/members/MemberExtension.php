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

	private static $has_many = array(
		'ChallengeReferences' => 'MemberChallengeReference'
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

	public function getActiveChallengeReference() {
		$reference = $this->owner->ChallengeReferences()->filter(array(
			'Status' => 'Active', 
			'PaymentStatus' => 'Paid'
		));

		if ($reference->exists()) {
			return $reference->First();
		}
	}

	public function getCompletedChallenges() {
		return $this->owner->ChallengeReferences()->filter(array(
			'Status' => 'Completed', 
			'PaymentStatus' => 'Paid'
		));
	}

	public function getActiveChallenge() {
		$reference = $this->owner->ChallengeReferences()->filter(array(
			'Status' => 'Active', 
			'PaymentStatus' => 'Paid'
		))->First();

		if ($reference) {
			return $reference->Challenge();
		}

		return null;
	}

	public function getActiveTeam() {
		$reference = $this->owner->ChallengeReferences()->filter(array(
			'Status' => 'Active', 
			'PaymentStatus' => 'Paid'
		))->First();

		if ($reference->exists()) {
			return $reference->Team();
		}

		return null;
	}

	public function getCoachTeams() {
		return Team::get()->filter(array('Coaches.ID' => $this->owner->ID));
	}

	public function LeaderActiveTeam() {
		$team = $this->getActiveTeam();
		$isLeader = $team->Leaders()->find('ID', $this->owner->ID);
		if ($isLeader) {
			return true;
		}

		return false;
	}

	/**
	 * @return bool
     */
	public function HasActiveChallenge() {
		$references = $this->owner->ChallengeReferences()->filter(array(
			'Status' => 'Active', 
			'PaymentStatus' => 'Paid'
		));

		if ($references->exists()) {
			return true;
		}

		return false;
	}

	/**
	 * @return bool
     */
	public function GetCurrentChallenge() {
//		get the current date.
		$date = new DateTime("Yesterday");
		$references = $this->owner->ChallengeReferences()->filter(array(
				'Status' => 'Active',
				'PaymentStatus' => 'Paid',
				'Challenge.StartDate:LessThan' => $date->format("Y-m-d"),
				'Challenge.EndDate:GreaterThan'    => $date->format("Y-m-d")
			)
		);

		if ($references->exists()) {
			return true;
		}

		return false;
	}

	/**
	 * @param null $optionalData
     */
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

	public function canAccess($RequiredLevel){
		$return = false;
		if ($this->owner->GetCurrentChallenge()){
			if ($this->owner->getActiveChallengeReference()->MembershipPlan()->Level()->Code == $RequiredLevel){
				$return = true;
			}
		}

		return $return;
	}

	public function IsLevelOneAccess() {
		if ($this->owner->HasActiveChallenge() && $this->owner->getActiveChallengeReference()->MembershipPlan()->Level()->Code == 'LEVEL_1') {
			return true;
		}

		return false;
	}	


	public function IsLevelTwoAccess() {
		if ($this->owner->HasActiveChallenge() && $this->owner->getActiveChallengeReference()->MembershipPlan()->Level()->Code == 'LEVEL_2') {
			return true;
		}

		return false;
	}

	public function IsLevelThreeAccess() {
		if ($this->owner->HasActiveChallenge() && $this->owner->getActiveChallengeReference()->MembershipPlan()->Level()->Code == 'LEVEL_3') {
			return true;
		}

		return false;
	}

	public function IsCoach() {
		$coachGroup = $this->owner->Groups()->filter(array('Code' => 'coach'));
		if ($coachGroup->exists()) {
			return true;
		}

		return false;
	}

	public function IsTeamLeader() {
		$teamLeadersGroup = $this->owner->Groups()->filter(array('Code' => 'team-leaders'));
		if ($teamLeadersGroup->exists()) {
			return true;
		}

		return false;
	}
}