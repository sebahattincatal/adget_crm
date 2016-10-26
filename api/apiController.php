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

	case "orderControl":

		$crm = new crm();
		$crm->orderStatus();
		break;

	case "statusInformation":

		$crm = new crm();
		$crm->statusInformation();
		break;

	default:
    	$crm = new crm();
		$crm->notFound();
		break;
}

?>