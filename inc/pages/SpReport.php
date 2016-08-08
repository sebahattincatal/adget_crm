<?php if (!defined("idokey")) { exit(); }?>



<?php

$tp = (int)$_GET["tp"];

?>






<div class="table-responsive" style="width:50%; float:left;">
    <h3>Satış işlemleri</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th>Bölüm Adı</th>
            <th>Adet</th>
    
             
          </tr>
        </thead>
        <tbody>

        <?php
        $x = 1;




        unset($dz);
          $alanlar = $db->get_results("SELECT * FROM  `siparis_durumlari`   ");
          foreach ($alanlar as $yzalan) {


            	$say = $db->get_var("SELECT count(*) FROM siparisler where siparis_tipi='".$tp."' AND siparis_durumu='".$yzalan->durum_id."' ");

            		$dz[]=$say;
             echo '<tr>
            <th scope="row">'.$x.'</th>
            <td>'.$yzalan->name.'</td>
            <td>'.number_format($say,0).'</td>
          
           
          </tr>';
          $x++;
           }

               echo 
               '<tr>
            <th scope="row">'.$x .'</th>
            <td><b style="color:red;">Genel Toplam</b></td>
            <td><b style="color:red;">'.number_format(array_sum($dz),0).'</b></td>
            
           
            <tr>';


        ?>
        
        </tbody>
      </table>
    </div>





<div class="table-responsive" style="width:49%; float:left; margin-left:1%; ">
    <h3>Gruplama</h3>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th >#</th>
            <th>Bölüm Adı</th>
            <th>Adet</th>
    
             
          </tr>
        </thead>
        <tbody>

        <?php
        $x = 1;

        $emts = array(
        	'1'=>'İşlemde / hold ',
        	'2'=>'Onaylı / confirmed',
        	'3'=>'Geçersiz / trash',
        	'4'=>'İptal / cancelled'
        	);

        $aktr = array(
        	'1'=>'1,2,3,99',
        	'2'=>'7,8,9',
        	'3'=>'4,88',
        	'4'=>'5'
        	);

unset($dz);
        	foreach ($emts as $key => $value) {
        		
        		$durumlar = $aktr[$key];
             	$say = $db->get_var("SELECT count(*) FROM siparisler where siparis_tipi='".$tp."' AND siparis_durumu in (".$durumlar.") ");
$dz[]=$say; 
        		  echo '<tr>
            <th scope="row">'.$x.'</th>
            <td>'.$value.'</td>
            <td>'.number_format($say,0).'</td>
          
           
          </tr>';
 $x++;

        	}
        
               echo 
               '<tr>
            <th scope="row">'.$x .'</th>
            <td><b style="color:red;">Genel Toplam</b></td>
            <td><b style="color:red;">'.number_format(array_sum($dz),0).'</b></td>
            
           
            <tr>';


        ?>
        
        </tbody>
      </table>
    </div>














