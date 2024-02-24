# Étapes

1. Création de ce dossier
2. Création du fichier `README.md`
3. Création des dossiers `src`, `public` et `database`
4. Création du fichier `public/index.php`
5. Création du fichier `database/db.sqlite`
6. Ajout de ArrestDB : `composer require bobanum/arrestDB`
7. Ajout de `include "../vendor/autoload.php";` dans `public/index.php`
8. Ajout de `go.bat`
9. ```
    "autoload": {
        "psr-4": {
            "": "app/"
        }
    },
	```
	`composer dump-autoload`

