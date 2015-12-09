<?php
class Recipe extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Content' => 'HTMLText', 
		'URLSegment' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_many = array(
		'GalleryImages' => 'RecipeGalleryImage'
	);

	private static $many_many = array(
		'Categories' => 'RecipeCategory'
	);

	private static $singular_name = 'Recipe';

	private static $plural_name = 'Recipes';		

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

		if ($this->ID) {
			$fields->insertAfter(
				TagField::create(
					'Categories',
					'Categories',
					RecipeCategory::get(),
					$this->Categories()
				)->setShouldLazyLoad(true)->setCanCreate(true), 
				'Title'	
			);

			$gridFieldBulkUpload = new GridFieldBulkUpload();
			$gridFieldBulkUpload->setUfSetup('setFolderName', 'Recipes/' .$this->ID. '/GalleryImages/');
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
			$job = Recipe::get()->filter(array('URLSegment' => $urlSegment))->First();
			if ($job) {
				$this->URLSegment .= $urlSegment . '-' . substr(md5(microtime()),rand(0,26),5);
			} else {
				$this->URLSegment .= $urlSegment;
			}
		}	
    }

    public function AbsoluteLink() {
		return Controller::join_links(
            RecipesPage::get()->First()->Link(),
            'recipe',
            $this->URLSegment
        );
    }	
}