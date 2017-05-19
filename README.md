# Silex Maintenance

Ce service provider permet d'afficher une page de maintenance.

## Installation

```php
require assura/silex-maintenance
```

## Example

Twig Example :

```php
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Assura\Silex\Maintenance\MaintenanceServiceProvider(), array(
    'maintenance.enabled' => function() {
    	return file_exists(__DIR__.'/../maintenance.file');
    },
    'maintenance.content' => $app['twig']->render('maintenance.html.twig'),
));
```
