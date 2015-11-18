<?php
class SocialMediaService extends DataObject {

	private static $db = array(
		'Title' => 'Varchar', 
		'SocialMediaServices' => "Enum(array('Facebook', 'Twitter', 'Google+', 'Instagram', 'Vine', 'Youtube', 'LinkedIn', 'Pinterest', 'RSS'))",
		'ExternalURL' => 'Varchar(2083)', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'SiteConfig' => 'SiteConfig'
	);

	private static $singular_name = 'Social media service';

	private static $plural_name = 'Social media services';

	private static $default_sort = 'SortOrder';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('Title', 'SortOrder', 'SiteConfigID')
		);

		$fields->dataFieldByName('SocialMediaServices')
			->setEmptyString('select from our list of social media services');

		$fields->dataFieldByName('ExternalURL')
			->setTitle('Address');

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();

		$this->Title = $this->SocialMediaServices;
	}
}