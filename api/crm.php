<?php

	include "inc/new_config.php";
	include "inc/function.php";



	/**
	* @author: @sebhattincatal (www.sebahattncatal.com)
	* @since: 15 Ağustos 2016
	*/
	class crm
	{
		public $data = array();

		function __construct()
		{
			// şuan boş burası
		}

		function clear($variable)
		{
			$variable = mysql_real_escape_string(strip_tags($variable));
   			return $variable;
		}

		function findApiKey($api_key)
		{
			global $db;

			$result = $db->get_results("SELECT * FROM api_key WHERE api_key = '".$api_key."'", ARRAY_A);

			if(count($result) > 0) {
			 	return true;
			} else{
			  	return false;
			}
		}

		function inNumeric($id)
		{
			if (is_numeric($id))
				return true;
			else
				return false;
		}

		function isNull($data)
		{
			if(isset($data) && !empty($data))
				return true;
			else
				return false;
		}

		function isTrim($data)
		{
			return $data = trim($data);
		}

		function orderSend()
		{
			$api_key = $this->clear($_POST['api_key']);
			$order_id = $this->clear($_POST["order_id"]);
			$phone = $this->clear($_POST["phone"]);
			$price = $this->clear($_POST['price']);
			$quantity = $this->clear($_POST['quantity']);
			$product = $this->clear($_POST['product_name']);
			$name_surname = $this->clear($_POST['name_surname']);
			$city = $this->clear($_POST['city']);
			$district = $this->clear($_POST['district']);
			$address = $this->clear($_POST['address']);

			$error = false;

			if ($this->findApiKey($api_key)) {
				
				if(!$this->inNumeric($order_id)) {

					$error = true;
					$data['statusCode'] = 100;
					$data['description'] = 'Invalid order number format';

				} elseif (!$this->inNumeric($phone)) {

					$error = true;
					$data['statusCode'] = 101;
					$data['description'] = 'Invalıd phone number';

				} elseif (!$this->inNumeric($quantity)) {

					$error = true;
					$data['statusCode'] = 102;
					$data['description'] = 'Invalid product number(piece)';

				} elseif (!$this->isNull($price)) {

					$error = true;
					$data['statusCode'] = 103;
					$data['description'] = 'You must send price';

				} elseif (!$this->isNull($product)) {

					$error = true;
					$data['statusCode'] = 104;
					$data['description'] = 'You must send product name';

				} elseif (!$this->isNull($name_surname)) {

					$error = true;
					$data['statusCode'] = 105;
					$data['description'] = 'You must send customer name&surname';

				} elseif (!$this->isNull($city)) {

					$error = true;
					$data['statusCode'] = 106;
					$data['description'] = 'You must send order city';

				} elseif (!$this->isNull($district)) {

					$error = true;
					$data['statusCode'] = 107;
					$data['description'] = 'You must send order town';

				} elseif (!$this->isNull($address)) {

					$error = true;
					$data['statusCode'] = 108;
					$data['description'] = 'You must send order adres';
				}

				if ($error == false) {
					if ($this->orderSendInsert($order_id, $quantity, $product, $price, $name_surname, $phone, $city, $district, $address, $api_key)) {
						
						$error = false;
						$data['statusCode'] = 109;
						$data['orderId'] = $order_id;
						$data['description'] = ' Order succesfully get.';

					} else {

						$error = true;
						$data['statusCode'] = 110;
						$data['description'] = 'An Error happen while getting order';
					}
				}

			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'This api key already using';
			}

			return $this->response($data);
		}

		private function orderSendInsert($order_id, $quantity, $product, $price, $name_surname, $phone, $city, $district, $address, $api_key)
		{
			global $db;

			$result = $db->query("INSERT INTO siparisler (order_id, urun_adeti, urunun_adi, fiyat, ad_soyad, Telefon_no, il, ilce, adres, api_key) VALUES ('".$this->isTrim($order_id)."', '".$this->isTrim($quantity)."', '".$this->isTrim($product)."', '".$this->isTrim($price)."', '".$this->isTrim($name_surname)."', '".$this->isTrim($phone)."', '".$this->isTrim($city)."', '".$this->isTrim($district)."', '".$this->isTrim($address)."', '".$this->isTrim($api_key)."')");

			if(count($result) > 0) {
			 	return true;
			} else {
			  	return false;
			}
		}

		public function orderStatus()
		{
			$api_key = $this->clear($_POST['api_key']);
			$order_id = $this->clear($_POST["order_id"]);

			if ($this->findApiKey($api_key)) {
				
				$data = $this->orderStatusControl($order_id);
				return $this->response($data);

			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'This api key already using';

				return $this->response($data);
			}			
		}

		private function orderStatusControl($order_id)
		{
			global $db;

			$result = $db->get_row("SELECT order_id, urunun_adi, siparis_durumu FROM siparisler WHERE order_id = '".$order_id."'");

			return $result;
		}

		public function orderStatusInformation()
		{
			$api_key = $this->clear($_POST['api_key']);
			$durum_id = $this->clear($_POST["durum_id"]);

			$data = $this->statusInformation($durum_id);

			return $this->response($data);
		}

		public function statusInformation()
		{
			global $db;

			//$result = $db->get_row("SELECT durum_id, name FROM siparis_durumlari WHERE durum_id = '".$durum_id."'");

			if ($this->findApiKey($api_key)) {

				$result = $db->get_results("SELECT durum_id, name FROM siparis_durumlari");

				foreach ($result as $value) {
					echo "status_id: ".$value->durum_id."\t";
					echo "status_name: ".$value->name."\n";
				}

				//return $result;
			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'This api key already using';

				return $this->response($data);
			}	
		}

		public function orderListStatusControl()
		{
			global $db;

			$orders = array();

			$api_key = $this->clear($_POST['api_key']);
			$orders = $this->clear($_POST["order_id"]);

			$orderId = explode(",", $orders);

			if ($this->findApiKey($api_key)) {

				foreach ($orderId as $key => $value) {
					//echo $value;exit;

					$result[$key] = $db->get_results("SELECT order_id, urunun_adi, siparis_durumu FROM siparisler WHERE order_id = '".$value."'", ARRAY_A);

					//$result = $db->get_results("SELECT * FROM api_key WHERE api_key = '".$api_key."'", ARRAY_A);

				    //print_r(get_object_vars($result));
				}

				return $this->response($result);

			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'This api key already using';

				return $this->response($data);
			}	
		}

		function notFound()
		{
			$data['statusCode'] = 404;
			$data['description'] = 'There is no url identification';

			return $this->response($data);
		}

		function response($data)
		{
			echo json_encode($data);
		}

	}

?>