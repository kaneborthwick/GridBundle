<?php

namespace GridBundle\Twig;
use GridBundle\Templating\Helper\GridHelper;
use Interop\Container\ContainerInterface;

class GridExtension extends \Twig_Extension {

	/** @var [type] [description] */
	private $gridHelper;

	/** @var [type] [description] */
	private $container;

	/**
	 * [__construct description]
	 *
	 * @param ContainerInterface $container [description]
	 */
	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFunctions() {
		return [
			new \Twig_SimpleFunction('tower_grid_render', [$this->getGridHelper(), 'renderGrid'], ['is_safe' => ['html']]),
			new \Twig_SimpleFunction('tower_grid_render_field', [$this->getGridHelper(), 'renderField'], ['is_safe' => ['html']]),
			new \Twig_SimpleFunction('tower_grid_render_filter', [$this->getGridHelper(), 'renderFilter'], ['is_safe' => ['html']]),
		];
	}

	/**
	 * No support for lazy loading twig extensions
	 *
	 * @return [type] [description]
	 */
	private function getGridHelper() {
		if (!$this->gridHelper) {
			$this->gridHelper = $this->container->get(GridHelper::class);
		}
		return $this->gridHelper;
	}

}