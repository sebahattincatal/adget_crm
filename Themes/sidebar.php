<div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="images/photos/loggeduser.png" class="media-object">
                <div class="media-body">
                    <h4><?=$_SESSION["name_surname"]?></h4>
                
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
           
              <li><a href="exit.php"><i class="fa fa-sign-out"></i> <span>Çıkış yap</span></a></li>
            </ul>
        </div>
      
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
    <li class="active"><a href="index.php"><i class="fa fa-home"></i> <span>Ana Sayfa</span></a></li>

       




  <?php

       if($_SESSION["user_type"]==1){

            $f = $db->get_results("SELECT * FROM  siparis_tipleri  ".$sql_statu2." ");
            foreach ($f as  $trs) {



            ?>
          <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span><?=$trs->name?></span></a>
              <ul class="children">
                    <?php

              $sws = $db->get_results("SELECT * FROM  siparis_durumlari");
              if($sws){
                foreach ($sws as  $value) {

                    $say = $db->get_var("SELECT count(*) FROM siparisler where siparis_tipi='".$trs->siparis_tipi."' AND siparis_durumu='".$value->durum_id."' ");
                   echo '<li><a href="pages.php?ido=siparis_listesi&drm='.$value->durum_id.'&tp='.$trs->siparis_tipi.'"><i class="fa fa-caret-right"></i> '.$value->name.' <font style="color:red">( '.number_format($say,0).' )</font></a></li>';
                }

               echo '<li><a href="pages.php?ido=SpReport&tp='.$trs->siparis_tipi.'"><i class="fa fa-caret-right"></i> Rapor</a></li>';

                }


              ?>
              </ul>
            </li>
    <?php


            }

            ?>





            <li class="nav-parent"><a href=""><i class="fa fa-suitcase"></i> <span>Ürünler</span></a>
              <ul class="children">
                <li><a href="pages.php?ido=urun_listesi"><i class="fa fa-caret-right"></i> Ürünler</a></li>
                <li><a href="pages.php?ido=urun_ekle"><span class="pull-right badge badge-danger">Yeni</span><i class="fa fa-caret-right"></i> Ürün Ekle</a></li>
                <li><a href="#"><i class="fa fa-caret-right"></i> Ürün Raporları</a></li>

              </ul>
            </li>

            <li class="nav-parent"><a href=""><i class="fa fa-user"></i> <span>Personel</span></a>
              <ul class="children">
                <li><a href="pages.php?ido=personeller"><i class="fa fa-caret-right"></i> Personeller</a></li>
                <li><a href="pages.php?ido=personel_ekle"><span class="pull-right badge badge-danger">Yeni</span><i class="fa fa-caret-right"></i> Personel Ekle</a></li>
                <li><a href="pages.php?ido=PersPrim"><i class="fa fa-caret-right"></i> Primler</a></li>

              </ul>
            </li>

            <li class="nav-parent"><a href=""><i class="fa fa-user"></i> <span>Raporlar</span></a>
              <ul class="children">
                <li><a href="pages.php?ido=Rapor"><i class="fa fa-caret-right"></i>Satış Raporu</a></li>
                <li><a href="pages.php?ido=personel_ekle"><span class="pull-right badge badge-danger">Yeni</span><i class="fa fa-caret-right"></i> Sipariş Adet</a></li>
                <li><a href="#"><i class="fa fa-caret-right"></i> Personel Raporları</a></li>

              </ul>
            </li>
    <?php }

       if($_SESSION["user_type"] == 1){

      ?>
      <li class="nav-parent"><a href="#"><i class="fa fa-qrcode"></i> <span>Manuel Fatura</span></a>
          <ul class="children">
              <li><a href="pages.php?ido=ManuelFatura"><i class="fa fa-caret-right"></i>Faturalar</a></li>
              <li><a href="pages.php?ido=ManuelFatura_Ekle"><i class="fa fa-caret-right"></i> Fatura Ekle</a></li>
          </ul>
      </li>
      <?php

  }

  ?>
      </ul>
      
      
      
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->