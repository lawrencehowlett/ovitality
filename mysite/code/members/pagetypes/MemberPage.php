<?php
class MemberPage extends Page {

}

class MemberPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();

		if (!Member::currentUser()) {
			Security::permissionFailure();
		}
	}

	public function getChallenges() {
		return Challenge::get();
	}
} 