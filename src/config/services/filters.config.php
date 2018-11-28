<?php

use Towersystems\Grid\Filter\DateFilter;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [],
	'dependencies' => [
		'factories' => [],
		'invokables' => [
			DateFilter::class,
		],
		'aliases' => [
			'tower.grid_filter.date',
		],
	],
];
