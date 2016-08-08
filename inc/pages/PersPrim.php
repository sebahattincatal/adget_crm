<?php if (!defined("idokey")) { exit(); }?>



<?php

if($_POST){
  $start = str_replace("/", "-", $_POST["start"]); 
  $stop  = str_replace("/", "-", $_POST["stop"]); 

  if(empty($start)){$start = date("Y-m-d"); }
  if(empty($stop)){$stop   = date("Y-m-d"); }

}else{
  $start = date("Y-m")."-1";
  $stop = date("Y-m")."-31";
}

 $start_data = date("Y-m-d", strtotime($start));
 $stop_data =date("Y-m-d", strtotime($stop));



$p1 = str_replace("-","/",date("d-m-Y", strtotime($start_data)));
$p2 = str_replace("-","/",date("d-m-Y", strtotime($stop_data))); 


$personel = (int)$_GET["id"];
/*
if(empty($personel)){
  header("Location:pages.php?ido=personeller");
}
*/
?>




<div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
              </div>
              <h4 class="panel-title">Tarih </h4>
            </div>
            <div class="panel-body">
            <form action="" method="post">
           
              
              <div class="input-group col-md-4" style="float:left; width:200px; ">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type="text" name="start" value="<?=$p1?>" placeholder="Başlangıç" id="date" class="form-control date" />
              </div>

              <div class="input-group col-md-4" style="float:left; margin-left:20px; width:200px;">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                <input type="text" name="stop" value="<?=$p2?>" placeholder="Bitiş" id="date" class="form-control date" />
              </div>

                <div class="input-group col-md-4" style="float:left; margin-left:20px; width:200px;"> 
              <input type="submit" class="btn btn-info"></div>
            </form>  
                          
            </div>
          </div><!-- panel -->
        </div><!-- col-md-6 -->









<div class="table-responsive">
    <h3>  Satış işlemleri</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th>Satış Alanı</th>
            <th>Toplam Satış</th>
            <th>Kesinleşen Satış</th>
            <th>Sepet Arttırımı</th>
            <th>Geçersiz</th>
            <th>Çift Kayıt</th>
              <th>İndirim</th>
            <th>Toplam Ciro</th>
            <th>Prim</th>
            <th>Toplam İade</th>
            <th>İade Ciro</th>
          
             
          </tr>
        </thead>
        <tbody>

        <?php
        $x = 1;




               if($_SESSION["yetki"]==0){
                   $alanlar = $db->get_results("SELECT * FROM admin where   login_case=0  ".$sql_statu3." ");
                 }else{
                   $alanlar = $db->get_results("SELECT * FROM admin where user_type=0 AND login_case=0  ".$sql_statu3." ");
                 }


  
          foreach ($alanlar as $yzalan) {


unset($dizim);
unset($cirox);
unset($indirim);
unset($iade_cirox);
unset($sepet);
unset($prim);


    $sor  = $db->get_results("SELECT * FROM siparisler where    personel='".$yzalan->admin_id."' AND islem_tarihi between '".$start_data." 00:00:00' AND '".$stop_data." 23:59:59'  ");

   foreach ($sor as   $value) {
     $dizim [$value->siparis_durumu][]=1;
       $gdd = $value->urun_adeti - $value->ilk_urun_adeti;

        if($value->siparis_durumu==7 OR $value->siparis_durumu==9 OR $value->siparis_durumu==8){
          $cirox[]=$value->fiyat;
          $indirim[]=$value->indirim;

         

        } 

        if($value->siparis_durumu==6){
          $iade_cirox[]=$value->fiyat;
        }

        if($value->ilk_urun_adeti> 0 AND $gdd > 0 AND ($value->siparis_durumu==7 OR $value->siparis_durumu==9 ) AND $value->siparis_tipi=1){
          if($value->siparis_durumu==8)
            { $prim[]=$gdd;}
            $sepet[]= $gdd;
          
       }
   }






                $tum_satislar = array_sum($dizim[7])+array_sum($dizim[9]);
                $kesinlesen =(int) array_sum($dizim[8]);
                $sepet_sayisi = (int)array_sum($sepet);
                $gecersiz = (int) array_sum($dizim[4]);
                $Ciftkayit = (int) array_sum($dizim[88]);
                $ciro = number_format(array_sum($cirox),2);
                $iade_ciro = number_format(array_sum($iade_cirox),2);
                $iade =(int) (array_sum($dizim[6]));
                $indirim  =array_sum($indirim);
                $prim = array_sum($prim);


                $tum_satislar1 = $tum_satislar1+$tum_satislar;
                $kesinlesen1 = $kesinlesen1+$kesinlesen1;
                $sepet_sayisi1 = $sepet_sayisi1+$sepet_sayisi;
                $gecersiz1 = $gecersiz1+$gecersiz;
                $Ciftkayit1 = $Ciftkayit1+$Ciftkayit;
                $ciro1 = ($ciro1 + array_sum($cirox));
                $iade_ciro1 = $iade_ciro1+array_sum($iade_cirox);
                $indirim1 = $indirim1+$indirim;
                $prim1 = $prim1+$prim;

                $iade1 = $iade1+$iade;







            if($tum_satislar>0){

             echo '<tr>
            <th scope="row">'.$x.'</th>
            <td>'.$yzalan->name_surname.'</td>
            <td>'.$tum_satislar.'</td>
            <td>'.$kesinlesen.'</td>
            <td style="color:green"><b>'.$sepet_sayisi.' adet </b></td>
            <td>'.$gecersiz.'</td>
            <td>'.$Ciftkayit.'</td>
             <td><b>'.number_format($indirim,2).' ₺</b></td>
            <td><b>'.$ciro.' ₺</b></td>
            <td><b style="color:red">'.number_format($prim,2).' ₺</b></td>
            <td>'.$iade.'</td>
            <td><b>'.$iade_ciro.' ₺</b></td>
           
          </tr>';
          $x++;
           }






         }

             echo '<tr>
            <th scope="row">'.$x .'</th>
            <td>Genel Toplam</td>
            <td>'.$tum_satislar1.'</td>
            <td>'.$kesinlesen1.'</td>
            <td style="color:green"><b>'.number_format($sepet_sayisi1,0).' adet</b></td>
            <td>'.$gecersiz1.'</td>
            <td>'.$Ciftkayit1.'</td>
             <td><b>'.number_format($indirim1,2).' ₺</b></td>
            <td><b>'.number_format($ciro1,2).' ₺</b></td>
            <td><b style="color:red">'.number_format($prim1,2).' ₺</b></td>
            <td>'.$iade1.' </td>
            <td><b>'.number_format($iade_ciro1,2).' ₺</b></td>
           
            <tr>';

          


        ?>
          


         
         
 
        </tbody>
      </table>
    </div>










