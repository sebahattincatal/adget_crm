<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 18.08.2015
 * Time: 20:07
 */
?>
<?php if (!defined("idokey")) {
    exit();
}


$user_type = $_SESSION["user_type"];

if ($user_type < 1) {
    header("Location:index.php");
}


function part($t)
{
    $xx = explode("/", $t);
    $k = $xx["2"] . "-" . $xx["1"] . "-" . $xx["0"];
    return $k;
}


if ($_POST) {
    $start_date = part($_POST["start"]);
    $stop_date = part($_POST["stop"]);

} else {
    $start_date = date("Y-m-d");
    $stop_date = date("Y-m-d");
}

if (empty($start_date)) {
    $start_date = date("Y-m-d");
}

if (empty($stop_date)) {
    $stop_date = date("Y-m-d");
}


$p1 = str_replace("-", "/", date("d-m-Y", strtotime($start_date)));
$p2 = str_replace("-", "/", date("d-m-Y", strtotime($stop_date)));


?>


<script type="text/javascript">

    function CargoPOST(x) {

        $("#EE" + x).hide();
        $("#EEE" + x).show();
        $("#EEE" + x).html(' <img src="yukleniyor.gif" style="height:70%">');

        $.post("inc/aras_api_post.php", {x: x}, function (donenVeri) {
            var donen = donenVeri;


            if (donen == 'Başarılı') {

                $("#CD" + x).css('background-color', '#DFFFBF');

                $("#CE" + x).html("Kargolandı");


                $("#EE" + x).show();
                $("#EEE" + x).hide("");

            } else {

                $("#CD" + x).css('background-color', '#FFD9D9');

                $("#CE" + x).html("Yeninden Dene");

                $("#EE" + x).show();
                $("#EEE" + x).html('<b style="color:#8C0000">' + donen + '</b>');


            }
            var res = donen.replace('<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" /></head>', "");
            //alert(res);

        });


    }

    function updateOrderCargoStatus(e, s){

        if(isset(s.CargoKey)){
            //$.post('inc/setCarkoKey.php', {CargoKey: s.CargoKey});
        }

    }

    function APIPost(e){
        event.stopPropagation();
        event.preventDefault();
        var raw = eval('('+$(e).data('kargo')+')');
        $.post('inc/aras_api_postCargo.php', {id: raw.id}, function(r){
            if(isset(r.ResultCode)){
                switch(r.ResultCode){
                    case '0':
                        updateOrderCargoStatus(e, {status: true, text: 'Kargoya gönderildi', CargoKey: r.CargoKey});
                        break;
                    case '936':
                        updateOrderCargoStatus(e, {status: false, text: 'Bilgiler eksik'});
                        break;
                    case '60020':
                        updateOrderCargoStatus(e, {status: false, text: r.ResultMessage});
                        break;
                }
            }else if(isset(r.CargoKey)){
                updateOrderCargoStatus(e, {status: true, text: 'Kargoya gönderildi', CargoKey: r.CargoKey});
            }
        });
    }

    function makeQuery(arr){
        var arr = arr || new Array();
        var Return = '';
        for(key in arr){
            for(keyX in arr[key]){
                Return += key+'['+keyX+']='+arr[key][keyX]+'&';
            }
        }
        return Return.substring(0, (Return.length-1));
    }

    function FaturaPrint(e){
        event.stopPropagation();
        event.preventDefault();
        var tr = $(e).parents('tr');
        var PostData = new Array();
        PostData['data'] = new Array();
        var Data = eval('('+tr.data('fatura')+')');
        PostData['data'][0] = Data.id;
        var Modal = $('.FaturaPrint-single');
        var PrinterWindow = null;
        Modal.modal('show');
        Modal.on('shown.bs.modal', function(){
            PrinterWindow = window.open('inc/ManuelFatura.php?data[0]='+Data.id, 'PrinterWindow', 'width=800, height=800');
            Modal.find('.save-fatura-no').click(function(){
                $.post('inc/updateManuelFaturaNo.php', {siparisId: Data.id, faturaNo: Modal.find('input.fatura_no').val()}, function(){
                    Modal.find('input.fatura_no').empty();
                    PrinterWindow.close();
                    Modal.modal('hide');
                    Modal.find('.save-fatura-no').off('click');
                    tr.remove();
                });
            });
        }).on('hidden.bs.modal', function(){
            PrinterWindow.close();
            $(this).find('input.fatura_no').empty();
            $(this).off('shown.bs.modal').off('hidden.bs.modal');
            $(this).find('input.fatura_no').empty();
            $(this).find('.save-fatura-no').off('click');
        });
    }

</script>


<div class="panel panel-default">


    <div class="panel-heading">
        <h4 class="panel-title">Manuel Faturalar</h4>
    </div>


    <div class="panel-body">

        <div class="table-responsive">
            <table class="table" id="table1 faturalar">
                <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>Telefon</th>
                    <th>Ürün</th>
                    <th>Fiyat</th>
                    <th>Personel</th>
                    <th>İşlem</th>
                </tr>
                </thead>
                <tbody>


                <?php

                $e = $db->get_results("SELECT * FROM `manuel_faturalar`");

                foreach ($e as $value) {

                    echo '
                  <tr data-fatura="{\'id\':\''.$value->id.'\'}" class="odd gradeX" id="CD' . $value->id . '">
                    <td>
                      <div id="EE' . $value->id . '">
                    ' . $value->isim . '<br>SipNo:' . $value->sip_No . ' </div>
                    <div   id="EEE' . $value->sip_No . '"  style="display:none">

                     </div>
                    </td>
                    <td>' . $value->telefon . '</td>
                    <td>' . product("urun_adi", $value->urun_id) . '</td>
                    <td>' . number_format($value->fiyat, 2, ',', ' ') . '</td>
                    <td>' . personel("name_surname", $value->personel) . '<br>' . dateFormat("d.m.Y H:i", $value->duz_tarih) . '</td>


                    <td >';
                    if($value->faturaPrint==0){
                        echo '<a style="cursor: pointer;" onclick="javascript:location.href=\'pages.php?ido=ManuelFatura_Duzenle&SiparisId=' . $value->id . '\'" class="btn btn-warning xs" id="CE' . $value->id . '">Düzenle</a>';
                        echo '&nbsp;<a href="#" onclick="javascript:FaturaPrint(this);" class="btn btn-info xs" id="CE' . $value->id . '">Faturaya Bas</a>';
                    }else{
                        echo 'Basılmış fatura!';
                    }

                    echo '


                    </td>
                 </tr>
                 ';
                }


                ?>


                </tbody>
            </table>
        </div>
        <!-- table-responsive -->


    </div>
    <!-- panel-body -->
</div><!-- panel -->

<!--<iframe width="0" height="0" class="fatura-printer"></iframe>-->

<div class="modal fade FaturaPrint-single" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body panel-body-nopadding">
                <form onsubmit="javascript: return false;" class="form-horizontal form-bordered">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Fatura Numarası</label>
                        <div class="col-sm-6">
                            <input type="text" placeholder="Fatura Numarası" class="form-control fatura_no">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-success save-fatura-no">Kaydet</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade FaturaPrint-multiple" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body panel-body-nopadding">
                <form onsubmit="javascript: return false;" class="form-horizontal form-bordered form-faturalar">
                    <div class="inputs" style="width: auto;max-height: 500px !important;min-height: 500px !important;overflow: scroll;overflow-x: hidden;overflow-y: auto;">
                        <div class="target"></div>
                    </div>
                </form>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button class="btn btn-success save-fatura-no">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
