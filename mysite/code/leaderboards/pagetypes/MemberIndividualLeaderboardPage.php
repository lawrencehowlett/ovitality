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
		    $startDateWeek = date('W', strtotime($selectedChallenge->StartDate));
		    $endDateWeek = date('W', strtotime($selectedChallenge->EndDate));
		    $numberOfWeeks = ($endDateWeek - $startDateWeek) + 1;
			
			if ($numberOfWeeks > 0) {
				$counter = 1;
				for ($i=$startDateWeek; $i <= $endDateWeek; $i++) { 
		    		$weekList->push(new ArrayData(array(
		    			'Title' => 'Week ' . (int)$i, 
		    			'Selected' => ($this->request->getVar('week') && (int)$i == $this->request->getVar('week')) ? true : false, 
		    			'WeekNumber' => '0' .(int)$i
		    		)));

					$counter+=1;
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

	/**
	 * Get top individuals
	 * 
	 * @return DataList
	 */
	public function getTopIndividuals() {
		$topIndividualsList = new ArrayList();

		$challengeID = $this->request->getVar('challenge');
		$weekNumber = $this->request->getVar('week');
		if ($challengeID && $weekNumber) {

			$references = MemberChallengeReference::get()->filter(array(
				'ChallengeID' => $challengeID, 
				'PaymentStatus' => 'Paid'
			));

			if ($references) {
				foreach ($references as $reference) {
					$total = 0;
					$challenge = $reference->Challenge();
					if ($challenge) {
						$dailyChallenges = $challenge->DailyChallenges();
						if ($dailyChallenges) {
							$date = date('Y-m-d', strtotime(date('Y', strtotime($challenge->StartDate)) . 'W' . $weekNumber));
							for ($i=1; $i <=7 ; $i++) {
								if ($i > 1) {
									$date = date('Y-m-d', strtotime($date . ' +1 day'));
								} else {
									$date = date('Y-m-d', strtotime($date . ' -1 day'));
								}

								$dailyChallenge = $dailyChallenges->filter(array('Date' => $date));
								if ($dailyChallenge->exists()) {
									$challengePoints = $reference->Points()->filter(array('DailyChallengeID' => $dailyChallenge->First()->ID));
									if ($challengePoints->exists()) {
										$total += $challengePoints->First()->TotalPoints;
									}
								}
							}
						}
					}

					$topIndividualsList->push(new ArrayData(array(
						'FullName' => $reference->Member()->FullName, 
						'Team' => $reference->Team()->Title, 
						'Points' => $total
					)));
				}
			}
		}

		$topIndividualsList = $topIndividualsList->sort('Points DESC');

		return $topIndividualsList;
	}
}