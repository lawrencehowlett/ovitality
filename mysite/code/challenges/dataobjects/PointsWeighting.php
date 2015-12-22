<?php
class PointsWeighting extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'Points' => 'Int'
	);

	private static $has_one = array(
		'DailyActivity' => 'DailyActivity'
	);

	private static $summary_fields = array(
		'Title' => 'Answer', 
		'Points' => 'Points'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();

		$fields->dataFieldByName('Title')
			->setTitle('Answer');

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('DailyActivityID')
		);

		return $fields;
	}
}