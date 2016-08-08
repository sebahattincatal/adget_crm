<?php if (!defined("idokey")) { exit(); }?>

<div class="modal fade bs-example-modal-static" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">Static Background</h4>
        </div>
        <div class="modal-body">
            Specify static for a backdrop which doesn't close the modal on click.
        </div>
    </div>
  </div>
</div>
        <link href="css/morris.css" rel="stylesheet">
<?php

      


      



      $id = (int)$_GET["id"];

      if(empty($id)){
        header("Location:index.php");
      }







$user_type =$_SESSION["user_type"];




 $row = $db->get_row("SELECT * FROM siparisler where siparis_id='".$id."' ");

 if($row->kilit_pers<>$_SESSION["admin_id"])
{
  if($user_type<>1){
  header("Location:index.php?error=1");
  }
}



          switch ($row->siparis_durumu) {
           /* case '7':
            if($user_type<1){
              header("Location:index.php");
            }*/
        
          }




if($_POST){




              $urun_id      = $_POST["urun_id"];


              $orders = $db->get_row("SELECT * FROM siparisler where  siparis_id ='".$id."' ");

              if($orders->siparis_durumu==7){
                $_SESSION["siparis_id"]=0;
                header("Location:index.php?error=505");

            }

              $product  = $db->get_row("SELECT * FROM  urunler where urun_id='".$orders->urun_id."'");

                   log_save($id,$_POST["siparis_durumu"]);

              if($urun_id<>$orders->urun_id){
                $siparis["ilk_urun_id"]    = $orders->urun_id;
                $siparis["ilk_fiyat"]      = $product->urun_fiyati;
                $siparis["ilk_urun_adeti"] = $product->adet;
              }




               
              $urun_bilgi   = $db->get_row("SELECT * FROM urunler where urun_id='".$urun_id."' ");

              $telefon=filler($_POST["tel"]);
              

              $siparis["urunun_adi"]          =$urun_bilgi->urun_adi; 
              $siparis["indirim"]             =$_POST["indirim"]; 

              if(!empty($_POST["indirim"])){
                $fiyat =$urun_bilgi->urun_fiyati - $_POST["indirim"];
              }else{
                $fiyat = $urun_bilgi->urun_fiyati;
              }

              $siparis["fiyat"]               =$fiyat; 
              $siparis["urun_id"]             =$urun_bilgi->urun_id; 
              $siparis["urun_adeti"]          =$urun_bilgi->adet; 
              $siparis["odeme_id"]            =$_POST["odeme"]; 
              $siparis["ad_soyad"]            =$_POST["adi"]; 
              $yorum                          =$_POST["yorum"]; 
              $siparis["Telefon_no"]          =$telefon; 
              $siparis["il"]                  =$_POST["il"]; 
              $siparis["ilce"]                =$_POST["ilce"];
              $siparis["adres"]               =$_POST["adres"];
              $siparis["renk"]                =$_POST["renk"];
              $siparis["siparis_durumu"]      =$_POST["siparis_durumu"];
              $siparis["personel"]            =$_SESSION["admin_id"];
              $siparis["islem_tarihi"]        =date("Y-m-d H:i:s");
              $siparis["kilit"]               =0;
              $siparis["kilit_pers"]          =0;
              $siparis["group_id"]            =$urun_bilgi->group_id;

              $_POST["update_date"] = $_POST["update_date"]." ".$_POST["saatim"].":00";

              $group_money =$db->get_row("SELECT prince_money FROM  urun_gruplari  where group_id='".$urun_bilgi->group_id."'");
              if($group_money){
               $siparis["affilate_money"]          =$group_money->prince_money;
              }




              $siparis["group_id"]          =$urun_bilgi->group_id;


              	$siparis_durumu_a =mysql_real_escape_string($_POST["siparis_durumu"]);

          			yorum_kaydet($id,$yorum,$siparis_durumu_a);



              if($_POST["siparis_durumu"]==3){
                if(!empty($_POST["update_date"])){

                 $siparis["update_date"] = date("Y-m-d H:i:s",strtotime($_POST["update_date"]));
                }else{
                  $siparis["update_date"] = date('Y-m-d H:i:s', time() + (60*60*1));
                }
              }elseif($_POST["siparis_durumu"]==9){

                $siparis["satis_tarihi"]=date("Y-m-d H:i:s",strtotime($_POST["update_date"]));
             
              }elseif($_POST["siparis_durumu"]==7){

                $siparis["satis_tarihi"]=date("Y-m-d H:i:s"); 

              }else{
                 $siparis["update_date"] = date('Y-m-d H:i:s', time() + (60*60*1));
              }

              $where = " siparis_id='".$id."'";

              $degistir= update_array("siparisler",$siparis,$where);

              if($degistir){
                alert_yes("İşleminiz Başarılı");

                $_SESSION["siparis_id"]=0;


               if($_POST["siparis_durumu"]==7){

                header("Location:index.php?error=7");
              }else{
                header("Location:index.php?error=2");
              }
              }else{
                 alert_no("işleminiz Başarısız.");
              }


       



}

     




      if(!$row){header("Location:index.php");}
