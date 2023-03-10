<?php

include "semor_api.php";

SEMOR::$token = "XXX";

$result = SEMOR::GetProjectIndex();
if($result["status"] == 200){//
	foreach($result["list"] as $data){
		//$data["date"] - datum
	}
	
}else{
	//error
	print_r($result["error"]);
}
?>