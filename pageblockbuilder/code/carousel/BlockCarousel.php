<?php
/**
 * Represents the block widget slider
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class BlockCarousel extends Block {

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static  $has_many = array(
		'Carousels' => 'Carousel'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Carousel';

	/**
	 * Get CMS Fields
	 * 
	 * @return Fieldlist
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Carousels');

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'Carousels', 
				'Carousels', 
				$this->Carousels(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}