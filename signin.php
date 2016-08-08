<?php
session_start(); ob_start();
include("inc/include.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title><?=$title?></title>

  <link href="css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">


<section>
  
    <div class="signinpanel">
        
        <div class="row">
            
            <div class="col-md-7">
                
                <div class="signin-info">
                    <div class="logopanel">
                        <h1><span>[</span> <?=$sistem_adi?> <span>]</span></h1>
                    </div><!-- logopanel -->
                
                    <div class="mb20"></div>
                
                    <h5><strong>Yönetime Hoşgelsiniz</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Sipariş İşlemleri</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Sipariş Yönetimi</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> Ürün işlemleri</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> ve diğer işlemler...</li>
                    </ul>
                    <div class="mb20"></div>
                   
                </div><!-- signin0-info -->
            
            </div><!-- col-sm-7 -->
            
            <div class="col-md-5">
                
                <form method="post" id="LoGin" action="javascript:login();">
                    <h4 class="nomargin">Kullanıcı girişi</h4>
                    <p class="mt5 mb20">Giriş Yapmak için bilgileri doldurun</p>
                
                    <input type="email" class="form-control uname" placeholder="mail" name="mail" required />
                    <input type="password" class="form-control pword" placeholder="şifre" name="password" required />
                    <a href=""><small>Şifremi unuttum</small></a>
                    <button class="btn btn-success btn-block">Giriş Yap</button>
                    
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015 gointeratif.com
            </div>
            <div class="pull-right">
               Code: <a href="http://gointeraktif.com/" target="_blank">gointeraktif</a>
            </div>
        </div>
        
    </div><!-- signin -->
  
</section>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.cookies.js"></script>

<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>

<script src="js/custom.js"></script>
<script src="js/ekolaysoft.js"></script>
<script>
    jQuery(document).ready(function(){
        
        // Please do not use the code below
        // This is for demo purposes only
        var c = jQuery.cookie('change-skin');
        if (c && c == 'greyjoy') {
            jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
        } else if(c && c == 'dodgerblue') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        } else if (c && c == 'katniss') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        }
    });
</script>

</body>
</html>
