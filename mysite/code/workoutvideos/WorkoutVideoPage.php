<?php
class WorkoutVideoPage extends Page {

	private static $icon = 'mysite/images/video-icon.png';
}
class WorkoutVideoPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'video', 'category'
	);

	public function init() {
		parent::init();
		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
			    	$('#VideoCategorySelection').change(function(){
			    		window.location = $(this).val();
			    	});
			    });
			})(jQuery);
JS
		);		
	}

	public function index() {
		$this->videos = $this->getVideos();
		return $this->render();
	}

	public function video(SS_HTTPRequest $request) {
		$details = WorkoutVideo::get()->filter(array('URLSegment' => $request->param('ID')))->First();
		$data = array (
			'Title' => $details->Title, 
			'Content'   => $details->Content, 
			'VideoURL' => $details->Link
		);

		return $this->customise($data)->renderWith(array('WorkoutVideoPage_details', 'WorkoutVideoPage', 'Page'));
	}

	public function category() {
		$category = $this->getCurrentCategory();
		if($category) {
			$this->videos = $category->WorkoutVideo();
			return $this->render();
		}

		return $this->httpError(404, "Not Found");		
	}	

	public function getVideos() {
		return WorkoutVideo::get();
	}	

	public function PaginatedVideos() {
		$list = new PaginatedList($this->videos, $this->getRequest());
		$list->setPageLength(15);
		return $list;
	}

	public function getCategories() {
		return WorkoutVideoCategory::get();
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
