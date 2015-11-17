<?php
class MemberChallengeReference extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'Motivation' => 'Text', 
		'TeamAssignment' => 'Enum(array("Auto", "Manual", "New"), "Auto")', 
		'IndividualOrTeam' => 'Enum(array("Individual", "Team"), "Individual")'
	);

	private static $has_one = array(
		'Member' => 'Member', 
		'Team' => 'Team', 
		'Challenge' => 'Challenge'
	);

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		$this->Title = $this->IndividualOrTeam;
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('Title')
		);

		return $fields;
	}
}