<?php
/**
 * Represents the action boxes
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class ActionBox extends DataObject {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Text', 
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
		'ActionBoxParent' => 'BlockActionBox', 
		'RedirectPage' => 'SiteTree',
		"ActionBoxImage" => "Image"
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Action box';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Action boxes';

	/**
	 * Set default sort
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

		$fields->removeFieldsFromTab('Root.Main', array('ActionBoxParentID', 'SortOrder'));
		$fields->replaceField('Title', TextField::create('Title', 'Title'));
		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->dataFieldByName('ButtonText')
			->setTitle('Redirect button text');

		$fields->replaceField(
			'RedirectPageID', 
			TreedropdownField::create('RedirectPageID', 'Redirect page', 'SiteTree')
		);


		return $fields;
	}
}