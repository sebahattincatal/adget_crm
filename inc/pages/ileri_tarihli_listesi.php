<?php

 if (!defined("idokey")) { exit(); }





        if(!$_SESSION["user_type"]==1){

        $d = ozel_yetki_sor(1);
        if(empty($d)){header("Location:index.php");}
        }








              $drm = 3;
              $tip = 1;
              $gd = (int)$_GET["g"];

              if(empty($drm)){header("Location:index.php");}

              $durum = $db->get_row("SELECT * FROM siparis_durumlari where durum_id='".$drm."' ");


?>

<div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title"> <?=$durum->name?> Sipariş Listesi</h3>
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
                    <th>il/ilce</th>
                    <th>Durumu</th>
                    <th>Kilit</th>
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>


       
              <?php


              

              $e = $db->get_results("SELECT * FROM siparisler where siparis_durumu='".$drm."' AND siparis_tipi='".$tip."'  AND update_date between '2015-01-01 00:00:00' AND '".date("Y-m-d")." 23:59:59'  order by update_date asc  ");
              foreach ($e as  $value) {

                
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->ad_soyad.'<br> <font style="color:green">Sip Kod : '.$value->siparis_id.'</font> </td>
                    <td>'.$value->Telefon_no.'</td>
                    <td>'.$value->urunun_adi.'</td>
                    <td>'.$value->fiyat.'</td>
                    <td>'.$value->il.' / '.$value->ilce.'<br> '.$value->update_date.'</td>
                    <td > '.$durum->name.'  

                    ';

                    if($drm==9 or $drm==7){echo "<br>".date("d-m-Y", strtotime($value->satis_tarihi));}
                    echo'

                    </td>
                    ';

                    if($drm==9 or $drm==7){


                       $kilitci= 'Satış<br><font style="color:green"> '.personel("name_surname",$value->personel).'</font>';


                    }else{


                        $kilitci =personel("name_surname",$value->personel);
                      
                    }



                    echo'
                    <td > '.$kilitci.'</td>
                    <td >

                    <a href="pages.php?ido=siparis&id='.$value->siparis_id.'" class="btn btn-info">Görüntüle</a>
                    <a style="display:none" href="pages.php?ido=siparis_listesi&drm='.$drm.'&tp='.$tip.'&id='.$value->siparis_id.'&g=4" class="btn btn-danger">Geçersiz</a>
                    
';

        if($drm==7 or $drm==9){
          echo '<a href="pages.php?ido=siparis_listesi&drm='.$drm.'&tp='.$tip.'&id='.$value->siparis_id.'&g=5" class="btn btn-danger">İptal</a>
';
        }
        
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
        