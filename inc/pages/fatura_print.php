<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 12.08.2015
 * Time: 18:43
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
            PrinterWindow = window.open('inc/fatura.php?data[0]='+Data.id, 'PrinterWindow', 'width=800, height=800');
            Modal.find('.save-fatura-no').click(function(){
                $.post('inc/updateFaturaNo.php', {siparisId: Data.id, faturaNo: Modal.find('input.fatura_no').val()}, function(){
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

    function FaturasPrint(){
        event.stopPropagation();
        event.preventDefault();
        var PostData = new Array();
        PostData['data'] = new Array();
        var Modal = $('.FaturaPrint-multiple');
        $.post('inc/fetchOrdersForInvoice.php', function(r){
            var Response = $(r);
            Response.each(function(i,v){
                PostData['data'][i] = v.id;
                var InputFaturaNo = $('<input/>').addClass('form-control input-fatura-no').attr('type', 'text').attr('name', 'data['+i+']['+v.id+']').attr('placeholder', 'Fatura Numarası').attr('count', i);
                var FormGroup = $('<div/>').addClass('form-group').attr('style', 'padding: 20px 80px !important;border-top: 1px solid #d3d7db !important;').append(
                    $('<label/>').addClass('col-sm-3').addClass('control-label').html('Sipariş No : <strong>'+v.id+'</strong>')
                ).append(
                    $('<div/>').addClass('col-sm-6').append(InputFaturaNo)
                );
                Modal.find('div.inputs > div.target').first().before(FormGroup);
                InputFaturaNo.change(function(){
                    var __this = $(this);
                    var FirstKey = parseInt(__this.attr('count'));
                    var LastKey = parseInt(Modal.find('input.input-fatura-no').last().attr('count'));
                    var plus = 1;
                    for(var ixX=(FirstKey+1);ixX<=LastKey;ixX++){
                        Modal.find('input.input-fatura-no[count="'+ixX+'"]').val(parseInt(__this.val())+plus);
                        plus++;
                    }
                });
            });
            var PrinterWindow = null;
            Modal.modal('show');
            Modal.on('shown.bs.modal', function(){
                PrinterWindow = window.open('inc/fatura.php?'+makeQuery(PostData), 'PrinterWindow', 'width=800, height=800');
                Modal.find('.save-fatura-no').click(function(){
                    $.post('inc/updateFaturalarNo.php', Modal.find('form.form-faturalar').serialize(), function(){
                        Modal.find('div.inputs').html('').empty();
                        PrinterWindow.close();
                        Modal.modal('hide');
                        Modal.find('.save-fatura-no').off('click');
                        $('table.faturalar').find('tbody').empty();
                    });
                });
            }).on('hidden.bs.modal', function(){
                PrinterWindow.close();
                $(this).find('input.fatura_no').empty();
                $(this).off('shown.bs.modal').off('hidden.bs.modal');
                $(this).find('input.fatura_no').empty();
                $(this).find('.save-fatura-no').off('click');
            });
        });
    }

</script>


<div class="panel panel-default">


    <div class="panel-heading">

        <div class="panel-btns">
            <a href="javascript:void(0);" style="opacity: 1 !important;color: #ffffff;" onclick="javascript:FaturasPrint(this);" class="btn btn-info xs">Tümünü Faturaya Bas</a>
        </div><br />

        <h4 class="panel-title">Satışlar</h4>

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

                $urun_listesi = array();
                //
                $e = $db->get_results("SELECT * FROM `siparisler` WHERE `satis_tarihi` BETWEEN '0000-00-00 00:00:00' AND '" . $stop_date . " 23:59:59' AND `siparis_durumu` AND (siparis_durumu = 7 OR siparis_durumu = 8 OR siparis_durumu = 9) AND `kal_kontrol` = 1 AND (`cargoPrint` = 0 AND `fatura_no` = 0 AND `kargo_post` = 0) ORDER BY `satis_tarihi` ASC");

                // $e = $db->get_results("SELECT * FROM siparisler where  (satis_tarihi between '".$start_date." 00:00:00' AND '".$stop_date." 23:59:59') AND siparis_durumu in (7,9)  ".$sql_statu."  ");
                foreach ($e as $value) {

                    $urun_listesi[$value->urun_id][] = 1;
                    $urun_listesi_name[$value->urun_id] = $value->urunun_adi;

                    echo '
                  <tr data-fatura="{\'id\':\''.$value->siparis_id.'\'}" class="odd gradeX" id="CD' . $value->siparis_id . '">
                    <td>
                      <div id="EE' . $value->siparis_id . '">
                    ' . $value->ad_soyad . '<br>SipNo:' . $value->siparis_id . ' </div>
                    <div   id="EEE' . $value->siparis_id . '"  style="display:none">

                     </div>
                    </td>
                    <td>' . $value->Telefon_no . '</td>
                    <td>' . $value->urunun_adi . '</td>
                    <td>' . $value->fiyat . '</td>
                    <td>' . personel("name_surname", $value->personel) . '<br>' . $value->satis_tarihi . '</td>


                    <td >
                    <a href="#" onclick="javascript:FaturaPrint(this);" class="btn btn-info xs" id="CE' . $value->siparis_id . '">Faturaya Bas</a>
';


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