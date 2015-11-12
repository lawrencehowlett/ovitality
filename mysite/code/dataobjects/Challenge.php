<?php
class Challenge extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text'
	);

	private static $has_many = array(
		'DailyChallenges' => 'DailyChallenge'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		$fields->dataFieldByName('DailyChallenges')
			->getConfig()
			->addComponent(new GridFieldSortableRows('SortOrder'));

		return $fields;
	}
}