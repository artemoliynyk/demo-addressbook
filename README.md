Address Book Demo App
=====================

Demo app based on Symfony 3.4

# App details
This demo app are build on Symfony 3.4 with following libraries:
* **Webpack Encore bundle** – JS, CSS, SCSS compilation with manifest and versioning
* **Doctrine Fixtures bundle** – fixture loader, demo data generator
* **KNP Paginator bundle** – pagination, sorting and filtering (not user in this app) library
* **Vich Uploader bundle** – files uploader for entities (user as an image uploader)

Also used **Generator bundle** for faster Entity and CRUD generation at the first project steps.

# Install
**Please note:** you need a MySQL database, user and password created before installation.

To install application follow these steps:

* Clone repository
* Run `yarn install` to install all resources required for front-end 
* Run `composer install` to install Symfony and libs components
* Provide DB details that will be asked during installation
* Everything else except of DB details are optional

You should not receive any error messages.

# Application deploy
After installation complete you will need to create database structure, compile assets and add demo data (optional)

* Create DB structure with this command: `php ./bin/console doctrine:schema:update --force` 
* Compile webpack-encore CSS and JS assets with yarn: `yarn encore prod`
* On Apache server – create .htaccess or copy (linux command): `cp web/.htaccess.prod web/.htaccess`

Application has a demo data generator (implemented with Doctrine Fixtures), to upload demo data run following command:
```
php ./bin/console doctrine:fixtures:load -e dev
```