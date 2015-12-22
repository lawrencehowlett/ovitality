<?php
class DailyActivitySelectionPoints extends DataObject {

	private static $db = array(
		'Title' => 'Text'
	);

	private static $has_one= array(
		'DailyActivity' => 'DailyActivity'
	);

	private static $has_many = array(
		'SelectionOptions' => 'DailyActivitySelectionOption'
	);

	private static $singular_name = 'Points Weighting';

	private static $plural_name = 'Points Weighting';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeFieldsFromTab(
			'Root.Main', 
			array('DailyActivityID')
		);

		$fields->removeByName('SelectionOptions');

		$fields->replaceField(
			'Title', 
			TextField::create('Title', 'Question')
		);

		if ($this->ID) {
			$fields->addFieldToTab(
				'Root.Main', 
				GridField::create('SelectionOptions', 'Points per answer', $this->SelectionOptions(), GridFieldConfig_RecordEditor::create())
			);
		}

		return $fields;
	}

	public function onBeforeWrite() {
		parent::onBeforeWrite();
		if (!$this->Title) {
			$this->Title = 'Question by sets of answers.';
		}
	}
}