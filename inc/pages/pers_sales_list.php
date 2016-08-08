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
                    <th>Satış</th>
                    <th>ulaşılamayan</th>
                    <th>İleri Tarihli</th>
                    <th>İleri T.satış</th>
                    <th>Geçersiz</th>
                
                    <th>Ürün Adeti</th>
                    <th>Sepet Ort.Adet</th>
                    <th>Sepet Ort.ciro</th>
                   <th>Ciro</th>
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>



              <?php


              





              $e = $db->get_results("SELECT * FROM admin where user_type=0   ");
              foreach ($e as  $value) {

              $ex = $db->get_results("SELECT DISTINCT siparis_id,  stop_case, count(*) as adet FROM  action_log WHERE personel='".$value->admin_id."' AND add_date between '".$start_data." 00:00:00' AND '".$stop_data." 23:59:59' AND stop_case in (2,3,4,7,88,9)   group by stop_case  ");
              unset($dizim);
              foreach ($ex as   $valuex) {
                $dizim[$valuex->stop_case] = $valuex->adet;
              }




                    $satis = $db->get_row("SELECT sum(fiyat) as ciro, Sum(urun_adeti) as urunAdeti, count(*) as adet  FROM siparisler where  islem_tarihi  between '".$start_data." 00:00:00' AND '".$stop_data." 23:59:59' AND  personel='".$value->admin_id."' AND siparis_durumu in (7,9)  ".$sql_statu."   ");



                      $t1 +=$satis->adet;
                      $t2 +=$dizim[2];
                      $t3 +=$dizim[3];
                      $t4 +=$dizim[9];
                      $t5 +=$dizim[4];
                      $t6 +=$satis->urunAdeti;
                      $t7 +=$satis->ciro;

              if($satis->ciro>0){
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->mail.'</td>
                    <td>'.$satis->adet.'</td>
                    <td>'.(int)$dizim[2].'</td>
                    <td>'.(int)$dizim[3].'</td>
                    <td>'.(int)$dizim[9].'</td>
                    <td>'.(int)$dizim[4].'</td>
               
                    <td>'.number_format($satis->urunAdeti).' </td>
                    <td>'.number_format($satis->urunAdeti/$satis->adet,1).'</td>
                    <td>'.number_format($satis->ciro/$satis->adet).'</td>
                    <td>'.number_format($satis->ciro).'</td>
                  

                    ';


                    echo'
        
                    <td >

                    <a href="pages.php?ido=Pers_sales_view&id='.$value->admin_id.'&start='.$start_data.'&stop='.$stop_data.'" class="btn btn-info">Satışları</a>


                    </td>
                 </tr>
                 ';
                 }










              }



              ?>
                 
               
              </tbody>
           </table>
          </div><!-- table-responsive -->
       
    
          
        </div><!-- panel-body -->
      </div><!-- panel -->
        