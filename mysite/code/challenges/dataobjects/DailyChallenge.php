<?php
class DailyChallenge extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'Date' => 'Date'
	);

	private static $has_one = array(
		'Challenge' => 'Challenge', 
		'Image' => 'Image'
	);

	private static $many_many = array(
		'DailyActivities' => 'DailyActivity'
	);

	private static $many_many_extraFields = array(
		'DailyActivities' => array('SortOrder' => 'Int')
	);

	private static $default_sort = 'Date ASC';

	/**
	 * Get CM Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('ChallengeID')
		);
		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);
		$fields->dataFieldByName('Content')
			->setRows(20);

		$fields->dataFieldByName('Date')
			->setConfig('showcalendar', true)
			->setConfig('dateformat', 'dd/MM/YYYY')
			->setTitle('Choose the date of the challenge');

		if (!$this->ID) {
			$fields->removeFieldsFromTab(
				'Root.Main', 
				array('ChallengeID', 'Image', 'Description', 'Type', 'Points')
			);
		} else {

			$fields->dataFieldByName('Image')
				->setFolderName('Challenge/' . $this->ChallengeID . '/DailyChallenges/');
			
			$config = $fields->dataFieldByName('DailyActivities')->getConfig();
			$autoCompleterField = $config->getComponentByType('GridFieldAddExistingAutocompleter');
			$autoCompleterField->setSearchList($this->Challenge()->DailyActivities());

			$fields->dataFieldByName('DailyActivities')
				->getConfig()
				->addComponent(new GridFieldSortableRows('SortOrder'));
		}

		return $fields;
	}

	public function DailyActivities() {
		return $this->getManyManyComponents('DailyActivities')->sort('SortOrder');
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();
	}
}