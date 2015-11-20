<?php
/**
 * Represents the tabs
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class ContentTab extends DataObject {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Text', 
		'TabIcon' => 'Varchar', 
		'Content' => 'HTMLText', 
		'ButtonText' => 'Varchar', 
		'SortOrder' => 'Int'
	);	

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'TabParent' => 'BlockTab', 
		'RedirectPage' => 'SiteTree', 
		'Image' => 'Image'
	);

	/**
	 * Set singular 
	 * 
	 * @var string
	 */
	private static $singular_name = 'Tab item';

	/**
	 * Set plural
	 * 
	 * @var string
	 */
	private static $plural_name = 'Tab items';

	/**
	 * Set default sort order
	 * 
	 * @var string
	 */
	private static $default_sort = 'SortOrder';

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab('Root.Main', array('TabParentID', 'SortOrder'));
		$fields->replaceField('Title', TextField::create('Title', 'Title'));
		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->dataFieldByName('ButtonText')
			->setTitle('Redirect button text');
		$fields->replaceField(
			'RedirectPageID', 
			TreedropdownField::create('RedirectPageID', 'Redirect page', 'SiteTree')
		);
		$fields->dataFieldByName('Image')
			->setFolderName('Tabs/Images');

		return $fields;
	}
}