?>



<div class="contentpanel">
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div>
          <h4 class="panel-title">Sipariş İşlemi</h4>
          <p>Sipariş Detayları aşağıdaki gibidir</p>



        </div>
        <div class="panel-body panel-body-nopadding col-sm-8">
          
          <form class="form-horizontal form-bordered" id="KalGKontrol" method="post">
            <div id="f1">
            <div class="form-group">
              <label class="col-sm-3 control-label">SipNo  </label>
              <div class="col-sm-6" style="color:red;">
              <y class="btn btn-danger-alt"><b><?=$row->siparis_id?></b></y>   <y class="btn btn-primary-alt"> <b><?=sipdurumu($row->siparis_durumu);?></b></y>
              <input type="hidden" name="ilanid" value="<?=$row->siparis_id?>">
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">Ad Soyad</label>
              <div class="col-sm-6">
                <input type="text" placeholder="Ürünün Adı"  name="adi" value="<?=$row->ad_soyad?>" required  class="form-control" />
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">Yaş / Kullanım</label>
              <div class="col-sm-6">
              <?=$row->u_age?> /
              <?=$row->kullanim?>
              </div>
            </div>

               <div class="form-group">
              <label class="col-sm-3 control-label">Telefon No</label>
              <div class="col-sm-6">

              <?php

            if(substr($row->Telefon_no, 0,1)==0){
 $tlfw=substr($row->Telefon_no, -10,10);
}else{
  $tlfw=$row->Telefon_no;
}



              ?>
                <input type="text" placeholder="Telefon No" name="tel" id="phone" value="<?=$tlfw?>" style="width:200px; float:left;" required class="form-control" />
              <a href="sip:<?=filler($row->Telefon_no)?>" style=" float:left; margin-left:15px;"><img  src="images/phone.png" height="40" width="40"></a>
              </div>
            </div>


             <div class="form-group">
              <label class="col-sm-3 control-label">Ürün</label>
              <div class="col-sm-6">
                <select class="form-control " id="urun_id" name="urun_id" style="width:400px" onchange="fiyatla()">
                <?php

                $urunler =$db->get_results("SELECT * FROM urunler  ");
                foreach ($urunler as  $value) {
                  if($value->urun_id==$row->urun_id){
                    $as = 'selected="selected"';
                  }else{
                    $as="";
                  }
                  echo '<option id="px'.$value->urun_id.'" fiyat="'.$value->urun_fiyati.'"  value="'.$value->urun_id.'" '.$as.' >'.$value->urun_adi.' [ '.$value->urun_fiyati.' ₺]</option>';
                }

                ?>
               
                  
                </select>
                
              </div>
            </div>


                  <div class="form-group">
              <label class="col-sm-3 control-label">İndirim</label>
              <div class="col-sm-6">
                                       <span><yy id="psts" style="font-size:25px; color:red"><?=$row->indirim?> </yy>₺</span>

              </div>
            </div>     


             <div class="form-group">
              <label class="col-sm-3 control-label">Extra  İndirim</label>

               <div class="col-sm-1">
                <input type="text" placeholder="Tutar Giriniz"   name="indirim" id="indirim" value="0"   class="form-control" />
               
              </div>
              <div class="col-sm-2">
                <select class="form-control " name="indirim_tipi" id="indirim_tipi" style="width:400px" onchange="fiyatla();">
                <?php
               echo '
                    <option value="0">İşlem Yok</option>
                    <option value="1">İndirim Yap.</option>
                    <option value="-1">Fiyatı Arttır</option>
                    ';
              ?>
          
                </select>
                
              </div>
            </div>

     

              <div class="form-group">
              <label class="col-sm-3 control-label">Toplam Ödeme</label>
              <div class="col-sm-6">
                <span><yy id="yyx" style="font-size:25px; color:red"><?=$row->fiyat?> </yy>₺</span>
                
              </div>
            </div>



             <div class="form-group">
              <label class="col-sm-3 control-label">Ödeme</label>
              <div class="col-sm-6">
                <select class="form-control " name="odeme" style="width:400px">
                  <?php

                $urunler =$db->get_results("SELECT * FROM  `odeme_tipi`  ");
                foreach ($urunler as  $value) {
                  if($value->odeme_id==$row->odeme_id){
                    $as = 'selected="selected"';
                  }else{
                    $as="";
                  }
                  echo '<option value="'.$value->odeme_id.'" '.$as.' >'.$value->name.' </option>';
                }

                ?>
               
                  
                </select>
                
              </div>
            </div>


        

                  <div class="form-group">
              <label class="col-sm-3 control-label">il / ilce</label>
              <div class="col-sm-6">

              <select name="il" id="il"  class="form-control " style="width:150px; float:left;" onchange="ilce_getir();">

              <?php

              if(!empty($row->il)){
              	echo '<option value="'.$row->il.'">'.$row->il.'</option>';
              }

              	$il_sq =$db->get_results("SELECT * FROM il ");
              	foreach ($il_sq as  $ilvalue) {
              		echo '<option value="'.$ilvalue->il_adi.'">'.$ilvalue->il_adi.'</option>';
              	}


              ?>
              
              	
              </select>

                <div style="float:left;width:25px;"><center>-</center></div> 

