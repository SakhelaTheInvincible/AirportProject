This is Airport Laravel App

To run project start by running Backend services first.

Clone repository,

Run VsCode or other terminal,

cd my-airport-app  
composer install  
npm install  
cp .env.example .env  

now for .env file update these settings:

DB_CONNECTION=pgsql  
DB_HOST=127.0.0.1  
DB_PORT=5432  
DB_DATABASE=my_airport_app  
DB_USERNAME=postgres  
DB_PASSWORD=password  
  
MAIL_MAILER=smtp  
MAIL_HOST=smtp.gmail.com  
MAIL_PORT=587  
MAIL_USERNAME=giorgisaxelashvili580@gmail.com  
MAIL_PASSWORD=vzckqrxqnsjcosda  
MAIL_ENCRYPTION=tls  
MAIL_FROM_ADDRESS=giorgisaxelashvili580@gmail.com  
MAIL_FROM_NAME="${APP_NAME}"  

  
(This app uses Postgres, so if possible add password to your postgres database,
in PgAdmin4 do this: in Login/Group Roles select postgres properties, in Definition tab set password, use that password in DB_Password)

after that run these commands:  
php artisan key:generate  
npm run build   

To build and run the code:
php artisan serve    

After changing code:  
php artisan config:clear    
php artisan cache:clear  
php artisan optimize:clear  
  
php artisan serve    