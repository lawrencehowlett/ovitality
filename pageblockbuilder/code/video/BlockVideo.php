<?php
class BlockVideo extends Block {

	private static $db = array(
		'VideoURL' => 'Text', 
		'VideoChannel' => 'Enum(array("Vimeo", "Youtube"), "Vimeo")', 
		'ButtonText' => 'Varchar'
	);

	private static $has_one = array(
		'RedirectPage' => 'SiteTree'
	);

	private static $singular_name = 'Video Text';

	private static $plural_name = 'Video Text';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->replaceField(
			'VideoURL', 
			TextField::create('VideoURL', 'Video URL')
		);
		$fields->insertAfter(
			'Content', 
			$fields->dataFieldByName('VideoURL')
		);

		$fields->replaceField(
			'RedirectPageID', 
			TreedropdownField::create('RedirectPageID', 'Choose a redirect page', 'SiteTree')
		);

		$fields->insertAfter(
			'Content', 
			$fields->dataFieldByName('VideoChannel')
				->setEmptyString('select video channel')
		);

		$fields->insertAfter(
			'VideoURL', 
			$fields->dataFieldByName('ButtonText')
		);

		$fields->insertAfter(
			'ButtonText', 
			$fields->dataFieldByName('RedirectPageID')
		);

		return $fields;
	}	
}