# ft4a-2021
[au 20/02/21] : travaux en cours.
`Le site n'est pas fonctionnel en l'état.`

### Pour déployer le site :

- cd ft4a-2021
- cp .env .env.local
- commenter la ligne PostgreSQL et décommenter la ligne MySQL. Renseigner le login:password et la base de données
- renseigner le MAILER_DSN (envoi de mail) : MAILER_DSN=smtp://MON_ADRESSE@MON_SITE.COM:MON_MOT_DE_PASSE@SMTP_SERVER:SMTP_PORT
- créer la base de donées symfony console doctrine:database:create
- composer install
- php bin/console ckeditor:install
- php bin/console assets:install public
- yarn && yarn build
- symfony console make:migration
- symfony console doctrine:migrations:migrate
