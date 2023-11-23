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

## Tester la synchronisation manuelle
La synchronisation n'est possible qu'une fois par jour, il y a donc une commande pour simuler un film qui n'est plus synchronisé :
- Se rendre sur la page d'un film
- Noter son ID depuis l'URL
- Exécuter la commande suivante : ```sail artisan movies:unsynchronize id``` en remplaçant "id" par l'ID du film souhaité
- Rafraichir la page du film : le bouton "synchronize" est maintenant disponible, si les informations du film ne sont plus à jour alors elles seront synchronisées avec celles venants de l'API

## Notes
Les demandes principales sont faites, les bonus aussi.

En plus des packages recommandés dans le PDF du test, j'ai aussi utilisé :
- Laravel Horizon pour monitorer plus simplement le job d'import et voir les erreurs sans aller dans les logs
- Laravel Pint pour garder des standards d'écriture
- Laravel Scout avec Meilisearch pour avoir une recherche plus permissive et sur plusieurs champs
- Fontawesome pour afficher quelques icônes sur les boutons, et le spinner

Le job d'import est programmé pour s'exécuter quotidiennement (je n'ai pas pu tester le scheduler en environnement local).  
Modifier un film désactive sa synchronisation automatique.  
Chaque film peut être synchronisé manuellement via un bouton, mais seulement une fois par jour.

Je n'ai pas de recherche particulière à noter, j'ai surtout navigué dans la documentation de Laravel, notamment Sail, Jetstream et Livewire que je n'avais jamais utilisé.

Je n'ai pas eu besoin de désactiver la vérification CORS de Chrome (sur Mac).

L'application est testée, les tests que j'ai fait peuvent être lancés avec ```sail artisan test tests/Unit``` (je n'ai rien rajouté aux dossiers "Feature", ce sont les tests de base de Laravel).
Les appels HTTP durant les tests sont fake, aucun réel appel avec la clé d'API n'est donc fait.

Les améliorations que j'aurai trouvé intéressantes à effectuer avec plus de temps : une validation de formulaire plus strict, plus de champs de formulaires, des tests des actions Livewire, vérifier le droit de supprimer/modifier un film, une meilleure séparation en plusieurs sous-composants dans la vue "details" d'un film, utiliser plus de relations pour un film (productions, acteurs, recommandations...).

