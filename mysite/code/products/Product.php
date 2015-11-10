<?php
class Product extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'PurchaseLink' => 'Text', 
		'Content' => 'HTMLText', 
		'URLSegment' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_many = array(
		'GalleryImages' => 'ProductGalleryImage'
	);

	private static $many_many = array(
		'Categories' => 'ProductCategory'
	);

	private static $singular_name = 'Product';

	private static $plural_name = 'Product';		

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Categories');
		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('SortOrder', 'URLSegment')
		);

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Title')
		);

		$fields->dataFieldbyName('Content')
			->setRows(20);

		$fields->replaceField(
			'PurchaseLink', 
			TextField::create('PurchaseLink', 'Purchase Link')
		);

		if ($this->ID) {
			$fields->insertAfter(
				TagField::create(
					'Categories',
					'Categories',
					ProductCategory::get(),
					$this->Categories()
				)->setShouldLazyLoad(true)->setCanCreate(true), 
				'Title'	
			);

			$gridFieldBulkUpload = new GridFieldBulkUpload();
			$gridFieldBulkUpload->setUfSetup('setFolderName', 'Products/' .$this->ID. '/GalleryImages/');
			$fields->dataFieldByName('GalleryImages')
				->getConfig()
				->addComponent(new GridFieldSortableRows('SortOrder'))
				->addComponent($gridFieldBulkUpload);
		}

		return $fields;
	}

    public function onBeforeWrite() {
    	parent::onBeforeWrite();

		if (!$this->URLSegment) {
			$urlSegment = str_replace(' ', '-', strtolower(preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $this->Title)));
			$urlSegment = str_replace('%20', '', $urlSegment);
			$job = Product::get()->filter(array('URLSegment' => $urlSegment))->First();
			if ($job) {
				$this->URLSegment .= $urlSegment . '-' . substr(md5(microtime()),rand(0,26),5);
			} else {
				$this->URLSegment .= $urlSegment;
			}
		}	
    }

    public function AbsoluteLink() {
		return Controller::join_links(
            ProductPage::get()->First()->Link(),
            'product',
            $this->URLSegment
        );
    }	
}