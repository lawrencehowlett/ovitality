<?php
class DailyActivitySelectionOption extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Points' => 'Int'
	);

	private static $has_one = array(
		'SelectionPoints' => 'DailyActivitySelectionPoints'
	);

	private static $summary_fields = array(
		'Title' => 'Answer', 
		'Points' => 'Points'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SelectionPointsID')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		return $fields;
	}
}