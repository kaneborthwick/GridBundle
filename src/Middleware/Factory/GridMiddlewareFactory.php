<?php

namespace GridBundle\Middleware\Factory;

use GridBundle\Middleware\GridMiddleware;
use Interop\Container\ContainerInterface;

class GridMiddlewareFactory {

	/**
	 * {@inheritdoc}
	 */
	function __invoke(ContainerInterface $container, $requestedName) {

		$config = $container->get('config');
		$gridConfig = $config['tower_grids'] ?? ['enable' => false];

		return new GridMiddleware(
			$container,
			$gridConfig,
			$container->get("tower.registry.form_type")
		);
	}

}
