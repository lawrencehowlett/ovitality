<?php
class Accordion extends DataObject {

	private static $db = array(
		'Title' => 'Text',
		'Content' => 'HTMLText', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'AccordionParent' => 'BlockAccordion'
	);

	private static $singular_name = 'Accordion';

	private static $plural_name = 'Accordion';

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'AccordionParentID')
		);

		$fields->dataFieldByName('Content')
			->setRows(20);

		return $fields;
	}
}