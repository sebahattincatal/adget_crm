<?php if (!defined("idokey")) { exit(); }?>


 <link href="css/jquery.datatables.css" rel="stylesheet">

<div class="col-md-6">


<?php

$form_id = (int)$_GET["f_id"];
if(empty($form_id)){
  header("Location:pages.php?ido=Ana_Form");
}



if($_POST){

     

$Label_name = p("Label_name");
$Sutun_name = p("Sutun_name");
$option_id = p("option_id");
$aciklama = p("aciklama");
$form_id = p("form_id");



if(!empty($Label_name)){
	$e = $db->query("insert into ilan_formlari_alanlari (Label_name,Sutun_name,option_id,aciklama,form_id) values ('$Label_name','$Sutun_name','$option_id','$aciklama','$form_id') ");
	if($e){
		alert_yes(" eklendi");
	}else{
		alert_no(" işlemi Başarısız oldu.");
	}
}

}

?>

          
          <form id="form1" class="form-horizontal" method="post">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="panel-btns">
                  <a href="" class="panel-close">×</a>
                  <a href="" class="minimize">−</a>
                </div>
                <h4 class="panel-title">Ana Form Ekle</h4>
                <p>Ana Kategori Form Ekleme</p>
              </div>
              <div class="panel-body">
              
                <div class="form-group">
                  <label class="col-sm-4 control-label">Label Adı:</label>
                  <div class="col-sm-8">
                    <input type="text" name="Label_name" class="form-control">
                  </div>
                </div>

                     <div class="form-group">
                  <label class="col-sm-4 control-label">Sutun</label>
                  <div class="col-sm-8">
                      <select name="Sutun_name" class="form-control">

<?php

$query = $db->get_results("SHOW COLUMNS FROM ilan");
         foreach ($query as  $value) {
          echo '<option value="'.$value->Field.'">'.$value->Field.'  =====    ( '.$value->Type.' ) </option>';
   
         }


?>
                </select>

                <input type="hidden" name="form_id" value="<?=$form_id?>">
                  </div>
                </div>    


                   <div class="form-group">
                  <label class="col-sm-4 control-label">option </label>
                  <div class="col-sm-8">
                      <select name="option_id" class="form-control ">


        <?php

$query = $db->get_results("SELECT * FROM  `option`");
         foreach ($query as  $value) {
          echo '<option value="'.$value->option_id.'">'.$value->option_name.' ('.$value->option_tanim.') </option>';
   
         }

                    


                      ?>

                </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-4 control-label">Açıklama:</label>
                  <div class="col-sm-8">
                    <input type="text" name="aciklama" class="form-control">
                  </div>
                </div>
                
                
              </div><!-- panel-body -->
              <div class="panel-footer">
                <button class="btn btn-primary">Ekle</button>
              </div><!-- panel-footer -->
            </div><!-- panel-default -->
          </form>
            
        </div>



     <div class="col-sm-6 col-md-4">
            <div class="panel panel-default panel-alt">
                <div class="panel-heading">
  
                  <div class="panel-btns">
                        <a href="" class="panel-close">&times;</a>
                        <a href="" class="minimize">&minus;</a>
                    </div><!-- panel-btns -->
                    <h5 class="panel-title">Optionlar (Seçenekler)</h5>
                    <p>Eklemek istediğiniz Seçeneği Eklemek için Aşağıdaki butonu Kullana Bilirsiniz.</p>
                </div>
                <div class="panel-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-static">Option Ekle</button>
                </div>
            </div><!-- panel -->
        </div>


             <div class="col-sm-6 col-md-4">
            <div class="panel panel-default panel-alt">
                <div class="panel-heading">
  
                  <div class="panel-btns">
                        <a href="" class="panel-close">&times;</a>
                        <a href="" class="minimize">&minus;</a>
                    </div><!-- panel-btns -->
                    <h5 class="panel-title">Selectler (ALT Seçenekler)</h5>
                    <p>istediğiniz Seçeneğin alt seçeneğini Eklemek için Aşağıdaki butonu Kullana Bilirsiniz.</p>
                </div>
                <div class="panel-body">
                    <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sds">Select Ekle</button>
                </div>
            </div><!-- panel -->
        </div>






