# Projet BigScreen 

# DEMO

[page sondage](https://projet-bigscreen.website)

[Page administration](https://projet-bigscreen.website/administration/login)

**Acces page admin**  👇

 **email:** admin@bigscreen.com

**Mot de passe:** password 




# installation du serveur Local

Créer votre base de donnée avec le nom db-bigscreen

Créer un fichier **.env** en reprenenant le fichier **.env.example** et suprrimer le **.example**. 
ouvrez le fichier .env puis renseigner vos infos de connexion 
comme ceci

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db-bigscreen
DB_USERNAME=root
DB_PASSWORD='VOTRE MOT DE PASS'

```


installation des packages

```
composer install

```

Alimentation de la base de données test

```
php artisan migrate:fresh --seed

```

page d'accueil serveur [http://localhost:8000](http://localhost:8000)
