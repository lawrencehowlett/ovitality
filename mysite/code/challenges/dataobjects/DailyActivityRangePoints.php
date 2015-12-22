<?php
class DailyActivityRangePoints extends DataObject {

	private static $db = array(
		'Title' => 'Text'
	);

	private static $has_one = array(
		'DailyActivity' => 'DailyActivity'
	);
}