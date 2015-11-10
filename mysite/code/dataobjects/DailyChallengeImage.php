<?php
class DailyChallengeImage extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'DailyChallenge' => 'DailyChallenge', 
		'Image' => 'Image'
	);

	private static $singular_name = 'Gallery Image';

	private static $plural_name = 'Gallery Images';	

	private static $default_sort = 'SortOrder';

	private static $summary_fields = array(
		'Thumbnail' => 'Thumbnail', 
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('RecipeID')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);		

		return $fields;
	}

	public function Thumbnail() {
		return $this->Image()->CMSThumbnail();
	}
}