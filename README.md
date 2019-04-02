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
- Edit .env file and enter the database credentials
- Give full permission to storage folder `chmod -R 777 www-data:www-data ./storage`
- And don't forget to point the Document Root Folder into Laravel public folder in the apache configuration file
- Migrate database by executing `php artisan migrate:fresh`
