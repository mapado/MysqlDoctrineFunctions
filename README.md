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

### Get the package

With [composer](https://getcomposer.org/)

```sh
composer require mapado/mysql-doctrine-functions
```

### Add the classes to your configuration

```php
$config = new \Doctrine\ORM\Configuration();
$config->addCustomStringFunction('rand', \Mapado\MysqlDoctrineFunctions\DQL\MysqlRand::class);
$config->addCustomStringFunction('round', \Mapado\MysqlDoctrineFunctions\DQL\MysqlRound::class);
$config->addCustomStringFunction('date', \Mapado\MysqlDoctrineFunctions\DQL\MysqlDate::class);
$config->addCustomStringFunction('date_format', \Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat::class);

$em = EntityManager::create($dbParams, $config);
```
You can of course pick just the functions you need.

### Use with Symfony
If you install the library in a Symfony application, you can add this in your `config.yml` file (`doctrine.yaml` file if you use symfony flex)

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
                        rand:        'Mapado\MysqlDoctrineFunctions\DQL\MysqlRand'
                        round:       'Mapado\MysqlDoctrineFunctions\DQL\MysqlRound'
                    datetime_functions:
                        date:        'Mapado\MysqlDoctrineFunctions\DQL\MysqlDate'
                        date_format: 'Mapado\MysqlDoctrineFunctions\DQL\MysqlDateFormat'
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
