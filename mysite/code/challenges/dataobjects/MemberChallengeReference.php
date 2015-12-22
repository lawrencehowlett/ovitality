<?php
class MemberChallengeReference extends DataObject {

	private static $db = array(
		'Title' => 'Varchar',  
		'Category' => 'Enum(array("Competitive", "Motivation"))', 
		'AutoAssignTeam' => 'Boolean', 
		'JoinExistingTeam' => 'Boolean', 
		'CreateNewTeam' => 'Boolean', 
		'IndividualOrTeam' => 'Enum(array("Individual", "Team"), "Individual")', 
		'Status' => 'Enum(array("Active", "Inactive", "Completed"), "Inactive")', 
		'PaymentStatus' => 'Enum(array("Pending", "Failed Payment", "Cancelled", "Paid"), "Pending")', 
		'ReferralCode' => 'Varchar'
	);

	private static $has_one = array(
		'Member' => 'Member', 
		'Team' => 'Team', 
		'Challenge' => 'Challenge', 
		'MembershipPlan' => 'ChallengeMembershipPlan'
	);

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		$this->Title = $this->IndividualOrTeam;
		if (!$this->ID) {
			$randGen = new RandomGenerator();
			$this->ReferralCode = substr($randGen->randomToken(), 100);
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('Title')
		);

		return $fields;
	}

	public function getReferenceFields() {
		$fields = parent::getFrontendFields();

		$fields->dataFieldByName('Category')
			->setTitle('What is your motivation?')
			->setEmptyString('Select one');
		$fields->dataFieldByName('AutoAssignTeam')
			->setTitle('Yes please automatically assign me to a team');
		$fields->dataFieldByName('JoinExistingTeam')
			->setTitle('Yes I want to join an existing team');

		$fields->removeByName('Title');
		$fields->removeByName('IndividualOrTeam');
		$fields->removeByName('MemberID');
		$fields->removeByName('TeamID');
		$fields->removeByName('ChallengeID');
		$fields->removeByName('CreateNewTeam');
		$fields->removeByName('Status');
		$fields->removeByName('PaymentStatus');
		$fields->removeByName('MembershipPlanID');

		return $fields;
	}

	public function IsJoiningIndividual() {
		if (!$this->AutoAssignTeam && !$this->JoinExistingTeam && !$this->CreateNewTeam) {
			return true;
		}

		return false;
	}

	public function getReferralSignupLink() {
		return Controller::join_links(
            SignupReferralPage::get()->First()->Link(),
            'code',
            $this->ReferralCode
        );
	}

	public function HasActiveChallenge() {
		return ($this->Status == 'Active') ? true : false; 
	}

	public function IsIndividual() {
		if ($this->IndividualOrTeam == 'Individual') {
			return true;
		}

		return false;
	}

	public function IsTeam() {
		if ($this->IndividualOrTeam == 'Team') {
			return true;
		}

		return false;
	}

}