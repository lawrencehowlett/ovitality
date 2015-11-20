<?php
/**
 * Base class of page block
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class Block extends DataObject {

	/**
	 * Set properties
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'SortOrder' => 'Int'
	);

	/**
	 * Set has one
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'Page' => 'Page'
	);

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Block';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Blocks';

	/**
	 * Set default sort
	 * 
	 * @var string
	 */
	private static $default_sort = 'SortOrder';

	/**
	 * Set summary fields
	 * 
	 * @var array
	 */
	private static $summary_fields = array(
		'getComponentTitle' => 'Component', 
		'Title' => 'Title'
	);

	/**
	 * Get CMS fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('PageID', 'Title', 'Content', 'Code', 'SortOrder', 'BackgroundImage')
		);

		if (!$this->ID) {
			$fields->addFieldToTab(
				'Root.Main', 
				DropdownField::create(
					'ClassName', 
					'Widgets', 
					$this->getListComponents()
				)->setEmptyString('Choose a block to add')
			);
		} else {
			$fields->addFieldToTab(
				'Root.Main', 
				TextField::create('Title', 'Title')
			);

			$fields->addFieldToTab(
				'Root.Main', 
				HTMLEditorField::create('Content', 'Content')
					->setRows(20)
			);
		}

		return $fields;
	}

	/**
	 * Hook on before write
	 */
	public function onBeforeWrite() {
		parent::onBeforeWrite();

		if (!$this->Title) {
			$this->Title = 'New ' . strtolower(self::$singular_name);		
		}
	}

	/**
	 * Get the list of components
	 * 
	 * @return Array
	 */
	public function getListComponents() {
		$components = array(
			'BlockText' => 'Text',
			'BlockImage' => 'Image',
			'BlockVideo' => 'Video',
			'BlockTab' => 'Tabs',
			'BlockGallery' => 'Gallery',
			'BlockAccordion' => 'Accordion',
			'BlockForm' => 'Form', 
			'BlockMap' => 'Map', 
			'BlockSlider' => 'Slider', 
			'BlockCarousel' => 'Carousel', 
			'BlockActionBox' => 'Action Box', 
			'BlockSpinningBanner' => 'Spinning Banner', 
			'BlockBanner' => 'Banner', 
			'BlockPrice' => 'Price',
			'BlockTeam' => 'Team' 
		);

		$this->extend('updateListComponents', $components);

		asort($components);

		return $components;
	}
}