<?php
class ChallengeMembershipPlanFeature extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text'
	);

	private static $has_one = array(
		'MembershipPlan' => 'ChallengeMembershipPlan'
	);

	private static $singular_name = 'Feature';

	private static $plural_name = 'Features';

	public function getCMSFields() {
		$fields= parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('MembershipPlanID')
		);
		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}	
}