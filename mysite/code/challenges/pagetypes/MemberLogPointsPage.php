<?php
class MemberLogPointsPage extends MemberPage {

}

class MemberLogPointsPage_Controller extends MemberPage_Controller {

	public function init() {
		parent::init();
		if (Member::currentUser()) {
			if (!Member::currentUser()->IsLevelTwoAccess() && !Member::currentUser()->IsLevelThreeAccess()) {
				return $this->redirect(MemberDashboardPage::get()->First()->Link());
			}
		} else {
			Security::permissionFailure();
		}

		Requirements::css(THEMES_DIR . '/ovitality/css/bootstrap-slider.css');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/bootstrap-slider.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/jquery.knob.min.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/Chart.min.js');
		Requirements::javascript(THEMES_DIR . '/ovitality/js/logpoints.js');
	}

	
}