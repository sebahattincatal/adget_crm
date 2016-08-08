<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 19.08.2015
 * Time: 03:20
 */
?>
<?php

ob_start();
ini_set("display_errors", "On");
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf8");

require_once "config.php";
require_once "function.php";
require_once "Price.Convertor.php";

?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">


    <style type="text/css">
        body {
            margin: 0px;
            padding: 0px;
        }

        .fatura {
            overflow: auto;
            height: 705px;
            padding-top: 38px;

            /*border-bottom-width: 1px;
            border-bottom-style: solid;
            border-bottom-color: #000;*/

        }

        .fatura_genel {
            float: left;
            height: 595px;

        }

        .fatura_musteri_bilgi {
            height: 460px;
            margin-top: 120px;
            float: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: normal;
            color: #000;
            padding-top: 2px;
            padding-right: 14px;

            padding-bottom: 2px;
            padding-left: 14px;

        }

        .list {
            float: right;
            margin-right: 15px;
            padding-right: 15px;

        }

        .list li {
            height: 16px;
            line-height: 16px;
        }

        .odeme {
            height: 20px;
            width: 150px;
            margin-right: auto;
            margin-left: 20px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            line-height: 20px;
            font-weight: bold;
            color: #000;
        }

        .fatura_musteri_bilgi ul {
            margin: 0px;
            padding: 0px;
        }

        .fatura_musteri_bilgi ul li {
            list-style-type: none;
            font-size: 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .fatura_icerik {

            padding-bottom: 2px;
            overflow: auto;
            margin-top: 15px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            height: 155px;
            overflow: auto;
        }

        .temizle {
            clear: both;
        }

        .fatura_icerik table {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        .fatura_ara_toplam {
            overflow: auto;
            margin-bottom: 2px;
            margin-left: 25px;
        }
    </style>
    <script type="text/javascript">


        function cevirt(sayi, separator) {
            sayarr = sayi.split(separator);
            var str = "";
            var items = [
                ["", ""],
                ["BIR", "ON"],
                ["IKI", "YIRMI"],
                ["UC", "OTUZ"],
                ["DORT", "KIRK"],
                ["BES", "ELLI"],
                ["ALTI", "ALTMIS"],
                ["YEDI", "YETMIS"],
                ["SEKIZ", "SEKSEN"],
                ["DOKUZ", "DOKSAN"]
            ];
            for (eleman = 0; eleman < sayarr.length; eleman++) {
                for (basamak = 1; basamak <= sayarr[eleman].length; basamak++) {
                    basamakd = 1 + (sayarr[eleman].length - basamak);
                    try {
                        switch (basamakd) {
                            case 6:
                                str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][0] + "YUZ";
                                break;
                            case 5:
                                str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][1];
                                break;
                            case 4:
                                if (items[sayarr[eleman].charAt(basamak - 1)][0] != "BIR") str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][0] + "BIN";
                                else str = str + "BIN";
                                break;
                            case 3:
                                if (items[sayarr[eleman].charAt(basamak - 1)][0] == "") {
                                    str = str + "";

                                }
                                elseif(items[sayarr[eleman].charAt(basamak - 1)][0] != "BIR")
                                str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][0] + "YUZ";
                            else
                                str = str + "YUZ";
                                break;
                            case 2:
                                str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][1];
                                break;
                            default:
                                str = str + "" + items[sayarr[eleman].charAt(basamak - 1)][0];
                                break;
                        }
                    } catch (err) {
                        alert(err.description);
                        alert("eleman" + basamak);
                        break;
                    }
                }

                if (eleman & lt;
                1
            )
                str = str + "TL";
            else
                {
                    if (sayarr[1] != "00") str = str + "KRS";
                }
            }


            return str;
        }


    </script>
</head>
<body style="font-size:12px; font-family:Verdana; margin:0px 0px 0px 0px"
      onload="setTimeout(function(){window.print(); /*window.close();*/}, 500);">

<?php

