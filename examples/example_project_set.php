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


//Uprava projektu
//upravuje se vše co je poslano, nejlépe vyplnuji jen to co chci zmìnit
$data = array(
	"idp"=>1,//povinny parametr, ID v systému SEMOR
	"url"=>"domena.tld",
	"https"=>"A",
	"lang"=>"CZ"
);

//Uprava projektu - jen zmìna frekvence mìøení
$data = array(
	"idp"=>1,//povinny parametr, ID v systému SEMOR
	"frekvency"=>5
);

//Uprava projektu - zrušení pravidelného meøení pozic
$data = array(
	"idp"=>1,//povinny parametr, ID v systému SEMOR
	"frekvency"=>0
);

//Uprava projektu - logicke smazani projektu, pøes status = A je možé projekt znovu kdykoliv aktivovat
$data = array(
	"idp"=>1,//povinny parametr, ID v systému SEMOR
	"status"=>"N"
);


$result = SEMOR::SetProject($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "Vše se uložilo v poøádku";
}else{
	//error
	print_r($result["error"]);
}
?>