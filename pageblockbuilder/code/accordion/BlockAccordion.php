<?php
class BlockAccordion extends Block {

	private static $has_many = array(
		'Accordions' => 'Accordion'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Action Box';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Accordions');

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'Accordions', 
				'Accordions', 
				$this->Accordions(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}
}