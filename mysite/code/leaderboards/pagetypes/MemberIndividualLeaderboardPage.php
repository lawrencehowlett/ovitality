<?php
class MemberIndividualLeaderboardPage extends MemberPage {}

class MemberIndividualLeaderboardPage_Controller extends MemberPage_Controller {

	/**
	 * Set allowed actions
	 * 
	 * @var array
	 */
	private static $allowed_actions =  array(
		'ChallengeWeeks'
	);

	/**
	 * Initialise the controller
	 */
	public function init() {
		parent::init();

		Requirements::javascript('themes/ovitality/js/jquery.chained.remote.min.js');

		$link = $this->Link();
		Requirements::customScript(<<<JS
			(function($) {
			    $(document).ready(function(){
					$("#series-remote").remoteChained({
						parents : "#mark-remote", 
						url : "$link/ChallengeWeeks", 
						loading : "--", 
						clear : true
					});

					$('#series-remote').change(function(e){

						if ($(this).val() > 0) {
							window.location = '$link?challenge=' +$('#mark-remote').val()+ '&week=' + $(this).val();
						}

						e.preventDefault();
					});
				});
			})(jQuery);
JS
		);
	}

	/**
	 * Get all the challenges
	 * 
	 * @return DataList
	 */
	public function getChallenges() {
		return Challenge::get()->filter(array(
			'Status' => 'Published'
		));
	}

	/**
	 * Get the selected challenge
	 * 
	 * @return Challenge
	 */
	public function getSelectedChallenge() {
		$challengeID = $this->request->getVar('challenge');
		if ($challengeID) {
			return Challenge::get()->byID($challengeID);
		}

		return null;
	}

	/**
	 * Get selected challenge week
	 * 
	 * @return ArrayList
	 */
	public function getSelectedChallengeWeek() {
		$weekList = new ArrayList();
		$selectedChallenge = $this->getSelectedChallenge();
		if ($selectedChallenge) {
		    $startDate = DateTime::createFromFormat('Y-m-d', $selectedChallenge->StartDate);
		    $endDate = DateTime::createFromFormat('Y-m-d', $selectedChallenge->EndDate);

		    $numberOfWeeks = floor($startDate->diff($endDate)->days / 7);
		    if ($numberOfWeeks > 0) {
		    	for ($i=1; $i <= $numberOfWeeks ; $i++) {

		    		$weekList->push(new ArrayData(array(
		    			'Title' => 'Week ' . $i, 
		    			'Selected' => ($this->request->getVar('week') && $i == $this->request->getVar('week')) ? true : false, 
		    			'WeekNumber' => $i
		    		)));
		    	}
		    }
		}

		return $weekList;
	}

	/**
	 * Get the challenge weeks
	 * 
	 * @param SS_HTTPRequest $request
	 */
	public function ChallengeWeeks(SS_HTTPRequest $request) {
		$arrNumberOfWeeks = array();
		$challenge = Challenge::get()->byID($request->getVar('challenge'));

		if ($challenge) {
		    $startDate = DateTime::createFromFormat('Y-m-d', $challenge->StartDate);
		    $endDate = DateTime::createFromFormat('Y-m-d', $challenge->EndDate);

		    $numberOfWeeks = floor($startDate->diff($endDate)->days/7);
		    $arrNumberOfWeeks[''] = 'select a week';
		    if ($numberOfWeeks > 0) {
		    	for ($i=1; $i <= $numberOfWeeks ; $i++) { 
		    		$arrNumberOfWeeks[$i] = 'Week ' . $i;
		    	}
		    }
		}

		return json_encode($arrNumberOfWeeks);
	}
}