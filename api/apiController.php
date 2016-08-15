<?php

include 'crm.php';

$type = "";
if(isset($_POST["type"]))
	$type= $_POST["type"];

switch($type){

	case "orders":

		$crm = new crm();
		$crm->orderSend();
		break;

	case "findApiKey":

		$crm = new crm();
		$crm->findApiKey();
		break;

	default:
    	$crm = new crm();
		$crm->notFound();
		break;
}

?>