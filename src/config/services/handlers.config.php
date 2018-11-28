<?php

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		GridBundle\Handler\TestHandler::class => [
			\Zend\Expressive\Template\TemplateRendererInterface::class,
			'tower.grid.grid_provider',
			'tower.grid.grid_view_factory',
		],

	],
	'dependencies' => [
		'factories' => [],
		'aliases' => [],
	],
];