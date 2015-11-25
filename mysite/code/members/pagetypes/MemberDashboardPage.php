<?php
class MemberDashboardPage extends MemberPage {
	private static $icon = 'mysite/images/dashboard-icon.png';
}

class MemberDashboardPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();

		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
					$('.challenge-today-slider').flexslider({
					    controlNav: false, 
					    slideshow: false
					});			    	
			    });
			})(jQuery);	
JS
		);
	}

	public function index() {
		$template = '';
		if (!Member::currentUser()->HasCurrentChallenge()) {
			$template = '_no_current_challenge';
		}
		return $this->renderWith(array(
			'MemberDashboardPage' . $template, 'Page'
		));
	}

	public function getInProgressChallenges() {
		return Challenge::getInProgressChallenges();
	}

	public function getCompletedChallenges() {
		return Challenge::getCompletedChallenges();
	}
}