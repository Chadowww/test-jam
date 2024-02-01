# Nom du Projet
Test technique pour le poste de développeur PHP

# Stack technique
- PHP 7.0
- Somesh PhpQuery Version: 0.9.5
- Jquery 3.5.1
## Initialisation du projet

1. Personnalisez le fichier `config.php` avec vos informations personnelles. (config/config.php)
 ```
define('APP_DB_USER', 'user');
define('APP_DB_PASSWORD', 'password');
define('APP_DB_HOST', 'localhost');
define('APP_DB_NAME', 'base_de_donnees');
 ```

2. Lancez la commande suivante pour effectuer les migrations de la base de données :

```
php migration.php
```
3. Lancez la commande suivante pour re-charger les fixtures dans la base de données si nécessaire :
```
php db/fixtures.php
```
4. Lancez la commande suivante pour lancer le serveur (vous pouvez changer le port selon vos besoin) :
```
php -S localhost:8000 
```

5. Maintenant  vous pouvez vous connecter sur l'url suivante :
``````
http://localhost:8000
``````
