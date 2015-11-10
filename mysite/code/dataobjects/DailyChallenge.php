<?php
class DailyChallenge extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text', 
		'Type' => 'Enum(array("slider", "number", "yesorno", "slider"))',
		'Points' => 'Int', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge'
	);

	private static $has_many = array(
		'FeaturedImages' => 'DailyChallengeImage'
	);

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID', 'SortOrder')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		$fields->dataFieldByName('Type')
			->setEmptyString('choose a type');

		if ($this->ID) {
			$gridFieldBulkUpload = new GridFieldBulkUpload();
			$gridFieldBulkUpload->setUfSetup('setFolderName', 'Challenges/' . $this->Challenge()->ID . '/DailyChallenges/' . $this->ID . '/Images');
			$fields->dataFieldByName('FeaturedImages')
				->getConfig()
				->addComponent(new GridFieldSortableRows('SortOrder'))
				->addComponent($gridFieldBulkUpload);
		}

		return $fields;
	}
}