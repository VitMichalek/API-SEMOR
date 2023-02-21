<?php

include "semor_api.php";

SEMOR::$token = "XXX";

$result = SEMOR::GetProjectList();
if($result["status"] == 200){//
	foreach($result["server"]["active"] as $project){

	}
	foreach($result["server"]["inactive"] as $project){

	}
}else{
	//error
	print_r($result["error"]);
}
?>