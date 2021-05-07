# Webové jádro pomocí frameworku CodeIgniter4  
  
## Co je CodeIgniter?  
  
CodeIgniter4 (4.1.1-může se v průběhu vývoje změnit), je robustní php framework, podobně jako například: Nette, Symphony, Laravel atd.  
  
## Co je součástí tohoto repozitáře  
  
V tomto repozitáři (snad) v budoucnu naleznete dynamické jádro webové aplikace, ze kterého pomocí snadno doprogramovatelných(MVC) modulů můžete vytvořit redakční aplikaci v podstatě pro cokoliv od školní docházky až po správu fotbalových turnajů (včetně plánování zápasů, vytíženost hřišť, statistiky hráčů atd).  
  
## stručný výčet základních funkcionalit (bez modulů):  

  - [x] google/ruční přihlášení  
  - [x] dynamické ACL (Access Control List), redaktor může dynamicky vytvářet a mazat role, a na základě nich určovat práva pro jednotlivé části aplikace  
  - [x] import/export dat CSV  
  - [ ] dynamické grafy statistiky  
  - [ ] komunikace mezi uživateli aplikace pomocí zpráv(synchronizováno s maily)  
  - [ ] oznámení o následujících událostch (závislé na modulu)  
  - [x] řízení celé databáze skrze webové rozhraní (práva uživatelů k jednotlivým dashbardům, struktura modulů atd..)  

##### Dokumentace:
  * [ ] kompletní dokumentace(v kódu, samostatný web/soubor jako návod) jak pro jádro tak pro tvorbu a instalaci modulů, část UML  
  * [ ] realizace libovolného projektu postaveného na tomto jádře (další moduly nejsou součástí práce, ale **mohou být přidány kýmkoliv**)  
---------------------------------------------------------  
##### Pokud zbyde čas:  
- [ ] instalace pomocí composru/php/batch scriptu  
- [ ] UI php script pro setup build in funkcionalit, aby redaktor napsal co nejméně(nejlépe žádný) kód   
 
