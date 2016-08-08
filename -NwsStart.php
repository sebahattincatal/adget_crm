<?php
session_start(); ob_start("ob_gzhandler");
set_time_limit(0);
error_reporting(0);
include("inc/include.php");
oturum_koru();
define("idokey","1",true);

if(!$_SESSION["user_type"]==1){
    exit();
}


$tipler= implode(",", $_POST["tipler"]);
$durumlar= implode(",", $_POST["durumlar"]);

echo '<iframe src="Nws.php?tipler='.$tipler.'&durumlar='.$durumlar.'" width="5" height="5"></iframe>';

?>