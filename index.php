<?php
session_start();
ob_start();
include("inc/include.php");
error_reporting(0);
echo ' <meta charset="utf-8">';
oturum_koru();

define("idokey", "1");


$esql = $db->get_results("SELECT siparis_tipi, count(*) as adet from  siparisler where  kayit_tarihi between '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59' " . $sql_statu . " group by  siparis_tipi");
foreach ($esql as $value) {
    $dizim[$value->siparis_tipi] = $value->adet;
}


$yenitarih = date('Y-m-d', strtotime("-1 day"));
$esqlx = $db->get_results("SELECT siparis_tipi, count(*) as adet from  siparisler where  kayit_tarihi between '" . $yenitarih . " 00:00:00' AND '" . $yenitarih . " 23:59:59' " . $sql_statu . "  group by  siparis_tipi");
foreach ($esqlx as $value) {
    $dizim_dun[$value->siparis_tipi] = $value->adet;
}


$esqlx = $db->get_row("SELECT sum(fiyat) as ciro, count(*) as adet from  siparisler where  islem_tarihi between '" . date("Y-m-d") . " 00:00:00' AND '" . date("Y-m-d") . " 23:59:59'  AND  siparis_durumu in (7,8,9) " . $sql_statu . "  ");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <link href="css/style.default.css" rel="stylesheet">

    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="leftpanel-collapsed">
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>


