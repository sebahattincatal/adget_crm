<?php
session_start(); ob_start();
include("../include.php");
oturum_koru();

$drmlar = $db->get_results("SELECT durum_id FROM siparis_durumlari WHERE toto=1");
foreach ($drmlar as $value) {
	$drm[]=$value->durum_id;
}


$drm_x  =implode(",", $drm);

if(empty($_SESSION["siparis_id"])){

/*
AND  `update_date` 
BETWEEN  '0000-00-00 00:00:00'
AND  '".date("Y-m-d H:i:s")."'
*/

$kuyruk =(int)$_SESSION["sip_type"];
if(empty($kuyruk)){ $kuyruk=1; }


$all = $db->get_row("SELECT * 
FROM  `siparisler` 
WHERE kilit =0
AND siparis_durumu
IN (1,2,3,99) 
AND siparis_tipi = '".$kuyruk."'
  order by update_date ASC limit 1");
if($all){
	
$degistir= $db->query("UPDATE siparisler  set kilit=1 , toto_date='".date("Y-m-d H:i:s")."' , kilit_pers='".$_SESSION["admin_id"]."' WHERE siparis_id='".$all->siparis_id."' ");
echo $all->siparis_id;
$_SESSION["siparis_id"]=$all->siparis_id;
}else{
	echo '010102';
}


}else{
	echo $_SESSION["siparis_id"];
}

?>