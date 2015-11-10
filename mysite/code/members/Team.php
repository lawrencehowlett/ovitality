<?php
class Team extends DataObject {
	private static $db = array(
		'Title' => 'Text', 
		'Description' => 'Text', 
		'FacebookURL' => 'Text', 
		'Type' => 'Enum(array("Competitive", "Motivation"), "Competitive")'
	);

	private static $has_one = array(
		'TeamLeader' => 'Member'
	);

	private static $many_many = array(
		'Members' => 'Member'
	);
}