<?php

require_once "mercadopago.php";

class ControllerPaymentMPStandard extends Controller {

	private $error;
	public $sucess = true;
	private $order_info;
	private $message;
	private $sponsors = array('MLB' => 204931135,
		'MLM' => 204962951,
		'MLA' => 204931029,
		'MCO' => 204964815,
		'MLV' => 204964612,
		'MPE' => 217176790,
		'MLC' => 204927454);

	public function index() {
		$data['customer_email'] = $this->customer->getEmail();
		$data['button_confirm'] = $this->language->get('button_confirm');
		$data['button_back'] = $this->language->get('button_back');
		$data['terms'] = 'Teste de termos';
		$data['public_key'] = $this->config->get('mp_standard_public_key');

		if ($this->config->get('mp_standard_country')) {
			$data['action'] = $this->config->get('mp_standard_country');
		}

		$this->load->model('checkout/order');

		$this->language->load('payment/mp_standard');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		//Cambio el código ISO-3 de la moneda por el que se les ocurrio poner a los de mp_standard!!!
		$accepted_currencies = array('ARS' => 'ARS', 'ARG' => 'ARS', 'VEF' => 'VEF',
			'BRA' => 'BRL', 'BRL' => 'BRL', 'REA' => 'BRL', 'MXN' => 'MEX',
			'CLP' => 'CHI', 'COP' => 'COP', 'PEN' => 'PEN', 'US' => 'US', 'USD' => 'USD');

		$currency = $accepted_currencies[$order_info['currency_code']];

		$currencies = array('ARS', 'BRL', 'MEX', 'CHI', 'PEN', 'VEF', 'COP');
		if (!in_array($currency, $currencies)) {
			$currency = '';
			$data['error'] = $this->language->get('currency_no_support');
		}

		$totalprice = $order_info['total'] * $order_info['currency_value'];
		$products = '';
		$all_products = $this->cart->getProducts();
		$items = array();

		foreach ($all_products as $product) {
			$products .= $product['quantity'] . ' x ' . $product['name'] . ', ';
			$items[] = array(
				"id" => $product['product_id'],
				"title" => $product['name'],
				"description" => $product['quantity'] . ' x ' . $product['name'], // string
				"quantity" => intval($product['quantity']),
				"unit_price" => $this->currency->format($product['price'], $order_info['currency_code'], false, false), //decimal
				"currency_id" => $currency,
				"picture_url" => HTTP_SERVER . 'image/' . $product['image'],
				"category_id" => $this->config->get('mp_standard_category_id'),
			);
		}

		// if (isset($this->session->data['coupon'])) {
		// 	$total_data = array(
		// 		'totals' => &$totals,
		// 		'taxes'  => &$taxes,
		// 		'total'  => &$total
		// 	);
		// 	$this->load->model('total/coupon');
		// 	$results = $this->model_extension_extension->getExtensions('total');
		// 	$this->model_total_coupon->getTotal($total_data);

		// 	$items[] = array(
		// 		"id" => $this->session->data['coupon'],
		// 		"title" => 'coupon',
		// 		"description" => 'coupon_code_by_seller',
		// 		"quantity" => 1,
		// 		"unit_price" => round(floatval($total_data['total']) * $order_info['currency_value'], 2),
		// 		"currency_id" => $currency,
		// 		"category_id" => $this->config->get('mp_standard_category_id')
		// 	);
		// }

		$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);

		error_log("====total====".$total);
		error_log("====text_total====".$this->language->get('text_total'));

		if ($total > 0) {
			// if (isset($this->session->data['shipping_method'])) {
			// 	$total =- round(floatval($this->session->data['shipping_method']['cost']), 2) * $order_info['currency_value']
			// }
			$items[] = array(
				"id" => 99,
				"title" => '',
				"description" => $this->language->get('text_total'),
				"quantity" => 1,
				"unit_price" => $total,
				"currency_id" => $currency,
				"category_id" => $this->config->get('mp_standard_category_id')
			);			
		}


