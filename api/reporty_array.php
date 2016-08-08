<?php
session_start(); ob_start();
include("inc/include.php");



			$order_id = mysql_real_escape_string(strip_tags($_GET["order_id"]));

			$part = explode(",", $order_id);
			if(count($part)>1){

				$stop_limit= 100;
				$cc =count($part)-1;
				if($cc>$stop_limit){
					$cc=$stop_limit;
				}

			for($i=0; $i<=$cc; $i++){

				if(is_numeric($part[$i]) AND !empty($part[$i])){

					$sql[]=$part[$i];


				}

			}

			$search = implode(",", $sql);
			}else{

				$search = (int)$order_id;

			}



			$drm = $db->get_results("SELECT * FROM siparis_durumlari ");
			foreach ($drm as  $value) {
				$iscase[$value->durum_id]=$value->donusum;
			}



			$sql = $db->get_results("SELECT * FROM siparisler where siparis_id in (".$search.")  ");
			if($sql){
				foreach ($sql as  $value) {

					$sonuc[][$value->order_id] = array(
						'order_id'=>$value->siparis_id,
						'status'=>$iscase[$value->siparis_durumu],
						'ext_id'=> '',
						'error'=> '',
						);



			} 

		     }


		     print_r($sonuc);

			/*
			   "order_id": "our order id",
   "status": "'ok' or 'error'",
   "ext_id": "your order id if status 'ok'",
   "error": "error message if error occurred"

			*/


?>