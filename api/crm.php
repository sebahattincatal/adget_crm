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
			if (is_numeric($id)) {
				return true;
			} else {
				return false;
			}
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
			//$surname = $this->clear($_POST['surname']);
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
				}

				if ($error == false) {
					if ($this->orderSendInsert($order_id, $quantity, $product, $price, $name_surname, $phone, $city, $district, $address, $api_key)) {
						
						$error = false;
						$data['statusCode'] = 103;
						$data['description'] = 'Siparişiniz Başarılı Bir Şekilde Alınmıştır.';

					} else {

						$error = true;
						$data['statusCode'] = 104;
						$data['description'] = 'Siparişiniz Alınırken Hata Meydana Geldi. Lütfen Tekrar Deneyin.';
					}
				}

			} else {

				$data['statusCode'] = 1000;
				$data['description'] = 'Bu apikeye sahip kullanıcı bulunmamaktadır';
			}

			return $this->response($data);
		}

		function orderSendInsert($order_id, $quantity, $product, $price, $name_surname, $phone, $city, $district, $address, $api_key)
		{
			global $db;

			//$result = $db->get_results("INSERT INTO 'siparisler' (api_key, order_id, Telefon_no, fiyat, urun_adeti,urunun_adi, ad_soyad, il, ilce, adres) VALUES ('".$order_id."', '".$quantity."', '".$product."', '".$price."', '".$name_surname."', '".$phone."', '".$city."', '".$district."', '".$address."', '".$api_key."')");


			$result = $db->get_query("INSERT INTO siparisler (order_id, urun_adeti, urunun_adi, fiyat, ad_soyad, Telefon_no, il, ilce, adres, api_key) VALUES ('".$order_id."', '".$quantity."', '".$product."', '".$price."', '".$name_surname."', '".$phone."', '".$city."', '".$district."', '".$address."', '".$api_key."')");

			var_dump($result);exit;

			if(count($result) > 0) {
			 	return true;
			} else{
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