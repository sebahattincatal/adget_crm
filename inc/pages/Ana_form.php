<?php if (!defined("idokey")) { exit(); }?>


 <link href="css/jquery.datatables.css" rel="stylesheet">

<div class="col-md-6">


<?php



if($_POST){
$name = p("name");
if(!empty($name)){
	$e = $db->query("insert into ilan_formlari (form_adi,form_aciklamasi) values ('".$name."','".$name."') ");
	if($e){
		alert_yes("Bölüm eklendi");
	}else{
		alert_no("Form Kayıt işlemi Başarısız oldu.");
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
                  <label class="col-sm-4 control-label">Form Adı:</label>
                  <div class="col-sm-8">
                    <input type="text" name="name" class="form-control">
                  </div>
                </div>
                
                
              </div><!-- panel-body -->
              <div class="panel-footer">
                <button class="btn btn-primary">Ekle</button>
              </div><!-- panel-footer -->
            </div><!-- panel-default -->
          </form>
            
        </div>









<div class="clearfix mb30"></div>
<div class="contentpanel">
<div class="row">



 <div class="table-responsive">
          <table class="table table-striped" id="table2">
              <thead>
                 <tr>
                    <th>Form id</th>
                    <th>Form adı</th>
                    <th>Açıklama</th>
                    <th>Git</th>
                    
                 </tr>
              </thead>
              <tbody>
<?php 
              	$e  =$db->get_results("SELECT * FROM ilan_formlari");
                 	foreach ($e as  $value) {
                 		echo '
                 		<tr class="gradeA odd" role="row">
                    <td class="sorting_1">'.$value->form_id.'</td>
                    <td class="sorting_1">'.$value->form_adi.'</td>
                    <td>'.$value->form_aciklamasi.'</td>
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
