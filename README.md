MySQL Doctrine functions
====================

This library provides you MySQL `RAND()` and `ROUND()` functions for Doctrine2.
Feel free to fork and add other functions.

## Installation

### Get the bundle

Add this in your composer.json

```json
{
	"require": {
		"mapado/mysql-doctrine-functions": "dev-master"
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

$em = EntityManager::create($dbParams, $config);
```

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
                string_functions:
                    rand: Mapado\MysqlDoctrineFunctions\DQL\MysqlRand
                    round: Mapado\MysqlDoctrineFunctions\DQL\MysqlRound
```

### Usage
You can now use the functions in your DQL Query

```php
$query = 'SELECT RAND(), ROUND(123.45) 
        FROM ...
    ';
$em->createQuery($query);

```
