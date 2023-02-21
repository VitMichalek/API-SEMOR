<?php
class SEMOR{
	static $token = "";
	static $jsonOutput = false; //defaultne vraci vysledek jako JSON, false => vrac� Array()
	static $server = "https://api.semor.cz/";
	

	public function __construct(){
		SEMOR::testToken();
	}

	static function testToken(){
		if(strlen(SEMOR::$token) != 45) {
			echo json_encode(array("error"=>"Chybn� zadan� token. Zkontrolujte sv� nastaven�"));
			return;
		}
	}

	static function send($url,$pole){
		//Odesle po�adavek na server a zpracuje odpoved
		
		
		$ch = curl_init();
		
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);		
		$postData = array();
		$postData["token"] = SEMOR::$token;//Jedine�n� token, je p�id�lov�n ka�d�mu z�jemci o API
		$postData["data"] = $pole;

		curl_setopt($ch,CURLOPT_POST, count($postData));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $postData);   
		
		curl_setopt($ch,CURLOPT_URL,SEMOR::$server.$url);
		$output=curl_exec($ch);

		curl_close($ch);
		return (!SEMOR::$jsonOutput) ? json_decode($output,true) : $output;//dle nastaven� jsonOutput vrac� hodnoty json/array
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
		//Vr�t� po�et kredit�, kter� je k dispozici
		
		$url = "kredit_check";
		return SEMOR::send($url,"{}");
	}

	static function PutProject($pole){
		//Zalo�en� nov�ho projektu do syst�mu
		/*
		$pole["url"] - www projektu
		$pole["https"] - b�� na https A/N
		$pole["frekvency"] - jak �asto m��it pozice(automatizovan�) 1,3,5 
		$pole["lang"] - (CZ,SK,PL,FR,DE,PL,AT) - ISO 3166-1 alpha-2
		*/
		if(!isset($pole["idp"]) || (isset($pole["idp"]) && $pole["idp"] == "")){
			return json_encode(array("error"=>"IDP is required"));
		}
		$url = "project_put";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function SetProject($pole){
		//Uprava ji� vlo�en�ho projektu; 
		/*
		$pole["idp"] - id_projectu v SEMOR - POVINNE

		To co bude vypln�no bude zm�n�no
		$pole["url"] - www projektu
		$pole["https"] - b�� na https A/N
		$pole["engine"] - GS (Google/Seznam), GB (Google)
		$pole["lang"] - (CZ,SK,PL,FR,DE,PL,AT) - ISO 3166-1 alpha-2
		$pole["status"] - A/aktivni, N/nekativn�(logick� smazan�,k dispozici v archivu k obnov�)
		*/
		if(!isset($pole["idp"]) || (isset($pole["idp"]) && $pole["idp"] == "")){
			return json_encode(array("error"=>"IDP is required"));
		}
		$url = "project_set";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function GetProjectList(){
		//V�pis v�ech projekt� pro dan� token		
		$url = "project_list";
		return SEMOR::send($url,"{}");
	}

	static function PutKeyword($pole){
		//V�pis seznamu kl��ov�ch slov s hodnotou o posledn�m m��en�
		/*
		$pole["idp"] - ID projektu
		$pole["keyword"][0]["key"] = "slovo" - UTF-8
		$pole["keyword"][0]["idv"] = 4 - mo�nost poslat vlastni ID podle, kter�ho lze n�sledn� statistiky parovat hodnota int(11)
		*/		
		$url = "keyword_put";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function SetKeyword($pole){
		//V�pis seznamu kl��ov�ch slov s hodnotou o posledn�m m��en�
		/*
		$pole["idp"] - ID projektu
		$pole["keyword"]["idk"][428]["status"] = "N" - 428 - ID slova v systemu, status A/N (logicke smazani,aktivovani)
		nebo
		$pole["keyword"]["idv"][123]["status"] = "N" - 123 - vlastn� ID slova, pokud bylo zad�no p�i vkl�d�n� slova, status A/N (logicke smazani,aktivovani)
		
		*/		
		$url = "keyword_set";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	static function GetKeywordList($pole){
		//V�pis seznamu kl��ov�ch slov s hodnotou o posledn�m m��en�
		/*
		$pole["idp"] - ID projektu
		*/		
		$url = "keyword_list";
		return SEMOR::send($url,SEMOR::Data($pole));
	}

	

}
?>