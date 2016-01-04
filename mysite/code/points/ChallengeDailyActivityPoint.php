<?php
class ChallengeDailyActivityPoint extends DataObject {

	private static $db = array();

	private static $has_one = array(
		'DailyActivity' => 'DailyActivity'
	);
}