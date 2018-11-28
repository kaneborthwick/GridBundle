<?php

use GridBundle\Renderer\Factory\TwigGridRendererFactory;
use GridBundle\Renderer\TwigGridRenderer;
use GridBundle\Twig\GridExtension;
use ResourceBundle\Factory\ContainerFactory;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

return [
	ConfigAbstractFactory::class => [],
	'dependencies' => [
		'factories' => [
			TwigGridRenderer::class => TwigGridRendererFactory::class,
			GridExtension::class => ContainerFactory::class,
		],
		'invokables' => [],
		'aliases' => [
			'tower.twig.extension.grid' => GridExtension::class,
			'tower.grid.renderer.twig' => TwigGridRenderer::class,
		],
	],
];
