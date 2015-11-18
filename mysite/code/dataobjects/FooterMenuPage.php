<?php
class FooterMenuPage extends DataObject {

	private static $db = array(
		'Title' => 'Text',
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Menu' => 'FooterMenu',
		'Page' => 'SiteTree'
	);

	private static $summary_fields = array(
		'Page.Title' => 'Title'
	);

	private static $singular_name = 'Menu page';

	private static $plural_name = 'Menu pages';	

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'MenuID', 'Title')
		);

		$fields->replaceField(
			'PageID', 
			TreeDropdownField::create("PageID", "Choose a page:", "SiteTree")
		);

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		$this->Title = $this->Page()->Title;
	}
}