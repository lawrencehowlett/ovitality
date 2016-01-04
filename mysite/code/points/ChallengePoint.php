<?php
class ChallengePoint extends DataObject {

	private static $db = array(
	);

	private static $has_one = array(
		'Reference' => 'MemberChallengeReference', 
		'DailyChallenge' => 'DailyChallenge'
	);

	private static $has_many = array(
		'DailyActivityPoints' => 'DailyActivityPoint'
	);
}