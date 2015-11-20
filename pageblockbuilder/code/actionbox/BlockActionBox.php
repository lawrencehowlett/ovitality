<?php
/**
 * Represents the action box block
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockActionBox extends Block {

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Action Box';

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static  $has_many = array(
		'ActionBoxes' => 'ActionBox'
	);

	/**
	 * Get Cms fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('ActionBoxes');

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('Content')
		);

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'ActionBoxes', 
				'Action Boxes', 
				$this->ActionBoxes(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}