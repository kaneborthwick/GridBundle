<?php

use GridBundle\Templating\Helper\GridHelper;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		GridHelper::class => [
			'tower.grid.renderer.twig',
		],
	],
	'dependencies' => [
		'factories' => [],
		'invokables' => [],
		'aliases' => [
			'tower.templating.helper.grid' => GridHelper::class,
		],
	],
];
