<?php

namespace GridBundle\Provider\Factory;

use Interop\Container\ContainerInterface;
use Towersystems\Grid\Provider\GridProvider;

class GridProviderFactory {

	/**
	 * {@inheritdoc}
	 */
	function __invoke(ContainerInterface $container, $requestedName) {

		$config = $container->get('config');
		$gridConfig = $config['tower_grids'] ?? [];
		$grids = $gridConfig['grids'] ?? [];

		$converter = $container->get('tower.grid.definition_converter');

		return new GridProvider($converter, $grids);
	}

}
