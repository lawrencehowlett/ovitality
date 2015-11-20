<?php

class ImageGallery extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Block' => 'BlockGallery', 
		'Image' => 'Image'
	);

	private static $singular_name = 'Gallery image';

	private static $plural_name = 'Gallery images';

	private static $default_sort = 'SortOrder';

	private static $summary_fields = array(
		'Thumbnail' => 'Image', 
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'BlockID', 'Image')
		);
		$fields->replaceField('Title', TextField::create('Title', 'Title'));
		$fields->dataFieldByName('Content')
			->setRows(20);

		if ($this->ID) {
			$fields->insertAfter(
				UploadField::create('Image', 'Image')
					->setFolderName('GalleryImages/'), 
				'Content'
			);
		}

		return $fields;
	}

	public function Thumbnail() {
		return $this->Image()->CMSThumbnail();
	}
}