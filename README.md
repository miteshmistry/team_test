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

# Command line options (directives):
```
php user_upload.php
    --file [csv file name] - this is the name of the CSV to be parsed
    --create_table - this will cause the MySQL users table to be built (and no further action will be taken)
    --dry_run - this will be used with the --file directive in case we want to run the script but not insert into the DB. 
      All other functions will be executed, but the database won't be altered
    -u - MySQL username
    -p - MySQL password
    -h - MySQL host
    --help - which will output the above list of directives with details
```

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