<?php
/**
 * Represents the image block
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockImage extends Block {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Position' => "Enum(array('Left', 'Right', 'Left'))",
		'ButtonText' => 'Varchar'
	);

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static  $has_one = array(
		'RedirectPage' => 'SiteTree',
		'Image' => 'Image'
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Image Text';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Image Text';


	/**
	 * Get CMS Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->dataFieldByName('Content')
			->setRows(20);
		$fields->replaceField(
			'RedirectPageID', 
			TreeDropdownField::create('RedirectPageID', 'Choose a redirect page', 'SiteTree')
		);		

		$fields->dataFieldByName('Image')
			->setTitle('Featured Image')
			->setFolderName('BlockImage/');

		$fields->insertAfter($fields->dataFieldByName('Position')->setTitle('Image position'), 'Title');
		$fields->insertAfter($fields->dataFieldByName('Content'), 'Position');
		$fields->insertAfter($fields->dataFieldByName('Image'), 'Content');
		$fields->insertBefore($fields->dataFieldByName('ButtonText'), 'Image');
		$fields->insertBefore($fields->dataFieldByName('RedirectPageID'), 'Image');	

		return $fields;
	}

	/**
	 * Get component name
	 *
	 * @return  string
	 */
	public function ComponentName() {
		return 'Image text widget';
	}	
}