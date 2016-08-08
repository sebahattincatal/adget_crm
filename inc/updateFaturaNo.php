<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 13.08.2015
 * Time: 02:40
 */

ob_start();
ini_set("display_errors", "On");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf8");

require_once "config.php";

$Response = array("status" => false);

$Done = $db->query("UPDATE `siparisler` SET `fatura_no` = '".$_POST["faturaNo"]."' WHERE `siparis_id` = '".$_POST["siparisId"]."'");

if($Done){

    $Response["status"] = true;

}

header("Content-Type: application/json; charset=utf8;");

exit(json_encode($Response));