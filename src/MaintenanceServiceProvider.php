<?php

namespace Assura\Silex\Maintenance;

use Symfony\Component\HttpFoundation\Response;
use Pimple\ServiceProviderInterface;
use Pimple\Container;

class MaintenanceServiceProvider implements ServiceProviderInterface
{
	public function register(Container $app)
	{
		if (!isset($app['maintenance.content'])) {
			$app['maintenance.content'] = 'Sorry for the inconvenience but we&rsquo;re performing some maintenance at the moment.';
		}

		$app->before(function () use($app){
			if (!isset($app['maintenance.enabled'])) {
				return;
			}

			$maintenanceEnabled = $app['maintenance.enabled'];

			if (!is_bool($maintenanceEnabled)) {
				throw new Exception("Identifier 'maintenance.enabled' must return boolean.");
			}

			if ($maintenanceEnabled) {
				return new Response($app['maintenance.content']);
			}
		});
	}
} 