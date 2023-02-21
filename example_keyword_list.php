<?php

include "semor_api.php";

SEMOR::$token = "XXX";

// vypsani klièových slov pro dany projekt
$data = array(
	"idp"=>1,//povinny parametr, ID projektu v systému SEMOR	
);


$result = SEMOR::GetKeywordList($data);
if($result["status"] == 200){//zalozen novy projekt
	foreach($result["list"] as $keyword){

	}
}else{
	//error
	print_r($result["error"]);
}
?>