<?php
class CustomLoginForm extends MemberLoginForm {

	public function dologin($data) {
		parent::dologin($data);

		if (!Permission::check('ADMIN')) {
			$this->controller->response->removeHeader('Location');
			$this->controller->redirect(MemberDashboardPage::get()->First()->Link());
		} else {
			$this->controller->redirect('admin/');
		}
	}
}