<div id="sps">
  					<select name="ilce" id="ilce"  class="form-control" style="width:150px; float:left;" >
              <?php

                if(!empty($row->ilce)){
              	echo '<option value="'.$row->ilce.'">'.$row->ilce.'</option>';
              }

                 if(!empty($row->il)){
                 	$il_ids = $db->get_row("SELECT * FROM il where il_adi like '%".$row->il."%' ");
                 	$ilsqls = "where  il_id='".$il_ids->il_id."'";
                 }else{
                 	$ilsqls="where  il_id=1";
                 }

              	$ilce_sq =$db->get_results("SELECT * FROM ilce $ilsqls ");
              	foreach ($ilce_sq as  $ilcevalue) {
              		echo '<option value="'.$ilcevalue->ilce_adi.'">'.$ilcevalue->ilce_adi.'</option>';
              	}

              ?>
              
              	
              </select>  

</div>
              </div>
            </div>








                 <div class="form-group">
              <label class="col-sm-3 control-label">Adres</label>
              <div class="col-sm-6">
              <textarea  class="form-control" name="adres"><?=$row->adres?></textarea>
              </div>
            </div>





             <div class="form-group">
              <label class="col-sm-3 control-label">Sipariş Tarihi  / IP</label>
              <div class="col-sm-6">
                 <?=$row->kayit_tarihi?> / <?=$row->ip_adres?> 
              </div>
            </div> 

            <?php

            if($row->siparis_durumu==7){


 
            ?>

            <div class="form-group">
              <label class="col-sm-3 control-label">Satış Tarihi</label>
              <div class="col-sm-6">
                Satışı Yapan : <b style="color:red"><?=personel("name_surname",$row->personel)?> </b>
                <br>
                <?=$row->satis_tarihi?>
              </div>
            </div>

            <?php } ?>

    

                 <div class="form-group" id="update_date" style="display:none;" >
              <label class="col-sm-3 control-label">Tarih</label>
              <div class="col-sm-2" >
                <div class="input-group">
                <input type="text" class="form-control" name="update_date" placeholder="mm/dd/yyyy" id="datepicker">
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
              </div>
              
              </div>

 <div class="col-sm-2" >
 <div class="input-group mb15">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                <div class="bootstrap-timepicker"><input id="timepicker2" name="saatim" type="text" class="form-control"/></div>
              </div>

</div>


            </div>



            </div>

            
         
          
        </div><!-- panel-body -->

           <div class="panel-body panel-body-nopadding col-sm-4">
          
        <div id="comments" style="padding-left:10%;width:90%; height:740px; overflow:scroll; overflow-x: hidden; padding-top:20px;">
         <h3>Notlar</h3>
         <ul class="media-list comment-list" >          
                                          
                <?php
                $yorumlar =$db->get_results("SELECT * FROM siparis_notlari WHERE  siparis_id='".$id."' ORDER BY add_date DESC  ");
                if($yorumlar){
                foreach ($yorumlar as $value) {
                	$agent_row = $db->get_row("SELECT name_surname FROM admin where admin_id='".$value->personel_id."' ");
                	
$durum  =sipdurumurenk($value->islem);
echo '
          <li class="media '.$durum.'" style="width:98%; margin-bottom:5px; margin-top:5px; padding-top:5px; padding-bottom:5px; ">       
            <div class="media-body">
                <h4>'.$agent_row->name_surname.'</h4>
                <small class="text-muted">'.date('d-m-Y H:i:s',strtotime($value->add_date)).'</small>
				<p>'.$value->siparis_notu.'</p> 
			</div>
        </li>
        ';
                }}else{
                	echo '
<li class="alert alert-info">
Henüz Not Yok.
</li>
                	';
                }
                ?>                                
       
                                    
     </ul>
                                       
		</div><!-- tab-pane -->
           </div>



        
        <div class="panel-footer">

         
</form>

       <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
        	
