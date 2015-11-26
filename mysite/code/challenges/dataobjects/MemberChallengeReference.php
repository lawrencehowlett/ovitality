<?php
class MemberChallengeReference extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'Category' => 'Text', 
		'AutoAssignedTeam' => 'Boolean', 
		'ManuallyJoinedTeam' => 'Boolean', 
		'CreatedTeam' => 'Boolean', 
		'IndividualOrTeam' => 'Enum(array("Individual", "Team"), "Individual")'
	);

	private static $has_one = array(
		'Member' => 'Member', 
		'Team' => 'Team', 
		'Challenge' => 'Challenge', 
		'MembershipPlan' => 'MembershipPlan'
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

	public function getReferenceFields() {
		$fields = parent::getFrontendFields();

		return $fields;
	}
}