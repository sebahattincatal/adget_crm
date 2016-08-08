<?php

$agent = $_POST["agent"];


/*$data = array(
"agent_no"			=>	"101",
"agent_password"	=>	"101"
);
*/
 $data["agent_no"]=$agent;
 $data["agent_password"]=$agent;


$fields = array(
'name'    => "GOINTERA_SERVICE",
'key'     => '2238-7586-1417',
'cluster' => 'pbx',
'module'  => 'agents_state',
'request' => 'peer',
'data'    => $data
);
 
$fieldsJson = json_encode($fields);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'http://89.145.184.202/api/UCM_CTI_SERVICE.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsJson);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($fieldsJson))
); 
$result = curl_exec($ch);
//print_r($result);
$result=json_decode($result);

foreach($result as $r){

	

	$r->last_caller_id = str_replace("(", "", $r->last_caller_id);
	$r->last_caller_id = str_replace(")", "", $r->last_caller_id);
	$r->last_caller_id = str_replace(" ", "", $r->last_caller_id);
	//echo "agent_no : ".$r->agent_no."<br>";
	//echo "agent_password : ".$r->agent_password."<br>";
	//echo "agent_name : ".$r->agent_name."<br>";
	//echo "agent_status : ".$r->agent_status."<br>";
	echo $r->call_state."|".strip_tags(str_replace(" ","", $r->last_caller_id));
	//echo "last_caller_id : ".$r->last_caller_id."<br>";
	//echo "last_call_id : ".$r->last_call_id."<br><br><br>";
}

?>