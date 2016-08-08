<?php

	date_default_timezone_set('Europe/Istanbul');
	include_once "inc/db/shared/ez_sql_core.php";
	include_once "inc/db/ez_sql_mysql.php";


	$prefix = "cimpanel_";
	$vt_kullanici=$prefix."go";
	$vt_parola="musa1202";
	$vt_isim=$prefix."go";
	$vt_sunucu="localhost";
 
    $db = new ezSQL_mysql($vt_kullanici,$vt_parola,$vt_isim,$vt_sunucu);
	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET utf8");
	$db->query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
	

   $fotograf_yollari =array(
   	'800'=>'_img_/img_one/'
   	);


 
?>