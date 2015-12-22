<?php
class DailyActivityNumberPoints extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'MaxPoints' => 'Int'
	);

	private static $has_one = array(
		'DailyActivity' => 'DailyActivity'
	);

	private static $singular_name = 'Number points';

	private static $plural_name = 'Number points';

	private static $summary_fields = array(
		'Title' => 'Question'
	);

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

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		if (!$this->Title) {
			$this->Title = $this->DailyActivity()->Title;
		}
	}
}