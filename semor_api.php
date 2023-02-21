<?php
class SEMOR{
	static $token = "";
	static $jsonOutput = false; //defaultne vraci vysledek jako JSON, false => vrací Array()
	static $server = "https://api.semor.cz/";
	

	public function __construct(){
		SEMOR::testToken();
	}

	static function testToken(){
		if(strlen(SEMOR::$token) != 45) {
			echo json_encode(array("error"=>"Chybnì zadaný token. Zkontrolujte své nastavení"));
			return;
		}
	}

	static function send($url,$pole){
		//Odesle požadavek na server a zpracuje odpoved
		
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);		
		$postData = array();
		$postData["token"] = SEMOR::$token;//Jedineèný token, je pøidìlován každému zájemci o API
		$postData["data"] = $pole;

		curl_setopt($ch,CURLOPT_POST, count($postData));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $postData);   
		
		curl_setopt($ch,CURLOPT_URL,SEMOR::$server.$url);
		$output=curl_exec($ch);

		curl_close($ch);
		return (!SEMOR::$jsonOutput) ? json_decode($output,true) : $output;//dle nastavení jsonOutput vrací hodnoty json/array
	}


	static function Data($data){
		if(is_array($data) && count($data)!=0){			
			return json_encode($data);			
		}else{
			return json_encode(array("error"=>"Data nejsou vyplnena v poradku"));
			return;
		}
	}


	static function CreditCheck(){
		//Vrátí poèet kreditù, který je k dispozici
		
		$url = "kredit_check";
		return SEMOR::send($url,"{}");
	}

	static function PutProject($pole){
		//Založení nového projektu do systému
		/*
		$pole["url"] - www projektu
		$pole["https"] - bìží na https A/N
		$pole["frekvency"] - jak èasto mìøit pozice(automatizovanì) 1,3,5 
		$pole["lang"] - (CZ,SK,PL,FR,DE,PL,AT) - ISO 3166-1 alpha-2
		*/
		if(!isset($pole["idp"]) || (isset($pole["idp"]) && $pole["idp"] == "")){
			return json_encode(array("error"=>"IDP is required"));
		}
		$url = "project_put";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function SetProject($pole){
		//Uprava již vloženého projektu; 
		/*
		$pole["idp"] - id_projectu v SEMOR - POVINNE

		To co bude vyplnìno bude zmìnìno
		$pole["url"] - www projektu
		$pole["https"] - bìží na https A/N
		$pole["engine"] - GS (Google/Seznam), GB (Google)
		$pole["lang"] - (CZ,SK,PL,FR,DE,PL,AT) - ISO 3166-1 alpha-2
		$pole["status"] - A/aktivni, N/nekativní(logické smazaní,k dispozici v archivu k obnovì)
		*/
		if(!isset($pole["idp"]) || (isset($pole["idp"]) && $pole["idp"] == "")){
			return json_encode(array("error"=>"IDP is required"));
		}
		$url = "project_set";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function GetProjectList(){
		//Výpis všech projektù pro daný token		
		$url = "project_list";
		return SEMOR::send($url,"{}");
	}

	static function PutKeyword($pole){
		//Výpis seznamu klíèových slov s hodnotou o posledním mìøení
		/*
		$pole["idp"] - ID projektu
		$pole["keyword"][0]["key"] = "slovo" - UTF-8
		$pole["keyword"][0]["idv"] = 4 - možnost poslat vlastni ID podle, kterého lze následnì statistiky parovat hodnota int(11)
		*/		
		$url = "keyword_put";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function SetKeyword($pole){
		//Výpis seznamu klíèových slov s hodnotou o posledním mìøení
		/*
		$pole["idp"] - ID projektu
		$pole["keyword"]["idk"][428]["status"] = "N" - 428 - ID slova v systemu, status A/N (logicke smazani,aktivovani)
		nebo
		$pole["keyword"]["idv"][123]["status"] = "N" - 123 - vlastní ID slova, pokud bylo zadáno pøi vkládání slova, status A/N (logicke smazani,aktivovani)
		
		*/		
		$url = "keyword_set";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function GetKeywordList($pole){
		//Výpis seznamu klíèových slov s hodnotou o posledním mìøení
		/*
		$pole["idp"] - ID projektu
		*/		
		$url = "keyword_list";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	

}
?>