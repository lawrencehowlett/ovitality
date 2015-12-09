<?php
class DailyActivity extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'Type' => 'Enum(array("Slider", "Number", "Boolean"))', 
		'Points' => 'Int'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge'
	);

	private static $has_many = array(
		'GalleryImages' => 'DailyActivityGalleryImage'
	);	

	private static $belongs_many_many = array(
		'DailyChallenges' => 'DailyChallenge'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID')
		);
		$fields->removeByName('DailyChallenges');
		$fields->removeByName('DailyActivityImages');

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->dataFieldByName('Type')
			->setEmptyString('Select one');

		if ($this->ID) {
			$gridFieldBulkUpload = new GridFieldBulkUpload();
			$gridFieldBulkUpload->setUfSetup('setFolderName', 'Challenge/' .$this->Challenge()->ID. '/DailyActivities/' . $this->ID . '/Images');
			$fields->dataFieldByName('GalleryImages')
				->getConfig()
				->addComponent(new GridFieldSortableRows('SortOrder'))
				->addComponent($gridFieldBulkUpload);
		}

		return $fields;
	}
}