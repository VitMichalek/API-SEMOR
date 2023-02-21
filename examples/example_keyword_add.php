<?php

include "semor_api.php";

SEMOR::$token = "XXX";

//vložení klíèových slov k projektu
// idv neni povinne, je to vlastní ID z vlasntího systému int(11)
$data = array(
	"idp"=>1,//povinny parametr, ID projektu v systému SEMOR
	"keyword"=>array(
		array("key"=>"slovo 1","idv"=>123),
		array("key"=>"slovo 2","idv"=>258),
		array("key"=>"slovo 3","idv"=>1)
	)	
);


$result = SEMOR::PutKeyword($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "Vše se uložilo v poøádku";
}else{
	//error
	print_r($result["error"]);
}
?>