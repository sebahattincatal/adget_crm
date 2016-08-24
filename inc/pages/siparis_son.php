<?php
ob_start();

include_once("config.php");

global $db;

$adSoyad = $_POST['adi'];
$siparis_id = $_POST['siparis_id'];
$phone = $_POST['tel'];
$urun = $_POST['urun_id'];
$hediye = $_POST['hediye_urun'];
$indirim = $_POST['indirim'];
$city = $_POST['il'];
$disrict = $_POST['ilce'];
$address = $_POST['adres'];
$note = $_POST['yorum'];
$siparis_durumu = $_POST['siparis_durumu'];
$personel_id = $_POST['personel_id'];

$db->get_results("UPDATE siparisler SET ad_soyad = '".$adSoyad."' WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET siparis_durumu = '".$siparis_durumu."' WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET hediye_urun = {$hediye} WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET indirim = {$indirim} WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET il = '".$city."' WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET ilce = '".$disrict."' WHERE siparis_id = '".$siparis_id."'");

$db->get_results("UPDATE siparisler SET adres = '".$address."' WHERE siparis_id = '".$siparis_id."'");

$db->query("INSERT INTO siparis_notlari (siparis_id, siparis_notu, personel_id, islem) VALUES ('$siparis_id', '$note', '$personel_id', '$siparis_durumu')");

echo "İşleminiz başarılı bir şekilde gerçekleştirilmiştir.Yönlendiriliyorsunuz...";

header ("refresh: 2; url=/pages.php?ido=siparis&id=$siparis_id");


?>