		// if (isset($this->session->data['shipping_method'])) {
		// 	$shipments = array(
		// 		"receiver_address" => array(
		// 			"floor" => "-",
		// 			"zip_code" => $order_info['shipping_postcode'],
		// 			"street_name" => $order_info['shipping_address_1'] . " - " .
		// 			$order_info['shipping_address_2'] . " - " .
		// 			$order_info['shipping_city'] . " - " .
		// 			$order_info['shipping_zone'] . " - " .
		// 			$order_info['shipping_country'],
		// 			"apartment" => "-",
		// 			"street_number" => "-",
		// 		),
		// 		"cost" => round(floatval($this->session->data['shipping_method']['cost']), 2) * $order_info['currency_value'],
		// 		"mode" => "custom",
		// 	);
		// }

		error_log("=====data items=====".json_encode($items));

		$this->id = 'payment';

		$data['server'] = $_SERVER;
		$data['debug'] = $this->config->get('mp_standard_debug');

		$client_id = $this->config->get('mp_standard_client_id');
		$client_secret = $this->config->get('mp_standard_client_secret');
		$url = $order_info['store_url'];
		$installments = (int) $this->config->get('mp_standard_installments');

		$cust = $this->db->query("SELECT * FROM `" .
			DB_PREFIX . "customer` WHERE customer_id = " .
			$order_info['customer_id'] . " ");
		$date_created = "";
		$date_creation_user = "";

		if ($cust->num_rows > 0):
			foreach ($cust->rows as $customer):
				$date_created = $customer['date_added'];
			endforeach;
			$date_creation_user = date('Y-m-d', strtotime($date_created)) . "T" . date('H:i:s', strtotime($date_created));
		endif;

		$payer = array(
			"name" => $order_info['payment_firstname'],
			"surname" => $order_info['payment_lastname'],
			"email" => $order_info['email'],
			"date_created" => $date_creation_user,
			"phone" => array(
				"area_code" => "-",
				"number" => $order_info['telephone'],
			),
			"address" => array(
				"zip_code" => $order_info['payment_postcode'],
				"street_name" => $order_info['payment_address_1'] . " - " .
				$order_info['payment_address_2'] . " - " .
				$order_info['payment_city'] . " - " .
				$order_info['payment_zone'] . " - " .
				$order_info['payment_country'],
				"street_number" => "-",
			),
			"identification" => array(
				"number" => "null",
				"type" => "null",
			),
		);

		$exclude = $this->config->get('mp_standard_methods');
		$country_id = $this->config->get('mp_standard_country') == null ? 'MLA' : $this->config->get('mp_standard_country');

		$installments = (int) $installments;
		if ($exclude != '') {

			$accepted_methods = preg_split("/[\s,]+/", $exclude);
			$all_payment_methods = $this->getMethods($country_id);
			$excluded_payments = array();
			foreach ($all_payment_methods as $method) {
				if (!in_array($method['id'], $accepted_methods) && $method['id'] != 'account_money') {
					$excluded_payments[] = array('id' => $method['id']);
				}
			}

			$payment_methods = array(
				"installments" => $installments,
				"excluded_payment_methods" => $excluded_payments,
			);
		} else {
			//case not exist exclude methods
			$payment_methods = array("installments" => $installments);
		}

		//set back url
		$back_urls = array(
			"pending" => $url . 'index.php?route=payment/mp_standard/callback',
			"success" => $url . 'index.php?route=payment/mp_standard/callback',
			"failure" => $url . 'index.php?route=payment/mp_standard/callback',
		);

		$pref = array();
		$pref['external_reference'] = $order_info['order_id'];
		$pref['items'] = $items;

		// if (isset($this->session->data['shipping_method'])) {
		// 	$pref['shipments'] = $shipments;
		// }

		$pref['auto_return'] = $this->config->get('mp_standard_enable_return');
		$pref['back_urls'] = $back_urls;
		$pref['payment_methods'] = $payment_methods;
		$pref['payer'] = $payer;
    if (!strrpos($url, 'localhost')) {
    	$pref['notification_url'] = $url . 'index.php?route=payment/mp_standard/notifications';
    }
		$sandbox = (bool) $this->config->get('mp_standard_sandbox');
		$is_test_user = strpos($order_info['email'], '@testuser.com');

