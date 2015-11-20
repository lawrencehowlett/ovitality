<?php
class GenericPage extends UserDefinedForm {
	private static $icon = 'mysite/images/document-icon.png';
}

class GenericPage_Controller extends UserDefinedForm_Controller {

	private static $allowed_actions = array(
		'Form'
	);

	public function init() {
		parent::init();

		Requirements::customCSS(<<<CSS
			ul.step-buttons {
				padding: 0;
			}
CSS
		);

		Requirements::block(FRAMEWORK_DIR .'/thirdparty/jquery/jquery.js');
		Requirements::block(USERFORMS_DIR . '/thirdparty/jquery-validate/jquery.validate.min.js');
	}

	public function Form() {
		$form = parent::Form();
		$form->addExtraClass('form-email');
		$form->setTemplate('BlockForm');

		return $form;
	}
}