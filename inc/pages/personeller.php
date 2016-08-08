<?php if (!defined("idokey")) { exit(); }?>

<div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div><!-- panel-btns -->
          <h3 class="panel-title"> Personel Listesi</h3>
        </div>
        <div class="panel-body">
     
      
          <div class="table-responsive">
            <table class="table" id="table1">
              <thead>
                 <tr>
                    <th>Ad Soyad</th>
                    <th>Telefon</th>
                  
                    <th>İşlem</th>
                 </tr>
              </thead>
              <tbody>


      

              <?php


              




                if($_SESSION["yetki"]==0){
                   $e = $db->get_results("SELECT * FROM admin where   login_case=0  ".$sql_statu3." ");
                 }else{
                   $e = $db->get_results("SELECT * FROM admin where user_type=0 AND login_case=0  ".$sql_statu3." ");
                 }



             
              foreach ($e as  $value) {

                
                  echo '
                  <tr class="odd gradeX">
                    <td>'.$value->name_surname.'</td>
                    <td>'.$value->telefon.'</td>
               
                    <td >

       <a href="pages.php?ido=pers_edit&id='.$value->admin_id.'" class="btn btn-info">Düzenle</a>
       <a href="pages.php?ido=pers_report&id='.$value->admin_id.'" class="btn btn-warning">Rapor</a>
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
        