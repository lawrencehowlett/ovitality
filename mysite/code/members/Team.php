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
		'TeamLeader' => 'Member'
	);

	private static $many_many = array(
		'Members' => 'Member'
	);

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}

	public static function getAutoAllocationTeam() {
		$teams = Team::get()->sort('Created ASC');
		if ($teams) {
			foreach ($teams as $team) {
				if ($team->IsNotFull()) {
					return $team;
				}
			}
		}

		return null;
	}

	public function IsNotFull() {
		if ($this->Limit > $this->Members()->Count()) {
			return true;
		}

		return false;
	}
}