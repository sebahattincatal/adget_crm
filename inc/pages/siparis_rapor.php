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

<div class="row">
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
</div>






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

              $e = $db->get_results("SELECT * FROM siparisler where  (satis_tarihi between '".$start_date." 00:00:00' AND '".$stop_date." 23:59:59') AND siparis_durumu in (7,8)  ".$sql_statu."  ");
              foreach ($e as  $value) {

                $urun_listesi[$value->urun_id][]=1;
                $urun_listesi_name[$value->urun_id]=$value->urunun_adi;
                
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->ad_soyad.'<br>SipNo:'.$value->siparis_id.'</td>
                    <td>'.$value->Telefon_no.'</td>
                    <td>'.$value->urunun_adi.'</td>
                    <td>'.$value->fiyat.'</td>
                    <td>'.personel("name_surname",$value->personel).'<br>'.$value->satis_tarihi.'</td>
               
                    <td >
                    <a href="javascript:sipDetay(\''.$value->siparis_id.'\')" class="btn btn-info xs">Düzenle</a>
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


      <div class="row">
<div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
              </div>
              <h4 class="panel-title">Satılan Ürünler</h4>
            </div>
            <div class="panel-body">
          

           <div class="col-md-6">
          <div class="table-responsive">
          <table class="table table-bordered mb30">
            <thead>
              <tr>
                <th>#</th>
                <th>Ürün Adı</th>
                <th>Adeti</th>
        
              </tr>
            </thead>
            <tbody>

                <?php

                      foreach ($urun_listesi as $key => $value) {
                        
                        echo '
                         <tr>
                <td>1</td>
                <td>'.$urun_listesi_name[$key].'</td>
                <td>'.array_sum($urun_listesi[$key]).'</td>
             
              </tr>

                        ';



                      }

                     


                      ?>
           
            </tbody>
          </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->
                      
            </div>
          </div><!-- panel -->
        </div><!-- col-md-6 -->
</div>
        