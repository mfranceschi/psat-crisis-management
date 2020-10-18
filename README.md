# psat-crisis-management

## Déploiement de la web app

### Avec Apache

Placer tous les fichiers de php-website dans /var/www/html/.

### Avec PHP -S

Dans le dossier php-website/, faire :

 
```bash
php -S IP:PORT
```

Example :

```bash
php -S 127.0.0.1:8000
```

### MySQL

L'appli web PHP essayera de se connecter à une BDD MySQL déployéé en local. 

| Champ        | Valeur         | 
| ------------- |:-------------:|
| DB_USERNAME    | root |
| DB_PASSWORD      | ''      |
| DB_NAME | users      |


## Scripts

### upload.sh

Upload un backdoor *weevely* dont le mot de passe est "secret"
L'URL doit être indiqué dans la variable TARGET au début du fichier.

### defacing.sh

Script pour automatiser le *deface* du website. Il remplace tous les fichiers .php avec .php.hacked et crée un nouveau index.php defaced
Doit être placé dans le fichier /php-website/