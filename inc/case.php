<?php
session_start(); ob_start();
include("include.php");


error_reporting();
$case = $_GET["ido"];



function fatura_guncelle(){
	global $db;




			$il           = mysql_real_escape_string(strip_tags($_POST["il"]));
			$ilce         = mysql_real_escape_string(strip_tags($_POST["ilce"]));
			$adres        = mysql_real_escape_string(strip_tags($_POST["adres"]));
			$siparis_id   = mysql_real_escape_string(strip_tags($_POST["ilanid"]));
			$Telefon_no   = mysql_real_escape_string(strip_tags(filler($_POST["tel"])));
			$adi      	  = mysql_real_escape_string(strip_tags(($_POST["adi"])));
			$indirim      = mysql_real_escape_string(strip_tags(($_POST["indirim"])));
			$indirim_tipi = mysql_real_escape_string(strip_tags(($_POST["indirim_tipi"])));
			$urun_id      = mysql_real_escape_string(strip_tags(($_POST["urun_id"])));

				

			$indirim = $indirim * $indirim_tipi;

   			
   			$orders       = $db->get_row("SELECT * FROM  siparisler  where  siparis_id = '".$siparis_id."' ");
			$product      = $db->get_row("SELECT * FROM  urunler     where  urun_id    = '".$orders->urun_id."' ");
			$nwproduct    = $db->get_row("SELECT * FROM  urunler     where  urun_id    = '".$urun_id."' ");

              if($urun_id==$orders->urun_id){
              
              	 $fiyat_es    = $orders->fiyat;
              }else{


              	$siparis["ilk_urun_id"]    		= $orders->urun_id;
                $siparis["ilk_fiyat"]      		= $product->urun_fiyati;
                $siparis["ilk_urun_adeti"] 		= $product->adet;
                $siparis["urun_adeti"]          = $nwproduct->adet; 
                $siparis["urunun_adi"]          = $nwproduct->urun_adi;  
                $siparis["urun_id"]             = $urun_id;  
                
                $fiyat_es    					= $nwproduct->urun_fiyati;

              }


				         

              if(!empty($indirim)){
                $fiyat               = number_format($fiyat_es,0) - $indirim;
                $siparis["fiyat"]    = $fiyat; 
                if($indirim>0){
                 $siparis["indirim"]  = $indirim;
                }
                 
              }else{
              	$siparis["fiyat"]= $fiyat_es;
              }






			$siparis["il"]=$il;
			$siparis["ilce"]=$ilce;
			$siparis["adres"]=$adres;
			$siparis["Telefon_no"]=$Telefon_no;
			$siparis["ad_soyad"]=$adi;
			
			


			if(empty($il) or empty($ilce) or empty($adres) or empty($adi) or empty($siparis_id) or empty($Telefon_no)){
				exit("2");
			}else{




				
					$where = " siparis_id='".$siparis_id."'";
				    $degistir= update_array("siparisler",$siparis,$where);
				 

				 	if($degistir){
				 		echo '1';
				 	}else{
				 		echo '0';
				 	}






			}






}



function sip_yenile($sip_no){
	global $db;
		

				if(!empty($sip_no)){
					$all = $db->get_row("SELECT * FROM  siparisler where siparis_id= '".$sip_no."'");
					if($all){
						$sql["ad_soyad"]      = $all->ad_soyad;
						$sql["Telefon_no"]    = $all->Telefon_no;
						$sql["il"]            = $all->il;
						$sql["ilce"]          = $all->ilce;
						$sql["add_user"]      = $_SESSION["admin_id"];
						$sql["kilit"]         = 1;
						$sql["kilit_pers"]    = $_SESSION["admin_id"];
						$sql["siparis_tipi"]  = 5;


						$ekle = insert_array("siparisler",$sql);
						if($ekle){
							echo $db->insert_id;
						}else{
							echo "0";
						}
					}
				}
}






