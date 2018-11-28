<?php

use GridBundle\Doctrine\ORM\Driver;
use GridBundle\Doctrine\ORM\ORMDataSourceProvider;
use GridBundle\Form\Registry\FormTypeRegistry;
use GridBundle\Provider\Factory\GridProviderFactory;
use ResourceBundle\Registry\Factory\AbstractRegistryFactory;
use Towersystems\Grid\DataExtractor\PropertyAccessDataExtractor;
use Towersystems\Grid\Data\DataProvider;
use Towersystems\Grid\Definition\DefinitionConverter;
use Towersystems\Grid\FieldTypes\FieldTypeInterface;
use Towersystems\Grid\Filtering\FilterInterface;
use Towersystems\Grid\Provider\GridProvider;
use Towersystems\Grid\Sorting\Sorter;
use Towersystems\Grid\View\GridViewFactory;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [

	AbstractRegistryFactory::class => [
		'tower.registry.grid_field' => [
			'interface' => FieldTypeInterface::class,
			'dependencies' => [],
		],
		'tower.registry.grid_filter' => [
			'interface' => FilterInterface::class,
			'dependencies' => [],
		],
	],

	ConfigAbstractFactory::class => [

		DataProvider::class => [
			'tower.grid.data_source_provider',
			'tower.grid.sorter',
		],

		ORMDataSourceProvider::class => [
			'tower.grid.driver.doctrine_orm',
		],

		GridViewFactory::class => [
			'tower.grid.data_provider',
		],

		Driver::class => [
			'doctrine.entity_manager.orm_default',
		],

	],
	'dependencies' => [
		'factories' => [
			GridProvider::class => GridProviderFactory::class,
		],
		'invokables' => [
			DefinitionConverter::class,
			PropertyAccessDataExtractor::class,
			Sorter::class,
			FormTypeRegistry::class,
		],
		'aliases' => [
			'tower.grid.data_source_provider' => ORMDataSourceProvider::class,
			'tower.grid.grid_provider' => GridProvider::class,
			'tower.grid.data_provider' => DataProvider::class,
			'tower.grid.definition_converter' => DefinitionConverter::class,
			'tower.grid.grid_view_factory' => GridViewFactory::class,
			'tower.grid.driver.doctrine_orm' => Driver::class,
			'tower.grid.sorter' => Sorter::class,
			'tower.registry.form_type' => FormTypeRegistry::class,
		],
	],
];
