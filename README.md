MySQL Doctrine functions
====================

This library provides you MySQL functions for Doctrine2.

At the moment are supported

 - RAND
 - ROUND
 - DATE
 - DATE_FORMAT

Feel free to fork and add other functions.

## Installation

### Get the bundle

Add this in your composer.json

```json
{
	"require": {
		"mapado/mysql-doctrine-functions": "1.*"
	}
}
```

and then run

```sh
php composer.phar update
```
or 
```sh
composer update
```
if you installed composer globally.

### Add the classes to your configuration

```php
$config = new \Doctrine\ORM\Configuration();
$config->addCustomStringFunction('rand', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlRand');
$config->addCustomStringFunction('round', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlRound');
$config->addCustomStringFunction('date', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDate');
$config->addCustomStringFunction('date_format', 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat');

$em = EntityManager::create($dbParams, $config);
```
You can of course pick just the functions you need.

### Use with Symfony2
If you install the library in a Symfony2 application, you can add this in your config.yml

```yaml
# app/config/config.yml
doctrine:
    orm:
        # ...
        entity_managers:
            default:
                # ...
                dql:
                    numeric_functions:
                        rand:        Mapado\MysqlDoctrineFunctions\DQL\MysqlRand
                        round:       Mapado\MysqlDoctrineFunctions\DQL\MysqlRound
                    datetime_functions:
                        date:        Mapado\MysqlDoctrineFunctions\DQL\MysqlDate
                        date_format: Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat
                    # ... add all functions you need
```

### Usage
You can now use the functions in your DQL Query

```php
$query = 'SELECT RAND(), ROUND(123.45) 
        FROM ...
    ';
$em->createQuery($query);

```
