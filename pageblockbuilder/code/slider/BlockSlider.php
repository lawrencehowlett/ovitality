<?php
/**
 * Represents the block widget slider
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockSlider extends Block {

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static  $has_many = array(
		'Sliders' => 'Slider'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Slider';

	/**
	 * Get CMS Fields
	 * 
	 * @return Fieldlist
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Sliders');

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'Sliders', 
				'Sliders', 
				$this->Sliders(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}