<div class="modal fade bs-example-modal-sds" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">Alt Seçenek  Ekle</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" action="javascript:selectADD()" method="post"  id="selectADD">
              




            <div class="panel panel-default">
          
              <div class="panel-body">
              
                <div class="form-group">
                  <label class="col-sm-4 control-label">Option:</label>
                   <div class="col-sm-8">
                  <textarea name="select_name" required id="select_name"   class="form-control"></textarea>
                  </div>
                </div>


                <div class="form-group" style="float:left">
                  <label class="col-sm-4 control-label">Seçenek Tipi:</label>
                  <div class="col-sm-8">
                      <select id="fruits" name="option_id" required class="form-control" required data-placeholder="Choose One">

                      <?php

                 $query = $db->get_results("SELECT * FROM  `option`");
         foreach ($query as  $value) {
          echo '<option value="'.$value->option_id.'">'.$value->option_name.' ('.$value->option_tanim.') </option>';
   
         }

                      ?>

                    
                    </select>
                  </div>
                </div>

                <div class="clearfix"></div>
                
               <div class="opt_sonuc"></div>
               <div class="clearfix"></div>
              </div><!-- panel-body -->
              <div class="panel-footer">
                <button class="btn btn-primary" >Ekle</button>
              </div><!-- panel-footer -->
            </div><!-- panel-default -->









            </form>
        </div>
    </div>
  </div>
</div>











<div class="modal fade bs-example-modal-static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">Seçenek Ekle</h4>
        </div>
        <div class="modal-body">
        <form class="form-horizontal" action="javascript:option_add()" method="post"  id="optionADD">
              




            <div class="panel panel-default">
          
              <div class="panel-body">
              
                <div class="form-group">
                  <label class="col-sm-4 control-label">Seçenek Adı:</label>
                  <div class="col-sm-8">
                    <input type="text" name="option_name" required id="option_name" reuq class="form-control">
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-4 control-label">Option :</label>
                  <div class="col-sm-8">
                      <select id="fruits" name="option_tipi" required class="form-control" required data-placeholder="Choose One">

                         <?php

  $e = $db->get_results("SELECT * FROM  `option_tipi` ");
                      foreach ($e as $value) {
                       echo '<option value="'.$value->option_tipi.'">'.$value->option_tipi_name.'</option>';
                      }


?>
                    </select>
                  </div>
                </div>
                
               <div class="opt_sonuc"></div>
              </div><!-- panel-body -->
              <div class="panel-footer">
                <button class="btn btn-primary" >Ekle</button>
              </div><!-- panel-footer -->
            </div><!-- panel-default -->









            </form>
        </div>
    </div>
  </div>
</div>


<div class="clearfix mb30"></div>
<div class="contentpanel">
<div class="row">



 <div class="table-responsive">
          <table class="table table-striped" id="table2">
              <thead>
                 <tr>
                    <th>Label id</th>
                    <th>Label adı</th>
                    <th>Açıklama</th>
                    <th>sutun</th>
                    <th>option_id</th>
                    <th>Git</th>
                    
                 </tr>
              </thead>
              <tbody>
<?php 
              	$e  =$db->get_results("SELECT * FROM ilan_formlari_alanlari where form_id='".$form_id."' ");
                 	foreach ($e as  $value) {
                 		echo '
                 		<tr class="gradeA odd" role="row">
                    <td class="sorting_1">'.$value->alan_id.'</td>
                    <td class="sorting_1">'.$value->Label_name.'</td>
                    <td class="sorting_1">'.$value->aciklama.'</td>
                    <td class="sorting_1">'.$value->Sutun_name.'</td>
                    <td>'.$value->option_id.'</td>
                    <td><a href="pages.php?ido=Form_option&f_id='.$value->form_id.'">seçenekler</a></td>
                                   </tr>';
                 	}

                ?>
               
              </tbody>
           </table>
          </div><!-- table-responsive -->

















</div></div>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.cookies.js"></script>


<script src="js/jquery.datatables.min.js"></script>
<script src="js/select2.min.js"></script>
<script src="js/ekolay_panel.js"></script>

<script src="js/custom.js"></script>
<script>
  jQuery(document).ready(function() {
    
    "use strict";
    
    jQuery('#table1').dataTable();
    
    jQuery('#table2').dataTable({
      "sPaginationType": "full_numbers"
    });
    
    // Delete row in a table
    jQuery('.delete-row').click(function(){
      var c = confirm("Continue delete?");
      if(c)
        jQuery(this).closest('tr').fadeOut(function(){
          jQuery(this).remove();
        });
        
        return false;
    });
    
    // Show aciton upon row hover
    jQuery('.table-hidaction tbody tr').hover(function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
    },function(){
      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
    });





  
  
  });
</script>
