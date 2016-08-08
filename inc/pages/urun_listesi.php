<?php if (!defined("idokey")) { exit(); }?>
<div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title">Ürün Listesi</h3>
        </div>
        <div class="panel-body">
        <?php

         $id = (int)$_GET["id"];
              if(!empty($id)){
                $e = $db->query("UPDATE  urunler set Durumu=1 where urun_id='".$id."' ");
                if($e){
                    alert_yes("İşlem Başarıyla yerine getirildi.");
                }else{
                    alert_no("İşlem Başarısız oldu.");
                }
              }


        ?>
      
          <div class="table-responsive">
            <table class="table" id="table1">
              <thead>
                 <tr>
                    <th>Ürünün Adı</th>
                    <th>fiyatı</th>
                    <th>Alış Fiyatı</th>
                    <th>Kargo</th>
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>

              <?php





              $e = $db->get_results("SELECT * FROM urunler where Durumu=0");
              foreach ($e as  $value) {
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->urun_adi.'</td>
                    <td>'.$value->urun_fiyati.'</td>
                    <td>'.$value->urun_alis_fiyati.'</td>
                    <td > '.$value->urun_kargo.'</td>
                    <td >

                    <a href="pages.php?ido=urun_duzenle&id='.$value->urun_id.'" class="btn btn-info">Düzenle</a>
                    <a href="pages.php?ido=urun_listesi&id='.$value->urun_id.'" class="btn btn-danger">Sil</a>
                    
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
        