# API SEMOR

API pro externí přístup ke službám systému SEMOR.cz pro partnerské služby

TOKEN pro komunikaci najdete po přihlášení v administrace->nastavení

1) stáhnout semor_api.php
2) nastavit si tokem SEMOR::$token = "váš token";


#PROJEKTY
- PutProject - založení nového projektu
- SetProject - editace/smazani projektu
- GetProjectList - výpis všech projektů
- GetProjectIndex - vrátí počet indexovaných stánek za posledních 60 dní

#KLÍČOVÁ SLOVA
- PutKeyword - vložení nových slov k projektu
- SetKeyword - editace/smazani slov
- GetKeywordList - výpis slov pro daný projekt

#SYSTEM
- CreditCheck - vrátí počet kreditů, které jsou k dispozici
