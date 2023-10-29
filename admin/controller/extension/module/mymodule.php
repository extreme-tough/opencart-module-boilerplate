<?php
class ControllerExtensionModuleMyModule extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/mymodule');

		$this->load->model('setting/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_mymodule', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['api_key'])) {
			$data['error_api_key'] = $this->error['api_key'];
		} else {
			$data['error_api_key'] = '';
		}
		if (isset($this->error['api_password'])) {
			$data['error_api_password'] = $this->error['api_password'];
		} else {
			$data['error_api_password'] = '';
		}
		if (isset($this->error['app_id'])) {
			$data['error_app_id'] = $this->error['app_id'];
		} else {
			$data['error_app_id'] = '';
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/mymodule', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/mymodule', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_mymodule_status'])) {
			$data['module_mymodule_status'] = $this->request->post['module_mymodule_status'];
		} else {
			$data['module_mymodule_status'] = $this->config->get('module_mymodule_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/mymodule', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/mymodule')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
	
	public function install() {
		$this->load->model('extension/module/mymodule');

		$this->model_extension_module_mymodule->install();
	}
	
	public function install() {
		$this->load->model('extension/module/mymodule');

		$this->model_extension_module_mymodule->uninstall();
	}

}