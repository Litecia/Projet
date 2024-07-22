Deploiement de l'application en locale
INTRODUCTION : AFIN D'ELABORER MON   APPLICATION LOCALE ,J'ai opté pour les etapes suivantes:
installer et configure le serveur uwamp qui est une plateforme de developpement web et j’ai opté pour  les étapes suivantes :
1.Preparation du design avec figma :
-créer des maquettes 
-exporter les assets (images,icones…)
2.Développement local avec Uwamp :
2.1. Installation et configuration du serveur locale Uwamp :qui est une plate forme de développement web.
2. 2  Installation de serveur :
-télécharger Uwamp en allant sur le site officiel Uwamp ;
-lancer le téléchargement ,une page s’affiche indique les versions de Php recommandé ;
-télécharger et Installer la dernière version de Php .8.0 .0 sur le site officiel Php.net ;
-Installer Uwamp ,en exécutant le fichier.exe ou bien décompressé fichier  avec 7Zip ;
-autoriser le parfeu et Mysql ;
-une fois l’installation terminée, lancer Uwamp en double cliquant sur Uwamp.exe ou sur l’icone Uwamp dans le répertoire décompressé ,l’interface  Uwamp s’ouvrira ,en voyant les options pour démarrer /arrêter Apache et Mysql ;
-tester le serveur en ouvrant un navigateur Web et saisir http://localhost/ dans la barre d’adresse ou bien saisir l’adresse 127.0.0.1 en voyant la page d’accueil par défaut d’Uwamp.
3 .Configuration du site et des bases de données :
-placer les fichiers Web (html,php) dans le dossier WWW d’Uwamp pour qu’il soit accessible via http://localhost/PhpMyadmin/.
4.Développement de l’application 
 4.1 création des fichiers HTML et CSS : utilisation du html ,qui est un langage utilisé pour structurer  des pages web et son contenu.
-création de fichier principal index .html ;
-création de fichier style .css ;
-création de fichier service .css ;
-création de fichier contact .css ;
 création de fichier habitat .css ;
-création de fichier connexion .css ;
4.2.Développer avec PHP : créer les fichiers php 
-création de fichier service .php ;
-création de fichier habitat .php ;
-création de fichier connexion .php ;
-création de fichier contact .php ;
-connecter a la base de données Mysql en utilisant PDO ;
5 .Test local
-faire un test local  dans un navigateur pour vérifier  l’apparence et son fonctionnement  en accédant a http://localhost.
6.Préparation pour le déploiement sur Alwaysdata :
-création d’ un compte alwaysdata nommé arcadia 
-création d’une base de donneé Mysql dans mon compte alwaysdata
7.Déploiement sur Alwaysdata : 
    -utiliser le ftp FileZilla pour téléverser les fichiers html, css et php sur le serveur.
8.Test final :
Tester en ligne le bon fonctionnement de l’application avec son lien sur alwaysdata et déboguez les erreurs servenues.

