<?php
session_start(); ob_start("ob_gzhandler");
set_time_limit(0);
error_reporting(0);
include("inc/include.php");
oturum_koru();
define("idokey","1",true);

if(!$_SESSION["user_type"]==1){
    exit();
}

$dizim = array();


$tipler =  mysql_real_escape_string(strip_tags($_GET["tipler"]));
$durumlar=  mysql_real_escape_string(strip_tags($_GET["durumlar"]));


if(empty($_GET["tipler"])){exit("tipler Boş Alamaz");}
if(empty($_GET["durumlar"])){exit("Durumlar Boş Alamaz");}



$ip = $_SERVER['REMOTE_ADDR'];




function exportExcel($filename='ExportExcel',$columns=array(),$data=array(),$replaceDotCol=array()){
	global $db,$tipler,$durumlar;
    header('Content-Encoding: UTF-8');
    header('Content-Type: text/plain; charset=utf-8'); 
    header("Content-disposition: attachment; filename=".$filename.".xls");
    echo "\xEF\xBB\xBF"; // UTF-8 BOM
      
    $say=count($columns);
      
    echo '<table border="0"><tr>';
    foreach($columns as $v){
        echo '<th  >'.trim($v).'</th>';
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
 

$replaceDotCol=array(3); 
 
 
/* Sütun Başlıkları */
$columns=array(
    'info',
    'number'
);




	/*$going = $db->get_results("SELECT name_surname,phone FROM  customer where customer_id in(".$cSd.") ");
		foreach ($going as  $value) {
			echo $value->name_surname." - ".$value->phone."<br>";
		}*/


//$tipler,$durumlar;

        $d = $db->get_results("SELECT ad_soyad,Telefon_no FROM  siparisler where siparis_tipi in(".$tipler.") AND  siparis_durumu in (".$durumlar.")    ");
        if($d){
        foreach ($d as  $value) {
            /* Satır Verileri */
$data[]=array(
    $value->ad_soyad,
    $value->Telefon_no,
  
);
        }}



















$DosyaAdi = date("Y-m-d")."- Data Aktarım";

exportExcel($DosyaAdi,$columns,$data,$replaceDotCol);

?>