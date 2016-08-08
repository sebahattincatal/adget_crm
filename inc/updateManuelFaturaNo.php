<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 19.08.2015
 * Time: 03:19
 */
?>
<?php

ob_start();
session_start();
ini_set("display_errors", "On");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf8");

require_once "config.php";

$Response = array("status" => false);

$Done = $db->query("UPDATE `manuel_faturalar` SET `fatura_No` = '".$_POST["faturaNo"]."', `faturaPrint` = 1, `faturaPrinter_personel` = '".$_SESSION["admin_id"]."' WHERE `id` = '".$_POST["siparisId"]."'");

if($Done){

    $Response["status"] = true;

}

header("Content-Type: application/json; charset=utf8;");

exit(json_encode($Response));
