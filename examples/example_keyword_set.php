<?php

include "semor_api.php";

SEMOR::$token = "XXX";

// smazani/aktivovani slova podle idk - ID ze syst�mu SEMOR
$data = array(
	"idp"=>1,//povinny parametr, ID projektu v syst�mu SEMOR
	"keyword"=>array(
		"idk"=>array(
			123=>array("status"=>"N")
		)		
	)	
);

// smazani/aktivovani slova podle idv - ID z vlastniho systemu
$data = array(
	"idp"=>1,//povinny parametr, ID projektu v syst�mu SEMOR
	"keyword"=>array(
		"idv"=>array(
			258=>array("status"=>"N")
		)		
	)	
);


$result = SEMOR::SetKeyword($data);
if($result["status"] == 200){//zalozen novy projekt
	echo "V�e se ulo�ilo v po��dku";
}else{
	//error
	print_r($result["error"]);
}
?>