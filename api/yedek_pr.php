<?php
session_start(); ob_start();


include("inc/include.php");


function psp($t){
  
   $t = mysql_real_escape_string(strip_tags($t));
   return $t;
}

 			 $af          = psp($_POST["af"]);
 			 $afPass      = psp($_POST["ps"]);
 			 $order_id    = psp($_POST["order_id"]);
 			 $phone       = psp($_POST["phone"]);	
 			 $api_key     = psp($_POST["api_key"]);
 			 $name        = psp($_POST["name"]);
 			 $goods_id    = psp($_POST["goods_id"]);

 			 /*----------------------*/

 			 $u_age     = psp($_POST["u_age"]);
 			 $kullanim  = psp($_POST["kullanim"]);
 			 $site_id   = psp($_POST["site_id"]);

 			 /*--------------------*/

 			

 				$produc_row =$db->get_row("SELECT * FROM urunler where urun_id='".$goods_id."'");

				$sql["u_age"]			    = $u_age;
				$sql["kullanim"]			= $kullanim;
				$sql["fiyat"]				= $produc_row->urun_fiyati;
				$sql["urun_adeti"]			= $produc_row->adet;
				$sql["site_id"]			    = $site_id;
				$sql["Telefon_no"]			= $produc_row->Telefon_no;
				$sql["urunun_adi"]			= $produc_row->urun_adi;
				$sql["ip_adres"]			= p($_POST["ip_adres"]);
				$sql["siparis_tipi"]		= 4;



 			 /*--------------------*/


 			 $sql["affiliate"]  = $af;
 			 $sql["order_id"]   = $order_id;
 			 $sql["Telefon_no"] = $phone;
 			 $sql["api_key"]    = $api_key;
 			 $sql["ad_soyad"]   = $name;
 			 $sql["urun_id"]    = $goods_id;

 			 if(!empty($phone)){

 			 	$ekle = insert_array("siparisler",$sql);
 			 	if($ekle){
 			 		echo '1';
 			 	}else{
 			 		echo '0';
 			 	}


 			 }else{

		   //  $hatali_ekle = insert_array("siparisler_hatali",$sql);

 			 	print_r($sql);
 			 }

 				//$yedek_ekle = insert_array("siparisler_yedek",$sql);


?>