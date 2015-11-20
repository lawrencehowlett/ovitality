<?php
class BlockGallery extends Block {

	private static $has_many = array(
		'Images' => 'ImageGallery'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Images');

		$gridFieldBulkUpload = new GridFieldBulkUpload();
		$gridFieldBulkUpload->setUfSetup('setFolderName', 'GalleryImages/');

		$fields->addFieldToTab(
			'Root.Main', 
			GridField::create(
				'Images', 
				'Images', 
				$this->Images(), 
				GridFieldConfig_RecordEditor::create()
					->addComponent(new GridFieldSortableRows('SortOrder'))
					->addComponent($gridFieldBulkUpload)

			)
		);

		return $fields;
	}
}