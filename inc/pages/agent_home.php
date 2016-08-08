
        <?php if (!defined("idokey")) { exit(); }?>



     <div class="col-sm-6 col-md-3 tskts" style="display:none">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
            
                <div class="row">
                
                  <div class="col-xs-12" id="msgss">
             asdasdasdsaasd
                  </div>
              
                
               
             
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->









        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                      <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                   <small>Yeni siparişe Geçmek için</small>
                <button class="btn btn-warning btn-lg" onclick="toto();">Tıklayınız</button>
                  </div>
                </div><!-- row -->
                
               
             
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->




<script type="text/javascript">
  
      function sipDetayx(sipno){

$.post("inc/case.php?ido=105",{sipno:sipno},function(donenVeri){
                             var donen  =donenVeri;

                            if(donen=="1"){
                              window.location.href="pages.php?ido=Kalite_kon&id="+sipno; 
                            }else{
                              alert("Şuan size bu işlemi gerçekleştiremiyorum Lütfen tekrar Deneyiniz.");
                            }
                            });  
}



    function yeni_fatx(){
        var x =4;
      $.post("inc/case.php?ido=14587002",{x:x},function(donenVeri){
                             var donen  =donenVeri;

                             if(donen=="-0-"){
                              alert("Kontrol bekleyen fatura kalmamıştır.  Sizi ana sayfaya yönlendiriyorum.");
                                window.location.href = 'index.php';
                             }else{
                             sipDetayx(donen);
                                }
                            }); 

      
    }






</script>



<?php

if($_SESSION["user_type"]==2){

?>

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                      <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                   <small>Yeni siparişe Geçmek için</small>
                   <?php

                   $e_count = $db->get_var("SELECT count(*) FROM  siparisler WHERE siparis_durumu=7 AND kal_kontrol=0 AND siparis_tipi<>4 ");
                   ?>
                <button class="btn btn-warning btn-lg" onclick="yeni_fatx();">Kalite Kontrol ( <?=$e_count?> )</button>
                  </div>
                </div><!-- row -->
                
               
             
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
<?php } ?>
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                      <img src="images/screen.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                   <small>Müşteri Kartları</small>
                <button class="btn btn-primary mr5 btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg">Müşteri Ara</button>
                  </div>
                </div><!-- row -->
                
               
             
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
    
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                      <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                   <small>Müşteri Kartları</small>
                <button class="btn btn-primary mr5 btn-lg" data-toggle="modal" data-target=".musteriekle">Müşteri Ekle</button>
                  </div>
                </div><!-- row -->
                
               
             
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->
    
    <div class="clearfix"></div>

<?php
        
        $d = ozel_yetki_sor(1);
        
        if(!empty($d)){

?>
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">
              
              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                      <img src="images/is-document.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                   <small>İleri Tarihte Aranacak Listesi</small><br>
                <a href="pages.php?ido=ileriTarihTeAra" class="btn btn-primary mr5 btn-lg"  >Listeyi Aç</a>
                  </div>
                </div><!-- row -->
                
              </div><!-- stat -->
              
            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 --> 
<?php } ?>
        <?php

        $error = $_GET["error"];
        switch ($error) {
          case '1':
            alert_no("<B>DİKKAT <BR>Size Atanmayan bir siparişi görüntüleyemezsiniz.</B>");
            break;

            case '2':
            alert_yes("İşleminiz Başrıyla Gerçekleşmiştir");
            break;

            case '7':
            alert_yes("TEBRİKLER<br>Siparişi  Başrıyla Onayladınız.");
            break;
          
          default:
            # code...
            break;
        }


        ?>