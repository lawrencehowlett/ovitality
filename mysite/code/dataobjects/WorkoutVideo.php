<?php
class WorkoutVideo extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Link' => 'Text', 
		'Content' => 'HTMLText', 
		'URLSegment' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'FeaturedImage' => 'Image'
	);

	private static $many_many = array(
		'Categories' => 'WorkoutVideoCategory'
	);

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	private static $singular_name = 'Video';

	private static $plural_name = 'Videos';	

    public function getCMSFields() {
    	$fields = parent::getCMSFields();

    	$fields->removeByName('Categories');
    	$fields->removeFieldsFromTab(
    		'Root.Main', 
    		array('SortOrder', 'URLSegment', 'FeaturedImage')
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
					WorkoutVideoCategory::get(),
					$this->Categories()
				)->setShouldLazyLoad(true)->setCanCreate(true), 
				'Title'	
			);

			$fields->insertAfter(
				UploadField::create('FeaturedImage')
					->setFolderName('WorkoutVideos/' . $this->ID . '/FeatuedImages/'), 
				'Content'
			);
		}
    	
    	return $fields;
    }

    public function onBeforeWrite() {
    	parent::onBeforeWrite();

		if (!$this->URLSegment) {
			$urlSegment = str_replace(' ', '-', strtolower(preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $this->Title)));
			$urlSegment = str_replace('%20', '', $urlSegment);
			$job = WorkoutVideo::get()->filter(array('URLSegment' => $urlSegment))->First();
			if ($job) {
				$this->URLSegment .= $urlSegment . '-' . substr(md5(microtime()),rand(0,26),5);
			} else {
				$this->URLSegment .= $urlSegment;
			}
		}	
    }

    public function AbsoluteLink() {
		return Controller::join_links(
            WorkoutVideoPage::get()->First()->Link(),
            'video',
            $this->URLSegment
        );
    }
}