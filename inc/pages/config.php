<?php

	include_once "inc/db/shared/ez_sql_core.php";
	include_once "inc/db/ez_sql_mysql.php";

	$prefix = "adgetcrm_";
	$vt_kullanici=$prefix."user";
	$vt_parola="12022133";
	$vt_isim=$prefix."db";
	$vt_sunucu="localhost";
 
    $db = new ezSQL_mysql($vt_kullanici,$vt_parola,$vt_isim,$vt_sunucu);
	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET utf8");
	$db->query("SET COLLATION_CONNECTION = 'utf8_general_ci'");
	

   $fotograf_yollari =array(
   	'800'=>'_img_/img_one/'
   	);

/*
 * sigarabirakin
 * vQrvVLcVLZ
 *
 */

 
?>