<?php
class DisqusSettings extends DataExtension {
	private static $db = array(
		'DisqusShortName' => 'Varchar'
	);

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab(
			'Root.Disqus', 
			TextField::create('DisqusShortName', 'Short Name')
		);
	}
}