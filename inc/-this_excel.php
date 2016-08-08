<?php
session_start(); ob_start();
include("include.php");
oturum_koru();
function exportExcel($filename='ExportExcel',$columns=array(),$data=array(),$replaceDotCol=array()){
    header('Content-Encoding: UTF-8');
    header('Content-Type: text/plain; charset=utf-8'); 
    header("Content-disposition: attachment; filename=".$filename.".xls");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
      
    $say=count($columns);
      
    echo '<table border="1"><tr>';
    foreach($columns as $v){
        echo '<th style="background-color:#FFA500">'.trim($v).'</th>';
    }
    echo '</tr>';
  
    foreach($data as $val){
        echo '<tr>';
        for($i=0; $i < $say; $i++){
  
            if(in_array($i,$replaceDotCol)){
                echo '<td>'.str_replace('.',',',$val[$i]).'</td>';
            }else{
                echo '<td>'.$val[$i].'</td>';
            }
        }
        echo '</tr>';
    }
}

/* TANIMLAMALAR */
 
$columns=array();
 
$data=array();
 
/*
 $replaceDotCol
 Decimal kolonlardaki noktayı (.) virgüle (,) dönüştürüelecek kolon numarası belirtilmelidir.
 Örneğin; Kolon 4'ün verilerinde nokta değilde virgül görülmesini istiyorsanız
 ilgili kolonun array key numarasını belirtmelisiniz. İlk kolonun key numarası 0'dır.
*/
$replaceDotCol=array(3); 
 
 
/* Sütun Başlıkları */
$columns=array(
    'Ad Soyad',
    'Telefon No',
    'Ürün Adı',
    'Fiyatı',
    'Adeti',
    'il',
    'ilce',
    'Adres'
);

function part($t){
  $xx =explode("/",$t);
  $k=  $xx["2"]."-".$xx["1"]."-".$xx["0"];
  return $k;
}


$tarih = mysql_real_escape_string(strip_tags($_GET["tarih"]));
if(empty($tarih)){
    exit();
}

$tarih = part($_GET["tarih"]);

        $d = $db->get_results("SELECT * FROM siparisler where satis_tarihi between '".$tarih." 00:00:00' AND '".$tarih." 23:59:59' AND siparis_durumu in (7,9)  ".$sql_statu."  order by satis_tarihi ASC ");
        if($d){
        foreach ($d as  $value) {
            /* Satır Verileri */
$data[]=array(
    $value->ad_soyad,
    $value->Telefon_no,
    $value->urunun_adi,
    $value->fiyat,
    $value->urun_adeti,
    $value->il,
    $value->ilce,
    $value->adres,
  
);
        }}




 

$DosyaAdi = "kargo_ciktisi-".rand(1,999);

exportExcel($DosyaAdi,$columns,$data,$replaceDotCol);