<?php

use GridBundle\Middleware\Factory\GridMiddlewareFactory;
use GridBundle\Middleware\GridMiddleware;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [],
	'dependencies' => [
		'factories' => [
			GridMiddleware::class => GridMiddlewareFactory::class,
		],
		'invokables' => [],
		'aliases' => [],
	],
];
