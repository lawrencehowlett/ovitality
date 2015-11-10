<?php
class RecipeCategory extends DataObject {
	
	private static $db = array(
		"Title" => "Varchar(255)",
		'URLSegment' => 'Text', 
		'SortOrder' => 'Int'
	);

	private static $belongs_many_many = array(
		"Recipes" => "Recipe",
	);

	private static $singular_name = 'Category';

	private static $plural_name = 'Categories';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('Recipes');
		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('URLSegment', 'SortOrder')
		);

		return $fields;
	}

    public function onBeforeWrite() {
    	parent::onBeforeWrite();

		if (!$this->URLSegment) {
			$urlSegment = str_replace(' ', '-', strtolower(preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $this->Title)));
			$urlSegment = str_replace('%20', '', $urlSegment);
			$job = RecipeCategory::get()->filter(array('URLSegment' => $urlSegment))->First();
			if ($job) {
				$this->URLSegment .= $urlSegment . '-' . substr(md5(microtime()),rand(0,26),5);
			} else {
				$this->URLSegment .= $urlSegment;
			}
		}	
    }

	public function AbsoluteLink() {
		return Controller::join_links(RecipesPage::get()->First()->Link(), "category", $this->URLSegment);
	}
}
