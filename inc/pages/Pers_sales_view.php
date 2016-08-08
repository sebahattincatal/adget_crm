<?php if (!defined("idokey")) { exit(); }


$personel = (int)$_GET["id"];
$start  = mysql_real_escape_string(strip_tags($_GET["start"]));
$stop   = mysql_real_escape_string(strip_tags($_GET["stop"]));
if(empty($start)){
  $start = date("Y-m-d");
	$stop = date("Y-m-d");
}

if(empty($personel)){
	header("Location:pages.php?ido=satisrapor");
}




?>


<div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title"> <?php echo personel("name_surname",$personel) ?> 'in <?=$start?> / <?=$stop?> Tarihli Satış Listesi</h3>
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
                
                    <th>Satış Tarihi</th>
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>



              <?php


              





 $e = $db->get_results("SELECT * FROM siparisler where ( islem_tarihi  between '".$start." 00:00:00' AND '".$stop." 23:59:59') AND siparis_durumu in(7,9) AND personel= '".$personel."'  ");
 if($e){
              foreach ($e as  $value) {

                
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->ad_soyad.'<br> <font style="color:green">Sip Kod : '.$value->siparis_id.'</font> </td>
                    <td>'.$value->Telefon_no.'</td>
                    <td>'.$value->urunun_adi.'</td>
                    <td>'.$value->fiyat.'</td>
                    <td>'.$value->il.' / '.$value->ilce.'<br> '.$value->update_date.'</td>
                    <td > ';  

                   if($value->siparis_durumu==7){
                   	echo 'Satış';
                   }else{
                   	echo 'İleri Tarihli Satış';
                   }

                    echo'

                    </td>
                    ';

                   


                       


                   



                    echo'
                    <td > '.$value->satis_tarihi.'</td>
                    <td >

                    <a href="pages.php?ido=siparis&id='.$value->siparis_id.'" class="btn btn-info">Siapriş\'i aç</a>

                    
';

  
        
echo '


                    </td>
                 </tr>
                 ';
              }}


              ?>
                 
               
              </tbody>
           </table>
          </div><!-- table-responsive -->
       
    
          
        </div><!-- panel-body -->
      </div><!-- panel -->
