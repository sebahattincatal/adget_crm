<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 18.08.2015
 * Time: 16:46
 */
?>
<?php if (!defined("idokey")) {
    exit();
}?>

<style>
    .refreshing-kuyruk{
        position: absolute;
        z-index: 1;
        right: 25px;
    }
</style>


<div class="col-sm-6 col-md-3">
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="images/screen.png" alt=""/>
                    </div>
                    <div class="col-xs-8">
                        <small>Müşteri Kartları</small>
                        <button class="btn btn-primary mr5 btn-lg" data-toggle="modal"
                                data-target=".bs-example-modal-lg">Müşteri Ara
                        </button>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->


<div class="col-sm-6 col-md-3">
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="images/is-document.png" alt=""/>
                    </div>
                    <div class="col-xs-8">
                        <small>Kargo</small>
                        <button class="btn btn-primary mr5 btn-lg" data-toggle="modal" data-target=".kargoara">Kargo
                            Listesi Al
                        </button>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->


<div class="col-sm-6 col-md-3" <?=$div_statu?>>
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="images/screen.png" alt=""/>
                    </div>
                    <div class="col-xs-8">
                        <small>Data işlemleri</small>
                        <button class="btn btn-primary mr5 btn-lg" data-toggle="modal" data-target=".dataView">Data
                            Aktar
                        </button>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->


<div class="col-sm-6 col-md-3 hidden" <?=$div_statu?>>
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="images/cargoPost.png" alt=""/>
                    </div>
                    <div class="col-xs-8">
                        <small>Karo İşlemleri</small>
                        <a href="pages.php?ido=KargoPost" class="btn btn-primary mr5 btn-lg">Kargo Gönder</a>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->


<div class="col-sm-6 col-md-3">
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <img src="images/is-document.png" alt=""/>
                    </div>
                    <div class="col-xs-8">
                        <small>Kilit Sipariş</small>
                        <br>
                        <button class="btn btn-primary mr5 btn-lg" onclick="SipReset();">Sıfırla</button>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->

<div class="col-sm-6 col-md-3" <?=$div_statu?>>
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <!--<img src="images/cargoPost.png" alt=""/>-->
                        <span style="font-size: 70px;color: #1D2939;" class="glyphicon glyphicon-qrcode"></span>
                    </div>
                    <div class="col-xs-8">
                        <small>Fatura İşlemleri</small>
                        <a href="pages.php?ido=FaturaPrint" class="btn btn-primary mr5 btn-lg">Fatura Yazdır</a>
                    </div>
                </div>
                <!-- row -->


            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->

<div class="col-sm-6 col-md-3" <?=$div_statu?>>
    <div class="panel panel-success panel-stat">
        <div class="panel-heading">

            <div class="stat">
                <div class="row">
                    <div class="col-xs-4">
                        <!--<img src="images/cargoPost.png" alt=""/>-->
                        <span style="font-size: 70px;color: #1D2939;" class="glyphicon glyphicon-qrcode"></span>
                    </div>
                    <div class="col-xs-8">
                        <small>Fatura İşlemleri</small>
                        <a href="pages.php?ido=ManuelFatura" class="btn btn-primary mr5 btn-lg">Manuel Fatura</a>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- stat -->

        </div>
        <!-- panel-heading -->
    </div>
    <!-- panel -->
</div><!-- col-sm-6 -->
