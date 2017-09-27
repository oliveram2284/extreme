<?php
//==============================================================================
// OCA 1.2
// 
// Desarrollado por: Cofran
// E-mail: franco.iglesias@gmail.com
// Sitio Web: http://www.wachipato.com
// Soporte: http://www.wachipato.com/support
//==============================================================================

class ModelExtensionShippingOca extends Model {

	private $valor_max = 6000;	// Valor máximo declarado
	private $valor_min = 100;	// Valor mínimo declarado

	public function getQuote($address, $total = 0) {
		$v14x = (!defined('VERSION') || VERSION < 1.5);
		$v150 = (defined('VERSION') && strpos(VERSION, '1.5.0') === 0);

		$this->load->language('extension/shipping/oca');

		$current_geozones = array();

		$geozones = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '0' OR zone_id = '" . (int)$address['zone_id'] . "')");

		foreach ($geozones->rows as $geozone)
		{
			$current_geozones[] = $geozone['geo_zone_id'];
		}

		if (!$total) {
			//$checkoutsetting = ($v14x) ? 'checkout' : 'setting';
			$checkoutsetting = 'extension';
			$keycode = ($v14x) ? 'key' : 'code';

			
			$this->load->model($checkoutsetting . '/extension');

			$order_totals = $this->{'model_'.$checkoutsetting.'_extension'}->getExtensions('total');

			$sort_order = array();

			foreach ($order_totals as $key => $value)
			{
				$sort_order[$key] = $this->config->get($value[$keycode] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $order_totals);
			
			$totals = array();
			$taxes = $this->cart->getTaxes();
			$total = 0;

			// Because __call can not keep var references so we put them into an array.
			$total_data = array(
				'totals' => &$totals,
				'taxes'  => &$taxes,
				'total'  => &$total
			);

			//$total_data = array('total');					
			
			$taxes = $this->cart->getTaxes();
			
			foreach ($order_totals as $order_total)
			{

				if ($this->config->get($order_total[$keycode] . '_status'))
				{
					//var_dump('extension/total/' . $order_total[$keycode]);
					$this->load->model('extension/total/' . $order_total[$keycode]);
					//var_dump('model_extension_total_' . $order_total[$keycode]);
					$this->{'model_extension_total_' . $order_total[$keycode]}->getTotal($total_data);//, $total, $taxes);
				}
			}

			
		}

		$total=$total_data['total'];
		$taxes=$total_data['taxes'];

		if (!$this->config->get('oca_status') ||
			($this->config->get('oca_total_min') && (float)$this->config->get('oca_total_min') > $total) ||
			($this->config->get('oca_total_max') && (float)$this->config->get('oca_total_max') < $total) ||
			($this->config->get('oca_store_id') == '') ||
			!in_array((int)$this->config->get('config_store_id'), explode(',',$this->config->get('oca_store_id'))) ||
			($this->config->get('oca_geo_zone_id') == '') ||
			(empty($current_geozones) && !in_array(0, explode(',',$this->config->get('oca_geo_zone_id')))) ||
			(!empty($current_geozones) && !array_intersect(explode(',',$this->config->get('oca_geo_zone_id')), $current_geozones)) ||
			($this->config->get('oca_customer_group_id') == '' ) ||
			!in_array( (int)$this->customer->getGroupId(), (explode(',',$this->config->get('oca_customer_group_id'))) )
		) {
			$status = FALSE;
		} else {
			$status = TRUE;
		}


		$method_data = array();

		if ($status) {

			// Si el País no es Argentina (ISO-3) o no se ingreso el CP se imprime el error.
			if ($address['iso_code_3'] != 'ARG') {
				return $this->_error($this->language->get('error_country'));
			}
			elseif ($address['iso_code_3'] == 'ARG' && $address['postcode'] == '') {
				return $this->_error($this->language->get('error_postcode'));
			}

			// Elimino letras del CP nuevo, por ejemplo X5001GTT queda solamente 5001
			$postcode = preg_replace ( '/[^0-9]/', '', $address['postcode'] );

			// Calculo el peso volumétrico del pedido
			$calc_volumen = 0;

			foreach ($this->cart->getProducts() as $product) {
				
				/*
				if ( !$product['length'] || floatval($product['length']) == 0 && !$product['width'] || floatval($product['width']) == 0 && !$product['height'] || floatval($product['height']) == 0 )
				{
					return $this->_error($this->language->get('error_medicion_producto'));
				}*/
				
				$length = $this->length->convert($product['length'], $this->config->get('config_length_class_id'), $this->config->get('oca_length_class_id'));
				$width = $this->length->convert($product['width'], $this->config->get('config_length_class_id'), $this->config->get('oca_length_class_id'));
				$height = $this->length->convert($product['height'], $this->config->get('config_length_class_id'), $this->config->get('oca_length_class_id'));
				
				$calc_volumen += $height * $length * $width;
			}

			// Ordeno en arrays las operativas, si no hay ningúna imprimo el error
			$operativas=array();
			if ( $this->config->get('oca_operativa') )
			{
				$operativas = unserialize($this->config->get('oca_operativa'));
			}
			/*else
			{
				return $this->_error($this->language->get('error_operativa'));
			}*/

			$quote_data = array();
			$i=0;

			// Recorro las operativas y envio los datos a OCA
			foreach ($operativas as $operativa)
			{

				//$info_operativa = $this->_operativas($operativa);

				// Si el envío es prioritario o urgente, el peso debe estar basado en el Peso Aforado y Volumen en m3.
				/*if ( isset($operativa['prioritario']) )
				{
					$volumen = $calc_volumen / 1000000;
					$peso = $volumen * 250;
				}
				else
				{
					$volumen = $calc_volumen / 166;
					$peso = $this->weight->convert($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->config->get('oca_weight_class_id'));
				}*/

				$volumen = $calc_volumen / 1000000;
					$peso = $volumen * 250;


				$data['PesoTotal'] = $peso;
				$data['VolumenTotal'] = $volumen;
				$data['CodigoPostalOrigen'] = trim($this->config->get('oca_cp_origen'));
				$data['CodigoPostalDestino'] = $postcode;
				$data['CantidadPaquetes'] = 2;
				$data['Cuit'] = trim($this->config->get('oca_cuit'));
				$data['Operativa'] = $operativa['operativa_id'];

				$results = $this->_nusoap($data);

				if ( empty($results) )
				{
					return $this->_error('Se ha producido un error al obtener los datos');
				}

				$costo_total = $results['Total'];

				// Si el envio es contrareembolso y se debe aplicar un % al costo, lo aplico acá
				if ( array_key_exists('destino', $operativa) && $this->config->get('oca_destino') != '')
				{
					$costo_total += ($costo_total * $this->config->get('oca_destino') / 100);
				}

				// Si el envio tiene seguro y se debe aplicar un % al costo, lo aplico acá
				if ( isset($operativa['seguro']) )
				{
					// Compruebo que el total del carrito no es superior al limite máximo permitido por OCA
					if ( $this->cart->getSubTotal() > $this->valor_max )
					{
						$seguro = $this->valor_max;
					}
					elseif ( $this->cart->getSubTotal() < $this->valor_min )
					{
						$seguro = $this->valor_min;
					}
					else
					{
						$seguro = $this->cart->getSubTotal();
					}

					$seguro = ($this->cart->getSubTotal() > $this->valor_max) ? $this->valor_max : $this->cart->getSubTotal();

					$costo_total += ( $this->config->get('oca_seguro') != '' ) ? ($seguro * (float)$this->config->get('oca_seguro') / 100) : $seguro;
				}

				// Convierto la Divisa que sea a Pesos Argentinos
				$total = $this->currency->convert($costo_total, $this->config->get('config_currency'), $this->config->get('config_currency'));

				// Redondeo del costo
				if ($this->config->get('oca_round'))
				{
					$total = round($total);
				}

				// Si la operativo OCA es con pago en destino, no se incluye el costo de envio.
				if ( isset($operativa['destino']) )
				{
					$cost_total = '0.00';
				}
				else
				{
					$cost_total = $total;
				}

				//
				// Si el envio es a sucursal listo los posibles destinos según el código postal del envio (no facturación).
				//
				if ( isset($operativa['sucursal'])  )
				{
					$sucursales = $this->get_idci($postcode);

					if ( empty($sucursales) )
					{
						return $this->_error('Sin Sucursales para este destino');
					}

					foreach ($sucursales as $sucursal) {
						$quote_data['oca_'.$data['Operativa'].'_'.$sucursal['idCentroImposicion']] = array(
							'id'			=> 'oca.oca_'. $data['Operativa'].'_'.$sucursal['idCentroImposicion'], //v14x
							'code'			=> 'oca.oca_'. $data['Operativa'].'_'.$sucursal['idCentroImposicion'], //v15x
							'title'			=> $operativa['nombre'] . ' (Sucursal ' . ucwords(strtolower($sucursal['Localidad'])) . ', ' . $sucursal['Calle'] . ' ' . $sucursal['Numero'] . ')',
							'cost'			=> $cost_total,
							'tax_class_id'	=> $this->config->get('oca_tax_class_id'),
							'text'			=> $this->currency->format($this->tax->calculate($total, $this->config->get('oca_tax_class_id'), $this->config->get('config_tax')), $this->config->get('config_currency'), '1.0000', true),
						);
					}
				}

				else
				{
					$quote_data['oca_'.$data['Operativa']] = array(
						'id'			=> 'oca.oca_'. $data['Operativa'], //v14x
						'code'			=> 'oca.oca_'. $data['Operativa'], //v15x
						'title'			=> $operativa['nombre'] . ' (Plazo de entrega estimado ' . $results['PlazoEntrega']. ' días)',
						'cost'			=> $cost_total,
						'tax_class_id'	=> $this->config->get('oca_tax_class_id'),
						'text'			=> $this->currency->format($this->tax->calculate($total, $this->config->get('oca_tax_class_id'), $this->config->get('config_tax')), $this->config->get('config_currency'), '1.0000', true),
					);
				}
			}
		}

		

		if (isset($quote_data)) {
			$method_data = array(
				'id'		 => 'oca',
				'code'       => 'oca',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('oca_sort_order'),
				'error'      => false
			);
		}


		
			
		return $method_data;
	}

