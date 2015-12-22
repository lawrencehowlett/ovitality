<?php
class DailyActivityBooleanPoints extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Answer' => 'Enum(array("Yes", "No"))', 
		'Points' => 'Int'
	);

	private static $has_one = array(
		'DailyActivity' => 'DailyActivity'
	);

	private static $summary_fields = array(
		'Title' => 'Title', 
		'Points' => 'Allocated Points'
	);

	private static $singular_name = 'Boolean points';

	private static $plural_name = 'Boolean points';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('DailyActivityID')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Question')
		);

		$fields->dataFieldByName('Answer')
			->setEmptyString('Select one');

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		if (!$this->Title) {
			$this->Title = 'Question answerable by yes or no.';
		}
	}
}