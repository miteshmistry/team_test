# PHP script to import CSV data into MySQL database

# Prerequisites
```
PHP 7.4.x (or higher)
MySQL 8.0 
Apache
```
For Ubuntu 20.04:

```
sudo apt-get update
sudo apt install php7.4-cli
sudo apt-get install mysql-server
```

# Installation
Clone or download zip to your machine.


# Database configuration
* Create a database with name: classes and import classes.sql file in mysql
```php
$db_host = 'localhost'; // localhost
$db_user = 'root'; // mysql username
$db_password = ''; // mysql password
$db_name = 'classes'; // mysql database name
```

# Run the project
```php
http://localhost/team_test
```