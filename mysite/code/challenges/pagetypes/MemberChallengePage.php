<?php
class MemberChallengeDetailPage extends MemberPage {

	private static $icon = 'mysite/images/timer-icon.png';
}

class MemberChallengeDetailPage_Controller extends MemberPage_Controller {
	
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
}