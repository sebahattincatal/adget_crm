<?php if (!defined("idokey")) { exit(); }?>



<?php

if($_POST){
  $start = str_replace("/", "-", $_POST["start"]); 
  $stop  = str_replace("/", "-", $_POST["stop"]); 

  if(empty($start)){$start = date("Y-m-d"); }
  if(empty($stop)){$stop   = date("Y-m-d"); }

}else{
  $start = date("Y-m-d");
  $stop = date("Y-m-d");
}

 $start_data = date("Y-m-d", strtotime($start));
 $stop_data =date("Y-m-d", strtotime($stop));



$p1 = str_replace("-","/",date("d-m-Y", strtotime($start_data)));
$p2 = str_replace("-","/",date("d-m-Y", strtotime($stop_data))); 


$personel = (int)$_GET["id"];

if(empty($personel)){
  header("Location:pages.php?ido=personeller");
}

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
            <th>Toplam İade</th>
            <th>İade Ciro</th>
          
             
          </tr>
        </thead>
        <tbody>

        <?php
        $x = 1;




   $sor  = $db->get_results("SELECT * FROM siparisler where    personel='".$personel."' AND islem_tarihi between '".$start_data." 00:00:00' AND '".$stop_data." 23:59:59'  ");
$urunlerdb= array();
   foreach ($sor as   $value) {
     $dizim[$value->siparis_tipi][$value->siparis_durumu][]=1;
       $gdd = $value->urun_adeti - $value->ilk_urun_adeti;

        if($value->siparis_durumu==7 OR $value->siparis_durumu==9 OR $value->siparis_durumu==8){
          $cirox[$value->siparis_tipi][]=$value->fiyat;
          $indirim[$value->siparis_tipi][]=$value->indirim;

          $urun_cix[$value->urun_id]["adet"][]=$value->urun_adeti;
          $urun_cix[$value->urun_id]["ciro"][]=$value->fiyat;
          $urun_cix[$value->urun_id]["toplam"][]=1;

          if(!in_array($value->urun_id, $urunlerdb)){
            $urunlerdb[]=$value->urun_id;
          }

        } 

        if($value->siparis_durumu==6){
          $iade_cirox[$value->siparis_tipi][]=$value->fiyat;
        }


        if($value->ilk_urun_adeti> 0 AND $gdd > 0 AND ($value->siparis_durumu==7 OR $value->siparis_durumu==9 )){
            $sepet[$value->siparis_tipi][]= $gdd;
       }
   }







          $alanlar = $db->get_results("SELECT * FROM  `siparis_tipleri`   ");
          foreach ($alanlar as $yzalan) {


                $tum_satislar = array_sum( $dizim[$yzalan->siparis_tipi][7])+array_sum($dizim[$yzalan->siparis_tipi][9]);
                $kesinlesen =(int) array_sum( $dizim[$yzalan->siparis_tipi][8]);
                $sepet_sayisi = (int)array_sum($sepet[$yzalan->siparis_tipi]);
                $gecersiz = (int) array_sum($dizim[$yzalan->siparis_tipi][4]);
                $Ciftkayit = (int) array_sum($dizim[$yzalan->siparis_tipi][88]);
                $ciro = number_format(array_sum($cirox[$yzalan->siparis_tipi]),2);
                $iade_ciro = number_format(array_sum($iade_cirox[$yzalan->siparis_tipi]),2);
                $iade =(int) (array_sum($dizim[6]));
                $indirim  =array_sum($indirim[$yzalan->siparis_tipi]);


                $tum_satislar1 = $tum_satislar1+$tum_satislar;
                $kesinlesen1 = $kesinlesen1+$kesinlesen1;
                $sepet_sayisi1 = $sepet_sayisi1+$sepet_sayisi;
                $gecersiz1 = $gecersiz1+$gecersiz;
                $Ciftkayit1 = $Ciftkayit1+$Ciftkayit;
                $ciro1 = ($ciro1 + array_sum($cirox[$yzalan->siparis_tipi]));
                $iade_ciro1 = $iade_ciro1+array_sum($iade_cirox[$yzalan->siparis_tipi]);
                $indirim1 = $indirim1+$indirim;

                $iade1 = $iade1+$iade;



             echo '<tr>
            <th scope="row">'.$x.'</th>
            <td>'.$yzalan->name.'</td>
            <td>'.$tum_satislar.'</td>
            <td>'.$kesinlesen.'</td>
            <td>'.$sepet_sayisi.' adet </td>
            <td>'.$gecersiz.'</td>
            <td>'.$Ciftkayit.'</td>
             <td><b>'.number_format($indirim,2).' ₺</b></td>
            <td><b>'.$ciro.' ₺</b></td>
            <td>'.$iade.'</td>
            <td><b>'.$iade_ciro.' ₺</b></td>
           
          </tr>';
          $x++;
           }

               echo '<tr>
            <th scope="row">'.$x .'</th>
            <td>Genel Toplam</td>
            <td>'.$tum_satislar1.'</td>
            <td>'.$kesinlesen1.'</td>
            <td>'.$sepet_sayisi1.' adet</td>
            <td>'.$gecersiz1.'</td>
            <td>'.$Ciftkayit1.'</td>
             <td><b>'.number_format($indirim1,2).' ₺</b></td>
            <td><b>'.number_format($ciro1,2).' ₺</b></td>
            <td>'.$iade1.' </td>
            <td><b>'.number_format($iade_ciro1,2).' ₺</b></td>
           
            <tr>';


        ?>
          


         
         
 
        </tbody>
      </table>
    </div>






