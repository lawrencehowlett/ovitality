<?php
class ChallengePoint extends DataObject {

	private static $db = array(
		'TotalPoints' => 'Int'
	);

	private static $has_one = array(
		'Reference' => 'MemberChallengeReference', 
		'DailyChallenge' => 'DailyChallenge'
	);

	private static $has_many = array(
		'DailyActivityPoints' => 'ChallengeDailyActivityPoint'
	);

	public function getCalculatedTotalPoints() {
		$totalPoints = 0;
		foreach ($this->DailyActivityPoints() as $points) {
			$totalPoints+=$points->Points;
		}

		return $totalPoints;
	}
}