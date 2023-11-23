# The Movies

## À la première utilisation
Exécuter les commandes suivantes :
- ```composer install``` : installe les dépendances PHP
- ```cp .env.example .env``` : initialiser le .env
- Compléter la variable ```TMDB_API_KEY``` du .env
- Changer la variable ```QUEUE_CONNECTION``` du .env à ```redis```
- ```php artisan sail:install``` et saisir ```meilisearch, redis, pgsql``` quand vous êtes invité à choisir les services à installer ; cela va ajouter au .env les variables relatives à l'utilisation de ces services avec Laravel Sail
- Voir [ici](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias) pour la configuration de l'alias ```sail```
- ```sail up``` : lance le serveur et le rend accessible (Docker doit être actif sur l'environnement local)
- ```sail artisan key:generate``` : générer **APP_KEY** dans le fichier **.env**
- ```sail artisan migrate --seed``` : exécute les migrations de base de données ; **--seed** rajoute les données de seed
- ```sail yarn install``` : installe les dépendances Javascript
- ```sail yarn dev``` : compile le code source Javascript
- ```sail artisan queue:work``` : permet aux tâches asynchrones de s'exécuter
- ```sail artisan movies:import``` : importe les films depuis l'API TMDB

L'application est maintenant accessible sur [localhost](http://localhost). 


Les identifiants suivants peuvent être utilisés :
- email : thomas.anderson@themovies.com
- mot de passe : M4trix!!
