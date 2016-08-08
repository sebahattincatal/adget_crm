<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 18.08.2015
 * Time: 19:44
 */
?>
<?php if (!defined("idokey")) {
    exit();
} ?>

<?php

error_reporting(E_ALL);

$user_type = $_SESSION["user_type"];

if ($user_type < 1) {
    header("Location:index.php");
}


if ($_POST) {

    $siparis = $_POST;

    $siparis["sip_No"] = (@$_POST["sip_No"]||strlen(@$_POST["sip_No"])>=4) ? filler(@$_POST["sip_No"]) : (rand(1, 99) + time() + microtime());

    $siparis["sevk_tarih"] = dateFormat("Y-m-d H:i:s", @$_POST["sevk_tarih"]);

    $siparis["personel"] = $_SESSION["admin_id"];

    $insert = insert_array("manuel_faturalar", $siparis);

    if ($insert) {
        alert_yes("İşleminiz Başarılı");
    } else {
        alert_no("işleminiz Başarısız.");
    }

}


?>


<div class="contentpanel">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">Manuel Fatura Ekle</h4>

            <p>Personel detaylarını giriniz</p>


        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" method="post">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Sipariş No(Varsa Alış Fatrura No)</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Varsa Alış Fatrura No, Yoksa Boş Bırak" name="sip_No" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">İsim Soyisim - Tüzel Adı</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="İsim Soyisim veya Tüzel Adı" name="isim" id="name" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Telefon No</label>

                    <div class="col-sm-6">
                        <input type="tel" placeholder="Telefon No" name="telefon" id="phone" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Adres</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Adres" name="adres" id="address" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Fiili Sevk Tarihi</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Fiili Sevk Tarihi" name="sevk_tarih" id="datepicker" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">KDV</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" placeholder="KDV" name="kdv" id="kdv" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Fiyat</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" placeholder="Fiyat" name="fiyat" id="fiyat" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">İndirim</label>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" placeholder="İndirim" name="indirim" id="indirim" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Ürün</label>

                    <div class="col-sm-6">
                        <select class="form-control " id="urun_id" name="urun_id" required style="width:300px">

                            <?php
                                $sx = $db->get_results("SELECT * FROM `urunler`");
                                foreach ($sx as $valuew) {
                                    echo '<option data-fiyat="'.$valuew->urun_fiyati.'" value="'.$valuew->urun_id.'">'.$valuew->urun_adi.' - '.$valuew->urun_fiyati.' TL</option>';
                                }
                            ?>

                        </select>
                        <script type="text/javascript">
                            $(function(){
                                $('select#urun_id').change(function(){
                                    var Adet = parseFloat($('input#fiyat').val()) / parseFloat($(this).find('option:selected').data('fiyat'));
                                    $('input#adet').val(parseInt(Adet));
                                });
                            });
                        </script>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Adet</label>
                    <div class="col-sm-6">
                        <input type="number" placeholder="Adet" name="adet" id="adet" required class="form-control"/>
                    </div>
                </div>
        </div>
        <!-- panel-body -->

        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">


                    <button type="submit" class="btn btn-primary">Bitir</button>
                    &nbsp;


                </div>
            </div>
        </div>
        <!-- panel-footer -->
        </form>
    </div>
    <!-- panel -->


</div><!-- contentpanel -->

