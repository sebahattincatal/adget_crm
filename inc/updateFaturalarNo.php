<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 13.08.2015
 * Time: 03:12
 */

ob_start();
ini_set("display_errors", "On");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf8");

require_once "config.php";

$Response = array();

foreach($_POST["data"] AS $index => $Fatura){

    $Response[$index] = array();

    foreach($Fatura AS $SiparisNo => $FaturaNo){

        $Response[$index] = array("siparis" => $FaturaNo, "status" => false);

        $Done = $db->query("UPDATE `siparisler` SET `fatura_no` = '".$FaturaNo."' WHERE `siparis_id` = '".$SiparisNo."'");

        if($Done){

            $Response[$index]["status"] = true;

        }

    }

}

header("Content-Type: application/json; charset=utf8;");

exit(json_encode($Response));