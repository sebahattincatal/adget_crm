<?php
session_start();
ob_start();
include("inc/include.php");
oturum_koru();
error_reporting(0);


define("idokey", "1");


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

    <link href="css/bootstrap-editable.css" rel="stylesheet">
    <link href="css/style.default.css" rel="stylesheet">
    <!--<link href="css/jquery.datatables.css" rel="stylesheet">-->
    <link href="css/jquery.dataTables.css" rel="stylesheet">
    <link href="js/syntax/shCore.css" rel="stylesheet">


    <link rel="stylesheet" href="css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" href="css/jquery.tagsinput.css"/>
    <link rel="stylesheet" href="css/colorpicker.css"/>
    <link rel="stylesheet" href="css/dropzone.css"/>
    <link rel="stylesheet" href="css/modify.css"/>
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

    <script src="js/jquery.js"></script>
    <script src="js/select2.min.js"></script>

</head>

<body class="leftpanel-collapsed">
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="leftpanel">

        <div class="logopanel">
            <h1><span>[</span> <?= $sistem_adi ?> <span>]</span></h1>
        </div>
        <!-- logopanel -->

        <?php include("Themes/sidebar2.php"); ?>
    </div>
    <!-- leftpanel -->

    <div class="mainpanel">

        <?php include("Themes/header.php"); ?>


        <div class="pageheader">
            <h2><i class="fa fa-pencil"></i> İşlem <span> Ekranı</span></h2>

            <div class="breadcrumb-wrapper">

            </div>
        </div>

        <div class="contentpanel">
            <?php

            $is = $_GET["ido"];
            switch ($is) {

                case "urun_ekle":
                    include("inc/pages/urun_ekle.php");

                    break;

                case "siparis":
                    include("inc/pages/siparis_islem.php");
                    break;

                case "siparis_listesi":
                    include("inc/pages/siparis_listesi.php");
                    break;

                case "urun_listesi":
                    include("inc/pages/urun_listesi.php");
                    break;

                case "urun_duzenle":
                    include("inc/pages/urun_duzenle.php");
                    break;

                case "Ana_Form":
                    include("inc/pages/Ana_form.php");
                    break;


                case "Form_option":
                    include("inc/pages/form_option.php");
                    break;

                case "personeller":
                    include("inc/pages/personeller.php");
                    break;

                case "pers_edit":
                    include("inc/pages/personel_edit.php");
                    break;

                case "personel_ekle":
                    include("inc/pages/personel_add.php");
                    break;

                case "Rapor":
                    include("inc/pages/siparis_rapor.php");
                    break;


                case "satisrapor":
                    include("inc/pages/pers_sales_list.php");
                    break;

                case "kargoList":
                    include("inc/pages/kargo.php");
                    break;

                case "Pers_sales_view":
                    include("inc/pages/Pers_sales_view.php");
                    break;

                case "pers_report":
                    include("inc/pages/pers_report.php");
                    break;


                case "PersPrim":
                    include("inc/pages/PersPrim.php");
                    break;

                case "Kalite_kon":
                    include("inc/pages/kalite_kontrol.php");
                    break;

                case "KargoPost":
                    include("inc/pages/cargo_post.php");
                    break;

                case "FaturaPrint":
                    include("inc/pages/fatura_print.php");
                    break;

                case "ManuelFatura":
                    include("inc/pages/manuel_fatura.php");
                    break;

                case "ManuelFatura_Ekle":
                    include("inc/pages/manuel_fatura_add.php");
                    break;

                case "ManuelFatura_Duzenle":
                    include("inc/pages/manuel_fatura_edit.php");
                    break;

                case "ManuelFaturaPrinter":
                    include("inc/pages/manuel_fatura_print.php");
                    break;

                case "Printer":
                    include("inc/pages/fatura.php");
                    break;


                case "SpReport":
                    include("inc/pages/SpReport.php");
                    break;


                case "ileriTarihTeAra":
                    include("inc/pages/ileri_tarihli_listesi.php");
                    break;


            }


            ?>


        </div>
        <!-- contentpanel -->

    </div>
    <!-- mainpanel -->

    <div class="rightpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#rp-alluser" data-toggle="tab"><i class="fa fa-users"></i></a></li>
            <li><a href="#rp-favorites" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
            <li><a href="#rp-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
            <li><a href="#rp-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="rp-alluser">
                <h5 class="sidebartitle">Online Users</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/userprofile.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user1.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <span class="pull-right badge badge-danger">2</span>
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user2.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user3.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user4.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                </ul>

                <div class="mb30"></div>

                <h5 class="sidebartitle">Offline Users</h5>
                <ul class="chatuserlist">
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user5.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user2.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user3.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user4.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user5.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user4.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user5.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="rp-favorites">
                <h5 class="sidebartitle">Favorites</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user2.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Los Angeles, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user1.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>San Francisco, CA</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user3.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Bangkok, Thailand</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user4.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Renov Leongal</strong>
                                <small>Cebu City, Philippines</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user5.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Weno Carasbong</strong>
                                <small>Tokyo, Japan</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane" id="rp-history">
                <h5 class="sidebartitle">History</h5>
                <ul class="chatuserlist">
                    <li class="online">
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user4.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Eileen Sideways</strong>
                                <small>Hi hello, ctc?... would you mind if I go to your...</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user2.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Zaham Sindilmaca</strong>
                                <small>This is to inform you that your product that we...</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                    <li>
                        <div class="media">
                            <a href="#" class="pull-left media-thumb">
                                <img alt="" src="images/photos/user3.png" class="media-object">
                            </a>

                            <div class="media-body">
                                <strong>Nusja Nawancali</strong>
                                <small>Are you willing to have a long term relat...</small>
                            </div>
                        </div>
                        <!-- media -->
                    </li>
                </ul>
            </div>
            <div class="tab-pane pane-settings" id="rp-settings">

                <h5 class="sidebartitle mb20">Settings</h5>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Show Offline Users</label>

                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Enable History</label>

                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label">Show Full Name</label>

                    <div class="col-xs-4 control-label">
                        <div class="toggle-chat1 toggle-success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-8 control-label testt">Show Location</label>

                    <div class="col-xs-4 control-label">
                        <div class="toggle toggle-success"></div>
                    </div>
                </div>

            </div>
            <!-- tab-pane -->

        </div>
        <!-- tab-content -->
    </div>
    <!-- rightpanel -->

