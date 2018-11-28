<?php

use Towersystems\Grid\DataExtractor\PropertyAccessDataExtractor;
use Towersystems\Grid\FieldTypes\DatetimeFieldType;
use Towersystems\Grid\FieldTypes\StringFieldType;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [
		StringFieldType::class => [
			PropertyAccessDataExtractor::class,
		],

		DatetimeFieldType::class => [
			PropertyAccessDataExtractor::class,
		],
	],
	'dependencies' => [
		'factories' => [],
		'invokables' => [],
		'aliases' => [],
	],
];
