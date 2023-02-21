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
			echo "Chybnì zadaný token. Zkontrolujte své nastavení";
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
			echo "Data v požadavku nejsou vyplnìna!";
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
		
		$pole["lang"] - (CZ,SK,PL,FR,DE,PL,AT) - ISO 3166-1 alpha-2
		*/
		
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
		
		$url = "project_set";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function GetProjectList(){
		//Výpis všech projektù pro daný token
		
		$url = "project_list";
		return SEMOR::send($url,"{}");
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