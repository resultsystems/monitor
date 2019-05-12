# Monitor log queries and laravel.log
==========

## Package abandoned in view of the package: [https://github.com/laravel/telescope](https://github.com/laravel/telescope) be much better and with many options.

### For Laravel 5.5-5.7

```shell
composer require resultsystems/monitor

or

In the **require** key of **composer.json** file add the following:

```php
"resultsystems/monitor": "~0.3"
```

In your **config/app.php** add *'ResultSystems\Monitor\MonitorServiceProvider::class'* to the end of the **'providers'** array:

```php
'providers' => array(
    ...
    ...
    ResultSystems\Monitor\MonitorServiceProvider::class,
),
```

### Usage:


This tailing storage/logs/laravel.log

```shell
php artisan monitor:laravel
```

This will create a queries.log file inside of storage/logs directory and tailing the file.

```shell
php artisan monitor:queries
```

This will delete queries.log.

```shell
php artisan monitor:queries --stop
```