switch ($case) {


		case "415285101":

				$durum  =$_POST["durum"];
			echo ' <select class="form-control " id="alt_durum_id" name="alt_durum_id" onchange="Gts2();"  style="width:300px"> ';
			 $urunler =$db->get_results("SELECT * FROM alt_siparis_durumlari  where alt_durum='".$durum."' ");
			 echo '<option value="0">Seçiniz</option>';
                foreach ($urunler as  $value) {
                
                  echo '<option value="'.$value->alt_durum_id.'" >'.$value->name.'</option>';
                }

			echo '</select>';


		break;





		case "412789302":

			fatura_guncelle();

		break;


		case "45001289":
		echo '0';

		break;


		case "14587002":


		$e = $db->get_row("SELECT siparis_id FROM  siparisler WHERE siparis_durumu=7 AND kal_kontrol=0 AND siparis_tipi<>4 order by kalite_date asc  limit 1");
		if($e){
		echo $e->siparis_id;
		}else{
		echo "-0-";
			}
		break;



	 	case "2244002":


	 	$sipno = (int)$_POST["x"];

	 	$user_id = $_SESSION["admin_id"];

	 	$islem = mysql_real_escape_string(strip_tags($_POST["y"]));

	 	if(!empty($sipno) AND !empty($islem) AND !empty($user_id)){
	 		
	 		if($islem =="Onay"){
	 			$x = $db->query("UPDATE `siparisler` SET  `Kal_onay_user`=".$user_id.", `kal_kontrol`=1 WHERE `siparis_id`=".$sipno." ");
	 		}elseif($islem=="308"){
				$x = $db->query("UPDATE `siparisler` SET  `kalite_date`='".date("Y-m-d H:i:s")."' WHERE `siparis_id`=".$sipno." ");
	 		}else{

	 		    $x= $db->query("UPDATE `siparisler` SET  `Kal_onay_user`=".$user_id.", siparis_durumu=5, iptal_tarihi='".date("Y-m-d H:i:s")."', `kal_kontrol`=1, iptal_nedeni=".$islem.", iptal_user=".$user_id." WHERE `siparis_id`=".$sipno." ");
	 		}

	 		$x=1;

	 		if($x){
	 			echo '1';
	 		}else{
	 			echo 'Lütfen İşemi Kontrol ediniz.';
	 		}

	 	}else{
	 		echo 'Lütfen İşlemi Kontrol ediniz.';
	 	}




	 	break;



		case "412536701":
		 $il  = mysql_real_escape_string(strip_tags($_POST["il"]));

		$il_ids = $db->get_row(" SELECT * FROM il where il_adi like '%".$il."%' ");
        $ilsqls = "where  il_id='".$il_ids->il_id."'";


        $ilce_sq =$db->get_results(" SELECT * FROM ilce $ilsqls ORDER BY ilce_id DESC");
        if($ilce_sq){
        	echo '<select name="ilce" id="ilce" class="select2" style="width:150px; display:inline-block; padding-left: 8px; padding-right: 20px; padding-top: 5px; padding-bottom: 4px; border-radius: 3px;">';
         foreach ($ilce_sq as  $ilcevalue) {
              		echo '<option value="'.$ilcevalue->ilce_adi.'">'.$ilcevalue->ilce_adi.'</option>';
              	}
              	echo '</select>';
        }

		break;


















			case "74157536":

$phone = strip_tags($_POST["tp"]);
$tipi  = strip_tags($_POST["phone"]);



if(is_numeric($phone)){
            $e = $db->get_row("SELECT * FROM siparisler where Telefon_no like '%".$phone."%' order by siparis_durumu ASC  ");

if($e)
{

   echo '

<div class="alert alert-success">
   <div style="width:100%; display:block; margin-left:auto; margin-right:auto;">
   <b>Şuan Görüşme sağladığınız Müşteri Bilgileri<b>
 <b style="padding:3px; display:block">Ad soyad :  '.$e->ad_soyad.'</b>
 <b style="padding:3px; display:block">Sipariş No: '.$e->siparis_id.'</b>
 <b style="padding:3px; display:block">Telefon Numarası : '.$e->Telefon_no.'</b>


<button type="button" onclick="sipDetay(\''.$e->siparis_id.'\')" class="btn btn-primary btn-lg">Müşteri Kartını Aç</button>
</div>
</div>


   ';


}else{
    echo '
    <div class="alert alert-success">
<div style="width:350px; display:block; margin-left:auto; margin-right:auto;">
     <center> Merhaba Arayan Müşteri CRM\'de kayıtlı değil.<br><br>
  
     Telefon Numarası : <b>'.$phone.'</b>
     </center>

     <br>
    <center>
<button class="btn btn-primary mr5 btn-lg" onclick="phone_go(\''.$phone.'\');" data-toggle="modal" data-target=".musteriekle">Müşteriyi CRM\'e Ekle</button>

   </center>
</div>
    </div>';
}


}else{
    echo 'Geçersiz Telefon Numarası.';
}




			break;



				case "110":
/*
AND  `update_date` 
BETWEEN  '0000-00-00 00:00:00'
AND  '".date("Y-m-d H:i:s")."'
*/
				$e= $db->get_results("SELECT siparis_tipi, COUNT( * ) AS adet
FROM  `siparisler` 
WHERE kilit =0
AND siparis_durumu
IN ( 1, 2, 3 )  ".$sql_statu."

GROUP BY siparis_tipi");
				
				$adet["1"][]="0"; $adet["2"][]="0"; $adet["3"][]="0"; $adet["4"][]=0;$adet["6"][]=0; $total[]=0;
				
		
				if($e){
				foreach ($e as  $value) {
					$adet[$value->siparis_tipi][]=$value->adet;
					$total[]=$value->adet;
				}
			}

				/*$d = $db->get_var("SELECT count(*)  FROM  `siparisler`  WHERE kilit =0 AND siparis_durumu IN (1,2,3)  AND  `update_date`  BETWEEN  '0000-00-00 00:00:00' AND  '".date("Y-m-d H:i:s")."'");

				if($d){
					echo $d;
				}else{
					echo "0";
				}*/


				echo '


				<div class="row">
                  <div class="col-xs-4">
                    <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">Kuyrukta</small>
                    <h1>'.array_sum($total).' </h1>
                  </div>
                </div><!-- row -->
                
                <div class="mb15"></div>


                 <div class="row">
                  <div class="col-xs-3">
                    <small class="stat-label"><center>Danış.</center></small>
                    <h4><center>'.array_sum($adet["4"]).' </center></h4>
                  </div>
                  
                  <div class="col-xs-3" '.$div_statu.'>
                    <small class="stat-label"><center>Sipariş</center></small>
                    <h4><center>'.array_sum($adet["1"]).'</center></h4>
                  </div>

                  <div class="col-xs-3" '.$div_statu.'>
                    <small class="stat-label"><center>Arama</center></small>
                    <h4><center>'.array_sum($adet["2"]).'</center></h4>
                  </div>

                  <div class="col-xs-3" '.$div_statu.'>
                    <small class="stat-label"><center>Yetişkin</center></small>
                    <h4><center>'.array_sum($adet["6"]).'</center></h4>
                  </div>

                </div>

                <!-- row -->';

				

				break;





				case "109":

				$d = $db->query("UPDATE siparisler set kilit=0 where `siparis_durumu` IN (0,1,2) AND kilit=1 ");
					if($d){
						echo 'Kilitler Açıldı';
					}else{
						echo 'Kiliç açma işlemi Başarısız';
					}
				break;



				case "106":
				$sip_no = (int)$_POST["sipno"];

					sip_yenile($sip_no);

				break;




				case "105":
				$sip_no = (int)$_POST["sipno"];
				if(!empty($sip_no)){
					$deg = $db->query("UPDATE siparisler set kilit=1, kilit_pers='".$_SESSION["admin_id"]."' where siparis_id='".$sip_no."'");
					if($deg){
						echo '1';
					}else{
						echo '0';
					}
				}

				break;



				case "104":

				$search = mysql_real_escape_string(strip_tags($_POST["search"]));


$durumlar = $db->get_results("SELECT * FROM siparis_durumlari ");
foreach ($durumlar as  $value) {
	$dizi[$value->durum_id]=$value->name;
	$dizirenk[$value->durum_id]=$value->renk;
}



				echo '

				<div class="panel panel-dark panel-alt">
                            
                                <div class="panel-body panel-table" style="height:300px; overflow:scroll;overflow-x: hidden;">
                                    <div class="table-responsive">
                                    <table class="table table-buglist">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left;">Müşteri</th>
                                                <th>Sipariş No</th>
                                                <th>Telefon</th>
                                                <th>Durumu</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody >

                                        ';
                                            
$user_type = $_SESSION["user_type"];
$sptype = $_SESSION["sip_type"];

if($sptype==4){
	$eksql = "AND siparis_tipi=4  ";
}else{
	$eksql ="";
}
    $e = $db->get_results("SELECT * FROM  siparisler where  (siparis_id='".$search."' or ad_soyad LIKE '%".$search."%' or Telefon_no LIKE '%".$search."%' ) ".$eksql." order by update_date ASC ");
    
    if($e){
    foreach ($e as $value) {
                                       

$trh_yaz="";
if($value->siparis_durumu==7){
	$trh_yaz = "<br>".$value->satis_tarihi;
}



                                        	echo '


                                            <tr class="'.$dizirenk[$value->siparis_durumu].'"">
                                                <td style="width:30%;text-align: left;">'.$value->ad_soyad.'</td>
                                                <td style="width:15%;text-align: left;">'.$value->siparis_id.'</td>
                                                <td style="width:20%">'.$value->Telefon_no.'</td>
                                                <td>'.$dizi[$value->siparis_durumu].'  '.$trh_yaz.'</td>
                                                <td>
                                                    <div class="btn-group drpdwn">
                                                        <a role="button" data-toggle="dropdown" class="dropdown-toggle" data-target="dropdown_list">
                                                          <i class="fa fa-cog"></i>
                                                        </a>
                                                        <ul role="menu" class="dropdown-menu pull-right">
                                                          <li><a href="javascript:sipDetay(\''.$value->siparis_id.'\')">Sipariş Detay</a></li>
                                                          <li><a href="javascript:SipYenile(\''.$value->siparis_id.'\');">Yeni Sipariş</a></li>
                                                          <li><a href="#">Kargo Durumu</a></li>
                                                          ';
                                                          if($user_type==1){
                                                         
                                                          echo'
                                                          <li class="divider"></li>
                                                          <li><a href="#" styl >İptal et</a></li>
                                                         ';
                                                         }

                                                         echo '
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            	';
 }}else{
 	echo '<div class="alert alert-danger"><center><b>'.$search.'</b> için Kayıt Bulunamadı.</center></div>';
 }

                                            	echo'

                                        </tbody>
                                    </table>
                                    </div><!-- table-responsive -->
                                </div><!-- panel-body -->
                            </div><!-- panel -->


				';

				break;



				case "303":

				$ad      = p("ad");
				$phone   = p("Phone");

				if(empty($ad) or empty($phone)){
					exit("-1");
				}else{

					$kayit = $db->get_row("SELECT siparis_id FROM  siparisler where   Telefon_no='".$phone."'");
					if($kayit){

							$sip_no = $kayit->siparis_id;
							sip_yenile($sip_no);

				}else{


					    $sql["ad_soyad"]=$ad;
						$sql["Telefon_no"]=$phone;
					
						$sql["add_user"]=$_SESSION["admin_id"];
						$sql["siparis_tipi"]=5;
						$sql["kilit"]=1;
						$sql["kilit_pers"]=$_SESSION["admin_id"];


						$ekle = insert_array("siparisler",$sql);
						if($ekle){
							echo $db->insert_id;
						}else{
							echo "0";
						}



				}
				}


				break;


				case "103":

				$option_name = p("select_name");
				$option_tipi = p("option_id");

				$part =explode(",", $option_name);
$toplama = count($part);



				if(!empty($option_name) AND !empty($option_tipi)){

if($toplama>1){
				
for($i=0; $i<=$toplama-1; $i++){
$names = $part[$i];	
 $save  = $db->query("insert into `option_select`  (select_name,option_id)values('$names','$option_tipi')");
 if($save){
  alert_yes($names." Seçenek Eklendi <br> ");
 }else{
   alert_no($names."Seçenek Eklenemedi <br>");
 }

}


	}else{
	

$save  = $db->query("insert into `option_select`  (select_name,option_id)values('$option_name','$option_tipi')");
 if($save){
  alert_yes("Seçenek Eklendi : ");
 }else{
   alert_no("Seçenek Eklenemedi ");
 }

}		







				}

	


				 break;







		case "102":

				$option_name = p("option_name");
				$option_tipi = p("option_tipi");

				if(!empty($option_name) AND !empty($option_tipi)){

 $save  = $db->query("insert into `option`  (option_name,option_tipi)values('$option_name','$option_tipi')");

 $id = $db->insert_id;
 if($save){
 	alert_yes("Seçenek Eklendi : ".$id);
 }else{
 	alert_no("Seçenek Eklenemedi ");
 }


				}

	


				 break;





















	case "101";


	$mail  = p("mail");
	$pass  = p("password");
    $where = array();

	if(empty($mail) or empty($pass)){
		exit("0");
	}else{

		$where[] = "mail='".$mail."'";
		$where[] = "password='".md5($pass)."'";
		$where[] = "login_case=0";
		$whr  = implode(" AND ", $where);

						$sor = cls_count("admin",$whr);

						if($sor>0){

							
							$r                         = cls_row("admin",$whr);
							$_SESSION["admin_id"]      = $r->admin_id;
							$_SESSION["admin_name"]    = $r->name_surname;
							$_SESSION["admin_time"]    = date("Y-m-d H:i:s");
							$_SESSION["admin_login"]   = 1;
							$_SESSION["user_type"]     = $r->user_type;
							$_SESSION["name_surname"]  = $r->name_surname;
							$_SESSION["sip_type"]      = $r->sip_type;
							$_SESSION["agent"]         = $r->agent;
							$_SESSION["yetki"]         = $r->yetki;
							$_SESSION["extra_yetki"]   = $r->extra_yetki;

							setcookie("admin_id",$r->admin_id,time()+(24*60*60));
							setcookie("admin_name",$r->name_surname,time()+(24*60*60));
							setcookie("admin_time",date("Y-m-d H:i:s"),time()+(24*60*60));
							setcookie("user_type",$r->user_type,time()+(24*60*60));
							setcookie("name_surname",$r->name_surname,time()+(24*60*60));
							setcookie("sip_type",$r->sip_type,time()+(24*60*60));
							setcookie("agent",$r->agent,time()+(24*60*60));
							setcookie("admin_login",1,time()+(24*60*60));




echo '1';

						}else{
							echo 'Lütfen Bilgileri Kontrol ediniz.';
						}

	}


	break;














}




?>