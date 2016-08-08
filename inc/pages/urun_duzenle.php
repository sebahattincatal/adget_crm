
<?php if (!defined("idokey")) { exit(); }?>


<div class="contentpanel">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">Ürün Düzenle</h4>
          <p>Ürün Bilgilerini Seçiniz.</p>

            <?php
 
             $id = (int)$_GET["id"];

             if(empty($id)){ header("Location:index.php");}

   if($_POST){

                  $where = " urun_id='".$id."'";
                $ekle = update_array("urunler",$_POST,$where);
                if($ekle){
                  alert_yes("Ürün Düzenleme işlemi Başarılı oldu.");
                }else{
                  alert_no("Ürün Düzenleme işlemi Başarısız oldu.");
                }

            }


            $row = $db->get_row("SELECT * FROM urunler where urun_id='".$id."' ");
            if(!$row){header("Location:index.php");}


         





?>



        </div>
        <div class="panel-body panel-body-nopadding">
          
          <form class="form-horizontal form-bordered" method="post">
            
            <div class="form-group">
              <label class="col-sm-3 control-label">Ürünün Adı</label>
              <div class="col-sm-6">
                <input type="text" placeholder="Ürünün Adı" value="<?=$row->urun_adi?>"  name="urun_adi" required  class="form-control" />
              </div>
            </div>


             <div class="form-group">
              <label class="col-sm-3 control-label">Ürünün Fiyatı</label>
              <div class="col-sm-6">
                <input type="text"  style="max-width:100px" placeholder=" Fiyatı" value="<?=$row->urun_fiyati?>" name="urun_fiyati"  required class="form-control" />
              </div>
            </div>


              <div class="form-group">
              <label class="col-sm-3 control-label">Ürünün Alış Fiyatı</label>
              <div class="col-sm-6">
                <input type="text" style="max-width:100px" placeholder=" Alış Fiyatı"  value="<?=$row->urun_alis_fiyati?>" name="urun_alis_fiyati" required  class="form-control" />
              </div>
            </div> 




             <div class="form-group">
              <label class="col-sm-3 control-label">Ürünün Adeti</label>
              <div class="col-sm-6">
                <input type="text" style="max-width:70px"> placeholder="Ürünün adeti" name="adet" value="<?=$row->adet?>" required class="form-control" />
              </div>
            </div>


                 <div class="form-group">
              <label class="col-sm-3 control-label">Kargo</label>
              <div class="col-sm-6">
                <input type="text" placeholder="Kargo Fiyatı" value="<?=$row->urun_kargo?>" name="urun_kargo" required class="form-control" />
              </div>
            </div>



            <div class="form-group">
              <label class="col-sm-3 control-label">Kuyruk</label>
              <div class="col-sm-6">
              <select class="form-control " id="kuyruk" name="kuyruk" style="width:200px">
            <?php
            $sx  = $db->get_results("SELECT * FROM siparis_tipleri  ");
            foreach ($sx as  $valuew) {
                
                echo '<option value="'.$valuew->siparis_tipi.'" ';
                if($valuew->siparis_tipi==$row->kuyruk) {echo 'selected';}

                 echo '>'.$valuew->name.'</option>
';


            }

            ?>



                </select>
                              Bu Üründen sipariş geldiğinde düşeceği kuyruğu belirler.

              </div>
            </div>
            
            
         
          
        </div><!-- panel-body -->
        
        <div class="panel-footer">
       <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <button type="submit" class="btn btn-primary">Ekle</button>&nbsp;
          
        </div>
       </div>
      </div><!-- panel-footer -->
         </form>
      </div><!-- panel -->
      
  
   
      

      
 
      
    
   
      
    </div><!-- contentpanel -->