<button class="btn btn-info btn-lg" onclick="BilDuzenle('<?=$id?>','mmds');" type="button">Bilgileri Değiştir</button>
			
			
 			<button class="btn btn-success btn-lg" onclick="KalOnay('<?=$id?>','308');" type="button">Sonra Ara </button>
 			<button class="btn btn-success btn-lg" onclick="KalOnay('<?=$id?>','Onay');" type="button">Onayla</button>
			<button class="btn btn-danger mr5 btn-lg" data-toggle="modal" data-target=".Mdst">İptal Et</button>
        </div>
       </div>
      </div><!-- panel-footer -->
         



      </div><!-- panel -->
      
  
   
      

      
 
      
    
   
      
    </div><!-- contentpanel -->





<div  class="modal fade bs-example-modal-lg Khtsysa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">İşlem Sonucu</h4>
        </div>
        <div class="modal-body" >
<div id="Bilreturn"></div>
              
        </div>
    </div>
  </div>
</div>





























<div  class="modal fade bs-example-modal-lg Mdst" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            <h4 class="modal-title">İptal Nedenini Seçiniz</h4>
        </div>
        <div class="modal-body" >

        <div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Kargo</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Agent</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Depo</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Müşteri</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
       <?php

          $dd = $db->get_results("SELECT * FROM errors_list WHERE errors_group=11");
          foreach ($dd as  $valuer) {

            echo '<button type="button" class="btn btn-info" onclick="KalOnay(\''.$id.'\',\''.$valuer->errors_id.'\');" style="margin:5px;">'.$valuer->errors_name.'</button>';
         
          }


        ?>


    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

<?php

          $dd = $db->get_results("SELECT * FROM errors_list WHERE errors_group=12");
          foreach ($dd as  $valuer) {

            echo '<button type="button" class="btn btn-info" onclick="KalOnay(\''.$id.'\',\''.$valuer->errors_id.'\');" style="margin:5px;">'.$valuer->errors_name.'</button>';
         
          }


        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
<?php

          $dd = $db->get_results("SELECT * FROM errors_list WHERE errors_group=13");
          foreach ($dd as  $valuer) {

            echo '<button type="button" class="btn btn-info" onclick="KalOnay(\''.$id.'\',\''.$valuer->errors_id.'\');" style="margin:5px;">'.$valuer->errors_name.'</button>';
         
          }


        ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="settings">

<?php

          $dd = $db->get_results("SELECT * FROM errors_list WHERE errors_group=14");
          foreach ($dd as  $valuer) {

            echo '<button type="button" class="btn btn-info" onclick="KalOnay(\''.$id.'\',\''.$valuer->errors_id.'\');" style="margin:5px;">'.$valuer->errors_name.'</button>';
         
          }


        ?>
    </div>
  </div>

</div>

       

 
        <div id="iadeSS"></div>
              
        </div>
    </div>
  </div>
</div>












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


    function yeni_fat(){
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

    function BilDuzenle(x,y){
 
 	var data = $("#KalGKontrol").serialize();
 
var  xts = "";
 	 $.post("inc/case.php?ido=412789302",data,function(donenVeri){
                             var donen  =donenVeri;
                              

                             	



                              if(donen==1){

                               			 xts = '<div class="alert alert-success" role="alert">Bilgiler Düzenlendi.</div>';

                              }else if(donen==2){
                                
                                		 xts = '<div class="alert alert-danger" role="alert">Eksik Bilgiler Bulunuyor.</div>';

                              }else{
                              	
                              			xts = '<div class="alert alert-danger" role="alert">'+donen+'</div>';

                              }

                              $("#Bilreturn").html(xts);
                          
                          $(".Khtsysa").modal('show');

                            }); 

    }

    function  KalOnay(x,y) {


          $.post("inc/case.php?ido=2244002",{x:x,y:y},function(donenVeri){
                             var donen  =donenVeri;
                              
                              if(donen==1){

                                yeni_fat();

                              }else{
                                alert(donen);
                              }
                          

                            }); 


        
    }






   $( "#siparis_durumu" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
    $( "div" ).text( str );
  })
  .change();


    </script>

    <script type="text/javascript">





function fiyatla(){
  var ft = $("#urun_id").val();
  var ins = $("#indirim").val();

  var tp  =$("#indirim_tipi").val();

   var attsr=$("#px"+ft).attr("fiyat");

  

    var kalan =  attsr-(ins * tp ); 
   $("#yyx").html(kalan+".00 ");

  
}
    

function level1(){

	$("#f1").hide();
	$("#yrm").show();
	
	$("#a1").hide();
}

function level2(){

	$("#f1").show();
	$("#a2").hide();
	$("#a1").show();
	
	$("#yrm").hide();
	
}



    </script>