<div class="table-responsive">
  <h3>Satılan Ürünler</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th>Ürünün Adı</th>
            <th>Fiyat</th>
            <th>Fatura Adeti</th>
            <th>Fatura Ort.</th>
    
            <th>Cirosu</th>
           
             
          </tr>
        </thead>
        <tbody>

<?php

 
$x=1;

    

      foreach ($urunlerdb as  $yxva) {


        /*
$urun_cix[$value->urun_id["adet"][]=$]value->urun_adeti;
          $urun_cix[$value->urun_id]["ciro"][]=$value->fiyat;
          $urun_cix[$value->urun_id]["toplam"][]=1;

        */

        $pr_row = $db->get_row("SELECT * FROM urunler where urun_id='".(int)$yxva."' ");
        $satilan_adet = array_sum( $urun_cix[$yxva]["adet"]);
        $fatura_adet = array_sum( $urun_cix[$yxva]["toplam"]);
        $ciro_c = array_sum( $urun_cix[$yxva]["ciro"]);

        $fatura_adet1=$fatura_adet1+$fatura_adet;
        $satilan_adet1=$satilan_adet1+$satilan_adet;
        $ciro_c1=$ciro_c1+$ciro_c;

        $fatorta  = $ciro_c / $fatura_adet;

       echo '<tr>
            <th scope="row">'.$x .'</th>
            <td>'.$pr_row->urun_adi.'</td>
            <td>'.$pr_row->urun_fiyati.' ₺</td>
            <td>'.$fatura_adet.' adet</td>
            <td>'.number_format($fatorta,2).' ₺</td>
    
            <td><b>'.number_format($ciro_c,2).' ₺</b> </td>
            
            <tr>';
            $x++;
      }




$xt = number_format($ciro_c1 / $fatura_adet1,2);

 echo '<tr>
            <th scope="row">'.$x .'</th>
            <td>Genel Topalm</td>
            <td>-</td>
            <td>'.$fatura_adet1.' adet</td>
            <td>'.number_format($xt,2).' ₺</td>
          
            <td><b>'.number_format($ciro_c1,2).' ₺</b> </td>
            
            <tr>';

?>






  
 
        </tbody>
      </table>
    </div>














