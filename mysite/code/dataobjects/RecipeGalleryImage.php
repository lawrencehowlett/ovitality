<?php
class RecipeGalleryImage extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Recipe' => 'Recipe', 
		'Image' => 'Image'
	);

	private static $singular_name = 'Featured Image';

	private static $plural_name = 'Featured Images';	

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