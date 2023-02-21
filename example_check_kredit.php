<?php

include "semor_api.php";

SEMOR::$token = "XXX";
$result = SEMOR::CreditCheck();
if($result["status"] == 200){
	echo $result["credit"];
}else{
	//error
	print_r($result["error"]);
}
?>