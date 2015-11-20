<?php
/**
 * Represents the regional offices of the map
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class MapRegionalOffice extends DataObject {
	/**
	 * Set properties of db object
	 * 
	 * @var array
	 */
	private static $db = array(
		'Title' => 'Varchar', 
		'Content' => 'HTMLText',
		'GoogleMapLat' => 'Text',
		'GoogleMapLong' => 'Text',
		'SortOrder' => 'Int'
	);

	/**
	 * Set one relationship
	 * 
	 * @var array
	 */
	private static $has_one = array(
		'Map' => 'BlockMap'
	);

	/**
	 * Set default sort
	 * 
	 * @var string
	 */
	private static $default_sort = 'SortOrder';

	/**
	 * Set singular name
	 * 
	 * @var string
	 */
	private static $singular_name = 'Regional Office';

	/**
	 * Set plural name
	 * 
	 * @var string
	 */
	private static $plural_name = 'Regional Offices';

	/**
	 * Get CMS Fields
	 * 
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Branches');
		$fields->removeFieldsFromTab('Root.Main', array(
			'MapID', 
			'SortOrder',  
			'GoogleMapLat', 
			'GoogleMapLong')
		);

		$fields->dataFieldByName('Content')
			->setRows(20);

		// Google map
		$fields->addFieldToTab(
			'Root.GoogleMap', 
			TextField::create('GoogleMapLat', 'Latitude')
		);
		$fields->addFieldToTab(
			'Root.GoogleMap', 
			TextField::create('GoogleMapLong', 'Longitude')
		);

		return $fields;
	}	
}