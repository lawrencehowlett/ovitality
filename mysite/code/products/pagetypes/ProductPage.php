<?php
class ProductPage extends Page {
	private static $icon = 'mysite/images/shopping-icon.png';
}

class ProductPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'product', 'category'
	);

	public function init() {
		parent::init();
	}

	public function index() {
		$this->products = $this->getProducts();
		return $this->render();
	}	

	public function product(SS_HTTPRequest $request) {
		$details = Product::get()->filter(array('URLSegment' => $request->param('ID')))->First();
		$data = array (
			'Title' => $details->Title, 
			'Content'   => $details->Content
		);

		return $this->customise($data)->renderWith(array('ProductPage_details', 'ProductPage', 'Page'));
	}

	public function category() {
		$category = $this->getCurrentCategory();
		if($category) {
			$this->products = $category->Products();
			return $this->render();
		}

		return $this->httpError(404, "Not Found");		
	}

	public function getProducts() {
		return Product::get();
	}

	public function PaginatedProducts() {
		$list = new PaginatedList($this->products, $this->getRequest());
		$list->setPageLength(15);

		return $list;
	}

	public function getCategories() {
		return ProductCategory::get();
	}

	public function getCurrentProduct() {
		$product = $this->request->param("ID");
		if($product) {
			return $this->getProducts()
				->filter("URLSegment", $product)
				->first();
		}

		return null;
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
