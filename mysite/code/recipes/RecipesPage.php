<?php
class RecipesPage extends Page {

	private static $icon = 'mysite/images/recipes-icon.png';
}

class RecipesPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'recipe', 'category'
	);

	public function init() {
		parent::init();

		if (Member::currentUser()) {
			if (!Member::currentUser()->IsLevelTwoAccess() && !Member::currentUser()->IsLevelThreeAccess()) {
				$this->redirect(MemberDashboardPage::get()->First()->Link());
			}
		} else {
			Security::permissionFailure();
		}

		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
			    	$('#RecipeCategorySelection').change(function(){
			    		window.location = $(this).val();
			    	});
			    });
			})(jQuery);
JS
		);
	}

	public function index() {
		$this->recipes = $this->getRecipes();
		return $this->render();
	}	

	public function recipe(SS_HTTPRequest $request) {
		$details = Recipe::get()->filter(array('URLSegment' => $request->param('ID')))->First();
		$data = array (
			'Title' => $details->Title, 
			'Content'   => $details->Content, 
			'RecipeCategories' => $details->Categories(),
			'GalleryImages' => $details->GalleryImages()
		);

		return $this->customise($data)->renderWith(array('RecipesPage_details', 'RecipesPage', 'Page'));
	}

	public function category() {
		$category = $this->getCurrentCategory();
		if($category) {
			$this->recipes = $category->Recipes();
			return $this->render();
		}

		return $this->httpError(404, "Not Found");		
	}

	public function getRecipes() {
		return Recipe::get();
	}

	public function PaginatedRecipes() {
		$list = new PaginatedList($this->recipes, $this->getRequest());
		$list->setPageLength(15);

		return $list;
	}

	public function getCategories() {
		return RecipeCategory::get();
	}

	public function getCurrentCategory() {
		$category = $this->request->param("ID");
		if($category) {
			return $this->getCategories()
				->filter("URLSegment", $category)
				->first();
		}
		return null;
	}	
}
