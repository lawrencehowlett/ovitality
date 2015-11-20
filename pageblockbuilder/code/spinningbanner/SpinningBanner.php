<?php
/**
 * Represents the spinning banners
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class SpinningBanner extends DataObject {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'HTMLText', 
		'RedirectButtonText' => 'Varchar',
		'SortOrder' => 'Int'
	);

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'SpinningBannerParent' => 'BlockSpinningBanner', 
		'RedirectPage' => 'SiteTree', 
		'Image' => 'Image'
	);

	/**
	 * Set default sort 
	 * 
	 * @var string
	 */
	private static $default_sort = 'SortOrder';

	/**
	 * Set summary fields
	 * 
	 * @var array
	 */
	private static $summary_fields = array(
		'Thumbnail' => 'Image', 
		'Title' => 'Title'
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Spinning Banner';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Spinning Banners';

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SpinningBannerParentID', 'SortOrder')
		);

		$fields->dataFieldByName('Title')
			->setRows(2);
		$fields->dataFieldByName('Description')
			->setRows(20);
		$fields->dataFieldByName('Image')
			->setFolderName('SpinningBanners/');
		$fields->dataFieldByName('RedirectButtonText')
			->setTitle('Redirect button text');
		$fields->replaceField(
			'RedirectPageID', 
			TreeDropdownField::create('RedirectPageID', 'Redirect Page', 'SiteTree')
		);

		return $fields;
	}

	/**
	 * Get CMS thumbnail
	 * 
	 * @return Image
	 */
	public function getThumbnail() {
		return $this->Image()->CMSThumbnail();
	}
}