foreach (@$_GET["data"] AS $index => $value) {

    $FetchOrders = $db->get_results("SELECT * FROM `manuel_faturalar` WHERE `id` = '" . $value . "'");

    $FetchOrder = $FetchOrders[0];

    ?>

    <div class="fatura" style="margin-left: 38px;">
        <div class="fatura_genel">
            <div class="fatura_musteri_bilgi" style="width: 290px; padding-left: 7.5px; ">
                <ul style="height:82px;font-family:tahoma; font-size:10px;margin-top: 13px;">
                    <li style="margin-top: 5px;  font-size:10px;"><b><span></span> <span style="margin-left: 0px;">Sip No: <?= $FetchOrder->sip_No; ?></span></b>
                    </li>
                    <li style="margin-top:7px;  font-size:10px; font-family:Tahoma">
                        <strong style="font-family:Tahoma"><?= $FetchOrder->isim; ?> T.C:</strong></li>
                    <li style="margin-top:2px; width:270px; font-size:10px">
                        <?= $FetchOrder->adres; ?><br/>
                        Tel :<?= $FetchOrder->telefon; ?>
                    </li>
                </ul>

                <ul class="list" style="clear:both;margin-right:22px; margin-top: -6px;">
                    <li><?= dateFormat("d.m.Y", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("H:i", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("d.m.Y", $FetchOrder->sevk_tarih); ?></li>
                </ul>
                <div class="temizle"></div>
                <div class="fatura_icerik">
                    <table width="270" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr height="20">
                            <td width="145" style="font-size:9px"> <?= product("urun_adi", $FetchOrder->urun_id); ?></td>
                            <td width="50" align="center"><?= $FetchOrder->adet; ?> Adet</td>
                            <td width="30" align="center">%8</td>
                            <td width="40" align="center"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?></td>
                            <td width="40" align="center"><b><?= $FetchOrder->fiyat; ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="fatura_ara_toplam">
                    <div style="float:left; width:100px;">&nbsp;
                        <img width="70" height="70"
                             src="https://chart.googleapis.com/chart?cht=qr&chl=<?= $FetchOrder->sip_No; ?>&choe=UTF-8&chs=70x70&chld=H|3"/>
                    </div>
                    <div style="float:left; width:140px;">
                        <table width="140" border="0" style="font-size:9px;">
                            <tbody>
                            <tr>
                                <td width="100">Ara Toplam</td>
                                <td width="50"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?> TL</td>
                            </tr>

                            <tr>
                                <td>Toplam KDV</td>
                                <td><?= ($FetchOrder->fiyat * (float) $FetchOrder->kdv);?> TL</td>
                            </tr>

                            <tr>
                                <td width="100">İndirim</td>
                                <td width="50"><?= $FetchOrder->indirim; ?> TL</td>
                            </tr>
                            <tr>
                                <td><strong>Genel Toplam</strong></td>
                                <td><strong><?= (float) ($FetchOrder->fiyat - $FetchOrder->indirim); ?> TL</strong></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="temizle"></div>
                Yalnız
                #<?=\Price\Convertor::convertToAlphanumeric((float) ($FetchOrder->fiyat - $FetchOrder->indirim));?>#
            </div>


            <div class="fatura_musteri_bilgi" style="width: 270px; margin-left: 33px;">

                <!-- start -->

                <ul style="height:80px; font-family:tahoma; font-size:9px;margin-top: 13px;">
                    <li style="margin-top: 5px; font-size:10px"><b><span></span> <span
                                style="margin-left: 0px;">Sip No: <?= $FetchOrder->sip_No; ?></span></b>
                    </li>
                    <li style="margin-top:7px; font-size:10px; font-family:Tahoma">
                        <strong><?= $FetchOrder->isim; ?> T.C:</strong></li>
                    <li style="margin-top:2px; font-size:9px">
                        <?= $FetchOrder->adres; ?><br/>
                        Tel :<?= $FetchOrder->telefon; ?>
                    </li>
                </ul>

                <ul class="list" style="clear:both; float:right; margin-top: -2px;">
                    <li><?= dateFormat("d.m.Y", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("H:i", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("d.m.Y", $FetchOrder->sevk_tarih); ?></li>
                </ul>
                <div class="temizle"></div>
                <div class="fatura_icerik">
                    <table width="270" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr height="20">
                            <td width="145" style="font-size:9px"> <?= product("urun_adi", $FetchOrder->urun_id); ?></td>
                            <td width="50" align="center"><?= $FetchOrder->adet; ?> Adet</td>
                            <td width="30" align="center">%8</td>
                            <td width="40" align="center"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?></td>
                            <td width="40" align="center"><b><?= $FetchOrder->fiyat; ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="fatura_ara_toplam">
                    <div style="float:left; width:100px;">&nbsp;

                        <img width="70" height="70"
                             src="https://chart.googleapis.com/chart?cht=qr&chl=<?= $FetchOrder->sip_No; ?>&choe=UTF-8&chs=70x70&chld=H|3"/>

                    </div>
                    <div style="float:left; width:140px;">
                        <table width="140" border="0" style="font-size:9px;">
                            <tbody>
                            <tr>
                                <td width="100">Ara Toplam</td>
                                <td width="50"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?> TL</td>
                            </tr>
                            <tr>
                                <td>Toplam KDV</td>
                                <td><?= ($FetchOrder->fiyat * (float) $FetchOrder->kdv);?> TL</td>
                            </tr>
                            <tr>
                                <td width="100">İndirim</td>
                                <td width="50"><?= $FetchOrder->indirim; ?> TL</td>
                            </tr>
                            <tr>
                                <td><strong>Genel Toplam</strong></td>
                                <td><?= (float) ($FetchOrder->fiyat - $FetchOrder->indirim); ?> TL</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="temizle"></div>
                Yalnız
                #<?=\Price\Convertor::convertToAlphanumeric((float) ($FetchOrder->fiyat - $FetchOrder->indirim));?>#
                <!-- Stop -->


            </div>


            <div class="fatura_musteri_bilgi"
                 style="width:270px; margin-left: 49.5px; padding-left: 15px; padding-right:0px">

                <!-- start -->

                <ul style="height:78px;  font-family:tahoma; font-size:8px;margin-top: 13px;">
                    <li style="margin-top:2px; font-size:10px"><b><span></span> <span
                                style="margin-left: 0px;">Sip No: <?= $FetchOrder->sip_No; ?></span></b>
                    </li>
                    <li style="margin-top:7px;  font-size:10px; font-family:Tahoma">
                        <strong><?= $FetchOrder->isim; ?> T.C:</strong></li>
                    <li style="margin-top:2px;  font-size:9px">
                        <?= $FetchOrder->adres; ?><br/>
                        Tel :<?= $FetchOrder->telefon; ?>
                    </li>
                </ul>

                <ul class="list" style="clear:both; float:right; margin-top: 0px;">
                    <li><?= dateFormat("d.m.Y", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("H:i", $FetchOrder->duz_tarih); ?></li>
                    <li><?= dateFormat("d.m.Y", $FetchOrder->sevk_tarih); ?></li>
                </ul>
                <div class="temizle"></div>
                <div class="fatura_icerik">
                    <table width="270" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                        <tr height="20">
                            <td width="145" style="font-size:9px"> <?= product("urun_adi", $FetchOrder->urun_id); ?></td>
                            <td width="50" align="center"><?= $FetchOrder->adet; ?> Adet</td>
                            <td width="30" align="center">%8</td>
                            <td width="40" align="center"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?></td>
                            <td width="40" align="center"><b><?= $FetchOrder->fiyat; ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="fatura_ara_toplam">
                    <div style="float:left; width:100px;">&nbsp;
                        <img width="70" height="70"
                             src="https://chart.googleapis.com/chart?cht=qr&chl=<?= $FetchOrder->sip_No; ?>&choe=UTF-8&chs=70x70&chld=H|3"/>


                    </div>
                    <div style="float:left; width:140px;">
                        <table width="140" border="0" style="font-size:9px;">
                            <tbody>
                            <tr>
                                <td width="100">Ara Toplam</td>
                                <td width="50"><?= ($FetchOrder->fiyat - ($FetchOrder->fiyat * (float) $FetchOrder->kdv));?> TL</td>
                            </tr>
                            <tr>
                                <td>Toplam KDV</td>
                                <td><?= ($FetchOrder->fiyat * (float) $FetchOrder->kdv);?> TL</td>
                            </tr>
                            <tr>
                                <td width="100">İndirim</td>
                                <td width="50"><?= $FetchOrder->indirim; ?> TL</td>
                            </tr>
                            <tr>
                                <td><strong>Genel Toplam</strong></td>
                                <td><?=(float) ($FetchOrder->fiyat - $FetchOrder->indirim); ?> TL</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="temizle"></div>
                Yalnız
                #<?=\Price\Convertor::convertToAlphanumeric((float) ($FetchOrder->fiyat - $FetchOrder->indirim));?>#
                <!-- Stop -->


            </div>

        </div>
    </div>

    <?php

}

?>

</body>
</html>

