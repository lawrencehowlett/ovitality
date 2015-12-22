<?php
class MemberLogPointsPage extends MemberPage {
	//private static $icon = 'mysite/images/';
}

class MemberLogPointsPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();

		Requirements::css(THEMES_DIR . '/ovitality/css/bootstrap-slider.css');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/bootstrap-slider.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/jquery.knob.min.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/Chart.min.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/logpoints.js');
	}

	
}