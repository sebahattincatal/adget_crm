<?php
session_start(); ob_start();


include("inc/include.php");
error_reporting(0);
header('Content-type: text/xml'); // Xml dosyası olduğunu belirtiyoruz.
// Xml tanımları
echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
echo "<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd\">";




$order_id = mysql_real_escape_string(strip_tags($_GET["order_id"]));

			$part = explode(",", $order_id);
			if(count($part)>1){

				$stop_limit= 50;
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

			$gost=0;

			$aff= (int)$_GET["af"];
			$pass= str_replace("_", "", $_GET["key"]);


		

			if(empty($aff) or empty($pass)){
				exit("99");
			}else{
				if(is_numeric($pass)){
						$sor = $db->get_var("SELECT COUNT(*) FROM affiliate where affiliate_id='".$aff."' AND affiliate_key='".$pass."' ");
						if($sor<1){
						exit("98");
						}else{
							$gost=1;
						}
				}else{
					exit("97");
				}

			}




			$drm = $db->get_results("SELECT * FROM siparis_durumlari ");
			foreach ($drm as  $value) {
				$iscase[$value->durum_id] = $value->donusum;
			}



			$sql = $db->get_results("SELECT * FROM siparisler where order_id in (".$search.")  AND affiliate='".$aff."' ");
			if($sql){
				foreach ($sql as  $value) {
						 $sonnot = $db->get_row("SELECT * FROM siparis_notlari where siparis_id ='".$value->siparis_id."' order by siparis_id DESC limit 1 ");

						 	if(empty($sonnot->siparis_notu)){
						 		$sipNo = "empty";
						 	}else{
						 		$sipNo= $sonnot->siparis_notu;
						 	}
					$xml_ciktisi .= "
					<orders>
                          <order_id>".$value->order_id."</order_id>
                          <status>".$iscase[$value->siparis_durumu]."</status>
                              <ext_id>".$value->siparis_durumu."</ext_id>
                              <error>".$sipNo."</error>
                   </orders>\n
                              ";



			} 

		     }





$xml_ciktisi .= "</urlset>\n";

echo $xml_ciktisi; // Oluşturduğumuz xml çıktısını bastırıyoruz.


?>