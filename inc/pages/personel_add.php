<?php if (!defined("idokey")) {
    exit();
} ?>

<?php


$user_type = $_SESSION["user_type"];

if ($user_type < 1) {
    header("Location:index.php");
}


if ($_POST) {


    $telefon = filler($_POST["telefon"]);
    $siparis["mail"] = tts($_POST["mail"]);
    $siparis["telefon"] = tts($_POST["telefon"]);
    $siparis["name_surname"] = tts($_POST["name_surname"]);
    $siparis["user_type"] = tts($_POST["user_type"]);
    $siparis["agent"] = tts($_POST["agent"]);


    if (!empty($_POST["sifre"])) {
        $siparis["password"] = md5(($_POST["sifre"]));
    }


    $degistir = insert_array("admin", $siparis);

    if ($degistir) {
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
            <h4 class="panel-title">Personel İşlemi</h4>

            <p>Personel Detayları aşağıdaki gibidir</p>


        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" method="post">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Ad Soyad</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Ürünün Adı" name="name_surname"
                               value="<?= $row->name_surname ?>" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Telefon No</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Telefon No" name="telefon" id="phone"
                               value="<?= $row->telefon ?>" required class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mail</label>

                    <div class="col-sm-6">
                        <input type="email" placeholder="Mail" name="mail" id="mail" value="<?= $row->mail ?>" required
                               class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"> Şifre</label>

                    <div class="col-sm-6">
                        <input type="password" placeholder="Şifre" name="sifre" id="sifre" value=""
                               class="form-control"/>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Kuyruk</label>

                    <div class="col-sm-6">
                        <select class="form-control " id="sip_type" name="sip_type" style="width:200px">

                            <?php
                            $sx = $db->get_results("SELECT * FROM siparis_tipleri " . $sql_statu2 . " ");
                            foreach ($sx as $valuew) {

                                echo '<option value="' . $valuew->siparis_tipi . '" ';
                                if ($valuew->siparis_tipi == $row->sip_type) {
                                    echo 'selected';
                                }

                                echo '>' . $valuew->name . '</option>
';


                            }

                            ?>


                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label">Saphira Dahili</label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Dahili" name="agent" id="agent" value="<?= $row->agent ?>"
                               class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Pozisyon</label>

                    <div class="col-sm-6">
                        <select class="form-control " id="user_type" name="user_type" style="width:200px">
                            <?php
                            if (empty($_SESSION["yetki"])) {
                                ?>
                                <option value="1" <?php if ($row->user_type == 1) {
                                    echo 'selected';
                                } ?> >Yönetici
                                </option>
                                <option value="4" <?php if ($row->user_type == 4) {
                                    echo 'selected';
                                } ?> >Muhasebe Yöneticisi
                                </option>
                                <option value="2" <?php if ($row->user_type == 2) {
                                    echo 'selected';
                                } ?> >Kalite Kontrol
                                </option>

                            <?php } ?>

                            <option value="0" <?php if ($row->user_type == 0) {
                                echo 'selected';
                            } ?>>AGENT
                            </option>

                            <option value="3" <?php if ($row->user_type == 3) {
                                echo 'selected';
                            } ?>>Depo Elemanı
                            </option>

                        </select>
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
