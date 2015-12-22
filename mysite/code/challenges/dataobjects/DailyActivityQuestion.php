<?php
class DailyActivityQuestion extends DataObject {

	private static $db = array(
		'Title' => 'Text', 
		'Type' => 'Enum(array("Slider", "Number", "Boolean", "Selections"))'
	);
}