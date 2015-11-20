<?php
class PageBlockBuilder_CMSMain_Extension extends Extension {

	private static $disallow_modules = array(
		'Blog', 'BlogPost'
	);

	public function LinkPageBlockBuilder() {
		if($id = $this->owner->currentPageID()) {
			return $this->owner->LinkWithSearch(
				Controller::join_links(singleton('CMSPageBlockBuilderController')->Link('show'), $id)
			);
		}
	}

	/**
	 * Check to show or hide block builder menu
	 *
	 * @return true
	 */
	public function ShowBlockBuilder() {
		$id = $this->owner->currentPageID();
		if ($id) {
			$page = Page::get()->byID($id);
			if ($page) {
				if (!$page->canShowBlockBuilder() || in_array($page->ClassName, self::$disallow_modules)) {
					return false;
				}
			}
		}

		return true;
	}
}

/**
 * Extension to page for block builder
 * 
 * @author Julius <julius@greenbrainer.com>
 * @copyright Copyright (c) 2015, Julius
 */
class PageBlockBuilder_Page_Extension extends DataExtension {

	/**
	 * Set has many
	 * 
	 * @var array
	 */
	private static $has_many = array(
		'Blocks' => 'Block'
	);

	/**
	 * Update CMS Fields
	 * 
	 * @param  FieldList &$fields
	 * @return FieldList
	 */
	public function updateCMSFields(FieldList $fields) {
		/*$fields->addFieldToTab(
			'Root.Blocks', 
			$this->getFieldEditorGrid()
		);*/
	}

	/**
	 * Gets the field editor, for adding and removing EditableFormFields.
	 *
	 * @return GridField
	 */
	public function getFieldEditorGrid() {
		Requirements::javascript('pageblockbuilder/javascript/FieldEditor.js');

		$editableColumns = new GridFieldEditableColumns();
		$fieldClasses = singleton('EditableFormField')->getEditableFieldClasses();
		$editableColumns->setDisplayFields(array(
			'ClassName' => function($record, $column, $grid) use ($fieldClasses) {
				if($record instanceof EditableFormField) {
					return $record->getInlineClassnameField($column, $fieldClasses);
				}
			},
			'Title' => function($record, $column, $grid) {
				if($record instanceof EditableFormField) {
					return $record->getInlineTitleField($column);
				}
			}
		));

		$config = GridFieldConfig::create()
			->addComponents(
				$editableColumns,
				new GridFieldButtonRow(),
				GridFieldAddClassesButton::create('EditableTextField')
					->setButtonName('Add Block')
					->setButtonClass('ss-ui-action-constructive'),
				new GridFieldEditButton(),
				new GridFieldDeleteAction(),
				new GridFieldToolbarHeader(),
				new GridFieldOrderableRows('SortOrder'),
				new GridFieldDetailForm()
			);

		$fieldEditor = GridField::create(
			'Fields',
			'Fields',
			$this->owner->Blocks(),
			$config
		)->addExtraClass('uf-field-editor');

		return $fieldEditor;
	}

	/**
	 * Get block builder fields
	 * 
	 * @return FieldList
	 */
	public function getBlockBuilderFields() {
		$fields = new FieldList(
			new TabSet('Root', 
				new Tab('BlockBuilder', 
					GridField::create(
						'Blocks', 
						'Blocks', 
						$this->owner->Blocks(), 
						GridFieldConfig_RecordEditor::create()
							->addComponent(new GridFieldSortableRows('SortOrder'))
					)
				)
			)
		);

		return $fields;
	}

	/**
	 * Permission to display show builder on a certain page type
	 * 
	 * @return boolean
	 */
	public function canShowBlockBuilder() {
		return true;
	}

}