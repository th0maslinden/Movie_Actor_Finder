# Développement d’une application

## DEHAY Roman deha0030

## LINDEN Thomas lind0013

## Configuration de la base de données

le fichier .mypdo.ini permet de faire la configuration de MyPdo
automatiquement avec le dsn user et mot de passe.
/!\ /!\ /!\ /!\ /!\ et il est OBLIGATOIRE pour faire fonctionner la BD /!\ /!\ /!\ /!\ /!\

## script
### chargement des classes

* recharger les classes de l'autoloader Composer "composer dump-autoload"

### start
* (linux) entrer la commande "composer  start:linux"

* (windows) entrer la commande "composer  start:windows"

### code
* vérifier le code : composer test:cs

* modifier le code : composer fix:cs
