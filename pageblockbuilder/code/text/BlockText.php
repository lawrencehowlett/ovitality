<?php
/**
 * Represents the block widget text with title
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius Caamic
 */
class BlockText extends Block {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'ButtonText' => 'Varchar'
	);

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'RedirectPage' => 'SiteTree'
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Text';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Text';

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Text';	

	/**
	 * Get CMS Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->insertAfter(
			$fields->dataFieldByName('ButtonText'), 
			'Content'
		);
		$fields->insertAfter(
			$fields->dataFieldByName('RedirectPageID'), 
			'ButtonText'
		);

		$fields->dataFieldByName('Content')
			->setRows(20);

		$fields->replaceField(
			'RedirectPageID', 
			TreedropdownField::create('RedirectPageID', 'Choose a redirect page', 'SiteTree')
		);

		return $fields;
	}
}