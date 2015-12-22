<?php
class DailyActivity extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Type' => 'Enum(array("Slider", "Number", "Boolean"))'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge'
	);

	private static $has_many = array(
		'Points' => 'PointsWeighting'
	);	

	private static $belongs_many_many = array(
		'DailyChallenges' => 'DailyChallenge'
	);

	private static $singular_name = 'Daily Activity';

	private static $plural_name = 'Daily Activities';	

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID', 'BooleanPointsID')
		);
		$fields->removeByName('DailyChallenges');
		$fields->removeByName('Points');
		$fields->removeByName('BooleanPoints');
		$fields->removeByName('SelectionPoints');
		$fields->removeByName('NumberPoints');

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Question')
		);

		$fields->dataFieldByName('Type')
			->setEmptyString('Select one');

		if ($this->ID) {
			$fields->insertAfter(
				GridField::create('Points', 'Points', $this->Points(), GridFieldConfig_RecordEditor::create()), 
				'Type'
			);
		}

		return $fields;
	}
}