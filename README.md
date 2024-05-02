# API SEMOR

API pro externí přístup ke službám systému SEMOR.cz pro partnerské služby

TOKEN pro komunikaci najdete po přihlášení v administrace->nastavení

1) stáhnout semor_api.php
2) nastavit si tokem SEMOR::$token = "váš token";


#PROJEKTY
- PutProject - založení nového projektu
- SetProject - editace/smazani projektu
- GetProjectList - výpis všech projektů
- GetProjectIndex - vrátí počet indexovaných stánek 

#KLÍČOVÁ SLOVA
- PutKeyword - vložení nových slov k projektu
- SetKeyword - editace/smazani slov
- GetKeywordList - výpis slov pro daný projekt

#SYSTEM
- CreditCheck - vrátí počet kreditů, které jsou k dispozici


#PŘIPRAVUJE SE
- GetKeywordHistory - informace o 1 klíčovém slovu (historie pozic)
- GetKeywordSERP - výpis výsledku hledání při posledním měření
- GetKeywordChangePage - změny vstupní stránky v čase

- 
