<?php
class MemberLogPointsPage extends MemberPage {}

class MemberLogPointsPage_Controller extends MemberPage_Controller {

	private static $allowed_actions = array(
		'DailyChallenge', 'PointsForm'
	);

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

		$previousSevenDates = $this->getPreviousSevenDates();
		$previousSevenDatesPoints = $this->getPreviousSevenDatesPoints();
		Requirements::customScript(<<<JS
			var lineChartDataLabels = "$previousSevenDates";
			lineChartDataLabels = lineChartDataLabels.split(",");

			var lineChartDataValues = "$previousSevenDatesPoints";
			lineChartDataValues = lineChartDataValues.split(",");
JS
		);
	}

	/**
	 * Get previous seven dates
	 * 
	 * @return string
	 */
	private function getPreviousSevenDates() {
		$arrDates = array();
		for ($i=1; $i <=7 ; $i++) { 
			if ($i > 1) {
				array_push($arrDates, date('M.d', strtotime(' -' .$i. ' days')));
			} else {
				array_push($arrDates, date('M.d', strtotime(' -' .$i. ' day')));
			}
		}

		return implode(',', $arrDates);
	}

	/**
	 * Get the points from the last seven days
	 * 
	 * @return string
	 */
	private function getPreviousSevenDatesPoints() {
		$arrPoints = array();
		for ($i=1; $i <= 7 ; $i++) { 
			if ($i > 1) {
				$dailyChallenge = $this->getDailyChallenges()->filter(array(
					'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' days'))
				));
			} else {
				$dailyChallenge = $this->getDailyChallenges()->filter(array(
					'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' day'))
				));
			}

			if ($dailyChallenge->exists()) {
				$challengePoints = ChallengePoint::get()->filter(array(
					'ReferenceID' => Member::currentUser()->getActiveChallengeReference()->ID, 
					'DailyChallengeID' => $dailyChallenge->First()->ID
				));

				if ($challengePoints->exists()) {
					array_push($arrPoints, $challengePoints->First()->TotalPoints);
				}
			} else {
				array_push($arrPoints, 0);
			}
		}

		return implode(',', $arrPoints);
	}

	/**
	 * log points form
	 *
	 * @return Form
	 */
	public function PointsForm() {
		$fields = new FieldList();

		if ($this->getTodayDailyChallenge()->ID == $this->getDailyChallenge()->ID) {
			$actions = new FieldList(
				FormAction::create('doSavePoints')
					->setTitle('Save my points')
			);
		} else {
			$actions = new FieldList();
		}

		$form = new Form($this, 'PointsForm', $fields, $actions);
		$form->setTemplate('PointsForm');

		return $form;
	}

	public function doSavePoints(Array $data, Form $form) {
		$challengePoints = ChallengePoint::get()->filter(array(
			'ReferenceID' => Member::currentUser()->getActiveChallengeReference()->ID, 
			'DailyChallengeID' => $this->getDailyChallenge()->ID
		));

		try {
			if (!$challengePoints->exists()) {
				$challengePoints = new ChallengePoint();
				$challengePoints->ReferenceID = Member::currentUser()->getActiveChallengeReference()->ID;
				$challengePoints->DailyChallengeID = $this->getDailyChallenge()->ID;
				$challengePoints->write();
			} else {
				$challengePoints = $challengePoints->First();
			}

			foreach ($this->getDailyChallenge()->DailyActivities() as $activity) {
				$dailyActivityPoints = $challengePoints->DailyActivityPoints()->filter(array('DailyActivityID' => $activity->ID));
				if (!$dailyActivityPoints->exists()) {
					$dailyActivityPoints = new ChallengeDailyActivityPoint();
					$dailyActivityPoints->DailyActivityID = $activity->ID;
					if (isset($data['DailyActivity_' . $activity->ID])) {
						$dailyActivityPoints->RawPoints = $data['DailyActivity_' . $activity->ID];
						$dailyActivityPoints->write();

						$equivalentPoints = $dailyActivityPoints->getEquivalentPoints();
						$dailyActivityPoints->Points = $equivalentPoints;
						$dailyActivityPoints->write();

						$challengePoints->DailyActivityPoints()->add($dailyActivityPoints);
					}
				} else {

					if (isset($data['DailyActivity_' . $activity->ID])) {
						$dailyActivityPoints = $dailyActivityPoints->First();
						$dailyActivityPoints->RawPoints = $data['DailyActivity_' . $activity->ID];
						$dailyActivityPoints->write();

						$equivalentPoints = $dailyActivityPoints->getEquivalentPoints();
						$dailyActivityPoints->Points = $equivalentPoints;
						$dailyActivityPoints->write();
					}
				}
			}

			$points = $challengePoints->getCalculatedTotalPoints();
			$challengePoints->TotalPoints = $points;
			$challengePoints->write();

			$form->sessionMessage('Success! You scored ' .$points. ' points today.', 'good');
		} catch(ValidationException $e) {
			$form->sessionMessage($e->getResult()->message(), 'bad');
			return $this->redirectBack();
		}

		return $this->redirectBack();	
	}

	public function getDailyChallenges() {
		$challenge = Member::currentUser()->getActiveChallenge();
		if ($challenge) {
			$dailyChallenges = $challenge->DailyChallenges();
			if ($dailyChallenges->exists()) {
				return $dailyChallenges;
			}
		}

		return null;
	}

	public function getTodayDailyChallenge() {
		return $this->getDailyChallenges()->filter('Date', date('Y-m-d'))->First();
	}

	public function getDailyChallenge() {
		$id = $this->request->param('ID');
		if ($id) {
			return $this->getDailyChallenges()->byID($id);
		}

		return $this->getDailyChallenges()->filter('Date', date('Y-m-d'))->First();
	}

	public function getNextDailyChallenge() {
		return $this->getDailyChallenges()->filter('Date', date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' +1 day')))->First();
	}

	public function getPreviousDailyChallenge() {
		return $this->getDailyChallenges()->filter('Date', date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -1 day')))->First();
	}

	public function getDailyActivityRawPoints($dailyActivityID) {
		$challengePoints = ChallengePoint::get()->filter(array(
			'ReferenceID' => Member::currentUser()->getActiveChallengeReference()->ID, 
			'DailyChallengeID' => $this->getTodayDailyChallenge()->ID
		));

		if ($challengePoints->exists()) {
			$dailyActivityPoints = $challengePoints->First()->DailyActivityPoints();
			$selectedDailyActivityPoints = $dailyActivityPoints->filter('DailyActivityID', $dailyActivityID);
			if ($selectedDailyActivityPoints->exists()) {
				return $selectedDailyActivityPoints->First()->RawPoints;
			}
		}

		return null;
	}

	/**
	 * Get my total points earned
	 * 
	 * @return int
	 */
	public function getMyTotalPoints() {
		$challengePoints = ChallengePoint::get()->filter(array(
			'ReferenceID' => Member::currentUser()->getActiveChallengeReference()->ID, 
			'DailyChallengeID' => $this->getDailyChallenge()->ID
		));

		if ($challengePoints->exists()) {
			return $challengePoints->First()->TotalPoints;
		}

		return 0;
	}

	/**
	 * Get perfect total points
	 * 
	 * @return int
	 */
	public function getMyPerfectTotalPoints(){
		$total = 0;
		$activities = $this->getDailyChallenge()->DailyActivities();
		if ($activities->exists()) {
			foreach ($activities as $activity) {
				$maxWeightPointsValue = $activity->Points()->max('Points');
				$total += $maxWeightPointsValue;
			}
		}

		return $total;
	}

	/**
	 * Get team total team points
	 * 
	 * @return int
	 */
	public function getTeamTotalPoints() {
		$total = 0;

		$referrence = Member::currentUser()->getActiveChallengeReference();
		$team = $referrence->Team();
		$members = $team->Members();
		if ($members) {
			foreach ($members as $member) {
				$challengePoints = ChallengePoint::get()->filter(array(
					'ReferenceID' => $member->getActiveChallengeReference()->ID, 
					'DailyChallengeID' => $this->getDailyChallenge()->ID
				));

				if ($challengePoints->exists()) {
					$total += $challengePoints->First()->TotalPoints;
				}
			}
		}

		return $total;
	}

	/**
	 * Get team perfect total team points
	 * 
	 * @return int
	 */
	public function getTeamPerfectTotalPoints() {
		$referrence = Member::currentUser()->getActiveChallengeReference();
		$team = $referrence->Team();

		return $this->getMyPerfectTotalPoints() * $team->Members()->Count();
	}

	/**
	 * Get previous 7 days total individual points
	 * 
	 * @return int
	 */
	public function getSevenDaysIndividualTotalPoints() {
		$total = 0;
		for ($i=1; $i <= 7 ; $i++) { 
			if ($i > 1) {
				$dailyChallenge = $this->getDailyChallenges()->filter(array(
					'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' days'))
				));
			} else {
				$dailyChallenge = $this->getDailyChallenges()->filter(array(
					'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' day'))
				));
			}

			if ($dailyChallenge->exists()) {
				$challengePoints = ChallengePoint::get()->filter(array(
					'ReferenceID' => Member::currentUser()->getActiveChallengeReference()->ID, 
					'DailyChallengeID' => $dailyChallenge->First()->ID
				));

				if ($challengePoints->exists()) {
					$total += $challengePoints->First()->TotalPoints;
				}
			}
		}

		return $total;
	}

	/**
	 * Get the team total points for the past seven days
	 * 
	 * @return [type] [description]
	 */
	public function getSevenDaysTeamTotalPoints() {
		$total = 0;

		$referrence = Member::currentUser()->getActiveChallengeReference();
		$team = $referrence->Team();
		$members = $team->Members();
		if ($members) {
			foreach ($members as $member) {
				for ($i=1; $i <= 7 ; $i++) { 
					if ($i > 1) {
						$dailyChallenge = $this->getDailyChallenges()->filter(array(
							'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' days'))
						));
					} else {
						$dailyChallenge = $this->getDailyChallenges()->filter(array(
							'Date' => date('Y-m-d', strtotime($this->getDailyChallenge()->Date . ' -' .$i. ' day'))
						));
					}

					if ($dailyChallenge->exists()) {
						$challengePoints = ChallengePoint::get()->filter(array(
							'ReferenceID' => $member->getActiveChallengeReference()->ID, 
							'DailyChallengeID' => $dailyChallenge->First()->ID
						));

						if ($challengePoints->exists()) {
							$total += $challengePoints->First()->TotalPoints;
						}
					}
				}
			}
		}

		return $total;
	}
}