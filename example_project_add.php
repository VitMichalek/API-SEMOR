<?php

include "semor_api.php";

SEMOR::$token = "XXX";

//Jen zalo�en� projektu, bez automatick�ho m��en� pozic
$data = array(
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ"
);

//Jen zalo�en� projektu, s m��en�m pozic ka�d� den
$data = array(
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ",
	"frekvency"=>1
);


$result = SEMOR::PutProject($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "ID projektu je:".$result["idp"];
}elseif($result["status"] == 201){//projekt u� v systemu existuje pod ID
	echo "ID projektu je:".$result["idp"];
}else{
	//error
	print_r($result["error"]);
}
?>