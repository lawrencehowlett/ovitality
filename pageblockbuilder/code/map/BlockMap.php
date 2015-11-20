<?php
class BlockMap extends Block {

	private static $has_one = array(
		'Marker' => 'Image', 
	);

	private static $has_many = array(
		'RegionalOffices' => 'MapRegionalOffice'
	);

	/**
	 * Get component title
	 * 
	 * @var string
	 */
	protected $component_title = 'Map';	

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('RegionalOffices');
		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'RegionalOffices', 
				'Regional Offices', 
				$this->RegionalOffices(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
			)
		);

		$fields->insertAfter(
			$fields->dataFieldByName('Marker')
				->setFolderName('BlockMap'), 
				'Content'
		);

		return $fields;
	}
}