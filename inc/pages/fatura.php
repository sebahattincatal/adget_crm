<?php
/**
 * Created by PhpStorm.
 * User: Musa ATALAY
 * Date: 13.08.2015
 * Time: 00:55
 */
?>
<html><head><meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">



    <style type="text/css">
        body{margin:0px; padding: 0px;}
        .fatura{
            overflow: auto;
            height:705px;
            padding-top:38px;

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
        .temizle{ clear:both;}
        .fatura_icerik table {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        .fatura_ara_toplam{
            overflow: auto;
            margin-bottom:2px;
            margin-left:25px;
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
                                elseif(items[sayarr[eleman].charAt(basamak - 1)][0] != "BIR") str = str + "" +           items[sayarr[eleman].charAt(basamak - 1)][0] + "YUZ";
                            else str = str + "YUZ";
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

                if (eleman & lt; 1) str = str + "TL";
            else {
                    if (sayarr[1] != "00") str = str + "KRS";
                }
            }



            return str;
        }


    </script>
</head>
<body style="font-size:12px; font-family:Verdana; margin:0px 0px 0px 0px" onload="setTimeout(function(){window.print();}, 500);">







<div class="fatura" style="margin-left: 38px;">
    <div class="fatura_genel">
        <div class="fatura_musteri_bilgi" style="width: 290px; padding-left: 7.5px; ">
            <ul style="height:82px;font-family:tahoma; font-size:10px;margin-top: 13px;">
                <li style="margin-top: 5px;  font-size:10px;"><b><span></span> <span style="margin-left: 0px;">Sip No: 26122632</span></b></li>
                <li style="margin-top:7px;  font-size:10px; font-family:Tahoma">
                    <strong style="font-family:Tahoma">özgen doğan T.C:</strong></li>
                <li style="margin-top:2px; width:270px; font-size:10px">
                    702sok. no 9 1.kadrıye mah cımen tepe   konak / İzmir
                    Tel :5535502469</li>
            </ul>

            <ul class="list" style="clear:both;margin-right:22px; margin-top: -6px;">
                <li>11.08.2015</li>
                <li>15:58</li>
                <li>11.08.2015</li>
            </ul>
            <div class="temizle"></div>
            <div class="fatura_icerik"><table width="270" border="0" cellpadding="0" cellspacing="0"><tbody><tr height="20">
                        <td width="145" style="font-size:9px">  THOMAS TAW - Saç Bakım Seti </td>
                        <td width="50" align="center">2 Adet</td>
                        <td width="30" align="center">%18</td>
                        <td width="40" align="center">126.27</td>
                        <td width="40" align="center"><b>149.00</b></td>
                    </tr>
                    </tbody></table></div>
            <div class="fatura_ara_toplam">
                <div style="float:left; width:100px;">&nbsp;
                    <iframe width="70" height="70" src="qr/code.php?x=26122632" frameborder="0"></iframe>
                </div>
                <div style="float:left; width:140px;">
                    <table width="140" border="0" style="font-size:9px;">
                        <tbody><tr>
                            <td width="100">Ara Toplam</td>
                            <td width="50">126.27 TL</td>
                        </tr>

                        <tr>
                            <td>Toplam KDV</td>
                            <td>22.73 TL</td>
                        </tr>

                        <tr>
                            <td width="100">İndirim</td>
                            <td width="50">19.00 TL</td>
                        </tr>
                        <tr>
                            <td><strong>Genel Toplam</strong></td>
                            <td><strong>130.00 TL</strong></td>
                        </tr>
                        </tbody></table>

                </div>
            </div>
            <div class="temizle"></div>  Yalnız
            #yüzotuzlira#
        </div>




        <div class="fatura_musteri_bilgi" style="width: 270px; margin-left: 33px;">

            <!-- start -->

            <ul style="height:80px; font-family:tahoma; font-size:9px;margin-top: 13px;">
                <li style="margin-top: 5px; font-size:10px"><b><span></span> <span style="margin-left: 0px;">Sip No: 26122632</span></b></li>
                <li style="margin-top:7px; font-size:10px; font-family:Tahoma">
                    <strong>özgen doğan  T.C:</strong></li>
                <li style="margin-top:2px; font-size:9px">
                    702sok. no 9 1.kadrıye mah cımen tepe   konak / İzmir
                    Tel :5535502469    </li>
            </ul>

            <ul class="list" style="clear:both; float:right; margin-top: -2px;">
                <li>11.08.2015</li>
                <li>15:58</li>
                <li>11.08.2015</li>
            </ul>
            <div class="temizle"></div>
            <div class="fatura_icerik"><table width="270" border="0" cellpadding="0" cellspacing="0"><tbody><tr height="20">
                        <td width="145" style="font-size:9px">  THOMAS TAW - Saç Bakım Seti </td>
                        <td width="50" align="center">2 Adet</td>
                        <td width="30" align="center">%18</td>
                        <td width="40" align="center">126.27</td>
                        <td width="40" align="center"><b>149.00</b></td>
                    </tr>
                    </tbody></table></div>
            <div class="fatura_ara_toplam">
                <div style="float:left; width:100px;">&nbsp;

                    <iframe width="70" height="70" src="qr/code.php?x=26122632" frameborder="0"></iframe>

                </div>
                <div style="float:left; width:140px;">
                    <table width="140" border="0" style="font-size:9px;">
                        <tbody><tr>
                            <td width="100">Ara Toplam</td>
                            <td width="50">126.27 TL</td>
                        </tr>
                        <tr>
                            <td>Toplam KDV</td>
                            <td>22.73 TL</td>
                        </tr>
                        <tr>
                            <td width="100">İndirim</td>
                            <td width="50">19.00 TL</td>
                        </tr>
                        <tr>
                            <td><strong>Genel Toplam</strong></td>
                            <td>130.00 TL</td>
                        </tr>
                        </tbody></table>

                </div>
            </div>
            <div class="temizle"></div>  Yalnız
            #yüzotuzlira#
            <!-- Stop -->


        </div>



        <div class="fatura_musteri_bilgi" style="width:270px; margin-left: 49.5px; padding-left: 15px; padding-right:0px">

            <!-- start -->

            <ul style="height:78px;  font-family:tahoma; font-size:8px;margin-top: 13px;">
                <li style="margin-top:2px; font-size:10px"><b><span></span> <span style="margin-left: 0px;">Sip No: 26122632</span></b></li>
                <li style="margin-top:7px;  font-size:10px; font-family:Tahoma">
                    <strong>özgen doğan  T.C:</strong></li>
                <li style="margin-top:2px;  font-size:9px">
                    702sok. no 9 1.kadrıye mah cımen tepe   konak / İzmir
                    Tel :5535502469    </li>
            </ul>

            <ul class="list" style="clear:both; float:right; margin-top: 0px;">
                <li>11.08.2015</li>
                <li>15:58</li>
                <li>11.08.2015</li>
            </ul>
            <div class="temizle"></div>
            <div class="fatura_icerik"><table width="270" border="0" cellpadding="0" cellspacing="0"><tbody><tr height="20">
                        <td width="145" style="font-size:9px">  THOMAS TAW - Saç Bakım Seti </td>
                        <td width="50" align="center">2 Adet</td>
                        <td width="30" align="center">%18</td>
                        <td width="40" align="center">126.27</td>
                        <td width="40" align="center"><b>149.00</b></td>
                    </tr>
                    </tbody></table></div>
            <div class="fatura_ara_toplam">
                <div style="float:left; width:100px;">&nbsp;
                    <iframe width="70" height="70" src="qr/code.php?x=26122632" frameborder="0"></iframe>


                </div>
                <div style="float:left; width:140px;">
                    <table width="140" border="0" style="font-size:9px;">
                        <tbody><tr>
                            <td width="100">Ara Toplam</td>
                            <td width="50">126.27 TL</td>
                        </tr>
                        <tr>
                            <td>Toplam KDV</td>
                            <td>22.73 TL</td>
                        </tr>
                        <tr>
                            <td width="100">İndirim</td>
                            <td width="50">19.00 TL</td>
                        </tr>
                        <tr>
                            <td><strong>Genel Toplam</strong></td>
                            <td>130.00 TL</td>
                        </tr>
                        </tbody></table>

                </div>
            </div>

            <div class="temizle"></div>  Yalnız
            #yüzotuzlira#
            <!-- Stop -->


        </div>




    </div>
</div>
</body></html>
