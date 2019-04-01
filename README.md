# Information
Todo App in Laravel

# Replicate
- Debian 9 (on Cloud)
- Apache Webserver
- PHP 7.3
- MariaDB

# External Tools
- Composer
- Laravels latest version

# Installation steps
- Run composer `create-project --prefer-dist laravel/laravel todo`
- Edit .env file and enter the database credentials
- Give full permission to storage folder `chmod -R 777 www-data:www-data ./storage`
- And don't forget to point the requests into Laravels public folder in the apaches configuration file