<div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> <?= $sistem_adi ?> <span>]</span></h1>
    </div>
    <!-- logopanel -->

    <?php include("Themes/sidebar.php"); ?>


    <div class="mainpanel">

        <?php include("Themes/header.php"); ?>

        <div class="pageheader">
            <h2><i class="fa fa-home"></i> AnaEkran <span>Ana Ekrana Hoş Geldiniz</span></h2>

        </div>

        <div class="contentpanel">

            <div class="row">


                <?php


                $user_type = $_SESSION["user_type"];
                switch ($user_type) {
                    case '0':
                        include("inc/pages/agent_home.php");
                        break;
                    case '1':
                        include("inc/pages/admin_home.php");
                        break;
                    case '2':
                        include("inc/pages/agent_home.php");
                        break;
                    case '4':
                        include("inc/pages/muhasebe_admin_home.php");
                        break;
                }


                ?>


                <!-- start admin -->


                <!-- stop admin -sm-6 -->

            </div>
            <!-- row -->


        </div>
        <!-- rightpanel -->


        <div <?= $div_statu ?> class="modal fade bs-example-modal-lgs kargoara" tabindex="-1" role="dialog"
                               aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Kargo Listesi</h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:KargoListe();" method="post">

                            <div class="input-group" style="width:250px;">
                                <input type="text" value="<?= date("d/m/Y") ?>" class="form-control date kargo-listesi-datepicker" name="tarih"
                                       placeholder="<?= date("d/m/Y") ?>" id="tarihs">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Liste!</button>
                  </span>
                            </div>
                        </form>

                        <div id="pops"></div>


                    </div>
                </div>
            </div>
        </div>


        <div <?= $div_statu ?> class="modal fade dataView" tabindex="-1" role="dialog"
                               aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Liste Aktar</h4>
                    </div>
                    <div class="modal-body">


                        <form id="DataViewS" name="form1" method="post" action="Javascript:GoGoDataview();">
                            <table width="650" border="0">
                                <tr>
                                    <td width="162" valign="top" style="font-family:tahoma; font-size:11px;">
                                        Sipariş Tipleri
                                        <hr>
                                        <p>

                                            <?php
                                            $x = 0;
                                            $drmList = $db->get_results("SELECT * FROM siparis_tipleri");
                                            foreach ($drmList as $valuw) {
                                                $x++;
                                                echo '<label>
          <input type="checkbox" checked="checked" name="tipler[]" value="' . $valuw->siparis_tipi . '" id="tipler' . $x . '" />
         ' . $valuw->name . '</label>
        <br />';
                                            }

                                            ?>


                                        </p></td>
                                    <td width="179" valign="top" style="font-family:tahoma; font-size:11px;">
                                        Durum Tipleri
                                        <hr>
                                        <p>
                                            <?php

                                            $drmList = $db->get_results("SELECT * FROM siparis_durumlari where durum_id not in (7,8) ");
                                            foreach ($drmList as $valuww) {
                                                echo '<label>
          <input type="checkbox" name="durumlar[]" checked="checked" value="' . $valuww->durum_id . '" id="tipler_0" />
          ' . $valuww->name . '</label>
        <br />';
                                            }

                                            ?>

                                        </p></td>
                                    <td width="400" valign="top" style="font-family:tahoma; font-size:11px;">
                                        Tarih Aralığı
                                        <hr>
                                        <p>

                                        <div class="form-group dp-group" id="datepicker-group1"
                                             data-date-format="mm.dd.yyyy">
                                            <label for="baslangic-tarihi" class="control-label">Başlangıç Tarihi</label>

                                            <div class="input-group input-append date">
                                                <input name="baslangic_cikis" type="text"
                                                       class="form-control span2 dating-input" id="baslangic-tarihi"
                                                       placeholder="Başlangıç Tarihi">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                        </p>
                                        <p>

                                        <div class="form-group dp-group" id="datepicker-group2"
                                             data-date-format="mm.dd.yyyy">
                                            <label for="bitis-tarihi" class="control-label">Bitiş Tarihi</label>

                                            <div class="input-group input-append date">
                                                <input name="bitis_donus" type="text"
                                                       class="form-control span2 dating-input" id="bitis-tarihi"
                                                       placeholder="Bitiş Tarihi">
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                        </div>
                                        </p>
                                    </td>
                                    <td width="100"><input style="margin-left: 50px;" type="submit"
                                                           class="btn btn-primary" name="aktar" id="aktar"
                                                           value="Dışarıya Aktar"/></td>
                                </tr>
                            </table>
                        </form>

                        <div id="DwReport"></div>


                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">


            function GoGoDataview() {

                var data = $("#DataViewS").serialize();
                $.post("NwsStart.php", data, function (donenVeri) {
                    var donen = donenVeri;
                    $("#DwReport").html(donen);


                });


            }

        </script>


        <div class="modal fade   musteriekle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Müşteri Ekle</h4>
                    </div>
                    <div class="modal-body">

                        <div class="Loadings"></div>

                        <form action="javascript:customerAdd();" method="post" id="islem">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Ad Soyad</label>

                                <div class="col-sm-6">


                                    <div class="input-group mb15">
                                        <input type="text" class="form-control" name="adsoyad" id="adsoyad"/>

                                    </div>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telefon No</label>

                                <div class="col-sm-6">


                                    <div class="input-group mb15">
                                        <input type="text" class="form-control" name="PhoneS" id="PhoneS"/>

                                    </div>


                                </div>
                            </div>

                            <div class="form-group">

                                <button class="btn btn-primary mr5 btn-lg">Müşteri Ekle</button>

                            </div>


                        </form>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Sipariş Ara</h4>
                    </div>
                    <div class="modal-body">


                        <form action="javascript:user_search();" method="post">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sipariş no, ad soyad, tel vs</label>

                                <div class="col-sm-6">


                                    <div class="input-group mb15">
                                        <input type="text" class="form-control" name="search" id="search"/>
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">ARA!</button>
                  </span>
                                    </div>


                                </div>
                            </div>
                        </form>

                        <div class="clearfix"></div>
                        <div id="sssonuc"></div>
                    </div>
                </div>
            </div>
        </div>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <!--<script src="js/jquery-ui-1.10.3.min.js"></script>-->
        <script src="js/moment.js"></script>
        <script src="js/moment-tr.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/jquery.sparkline.min.js"></script>
        <script src="js/toggles.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/jquery.cookies.js"></script>

        <script src="js/flot/jquery.flot.min.js"></script>
        <script src="js/flot/jquery.flot.resize.min.js"></script>
        <script src="js/flot/jquery.flot.spline.min.js"></script>
        <script src="js/morris.min.js"></script>
        <script src="js/raphael-2.1.0.min.js"></script>
        <script src="js/jquery.maskedinput.min.js"></script>
        <script src="js/custom.js"></script>


        <script src="js/chosen.jquery.min.js"></script>


        <?php
        if ($_SESSION["user_type"] == 1) {
            ?>
            <script type="text/javascript">
                function op_refresh() {
                    $(".refreshing-kuyruk").show(0);
                    $("#t_kuyruk").hide(400, function () {
                        $("#t_kuyruk_yaz").show(0);
                    });
                    var sipno = 1;
                    //$("#t_kuyruk").show(800);
                    //$("#t_kuyruk_yaz").hide(800);

                    $.post("inc/case.php?ido=110", {sipno: sipno}, function (donenVeri) {
                        var donen = donenVeri;
                        $("#t_kuyruk_yaz").html(donen);
                        $(".refreshing-kuyruk").delay(2000).hide(0);
                        //$("#t_kuyruk").hide(800);
                        //$("#t_kuyruk_yaz").show(800);
                    });
                }

                $(window).load(function () {
                    $(".refreshing-kuyruk").hide(0);
                    $("#t_kuyruk_yaz").hide(0);
                    op_refresh();
                });

                setInterval(op_refresh, 5000);


            </script>
        <?php } ?>


        <script type="text/javascript">

            $('#datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('.date').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $('.kargo-listesi-datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });


            function SipReset() {
                var sipno = 1;
                $.post("inc/case.php?ido=109", {sipno: sipno}, function (donenVeri) {
                    var donen = donenVeri;

                    alert(donen);
                });

            }

            function KargoListe() {

                var tarih = $("#tarihs").val();
                if (tarih == "") {
                    alert("Tarih Seçiniz");
                } else {
                    var tss = '<iframe frameborder="0" width="5" height="5" src="/inc/this_excel.php?tarih=' + tarih + '"></iframe>';
                    $("#pops").html(tss);
                }


            }

            function SipYenile(sipno) {
                $.post("inc/case.php?ido=106", {sipno: sipno}, function (donenVeri) {
                    var donen = donenVeri;

                    if (donen > 0) {
                        window.location.href = "pages.php?ido=siparis&id=" + donen;
                    } else {
                        alert("Şuan size bu işlemi gerçekleştiremiyorum\n Lütfen tekrar Deneyiniz.");
                    }
                });

            }

            function sipDetay(sipno) {

                $.post("inc/case.php?ido=105", {sipno: sipno}, function (donenVeri) {
                    var donen = donenVeri;

                    if (donen == "1") {
                        window.location.href = "pages.php?ido=siparis&id=" + sipno;
                    } else {
                        alert("Şuan size bu işlemi gerçekleştiremiyorum Lütfen tekrar Deneyiniz.");
                    }
                });
            }


            function customerAdd() {

                $("#Loadings").html('<center><img src="ajax-loader.gif"></center>');
                var ad = $("#adsoyad").val();
                var Phone = $("#PhoneS").val();

                if (ad == "") {
                    $("#adsoyad").val();
                } else if (Phone == "") {
                    var Phone = $("#PhoneS").val();
                } else {


                    $.post("inc/case.php?ido=303", {ad: ad, Phone: Phone}, function (donenVeri) {
                        var donen = donenVeri;

                        if (donen == "-1") {
                            alert("Bilgileri Kontrol ediniz");
                        } else if (donen == "0") {
                            alert("Lütfen Tekrar Deneyin Bilgileri Kaydedemedik.");
                        } else {
                            sipDetay(donen);
                        }


                    });


                    $("#Loadings").html(' ');
                }


            }


            function user_search() {
                var search = $("#search").val();
                if (search == "") {
                    alert("Lütfen Bilgi Girişi sağlayın");
                } else {


                    $.post("inc/case.php?ido=104", {search: search}, function (donenVeri) {
                        var donen = donenVeri;
                        $("#sssonuc").html(donen).promise().done(function(){
                            var tAble = $(this).find('table.table.table-buglist');
                            tAble.find('tbody > tr').each(function(){
                                $(this).find('td').last().find('.drpdwn > [role="button"].dropdown-toggle').click(function(){
                                    var pArent = $(this).parents('.drpdwn');
                                    /*if(pArent.is('.open')){
                                        pArent.removeClass('open');
                                    }else{
                                        pArent.addClass('open');
                                    }*/
                                });
                            });
                        });
                    });
                }
            }


            function toto() {

                var pers = 1;
                $.post("inc/pages/toto.php?ido=10914", {pers: pers}, function (donenVeri) {
                    var donen = donenVeri;
                    if (donen == "010102") {
                        alert("Şuan için size bir sipariş veremiyorum Lütfen 1 dk içinde tekrar deneyiniz.");
                    } else {
                        window.location.href = "pages.php?ido=siparis&id=" + donen;
                    }
                });

            }

        </script>

        <script type="text/javascript">
            $(function(){

                if($('#datepicker-group1 input[type="text"]')){
                    var _DP1 = $('#datepicker-group1 input[type="text"]').datetimepicker({
                        format: 'MM/DD/YYYY HH:mm'
                    });
                }

                if($('#datepicker-group2 input[type="text"]')){
                    var _DP2 = $('#datepicker-group2 input[type="text"]').datetimepicker({
                        format: 'MM/DD/YYYY HH:mm'
                    });
                }
            });
        </script>

        <?php

        if (!empty($_SESSION["agent"])) {

            ?>


            <script type="text/javascript">

                function phone_go(phone) {
                    $("#PhoneS").val(phone);

                }


                function musteri_varmi(phone, tp) {
                    $.post("inc/case.php?ido=74157536", {phone: phone, tp: tp}, function (donenVeri) {
                        var donen = donenVeri;
                        $(".tskts").show();
                        $("#msgss").html(donen);

                    });
                }


                function agent_durum() {
                    var agent = <?=$_SESSION["agent"]?>;
                    var msaj = '';

                    $.post("agent.php?x=" + agent, {agent: agent}, function (donenVeri) {
                        var donen = donenVeri;


                        if (donen == "0") {
                            var msaj = 'Müsayit';
                        } else if (donen == "1") {
                            var msaj = 'Görüşme Yapıyor';
                            //  musteri_varmi(arr[0],arr[1]);
                        } else if (donen == "2") {
                            var msaj = 'Telefonunuz Çalıyor';

                        } else if (donen == "4") {
                            var msaj = 'Dış Aramadasınız';
                            //  musteri_varmi(arr[0],arr[1]);
                        } else {
                            var msaj = donen;
                        }

                        var arr = msaj.split('|');
                        musteri_varmi(arr[0], arr[1]);


                    });


                }


                setInterval(agent_durum, 1000);

            </script>


        <?php } ?>
</body>
</html>
