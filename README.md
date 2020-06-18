# Timemate - Üliõpilase ajakasutus / Timemate - Student time management
[Timemate.ee](http://timemate.ee/)
## Rakenduse kirjeldus / Application description

Meie juurde tuli klient probleemiga, et pole teada kui palju õpilased reaalselt aega kulutavad õppetegevusele digitehnoloogia instituudis ja kui ühtlaselt see jaguneb semestri vältel. EAP on teoorias 26 tundi õppetööd aga siiani on seda arvestatud umbes tunde järgi. Seepärast ongi loodava rakenduse eesmärk jälgida õpilaste tegelikku ajakasutust ja anda õpilastele võimalus võrrelda teiste õpilaste keskmisega. Projekt on tehtud Tallinna Ülikooli digitehnoloogiate instituudis, tarkvaraarenduse projekti raames.
 ##  
Client came to us with a problem. The problem was that teachers do not have actual overview how much do students invest time on learning and how well is time divided between different tasks. In theory EAP points should be worth 26 hours of academic work but in lots of cases it is not accurate because teachers assign many assignments as homework and assumption how long does it take for a student to learn is based on rough estimates. Therefore our application is designed to track real time consumption, make statistics based on students inputs and provide overview both for student and teacher. Project was created in Tallinn University's School of Digital Technologies as a Software Development Project.


## Ekraanitõmmised / Screenshots
![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Login.PNG)

![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Aine.PNG)

![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Kalender.PNG)

![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Statistika.PNG)

![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Ajalugu.PNG)

![Rakenduse ekraanitõmmised](https://raw.githubusercontent.com/andrkuu/timemate/master/pildid/Teacher.PNG)

## Kasutatud tehnoloogiad / Used technologies

MySQL 5

PHP 7.44

HTML 5

CSS 3

jQuery 3.5

JavaScript 1.7


## Tiimi liikmed / Team Members

Martten Mitri

Andreas Kuuskaru

Priit Sauer

Hans Robert

## Käivitamise juhend / Manual


### Juhend:

* Laed enda arvutisse xamppi, config.php ja timemate.sql.
* Tõstad config faili xampp kausta.
* Kloonid githubist https://github.com/andrkuu/timemate xamppis asuvasse htdocs kausta.
* Avad xamppi ja stardid Apache ja MySQL moodulid.
* Lähed lingile http://localhost/phpmyadmin/ ja impordid sinna timemate.sql
* phpmyadminis lisada õiguste alla uus kasutaja kasutajanimega:timemate ja salasõnaga:timemateteam
* Lae alla simplesamlphp ning paiguta see apache avalikust kaustast väljapoole
* Seadista domeenile alias /simplesaml mis viitab eelnevalt tehtud simplesamlphp kaustale
* Genereeri kausta simplesaml/cert sertifikaadid
* Lisa genereeritud sertifikaatide nimed faili simplesamlphp/config/authsources.php
* Samas failis asub ka idp ehk identity provider kuhu tuleb panna “https://passwd.tlu.ee/sisedevauth/saml2/idp/metadata.php”
* Ava fail config.php mis asub samuti config kaustas
* Muuda ära baseurlpath vastavalt simplesaml kasuta asukohale
* Samuti muuda ära auth.adminpassword millega saab hiljem simplesaml-i ligi
* Genereeri salajane sool ning aseta see secretsalt parameertisse
* Kui simplesaml on edukalt paigaldatud siis avaneb http://localhost/simplesaml
* Logi sisse eelnevalt tehtud admin kasutajaga ning võta federeerimise alt metaandmed ning saada need edasi identiteedi pakkujale
* Avad lingi http://localhost/timemate/

### Tähelepanekud:
Kui githubist timemate alla laadida mitte kloonida, siis kindlasti muuta kausta nimeks “timemate”.

### Vajalike failide allalaadimise lingid:
 [config ja SQL fail](https://github.com/andrkuu/timemate/tree/master/setup)
 
 [XAMPP](https://www.apachefriends.org/index.html)
 
 ##  

### Tutorial:

* Download xampp, config.php and timemate.sql.
* Put config file into xampp folder.
* Clone https://github.com/andrkuu/timemate from github into htdocs file that you can find in xampp.
* Run xampp and start Apache and MySQL modules.
* Open link http://localhost/phpmyadmin/ and import timemate.sql.
* In phpmyadmin open privileges and make new user with username timemate and password timemateteam
* Download simplesamlphp and locate it outside of apache public folder.
* Set up alias /simplesaml in your domain that points to previously made simplesamlphp folder.
* Generate simplesaml/cert certificates into folder.
* Add generated certificate names into file simplesamlphp/config/authsources.php
* In the same file there is idp (identity provider) and put there “https://passwd.tlu.ee/sisedevauth/saml2/idp/metadata.php”
* Open config.php that locates in config folder.
* Change baseurlpath to your simplesaml folder location
* Also change auth.adminpassword with what u can later access admin user in simplesaml.
* Generate secret salt and put it into secretsalt parametre.
* If simplesaml is installed successfully then you can open http://localhost/simplesaml
* Log in with previously made admin user and take metadata under federation tab and send it to your identity provider.
* Open http://localhost/timemate/

### What to watch out for:

If you choose to download timemate instead of cloning, change the folder name to“timemate”

### Download links:
 [config and SQL file](https://github.com/andrkuu/timemate/tree/master/setup)
 
 [XAMPP](https://www.apachefriends.org/index.html)


## Litsents / License

Käesolev projekt on kaitstud MIT litsentsiga.

 ##  

The following project is protected with MIT license.
