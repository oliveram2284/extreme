<?php
//==============================================================================
// OCA 1.2
//
// Desarrollado por: Cofran
// E-mail: franco.iglesias@gmail.com
// Sitio Web: http://www.wachipato.com
// Soporte: http://www.wachipato.com/support
//==============================================================================

class ControllerExtensionShippingOca extends Controller {
	private $error = array();
	private $type = 'shipping';
	private $name = 'oca';

	public function index() {
		$this->load->model('setting/setting');
		$v14x = $data['v14x'] = (!defined('VERSION') || VERSION < 1.5);
		$v150 = $data['v150'] = (defined('VERSION') && strpos(VERSION, '1.5.0') === 0);
		$v151 = $data['v151'] = (defined('VERSION') && strpos(VERSION, '1.5.1') === 0);
		$token = $data['token'] = (isset($this->session->data['token'])) ? $this->session->data['token'] : '';


		$this->_load_language();

		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_general'] = $this->language->get('heading_general');
		$data['heading_restrinction'] = $this->language->get('heading_restrinction');


		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_list_envios'] = $this->language->get('tab_list_envios');


		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_cuit'] = $this->language->get('entry_cuit');
		$data['entry_user'] = $this->language->get('entry_user');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_cp_origen'] = $this->language->get('entry_cp_origen');
		$data['entry_operativa'] = $this->language->get('entry_operativa');
		$data['entry_round'] = $this->language->get('entry_round');
		$data['entry_medicion'] = $this->language->get('entry_medicion');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_tax'] = $this->language->get('entry_tax');
		$data['entry_destino'] = $this->language->get('entry_destino');
		$data['entry_seguro'] = $this->language->get('entry_seguro');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');

		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_idoperativa'] = $this->language->get('text_idoperativa');
		$data['text_descripcion'] = $this->language->get('text_descripcion');
		$data['text_seguro'] = $this->language->get('text_seguro');
		$data['text_sucursal'] = $this->language->get('text_sucursal');
		$data['text_prioritario'] = $this->language->get('text_prioritario');
		$data['text_destino'] = $this->language->get('text_destino');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_total_max'] = $this->language->get('text_total_max');
		$data['text_total_min'] = $this->language->get('text_total_min');
		$data['text_all_zone'] = $this->language->get('text_all_zone');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['text_unselect_all'] = $this->language->get('text_unselect_all');
		$data['text_guest_user'] = $this->language->get('text_guest_user');
		$data['text_total_max'] = $this->language->get('text_total_max');

		$data['text_edit'] = $this->language->get('text_edit');


		$data['help_status'] ="";// $this->language->get('help_key');
		$data['help_key'] = $this->language->get('help_key');
		$data['help_username'] = $this->language->get('help_username');
		$data['help_password'] = $this->language->get('help_password');
		$data['help_pickup'] = $this->language->get('help_pickup');
		$data['help_packaging'] = $this->language->get('help_packaging');
		$data['help_classification'] = $this->language->get('help_classification');
		$data['help_origin'] = $this->language->get('help_origin');
		$data['help_city'] = $this->language->get('help_city');
		$data['help_state'] = $this->language->get('help_state');
		$data['help_country'] = $this->language->get('help_country');
		$data['help_postcode'] = $this->language->get('help_postcode');
		$data['help_test'] = $this->language->get('help_test');
		$data['help_quote_type'] = $this->language->get('help_quote_type');
		$data['help_service'] = $this->language->get('help_service');
		$data['help_insurance'] = $this->language->get('help_insurance');
		$data['help_display_weight'] = $this->language->get('help_display_weight');
		$data['help_weight_class'] = $this->language->get('help_weight_class');
		$data['help_length_class'] = $this->language->get('help_length_class');
		$data['help_dimension'] = $this->language->get('help_dimension');
		$data['help_debug'] = $this->language->get('help_debug');

		$data['button_add_operativa'] = $this->language->get('button_add_operativa');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');



		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {



			if ($this->request->post[$this->name.'_store_id'])
			{
				$this->request->post[$this->name.'_store_id'] = implode(',', $this->request->post[$this->name.'_store_id']);
			}

			if ($this->request->post[$this->name.'_geo_zone_id'])
			{
				$this->request->post[$this->name.'_geo_zone_id'] = implode(',', $this->request->post[$this->name.'_geo_zone_id']);
			}

			if ($this->request->post[$this->name.'_customer_group_id'])
			{
				$this->request->post[$this->name.'_customer_group_id'] = implode(',', $this->request->post[$this->name.'_customer_group_id']);
			}

			if (isset($this->request->post[$this->name.'_operativa']))
			{
				$this->request->post[$this->name.'_operativa'] = serialize($this->request->post[$this->name.'_operativa']);
			}

			/*
			$this->model_setting_setting->editSetting($this->name, $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->_format_url('extension/' . $this->type, 'token=' . $token, 'SSL'));*/
			$this->model_setting_setting->editSetting($this->name, $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'));


		}

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['total'])) {
			$data['error_total'] = $this->error['total'];
		} else {
			$data['error_total'] = '';
		}

