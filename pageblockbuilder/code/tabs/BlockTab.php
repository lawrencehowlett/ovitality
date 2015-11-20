<?php
/**
 * Represents the tab block widget
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockTab extends Block {

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static  $has_many = array(
		'Tabs' => 'ContentTab'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Tabs';	

	/**
	 * Get CMS Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Tabs');

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('BackgroundImage')
		);

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'Tabs', 
				'Tabs', 
				$this->Tabs(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}