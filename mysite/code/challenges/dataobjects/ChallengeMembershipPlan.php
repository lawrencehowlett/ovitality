<?php
class ChallengeMembershipPlan extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Price' => 'Currency'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge'
	);

	private static $has_many = array(
		'Features' => 'ChallengeMembershipPlanFeature'
	);

	public function getCMSFields() {
		$fields= parent::getCMSFields();

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
}