</section>

<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery.cookies.js"></script>
<script src="js/jquery.autogrow-textarea.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/colorpicker.js"></script>
<script src="js/jquery.validate.min.js"></script>
<!--<script src="js/jquery.datatables.min.js"></script>-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/syntax/shCore.js"></script>

<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>

<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/moment-tr.js"></script>
<script src="js/select2.min.js"></script>
<!--<script src="js/bootstrap-editable.min.js"></script>-->
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/bootstrap-wizard.min.js"></script>
<script src="js/bootstrap-timepicker.min.js"></script>
<script src="js/custom.js"></script>

<script type="text/javascript">
    $(function(){

        $('.siparis-form').keypress(function(e){
            if(e.keyCode===13){
                e.stopPropagation();
                e.preventDefault();
                return false;
            }
        });

    });
</script>

<script type="text/javascript">

    function ilce_getir() {


        var il = $("#il").val();
        $.post("inc/case.php?ido=412536701", {il: il}, function (donenVeri) {
            var donen = donenVeri;

            $("#sps").html(donen);
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


</script>

<script>
    $(document).ready(function () {

        "use strict";

        // Basic Wizard
        $('#basicWizard').bootstrapWizard();

        // Progress Wizard
        $('#progressWizard').bootstrapWizard({
            'nextSelector': '.next',
            'previousSelector': '.previous',
            onNext: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#progressWizard').find('.progress-bar').css('width', $percent + '%');
            },
            onPrevious: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#progressWizard').find('.progress-bar').css('width', $percent + '%');
            },
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#progressWizard').find('.progress-bar').css('width', $percent + '%');
            }
        });

        // Disabled Tab Click Wizard
        $('#disabledTabWizard').bootstrapWizard({
            tabClass: 'nav nav-pills nav-justified nav-disabled-click',
            onTabClick: function (tab, navigation, index) {
                return false;
            }
        });

        // With Form Validation Wizard
        var $validator = $("#firstForm").validate({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            }
        });

        $('#validationWizard').bootstrapWizard({
            tabClass: 'nav nav-pills nav-justified nav-disabled-click',
            onTabClick: function (tab, navigation, index) {
                return false;
            },
            onNext: function (tab, navigation, index) {
                var $valid = $('#firstForm').valid();
                if (!$valid) {

                    $validator.focusInvalid();
                    return false;
                }
            }
        });

        $(".adget-sc select").select2({
            /*width: '100%',*/
            /*minimumResultsForSearch: -1*/
        });



    });
</script>


<script>
    $(document).ready(function () {

        "use strict";

        $('#table1').dataTable({
            'footerCallback': function ( row, data, start, end, display ) {
                var tAble = $(this);
                var Api = this.api();
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                Api.column(4).data().reduce(function( ){
                    var start = 1;
                    var count = 10;
                    var Sum = new Array();
                    $(data).each(function(iX, td){
                        for(var i = start; i <= count; i++){
                            if(!Sum[i]&&Sum[i]==null){
                                Sum[i] = 0;
                            }
                            Sum[i] += parseFloat(td[i]);
                        }
                    });
                    $(Sum).each(function(iXx){
                        iXx++;
                        tAble.find('tfoot').find('tr').first().find('th').eq(iXx).text(Sum[iXx]);
                    });
                });
            }
        });

        $('#table2').dataTable({
            "sPaginationType": "full_numbers"
        });


        // Delete row in a table
        $('.delete-row').click(function () {
            var c = confirm("Continue delete?");
            if (c)
                $(this).closest('tr').fadeOut(function () {
                    $(this).remove();
                });

            return false;
        });

        $('#datepicker').datetimepicker({
            format: 'MM/DD/YYYY'
        });

        $("#phone").mask("(999) 999-9999");

        $(".date").mask("99/99/9999");


        $("#siparis_durumu").change(function () {
            var str = "";
            $("#siparis_durumu option:selected").each(function () {
                str = $(this).val();

            });

            if (str == 3) {
                $("#update_date").show();
            } else if (str == 9) {
                $("#update_date").show();
            } else {
                $("#update_date").hide();
            }


        }).change();


        $('#timepicker2').timepicker({showMeridian: false});


        // Show aciton upon row hover
        $('.table-hidaction tbody tr').hover(function () {
            $(this).find('.table-action-hide a').animate({opacity: 1});
        }, function () {
            $(this).find('.table-action-hide a').animate({opacity: 0});
        });


    });
</script>

</body>
</html>


<script type="text/javascript">
    $(function () {


        $("#yorum").keypress(function () {


            var yazi = $("#yorum").val();
            var uzunluk = yazi.length;

            if (uzunluk > 9) {

                $("#a1").hide();
                $("#a2").show();
            } else {
                $("#a2").hide();
                var kalan = Math.ceil(9 - uzunluk);
                $("#yrmak").html(kalan);
            }


        });

    });
</script>
