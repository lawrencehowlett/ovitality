<?php
class ChallengeMembershipPlan extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Price' => 'Currency', 
		'Features' => 'HTMLText'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge', 
		'Level' => 'MembershipLevel'
	);

	private static $singular_name = 'Membership Plan';

	private static $plural_name = 'Membership Plans';

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
		$fields->dataFieldByName('Features')
			->setRows(20);

		$fields->insertBefore(
			'Features', 
			$fields->dataFieldByName('LevelID')
		);

		return $fields;
	}

	public function SelectMembershipPlanLink() {
		return Controller::join_links(
            MemberJoinChallengePlanPage::get()->First()->Link(),
            'SelectMembershipPlan',
            $this->ID
        );		
	}
}