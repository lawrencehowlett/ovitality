<?php
class MembershipLevel extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text', 
		'Code' => 'Varchar'
	);

	private static $has_many = array(
		'MembershipPlan' => 'ChallengeMembershipPlan'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}
}