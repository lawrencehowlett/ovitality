<?php
/**
 * Represents the slider items
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Carousel extends DataObject {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Text', 
		'SortOrder' => 'Int'
	);	

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'CarouselParent' => 'BlockCarousel', 
		'RedirectPage' => 'SiteTree', 
		'Image' => 'Image'
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Carousel';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Carousels';

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

		$fields->removeFieldsFromTab('Root.Main', array('CarouselParentID', 'SortOrder'));

		$fields->replaceField('Title', TextField::create('Title', 'Title'));
		$fields->dataFieldByName('Image')
			->setFolderName('Carousels');

		$fields->replaceField(
			'RedirectPageID', 
			TreeDropdownField::create('RedirectPageID', 'Choose a redirect page', 'SiteTree')
		);

		return $fields;
	}
}