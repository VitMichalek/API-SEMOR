<?php

include "semor_api.php";

SEMOR::$token = "XXX";

//vlo�en� kl��ov�ch slov k projektu
// idv neni povinne, je to vlastn� ID z vlasnt�ho syst�mu int(11)
$data = array(
	"idp"=>1,//povinny parametr, ID projektu v syst�mu SEMOR
	"keyword"=>array(
		array("key"=>"slovo 1","idv"=>123),
		array("key"=>"slovo 2","idv"=>258),
		array("key"=>"slovo 3","idv"=>1)
	)	
);


$result = SEMOR::PutKeyword($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "V�e se ulo�ilo v po��dku";
}else{
	//error
	print_r($result["error"]);
}
?>