<?php
/**
 * Represents the page banner
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockBanner extends Block {

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'Image' => 'Image'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Banner';

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->insertAfter(
			$fields->dataFieldByName('Image')->setFolderName('Banners'), 
			'Content'
		);

		return $fields;
	}
}