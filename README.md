## Photos
Toutes les photos du site proviennent du site [pexels.com](https://www.pexels.com/) et sont libre 
d'utilisation.

## Démarrer l'application
***

Pour démarrer le serveur web (à la racine du projet) :
```sh
$ symfony serve
```
ou

```sh
$ php -S localhost:3000 -t public 
```

## Installation

Créer le fichier .env.local avec la connexion à la base de données (ex) :

```dotenv
DATABASE_URL=mysql://root:root@127.0.0.1:8889/motooplanner?serverVersion=5.7
```

- Installer les packages :

```shell script
$ composer install
```

- Créer la base de données et ajouter les fixtures :

```shell script
$ php bin/console doctrine:database:drop --force
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load
```

- Démarrer l'application :

```sh
$ symfony serve
```

