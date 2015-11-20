<?php
class PriceTable extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Price' => 'Varchar',
		'Content' => 'HTMLText', 
		'ButtonText' => 'Varchar', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Block' => 'BlockPrice',
		'RedirectPage' => 'SiteTree'
	);

	private static $singular_name = 'Price table';

	private static $plural_name = 'Price tables';

	private static $default_sort = 'SortOrder';

	private static $summary_fields = array(
		'Title'
	);	

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'BlockID')
		);	

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);
		$fields->dataFieldByName('Content')
			->setRows(20);

		$fields->replaceField(
			'RedirectPageID', 
			TreeDropdownField::create('RedirectPageID', 'Choose a redirect page', 'SiteTree')
		);

		return $fields;
	}
}