		if (!$is_test_user) {
			$pref["sponsor_id"] = $this->sponsors[$this->config->get('mp_standard_country')];
		}

		$mp = new MP($client_id, $client_secret);
		$preferenceResult = $mp->create_preference($pref);

		if ($preferenceResult['status'] == 201):
			$data['type_checkout'] = $this->config->get('mp_standard_type_checkout');
			if ($sandbox):
				$data['redirect_link'] = $preferenceResult['response']['sandbox_init_point'];
			else:
				$data['redirect_link'] = $preferenceResult['response']['init_point'];
			endif;
		else:
			$data['error'] = "Error: " . $preferenceResult['status'];
		endif;
		$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('order_status_id_pending'), date('d/m/Y h:i'));
		$view = floatval(VERSION) < 2.2 ? 'default/template/payment/mp_standard.tpl' : 'payment/mp_standard.tpl';
		return $this->load->view($view, $data);
	}

	private function getMethods($country_id) {
		$url = "https://api.mercadolibre.com/sites/" . $country_id . "/payment_methods";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //returns the transference value like a string
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/x-www-form-urlencoded')); //sets the header
		curl_setopt($ch, CURLOPT_URL, $url); //oauth API
		if (isset($posts)) {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
		}
		$jsonresult = curl_exec($ch); //execute the conection
		curl_close($ch);
		$result = json_decode($jsonresult, true);
		return $result;
	}

	public function callback() {
		if ($this->request->get['collection_status'] == "null") {
			$this->response->redirect($this->url->link('checkout/checkout'));
		} elseif (isset($this->request->get['preference_id'])) {
			$order_id = $this->request->get['collection_id'];

			$this->load->model('checkout/order');
			$order = $this->model_checkout_order->getOrder($order_id);
			$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mercadopago_order_status_id'), date('d/m/Y h:i'));
			$this->retorno();
			$this->response->redirect($this->url->link('checkout/success'));
		}
	}

	public function notifications() {
		if (isset($this->request->get['topic'])) {
			$this->request->get['collection_id'] = $this->request->get['id'];
			$this->retorno();
			echo json_encode(200);
		}
	}

	public function retorno() {

		error_log("=====collection_id======".$this->request->get['collection_id']);

		error_log("=====collection_id request======".json_encode($this->request));

		if (isset($this->request->get['collection_id'])) {
			if ($this->request->get['collection_id'] == 'null') {
				$order_id = $this->request->get['external_reference'];
				$this->load->model('checkout/order');
				$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_' . $this->request->get['status']), date('d/m/Y h:i'));
				return;

			}

			$ids = explode(',', $this->request->get['collection_id']);
			$client_id = $this->config->get('mp_standard_client_id');
			$client_secret = $this->config->get('mp_standard_client_secret');
			$sandbox = $this->config->get('mp_standard_sandbox') == 1 ? true : null;
			$mp = new MP($client_id, $client_secret);
			$mp->sandbox_mode($sandbox);
			foreach ($ids as $id) {
				$resposta = $mp->get_payment_info($id);
				$dados = $resposta['response'];

				$order_id = $dados['collection']['external_reference'];
				$order_status = $dados['collection']['status'];

				$this->load->model('checkout/order');
				$order = $this->model_checkout_order->getOrder($order_id);

				if ($order['order_status_id'] == '0') {
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id'));
				}

				switch ($order_status) {
				case 'approved':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_completed'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'pending':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_pending'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'in_process':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_process'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'reject':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_rejected'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'refunded':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_refunded'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'cancelled':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_cancelled'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				case 'in_metiation':
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_in_mediation'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				default:
					$this->model_checkout_order->addOrderHistory($order_id, $this->config->get('mp_standard_order_status_id_pending'), date('d/m/Y h:i') . ' - ' . $dados['collection']['payment_method_id'] . ' - ' . $dados['collection']['net_received_amount']);
					break;
				}
			}
		} else {
			error_log('id não setado na compra!!!');
		}

	}
}
