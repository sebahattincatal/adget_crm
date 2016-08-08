<?php
session_start();
ob_start();

//require_once "inc/include.php";
include "inc/config.php";
include "inc/function.php";

function psp($t)
{

    $t = mysql_real_escape_string(strip_tags($t));
    return $t;
}

/*
- 99  => affilate Bilgileri Yanlış Bililer Yedeklenir.
- 97  => Telefon Bilgisi Yanlış.

*/
$af = psp($_POST["af"]);
$afPass = psp($_POST["ps"]);
$order_id = @$_POST["order_id"] ? psp(@$_POST["order_id"]) : (int) (rand(1, 99) + time() + microtime());
$phone = psp($_POST["phone"]);
$api_key = psp($_POST["api_key"]);
$name = psp($_POST["name"]);
$goods_id = psp($_POST["goods_id"]);
$ip_adres = psp($_POST["ip_adres"]);

/*----------------------*/

$u_age = psp($_POST["u_age"]);
$kullanim = psp($_POST["kullanim"]);
$site_id = psp($_POST["site_id"]);

/*--------------------*/


if ($site_id == "1") {
    $sor_count = $db->get_var("SELECT * FROM siparisler where ip_adres='" . $ip_adres . "' AND kayit_tarihi BETWEEN '" . DATE("Y-m-d") . " 00:00:00' AND '" . DATE("Y-m-d") . " 23:59:59' ");

    if ($sor_count >= 2) {
        exit("0");
    }
}

$produc_row = $db->get_row("SELECT * FROM urunler where urun_id='" . $goods_id . "'");


$sql["u_age"] = $u_age;
$sql["kullanim"] = $kullanim;
$sql["fiyat"] = $produc_row->urun_fiyati;
$sql["urun_adeti"] = $produc_row->adet;
$sql["site_id"] = $site_id;
$sql["Telefon_no"] = $produc_row->Telefon_no;
$sql["urunun_adi"] = $produc_row->urun_adi;
$sql["ip_adres"] = p($_POST["ip_adres"]);
$sql["adres"] = psp($_POST["adres"]);
$sql["il"] = psp($_POST["il"]);
$sql["ilce"] = psp($_POST["ilce"]);
$sql["odeme_id"] = psp($_POST["odeme"]);


/*--------------------*/


$sql["affiliate"] = $af;
$sql["order_id"] = $order_id;
$sql["Telefon_no"] = $phone;
$sql["api_key"] = $api_key;
$sql["ad_soyad"] = $name;
$sql["urun_id"] = $goods_id;
$sql["update_date"] = date("Y-m-d H:i:s");
$sql["islem_tarihi"] = date("Y-m-d H:i:s");


/* if($goods_id==6464){
$sql["siparis_tipi"]		= 1;
}else{
$sql["siparis_tipi"]		= 4;
}

*/

if (!empty($produc_row->kuyruk)) {
    $sql["siparis_tipi"] = $produc_row->kuyruk;
} else {
    if ($goods_id == 6464) {
        $sql["siparis_tipi"] = 1;
    } else {
        $sql["siparis_tipi"] = 4;
    }
}


if (!empty($phone)) {

    $ekle = insert_array("siparisler", $sql);
    if ($ekle) {
        echo '1';
    } else {
        $if = $db->get_row("SELECT * FROM siparisler WHERE order_id = '".$order_id."'");
        if($if){
            echo '1';
        }else{
            echo '0';
        }
    }


} else {

    //  $hatali_ekle = insert_array("siparisler_hatali",$sql);

    echo '';
}

//$yedek_ekle = insert_array("siparisler_yedek",$sql);


?>