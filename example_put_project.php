<?php

include "semor_api.php";

SEMOR::$token = "XXX";

$data = array(
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ"
);


$result = SEMOR::PutProject($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "ID projektu je:".$result["idp"];
}elseif($result["status"] == 201){//projekt už v systemu existuje pod ID
	echo "ID projektu je:".$result["idp"];
}else{
	//error
	print_r($result["error"]);
}
?>