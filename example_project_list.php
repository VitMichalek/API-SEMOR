<?php

include "semor_api.php";

SEMOR::$token = "XXX";


$result = SEMOR::GetProjectList();
if($result["status"] == 200){//zalozen novy projekt
	foreach($result["list"] as $project){

	}
}else{
	//error
	print_r($result["error"]);
}
?>