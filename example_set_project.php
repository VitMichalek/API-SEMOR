<?php

include "semor_api.php";

SEMOR::$token = "XXX";

//Uprava projektu
//upravuje se v�e co je poslano, nejl�pe vyplnuji jen to co chci zm�nit
$data = array(
	"idp"=>1,//povinny parametr, ID v syst�mu SEMOR
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ"
);

//Uprava projektu - jen zm�na frekvence m��en�
$data = array(
	"idp"=>1,//povinny parametr, ID v syst�mu SEMOR
	"frekvency"=>5
);

//Uprava projektu - zru�en� pravideln�ho me�en� pozic
$data = array(
	"idp"=>1,//povinny parametr, ID v syst�mu SEMOR
	"frekvency"=>0
);


$result = SEMOR::SetProject($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "V�e se ulo�ilo v po��dku";
}else{
	//error
	print_r($result["error"]);
}
?>