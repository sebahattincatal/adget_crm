<?php if (!defined("idokey")) {
    exit();
} ?>

<?php


$id = (int)$_GET["id"];

if (empty($id)) {
    header("Location:index.php");
}


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
    $siparis["login_case"] = tts($_POST["login_case"]);
    $siparis["sip_type"] = tts($_POST["sip_type"]);
    $siparis["agent"] = tts($_POST["agent"]);
    $siparis["extra_yetki"] = implode(",", $_POST["ozel_yetki"]);


    if (!empty($_POST["sifre"])) {
        $siparis["password"] = md5(p($_POST["sifre"]));
    }


    $where = " admin_id='" . $id . "'";


    $degistir = update_array("admin", $siparis, $where);

    if ($degistir) {
        alert_yes("İşleminiz Başarılı");
    } else {
        alert_no("işleminiz Başarısız.");
    }


}


$row = $db->get_row("SELECT * FROM admin where admin_id='" . $id . "' ");


if (!$row) {
    header("Location:index.php");
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
                    <label class="col-sm-3 control-label">Yeni Şifre</label>

                    <div class="col-sm-6">
                        <input type="password" placeholder="Şifre değiştirmek isterseniz." name="sifre" id="sifre"
                               value="" class="form-control"/>
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

                            <option value="0" <?php if ($row->user_type == 0) {
                                echo 'selected';
                            } ?>>AGENT
                            </option>

                            <option value="3" <?php if ($row->user_type == 3) {
                                echo 'selected';
                            } ?>>Depo Elemanı
                            </option>

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

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">İş Durumu</label>

                    <div class="col-sm-6">
                        <select class="form-control " id="login_case" name="login_case" style="width:200px">
                            <option value="0" <?php if ($row->login_case == 0) {
                                echo 'selected';
                            } ?>>Çalışıyor
                            </option>
                            <option value="1" <?php if ($row->login_case == 1) {
                                echo 'selected';
                            } ?> >İş Feshi
                            </option>


                        </select>
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
                    <label class="col-sm-3 control-label">Özel Yetki</label>

                    <div class="col-sm-6">
                        <?php
                        $all_yt = explode(",", $row->extra_yetki);

                        $eds = $db->get_results("SELECT * FROM ozel_yetkiler ");
                        foreach ($eds as $wsw) {

                            if (in_array($wsw->yt_id, $all_yt)) {
                                $sts = 'checked="checked"';
                            } else {
                                $sts = "";
                            }

                            echo '<label>
          <input type="checkbox" name="ozel_yetki[]" ' . $sts . ' value="' . $wsw->yt_id . '" id="oyetki" />
      ' . $wsw->yetki_adi . '
      </label>';
                        }

                        ?>
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


<script type="text/javascript">

    $("#siparis_durumu")
        .change(function () {
            var str = "";
            $("select option:selected").each(function () {
                str += $(this).text() + " ";
            });
            $("div").text(str);
        })
        .change();


</script>