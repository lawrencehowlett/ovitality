<?php
class Team extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text', 
		'Limit' => 'Int', 
		'FacebookURL' => 'Text', 
		'Type' => 'Enum(array("Competitive", "Motivation"), "Competitive")'
	);

	private static $has_one = array(
		'TeamLeader' => 'Member', 
		'Challenge' => 'Challenge'
	);

	private static $many_many = array(
		'Members' => 'Member'
	);

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID')
		);
		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}

	public function getTeamFormFields() {
		$fields = parent::getFrontendFields();

		$fields->removeByName('Limit');
		$fields->removeByName('TeamLeaderID');
		$fields->removeByName('ChallengeID');
		$fields->removeByName('Type');

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Team Name')
		);

		$fields->replaceField(
			'FacebookURL', 
			TextField::create('FacebookURL', 'Team Facebook Group URL')
		);

		return $fields;
	}

	public function getTeamMembers() {
		return $this->Members()->exclude('ID', Member::currentUserID());
	}

	public function IsNotFull() {
		if (!$this->Limit) {
			return true;
		}

		if ($this->Limit > $this->Members()->Count()) {
			return true;
		}

		return false;
	}

	public function getTeamManagementLink() {
		return Controller::join_links(
            MemberTeamManagementPage::get()->First()->Link()
        );		
	}
}