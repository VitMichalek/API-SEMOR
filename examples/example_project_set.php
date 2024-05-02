<?php

include "semor_api.php";

SEMOR::$token = "XXX";

/*
frekvency
1 - ka�d� den
3 - ka�d� 3dny
5 - ka�d�ch 5 dn�
7 - ka�d�ch 7 dn�
14 - ka�d�ch 14 dn�
*/


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

//Uprava projektu - jednorázové změření pozic
$data = array(
	"idp"=>1,//povinny parametr, ID v syst�mu SEMOR
	"frekvency"=>99,
	"ping_back"=>"htt..//domana.tld/"//při dokončení měření pošle ping na danou url
);

//Uprava projektu - logicke smazani projektu, p�es status = A je mo�� projekt znovu kdykoliv aktivovat
$data = array(
	"idp"=>1,//povinny parametr, ID v syst�mu SEMOR
	"status"=>"N"
);


$result = SEMOR::SetProject($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "V�e se ulo�ilo v po��dku";
}else{
	//error
	print_r($result["error"]);
}
?>