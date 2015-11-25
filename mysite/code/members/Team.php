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

	public function IsNotFull() {
		if ($this->Limit > $this->Members()->Count()) {
			return true;
		}

		return false;
	}
}