<?php

date_default_timezone_set('Europe/Istanbul');

include_once("config.php");
include_once("function.php");
include_once("class.php");
include_once("settings.php");





 $statu = $_SESSION["yetki"];

 if(empty($statu)){
  $sql_statu = "";
  $sql_statu2 = "";
  $sql_statu3 = "";
   
  $div_statu = '';
 }else{
  $sql_statu = " AND siparis_tipi in (".$statu.")";
  $sql_statu3 = " AND sip_type in (".$statu.")";
   
  $sql_statu2 = " WHERE siparis_tipi in (".$statu.")";
  $div_statu = 'style="display:none"';
 }



?>