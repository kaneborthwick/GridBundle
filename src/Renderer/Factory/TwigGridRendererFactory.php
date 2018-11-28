<?php

namespace GridBundle\Renderer\Factory;

use GridBundle\Renderer\TwigGridRenderer;
use Interop\Container\ContainerInterface;

class TwigGridRendererFactory {

	protected $options = [
		'grid_fields' => [],
		'grid_filters' => [],
		'templates' => [],
		'grids' => [],
	];

	/**
	 * {@inheritdoc}
	 */
	function __invoke(ContainerInterface $container, $requestedName) {

		$options = $this->resolveOptions($container->get("config"));

		$defaultTemplate = "@ui/grid/_default.html.twig";

		return new TwigGridRenderer(
			$container->get(\Twig_Environment::class),
			$defaultTemplate,
			$container->get('tower.registry.grid_field'),
			$container->get('tower.registry.form_type'),
			$options['templates']['filter'] ?? []
		);

	}

	/**
	 * [resolveOptions description]
	 *
	 * @param  array  $config [description]
	 * @return [type]         [description]
	 */
	private function resolveOptions(array $config): array{
		return array_merge($this->options, $config['tower_grids']);
	}

}
