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
					$data['description'] = 'Geçersiz sipariş numarası formatı';

				} elseif (!$this->inNumeric($phone)) {

					$error = true;
					$data['statusCode'] = 101;
					$data['description'] = 'Geçersiz telefon numarası formatı';

				} elseif (!$this->inNumeric($quantity)) {

					$error = true;
					$data['statusCode'] = 102;
					$data['description'] = 'Geçersiz adet girdiniz';

				} elseif (!$this->isNull($price)) {

					$error = true;
					$data['statusCode'] = 103;
					$data['description'] = 'Fiyat değerini göndermelisiniz';

				} elseif (!$this->isNull($product)) {

					$error = true;
					$data['statusCode'] = 104;
					$data['description'] = 'Ürünün adını göndermelisiniz';

				} elseif (!$this->isNull($name_surname)) {

					$error = true;
					$data['statusCode'] = 105;
					$data['description'] = 'Müşterinin ad ve soyad bilgisini göndermelisiniz';

				} elseif (!$this->isNull($city)) {

					$error = true;
					$data['statusCode'] = 106;
					$data['description'] = 'Siparişe ait il bilgisini göndermelisiniz';

				} elseif (!$this->isNull($district)) {

					$error = true;
					$data['statusCode'] = 107;
					$data['description'] = 'Siparişe ait ilçe bilgisini göndermelisiniz';

				} elseif (!$this->isNull($address)) {

					$error = true;
					$data['statusCode'] = 108;
					$data['description'] = 'Siparişe ait adres bilgisini göndermelisiniz';
				}

				if ($error == false) {
					if ($this->orderSendInsert($order_id, $quantity, $product, $price, $name_surname, $phone, $city, $district, $address, $api_key)) {
						
						$error = false;
						$data['statusCode'] = 109;
						$data['description'] = 'Siparişiniz Başarılı Bir Şekilde Alınmıştır.';

					} else {

						$error = true;
						$data['statusCode'] = 110;
						$data['description'] = 'Siparişiniz Alınırken Hata Meydana Geldi. Lütfen Tekrar Deneyin.';
					}
				}

			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'Bu apikeye sahip kullanıcı bulunmamaktadır';
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

		function notFound()
		{
			$data['statusCode'] = 404;
			$data['description'] = 'Böyle bir url tanımlaması bulunmamaktadır.';

			return $this->response($data);
		}

		function response($data)
		{
			echo json_encode($data);
		}

	}

?>