	private function _nusoap($data)
	{
		require_once('system/nusoap/lib/nusoap.php');

		$client = new nusoap_client("http://webservice.oca.com.ar/oep_tracking/Oep_Track.asmx?wsdl", true);

		$response = $client->call('Tarifar_Envio_Corporativo', array($data), '', '#Oca_Express_Pak/Tarifar_Envio_Corporativo');

		$err = $client->getError();

		if($err) {
			$respPrint = print_r($response, true);
			exit("OCA Error: $err \r\n\r\n  $respPrint");
		}

		if (!$response) {
			//no hay respuesta de OCA
			return array();
		}

		if (isset($response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']))
		{
			$service = array();

			$service['Tarifador'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['Tarifador'];
			$service['Precio'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['Precio'];
			$service['idTiposervicio'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['idTiposervicio'];
			$service['Ambito'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['Ambito'];
			$service['PlazoEntrega'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['PlazoEntrega'];
			$service['Adicional'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['Adicional'];
			$service['Total'] = $response['Tarifar_Envio_CorporativoResult']['diffgram']['NewDataSet']['Table']['Total'];
		}

		else
		{
			//no hay resultados
			return array();
		}

		return $service;
	}

	private function _error($error="error desconocido") {

		$quote_data = array();

		$quote_data['oca'] = array(
			'id'			=> 'oca.oca', //v14x
			'code'			=> 'oca.oca', //v15x
			'title'			=> $this->language->get('text_title'),
			'cost'			=> NULL,
			'tax_class_id'	=> NULL,
			'text'			=> $error
		);

		$method_data = array(
			'id'			=> 'oca', //v14x
			'code'			=> 'oca', //v15x
			'title'			=> $this->language->get('text_title'),
			'quote'			=> $quote_data,
			'sort_order'	=> $this->config->get('oca_sort_order'),
			'tax_class_id'	=> $this->config->get('oca_tax_class_id'),
			'error'			=> $error
		);
		return $method_data;
	}

	public function get_idci($postalcode = null) {

		require_once('system/nusoap/lib/nusoap.php');

		$client = new nusoap_client("http://webservice.oca.com.ar/oep_tracking/Oep_Track.asmx?wsdl", true);

		$data['CodigoPostal'] = $postalcode;

		$response = $client->call('GetCentrosImposicionPorCP', array($data), '', '#Oca_Express_Pak/GetCentrosImposicionPorCP');

		$err = $client->getError();

		$service = array();

		if($err) {
			$respPrint = print_r($response, true);
			exit("OCA Error Sucursales: $err \r\n\r\n  $respPrint");
		}

		if (!$response) {
			return array();
		}

		if (!isset($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']))
		{
			return array();
		}

		if (isset($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']))
		{
			if (isset($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table'][0]))
			{
				foreach ($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table'] as $sucursal)
				{
					$service[] = array(
						'idCentroImposicion'	=>	trim($sucursal['idCentroImposicion']),
						'Provincia'				=>	trim($sucursal['Provincia']),
						'Localidad'				=>	trim(str_replace('.','. ',$sucursal['Localidad'])),
						'Calle'					=>	utf8_encode(trim($sucursal['Calle'])),
						'Numero'				=>	trim($sucursal['Numero']),
					);
				}
			}
			else
			{
				$service[] = array(
						'idCentroImposicion'	=>	trim($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']['idCentroImposicion']),
						'Provincia'				=>	trim($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']['Provincia']),
						'Localidad'				=>	trim(str_replace('.','. ',$response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']['Localidad'])),
						'Calle'					=>	utf8_encode(trim($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']['Calle'])),
						'Numero'				=>	trim($response['GetCentrosImposicionPorCPResult']['diffgram']['NewDataSet']['Table']['Numero']),
				);
			}
		}

		return $service;
	}

}
?>