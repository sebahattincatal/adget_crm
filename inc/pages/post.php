<?php
/**
 * Presented by @sebahattincatal
 */

require_once "config.php";

$adsoyad = $_POST["s94886"];
$telefon = '00966'.substr($_POST["a63543"], -20);
$urun_id = $_POST['h83206'];
$urun = explode('/', $urun_id);

$urun[2] = (double) $urun[2];

if( strlen($adsoyad) <= 3 || (strlen($telefon) < 10 || !is_numeric($telefon)) ) {
    echo "<script>";
    echo "alert('Lütfen formu kontrol ediniz');";
    echo "location.href='sale.html';";
    echo "</script>";
    exit;
} else {

	$query = mysqli_query($db_conn, "INSERT INTO siparisler (site_id, siparis_tipi, urun_id, urunun_adi, fiyat, urun_adeti, ad_soyad, Telefon_no) VALUES ('1', '1', '".$urun[0]."', '".$urun[1]."', '".$urun[2]."','1', '".$adsoyad."', '".$telefon."')");

    if( $query ) {
        header("Location: thanks.html#cc6");
    }
}