<?php
class MemberChallengeDetailPage extends MemberPage {

	private static $icon = 'mysite/images/timer-icon.png';
}

class MemberChallengeDetailPage_Controller extends MemberPage_Controller {
	
	private static $allowed_actions = array(
		'details'
	);

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

	public function details(SS_HTTPRequest $request) {
		$urlSegment = $request->param('ID');
		$activeChallenge = Member::currentUser()->getActiveChallenge();

		if ($urlSegment && $activeChallenge && $activeChallenge->URLSegment == $urlSegment) {
			return $this->renderWith(array('MemberChallengeDetailPage', 'Page'));
		}

		$this->redirectBack();
	}

	public function getActiveChallenge() {
		return Member::currentUser()->getActiveChallenge();		
	}

	public function getTeam() {
		$referrence = MemberChallengeReference::get()->filter(array(
			'ChallengeID' => $this->getActiveChallenge()->ID, 
			'MemberID' => Member::currentUserID(), 
			'Status' => 'Active', 
			'PaymentStatus' => 'Paid'
		));
		
		if ($referrence->exists()) {
			if ($referrence->First()->Team()) {
				return $referrence->First()->Team();
			}
		}

		return null;
	}

	public function getTeamMembers() {
		if (Member::currentUser()->getActiveChallengeReference()->IsTeam()) {
			return $this->getTeam()->Members()->exclude('ID', Member::currentUserID());
		}

		return null;
	}
}