<?php

include "semor_api.php";

SEMOR::$token = "XXX";

/*
frekvency
1 - každý den
3 - každé 3dny
5 - každých 5 dní
7 - každých 7 dní
14 - každých 14 dní
*/

//Jen založení projektu, bez automatického mìøení pozic
$data = array(
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ"
);

//Jen založení projektu, s mìøením pozic každý den
$data = array(
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ",
	"frekvency"=>1
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