		if (isset($this->error['cuit'])) {
			$data['error_cuit'] = $this->error['cuit'];
		} else {
			$data['error_cuit'] = '';
		}

		if (isset($this->error['cp_origen'])) {
			$data['error_cp_origen'] = $this->error['cp_origen'];
		} else {
			$data['error_cp_origen'] = '';
		}

 		if (isset($this->error['destino'])) {
			$data['error_destino'] = $this->error['destino'];
		} else {
			$data['error_destino'] = '';
		}

 		if (isset($this->error['seguro'])) {
			$data['error_seguro'] = $this->error['seguro'];
		} else {
			$data['error_seguro'] = '';
		}

 		if (isset($this->error['user'])) {
			$data['error_user'] = $this->error['user'];
		} else {
			$data['error_user'] = '';
		}

 		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['dimension'])) {
			$data['error_dimension'] = $this->error['dimension'];
		} else {
			$data['error_dimension'] = '';
		}

 		if (isset($this->error['nombre'])) {
			$data['error_nombre'] = $this->error['nombre'];
		} else {
			$data['error_nombre'] = array();
		}

	 	if (isset($this->error['operativa_id'])) {
			$data['error_operativa_id'] = $this->error['operativa_id'];
		} else {
			$data['error_operativa_id'] = array();
		}

  		$breadcrumbs = array();

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->_format_url('common/home', 'token=' . $token, 'SSL'),
      		'separator' => false
   		);

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('text_'.$this->type),
			'href'      => $this->_format_url('extension/' . $this->type, 'token=' . $token, 'SSL'),
      		'separator' => ' :: '
   		);

   		$breadcrumbs[] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->_format_url($this->type . '/' . $this->name, 'token=' . $token, 'SSL'),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->_format_url($this->type . '/' . $this->name, 'token=' . $token, 'SSL');

		$data['cancel'] = $this->_format_url('extension/' . $this->type, 'token=' . $token, 'SSL');

		if (isset($this->request->post[$this->name.'_cuit'])) {
			$data[$this->name.'_cuit'] = trim($this->request->post[$this->name.'_cuit']);
		} else {
			$data[$this->name.'_cuit'] = $this->config->get($this->name.'_cuit');
		}

		if (isset($this->request->post[$this->name.'_cp_origen'])) {
			$data[$this->name.'_cp_origen'] = trim($this->request->post[$this->name.'_cp_origen']);
		} else {
			$data[$this->name.'_cp_origen'] = $this->config->get($this->name.'_cp_origen');
		}

		if (isset($this->request->post[$this->name.'_user'])) {
			$data[$this->name.'_user'] = $this->request->post[$this->name.'_user'];
		} else {
			$data[$this->name.'_user'] = $this->config->get($this->name.'_user');
		}

		if (isset($this->request->post[$this->name.'_password'])) {
			$data[$this->name.'_password'] = $this->request->post[$this->name.'_password'];
		} else {
			$data[$this->name.'_password'] = $this->config->get($this->name.'_password');
		}

		if (isset($this->request->post[$this->name.'_destino'])) {
			$data[$this->name.'_destino'] = $this->request->post[$this->name.'_destino'];
		} else {
			$data[$this->name.'_destino'] = $this->config->get($this->name.'_destino');
		}

		if (isset($this->request->post[$this->name.'_seguro'])) {
			$data[$this->name.'_seguro'] = $this->request->post[$this->name.'_seguro'];
		} else {
			$data[$this->name.'_seguro'] = $this->config->get($this->name.'_seguro');
		}

		if (isset($this->request->post[$this->name.'_weight_class_id'])) {
			$data[$this->name.'_weight_class_id'] = $this->request->post[$this->name.'_weight_class_id'];
		} else {
			$data[$this->name.'_weight_class_id'] = $this->config->get($this->name.'_weight_class_id');
		}

		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post[$this->name.'_length_class_id'])) {
			$data[$this->name.'_length_class_id'] = $this->request->post[$this->name.'_length_class_id'];
		} else {
			$data[$this->name.'_length_class_id'] = $this->config->get($this->name.'_length_class_id');
		}

		$this->load->model('localisation/length_class');

		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post[$this->name.'_length'])) {
			$data[$this->name.'_length'] = $this->request->post[$this->name.'_length'];
		} else {
			$data[$this->name.'_length'] = $this->config->get($this->name.'_length');
		}

		if (isset($this->request->post[$this->name.'_width'])) {
			$data[$this->name.'_width'] = $this->request->post[$this->name.'_width'];
		} else {
			$data[$this->name.'_width'] = $this->config->get($this->name.'_width');
		}

		if (isset($this->request->post[$this->name.'_height'])) {
			$data[$this->name.'_height'] = $this->request->post[$this->name.'_height'];
		} else {
			$data[$this->name.'_height'] = $this->config->get($this->name.'_height');
		}

		if (isset($this->request->post[$this->name.'_tax_class_id'])) {
			$data[$this->name.'_tax_class_id'] = $this->request->post[$this->name.'_tax_class_id'];
		} else {
			$data[$this->name.'_tax_class_id'] = $this->config->get($this->name.'_tax_class_id');
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		//
		// Restricciones
		//
		if (isset($this->request->post[$this->name.'_total_max'])) {
			$data[$this->name.'_total_max'] = trim($this->request->post[$this->name.'_total_max']);
		} else {
			$data[$this->name.'_total_max'] = $this->config->get($this->name.'_total_max');
		}

		if (isset($this->request->post[$this->name.'_total_min'])) {
			$data[$this->name.'_total_min'] = trim($this->request->post[$this->name.'_total_min']);
		} else {
			$data[$this->name.'_total_min'] = $this->config->get($this->name.'_total_min');
		}

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post[$this->name.'_store_id'])) {
			$data[$this->name.'_store_id'] = $this->request->post[$this->name.'_store_id'];
		} elseif ($this->config->get($this->name.'_store_id')) {
			$data[$this->name.'_store_id'] = explode(',', $this->config->get($this->name.'_store_id'));
		} else {
			$data[$this->name.'_store_id'] = array(0);
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post[$this->name.'_geo_zone_id'])) {
			$data[$this->name.'_geo_zone_id'] = $this->request->post[$this->name.'_geo_zone_id'];
		} elseif ($this->config->get($this->name.'_geo_zone_id')) {
			$data[$this->name.'_geo_zone_id'] = explode(',', $this->config->get($this->name.'_geo_zone_id'));
		} else {
			$data[$this->name.'_geo_zone_id'] = array(0);
		}

		//$this->load->model('sale/customer_group');  oca version 1.5
		$this->load->model('customer/customer_group'); //oca version 2.0.x
		//$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups(); //oca version 1.5

		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups(); //oca version 2.0.x

		if (isset($this->request->post[$this->name.'_customer_group_id'])) {
			$data[$this->name.'_customer_group_id'] = $this->request->post[$this->name.'_customer_group_id'];
		} elseif ($this->config->get($this->name.'_customer_group_id')) {
			$data[$this->name.'_customer_group_id'] = explode(',', $this->config->get($this->name.'_customer_group_id'));
		} else {
			$data[$this->name.'_customer_group_id'] = array(0);
		}

		if (isset($this->request->post[$this->name.'_status'])) {
			$data[$this->name.'_status'] = $this->request->post[$this->name.'_status'];
		} else {
			$data[$this->name.'_status'] = $this->config->get($this->name.'_status');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post[$this->name.'_sort_order'])) {
			$data[$this->name.'_sort_order'] = $this->request->post[$this->name.'_sort_order'];
		} elseif ( $this->config->get($this->name.'_sort_order') ) {
			$data[$this->name.'_sort_order'] = $this->config->get($this->name.'_sort_order');
		} else {
			$data[$this->name.'_sort_order'] = $this->_get_shipping_sort_order();
		}

		$operativas = unserialize($this->config->get($this->name.'_operativa'));

		if (isset($this->request->post[$this->name.'_operativa'])) {
			$data[$this->name.'_operativas'] = $this->request->post[$this->name.'_operativa'];
		} elseif (!empty($operativas)) {
			$data[$this->name.'_operativas'] = $operativas;
		} else {
			$data[$this->name.'_operativas'] = array();
		}

		if (isset($this->request->post[$this->name.'_round'])) {
			$data[$this->name.'_round'] = $this->request->post[$this->name.'_round'];
		} else {
			$data[$this->name.'_round'] = $this->config->get($this->name.'_round');
		}


		$this->template = '/extension/'.$this->type . '/' . $this->name . '.tpl';//$this->type . '/extension/' . $this->name . '.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		if ($v14x)
		{
			$this->document->title = $data['heading_title'];
			$this->document->breadcrumbs = $breadcrumbs;
			//$this->response->setOutput($this->render(true), $this->config->get('config_compression'));
		}

		else
		{
			$this->document->setTitle($data['heading_title']);
			$data['breadcrumbs'] = $breadcrumbs;
			//$this->response->setOutput($this->render());
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/oca.tpl', $data));

	}

	private function _get_shipping_sort_order() {

		//$this->load->model('setting/extension');
		$this->load->model('extension/extension');

		$sort_order = array();

		foreach ($this->model_extension_extension->getInstalled($this->type) as $shipping) {
			$sort_order[] = $this->config->get($shipping . '_sort_order');
		}

		return max($sort_order)+1;
	}

	private function _load_language() {

		//var_dump(VERSION);
		/*
		if (!defined('VERSION') || strpos(VERSION, '1.4.7') === 0) {


			$language = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE language_id = '" . $this->config->get('config_language_id') . "'");
			$directory = (file_exists(DIR_LANGUAGE . $language->row['directory'] . '/' . $this->type . '/' . $this->name . '.php')) ? $language->row['directory'] : 'english';

			if (!file_exists(DIR_LANGUAGE . $directory . '/' . $this->type . '/' . $this->name . '.php')) {
				echo 'Error: Could not load language ' . $this->type . '/' . $this->name . '!';
				exit();
			}

			$_ = array();
			require(DIR_LANGUAGE . $language->row['directory'] . '/' . $language->row['filename'] . '.php');
			require(DIR_LANGUAGE . $directory . '/' . $this->type . '/' . $this->name . '.php');
			//$data = array_merge($data, $_);
		} else {
			echo "ho";
			var_dump($this->type);
			var_dump($this->name);
			//$data = array_merge($data, $this->load->language($this->type . '/' . $this->name));
		}*/

		$this->load->language('extension/shipping/oca');

		$data['heading_general'] = $this->language->get('heading_general');




	}

	private function _format_url($route, $args = '', $connection = 'NONSSL')
	{
		if (!defined('VERSION') || VERSION < 1.5)
		{
			$url = ($connection == 'NONSSL') ? HTTP_SERVER : HTTPS_SERVER;
			$url .= 'index.php?route=' . $route;
			$url .= ($args) ? '&' . ltrim($args, '&') : '';

			return $url;
		}

		else
		{
			return $this->url->link($route, $args, $connection);
		}
	}

	private function validate()
	{

		if (!$this->user->hasPermission('modify', $this->type . '/' . $this->name))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (empty($this->request->post[$this->name.'_cuit']))
		{
			$this->error['cuit'] = $this->language->get('error_cuit');
		}
		else
		{
			if (!preg_match('/^[\d]{2}-[\d]{7,8}-[\d]$/', $this->request->post[$this->name.'_cuit'])) {
				$this->error['cuit'] = $this->language->get('error_cuit_format');
			}
		}

		if (empty($this->request->post[$this->name.'_cp_origen']))
		{
			$this->error['cp_origen'] = $this->language->get('error_cp_origen');
		}
		else
		{
			if (!preg_match('/^([1-9]{1}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/', $this->request->post[$this->name.'_cp_origen'])) {
				$this->error['cp_origen'] = $this->language->get('error_cp_format');
			}
		}

		if (!empty($this->request->post[$this->name.'_destino']) && !is_numeric($this->request->post[$this->name.'_destino']) )
		{
			$this->error['destino'] = $this->language->get('error_destino');
		}

		if (empty($this->request->post[$this->name.'_user']) || $this->request->post[$this->name.'_user'] == '' )
		{
			$this->error['user'] = $this->language->get('error_user');
		}

		if (empty($this->request->post[$this->name.'_password']) || $this->request->post[$this->name.'_password'] == '' )
		{
			$this->error['password'] = $this->language->get('error_password');
		}

		if (!empty($this->request->post[$this->name.'_seguro']) && !is_numeric($this->request->post[$this->name.'_seguro']) )
		{
			$this->error['seguro'] = $this->language->get('error_seguro');
		}

		if (!empty($this->request->post[$this->name.'_total_min']) && !is_numeric($this->request->post[$this->name.'_total_min']) )
		{
			$this->error['total'] = $this->language->get('error_total');
		}

		if (!empty($this->request->post[$this->name.'_total_max']) && !is_numeric($this->request->post[$this->name.'_total_max']) )
		{
			$this->error['total'] = $this->language->get('error_total');
		}

		if ( empty($this->request->post[$this->name.'_length']) || empty($this->request->post[$this->name.'_width']) || empty($this->request->post[$this->name.'_height']) )
		{
			$this->error['dimension'] = $this->language->get('error_dimension');
		}

		if(isset($this->request->post[$this->name.'_operativa'])){

			foreach ( $this->request->post[$this->name.'_operativa'] as $operativa_key => $operativa_value ) {
				if ( (utf8_strlen($operativa_value['nombre']) < 3) || (utf8_strlen($operativa_value['nombre']) > 80) )
				{
					$this->error['nombre'][$operativa_key] = $this->language->get('error_nombre');
				}

				if ( ! is_numeric($operativa_value['operativa_id']) )
				{
					$this->error['operativa_id'][$operativa_key] = $this->language->get('error_operativa_id');
				}
			}

		}


		if (!$this->error)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function listado_envios()
	{
		$this->_load_language();



		$data['button_filter']=$this->language->get('button_filter');
		$data['column_num_producto']=$this->language->get('column_num_producto');
		$data['column_num_envio']=$this->language->get('column_num_envio');
		$data['text_no_results']=$this->language->get('text_no_results');


		$token = $data['token'] = (isset($this->session->data['token'])) ? $this->session->data['token'] : '';
		$version = (!defined('VERSION')) ? 140 : (int)substr(str_replace('.', '', VERSION), 0, 3);

		$data['CUIT'] = $this->config->get($this->name.'_cuit');

		if (isset($this->request->post['FechaDesde'])) {
			$data['FechaDesde'] = date('d/m/Y', strtotime($this->request->post['FechaDesde']));
		} else {
			$data['FechaDesde'] = date('d/m/Y', strtotime('-30 day'));
		}

		if (isset($this->request->post['FechaHasta'])) {
			$data['FechaHasta'] = date('d/m/Y', strtotime($this->request->post['FechaHasta']));
		} else {
			$data['FechaHasta'] = date('d/m/Y', strtotime('now'));
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', $this->type . '/' . $this->name))
		{
			$data['success'] = sprintf($this->language->get('text_success_le'), $data['FechaDesde'], $data['FechaHasta']);
		}
		else
		{
			$data['success'] = '';
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', $this->type . '/' . $this->name))
		{
			$data['error_warning'] = $this->language->get('error_permission');
		}
		else
		{
			$data['error_warning'] = '';
		}


		if (isset($this->request->get['page']))
		{
			$page = $this->request->get['page'];
		}
		else
		{
			$page = 1;
		}

		$data['listados_envios'] = array();

		$resultados = $this->_listado($data);

		if ($resultados)
		{
			foreach (array_slice($resultados['resultados'], ($page - 1) * $this->config->get('config_admin_limit'), $this->config->get('config_admin_limit'), true) as $resultado)
			{
				$data['listados_envios'][] = array(
					'numero_producto'	=>	$resultado['NroProducto'],
					'numero_envio'		=>	$resultado['NumeroEnvio']
				);
			}
		}

		$listado_envios_total = count($resultados['resultados']);

		$pagination = new Pagination();
		$pagination->total = $listado_envios_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->_format_url($this->type . '/' . $this->name . '/listado_envios', 'token=' . $token . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$this->template = $this->type . '/oca_listado_envio.tpl';

		if ($version < 150)
		{
			$this->response->setOutput($this->render(true), $this->config->get('config_compression'));
		}

		else
		{
			//$this->response->setOutput($this->render());
			$this->response->setOutput($this->load->view('ectenshipping/oca_listado_envio.tpl', $data));
		}
	}

	private function _listado($data)
	{
		require_once('../system/nusoap/lib/nusoap.php');

		$client = new nusoap_client("http://webservice.oca.com.ar/oep_tracking/Oep_Track.asmx?wsdl", true);

		$response = $client->call('List_Envios', array($data), '', '#Oca_Express_Pak/List_Envios');

		$err = $client->getError();

		if($err) {
			$respPrint = print_r($response, true);
			exit("OCA Error: $err \r\n\r\n  $respPrint");
		}

		if (!$response) {
			return;
		}

		if (isset($response['List_EnviosResult']['diffgram']['NewDataSet']['Table']))
		{
			$service = array();

			$service['resultados'] = $response['List_EnviosResult']['diffgram']['NewDataSet']['Table'];
		}

		else
		{
			//no hay resultados
			return;
		}

		return $service;
	}

	public function tracking_envio()
	{
		$this->_load_language();

		$json = array();

		require_once('../system/nusoap/lib/nusoap.php');

		$client = new nusoap_client("http://webservice.oca.com.ar/oep_tracking/Oep_Track.asmx?wsdl", true);

		$data['Pieza'] = $this->request->post['Pieza'];

		$response = $client->call('Tracking_Pieza', array($data), '', '#Oca_Express_Pak/Tracking_Pieza');

		$err = $client->getError();

		if($err) {
			$respPrint = print_r($response, true);
			exit("OCA Error: $err \r\n\r\n  $respPrint");
		}

		if (!$response) {
			$json['error'] = 'Error obteniendo datos 1';
		}

		if (!isset($response['Tracking_PiezaResult']['diffgram']['NewDataSet']))
		{
			$json['error'] = 'Error obteniendo datos 2';
			$json['pieza'] = $data['Pieza'];
		}

		else
		{
			foreach ($response['Tracking_PiezaResult']['diffgram']['NewDataSet']['Table'] as $resultado)
			{
				$json['resultados'][] = array(
					'NumeroEnvio'			=>	$resultado['NumeroEnvio'],
					'Descripcion_Motivo'	=>	utf8_encode($resultado['Descripcion_Motivo']),
					'Desdcripcion_Estado'	=>	utf8_encode(trim(str_replace($resultado['SUC'], '', $resultado['Desdcripcion_Estado']))),
					'SUC'					=>	utf8_encode($resultado['SUC']),
					'fecha'					=>	date('d/m/Y', strtotime($resultado['fecha'])),
				);
			}
			$json['title'] = sprintf($this->language->get('text_dialog_le'), $data['Pieza']);
		}

		$this->response->setOutput(json_encode($json));
	}

}
?>
