<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 13.08.2015
 * Time: 02:44
 */

ob_start();
ini_set("display_errors", "On");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf8");

require_once "config.php";

$FetchOrders = $db->get_results("SELECT * FROM siparisler WHERE satis_tarihi between '0000-00-00 00:00:00' AND '" . date("Y-m-d") . " 23:59:59' AND siparis_durumu in(7,9) AND kal_kontrol=1 AND (cargoPrint = 0 AND fatura_no = 0 AND paket_user_id = 0 AND kargo_post = 0)  ORDER BY satis_tarihi ASC");

$Response = array();

foreach($FetchOrders AS $index => $Data){

    $Response[] = array("id" => $Data->siparis_id);

}

header("Content-Type: application/json; charset=utf8;");

exit(json_encode($Response));