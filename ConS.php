<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

include ("inc/include.php");

$x=0;

exit();


$today = date("Y-m-d H:i:s",time(date("m/d/Y H:i:s"))-60*240);


$d =$db->get_results("SELECT * FROM  siparisler where siparis_durumu=99 AND siparis_tipi=1 AND update_date between '0000-00-00 00:00:00' AND '".$today."' ");
foreach ($d as  $value) {
	
	$ekle = $db->query("INSERT into gointera_calling.calling (phone,customer_type,orders_code) VALUES ('".$value->Telefon_no."','".$value->siparis_tipi."', '".$value->siparis_id."')  ");
	if($ekle){
		$degistir= $db->query("UPDATE siparisler SET siparis_durumu=1 WHERE  siparis_id='".$value->siparis_id."' ");
		if($degistir){
			echo ' - Başarılı <br>';
		}else{
			echo ' - Başarılı <br>';
		}
	}
	$x++;
}




?>