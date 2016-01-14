<?php
class BlockPrice extends Block{

	private static $has_many = array(
		'PriceTables' => 'PriceTable'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('PriceTables');
		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('BackgroundImage')
		);

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'PriceTables', 
				'Pricing PriceTables', 
				$this->PriceTables(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		return $fields;
	}

	public function getComponentTitle() {
		return 'Price box';
	}

}