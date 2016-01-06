<?php
class ChallengeDailyActivityPoint extends DataObject {

	private static $db = array(
		'RawPoints' => 'Varchar', 
		'Points' => 'Int'
	);

	private static $has_one = array(
		'Points' => 'ChallengePoint', 
		'DailyActivity' => 'DailyActivity'
	);

	public function getEquivalentPoints() {
		$weightPoints = $this->DailyActivity()->Points();
		if ($weightPoints) {
			if ($this->DailyActivity()->Type == 'Boolean') {

				$booleanAnswer = ($this->RawPoints) ? 'YES' : 'NO';
				$weightPointsValue = $weightPoints->filter('Title', $booleanAnswer);
			} else {
				$weightPointsValue = $weightPoints->filter('Title', $this->RawPoints);
			}

			if ($weightPointsValue->exists()) {
				return $weightPointsValue->First()->Points;
			} else {
				$maxWeightPointsValue = $weightPoints->max('Title');
				if ($maxWeightPointsValue && $maxWeightPointsValue < $this->RawPoints) {
					return $weightPoints->max('Points');
				}
			}

		}

		return 0;
	}
}