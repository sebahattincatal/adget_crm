<?php if (!defined("idokey")) { exit(); }



$user_type =$_SESSION["user_type"];

if($user_type<1){header("Location:index.php");}


function part($t){
  $xx =explode("/",$t);
  $k=  $xx["2"]."-".$xx["1"]."-".$xx["0"];
  return $k;
}



if($_POST){
$start_date =part($_POST["start"]);
$stop_date  =part($_POST["stop"]);

}else{
 $start_date = date("Y-m-d");
   $stop_date = date("Y-m-d");
}

if(empty($start_date)){
  $start_date = date("Y-m-d");
}

if(empty($stop_date)){
  $stop_date = date("Y-m-d");
}




$p1 = str_replace("-","/", date("d-m-Y",strtotime($start_date)));
$p2 = str_replace("-","/", date("d-m-Y",strtotime($stop_date)));



?>




<script type="text/javascript">
  
function CargoPOST(x){

     $("#EE"+x).hide();
     $("#EEE"+x).show();
     $("#EEE"+x).html(' <img src="yukleniyor.gif" style="height:70%">');

  $.post("inc/aras_api_post.php",{x:x},function(donenVeri){
                             var donen  =donenVeri;



                             if(donen=='Başarılı'){

                              $("#CD"+x).css('background-color', '#DFFFBF');

                              $("#CE"+x).html("Kargolandı");


                              $("#EE"+x).show();
                             $("#EEE"+x).hide("");

                             }else{

                              $("#CD"+x).css('background-color', '#FFD9D9');

                              $("#CE"+x).html("Yeninden Dene");

                              $("#EE"+x).show();
                             $("#EEE"+x).html('<b style="color:#8C0000">'+donen+'</b>');


                             }
                             		var res = donen.replace('<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" /></head>',  "");
                             //alert(res);

                            });  

       

}

</script>




<div class="panel panel-default">


<div class="panel-heading">
          
              <h4 class="panel-title">Satışlar</h4>
            </div>

     
        <div class="panel-body">

          <div class="table-responsive">
            <table class="table" id="table1">
              <thead>
                 <tr>
                    <th>Ad Soyad</th>
                    <th>Telefon</th>
                    <th>Ürün</th>
                    <th>Fiyat</th>
                    <th>Personel</th>
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>


            

              <?php

$urun_listesi = array();

        $e = $db->get_results("SELECT * FROM siparisler where satis_tarihi between '0000-00-00 00:00:00' AND '".$stop_date." 23:59:59' AND siparis_durumu in (7,9) AND kal_kontrol=1 AND cargoPrint=0 ".$sql_statu."  order by satis_tarihi ASC ");

 // $e = $db->get_results("SELECT * FROM siparisler where  (satis_tarihi between '".$start_date." 00:00:00' AND '".$stop_date." 23:59:59') AND siparis_durumu in (7,9)  ".$sql_statu."  ");
              foreach ($e as  $value) {

                $urun_listesi[$value->urun_id][]=1;
                $urun_listesi_name[$value->urun_id]=$value->urunun_adi;
                
                  echo '
                  <tr class="odd gradeX" id="CD'.$value->siparis_id.'">
                    <td>
                      <div id="EE'.$value->siparis_id.'">
                    '.$value->ad_soyad.'<br>SipNo:'.$value->siparis_id.' </div>
                    <div   id="EEE'.$value->siparis_id.'"  style="display:none">
                    
                     </div>
                    </td>
                    <td>'.$value->Telefon_no.'</td>
                    <td>'.$value->urunun_adi.'</td>
                    <td>'.$value->fiyat.'</td>
                    <td>'.personel("name_surname",$value->personel).'<br>'.$value->satis_tarihi.'</td>
                   
               
                    <td >
                    <a href="javascript:CargoPOST(\''.$value->siparis_id.'\')" class="btn btn-info xs" id="CE'.$value->siparis_id.'">Kargola</a>
';

       
   
        
echo '


                    </td>
                 </tr>
                 ';
              }


              ?>
                 
               
              </tbody>
           </table>
          </div><!-- table-responsive -->
       
    
          
        </div><!-- panel-body -->
      </div><!-- panel -->

