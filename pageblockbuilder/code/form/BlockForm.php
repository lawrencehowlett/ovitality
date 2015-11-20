<?php
/**
 * Represents the block form
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockForm extends Block {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Form';	

	/**
	 * Get CMS Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		return $fields;
	}
}