<?php

namespace GridBundle\Middleware;

use Exception;
use GridBundle\Form\Registry\FormTypeRegistryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Towersystems\Resource\Registry\ServiceRegistryInterface;
use Zend\Stdlib\ArrayObject;

/**
 *
 */
class GridMiddleware implements MiddlewareInterface {

	const DEFAULT_REGISTRY_KEY = 'tower.registry.grid_field';
	const DEFAULT_FILTER_KEY = "tower.registry.grid_filter";

	/** @var [type] [description] */
	private $container;

	/** @var [type] [description] */
	private $config;

	/** @var [type] [description] */
	private $formTypeRegistry;

	/**
	 * [__construct description]
	 * @param ContainerInterface $container [description]
	 */
	public function __construct(
		$container,
		$config = [],
		FormTypeRegistryInterface $formTypeRegistry
	) {
		$this->config = $config;
		$this->container = $container;
		$this->formTypeRegistry = $formTypeRegistry;
	}

	/**
	 * {@inheritDoc}
	 */
	public function process(
		ServerRequestInterface $request,
		RequestHandlerInterface $handler
	): ResponseInterface{

		$fieldRegistry = $this->getRegistry($this->config['field_registry_name'] ?? self::DEFAULT_REGISTRY_KEY);
		$this->registerFields($this->config, $fieldRegistry);

		$filterRegistry = $this->getRegistry($this->config['filter_registry_name'] ?? self::DEFAULT_FILTER_KEY);
		$this->registerFilters($this->config, $filterRegistry);

		return $handler->handle($request);
	}

	/**
	 * [registerFilters description]
	 *
	 * @param  array                    $config   [description]
	 * @param  ServiceRegistryInterface $registry [description]
	 * @return [type]                             [description]
	 */
	private function registerFilters(array $config, ServiceRegistryInterface $registry) {

		$gridFields = $config['grid_filters'] ?? [];

		if (!(is_array($gridFields) || $gridFields instanceof ArrayObject)) {
			throw new Exception('grid_fields config must be an array or an instance of ArrayObject');
		}

		foreach ($gridFields as $fieldConfig) {

			$class = $fieldConfig['class'] ?? '';
			$type = $fieldConfig['type'] ?? '';
			$formType = $fieldConfig['form_type'] ?? '';

			if (!$class || !$type || !$formType) {
				throw new Exception('class, field and field_type are required for filter registry');
			}

			$field = $this->container->get($class);
			$registry->register($type, $field);
			$this->formTypeRegistry->add($type, 'default', $formType);

		}

	}

	/**
	 * [registerFields description]
	 *
	 * @param  array                    $config   [description]
	 * @param  ServiceRegistryInterface $registry [description]
	 * @return [type]                             [description]
	 */
	private function registerFields(array $config, ServiceRegistryInterface $registry) {

		$gridFields = $config['grid_fields'] ?? [];

		if (!(is_array($gridFields) || $gridFields instanceof ArrayObject)) {
			throw new Exception('grid_fields config must be an array or an instance of ArrayObject');
		}

		foreach ($gridFields as $fieldConfig) {

			$class = $fieldConfig['class'] ?? '';
			$type = $fieldConfig['type'] ?? '';

			if (!$class || !$type) {
				throw new Exception('class and field  are required for field registry');
			}

			$field = $this->container->get($class);
			$registry->register($type, $field);
		}

	}

	/**
	 * [getRegistry description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	private function getRegistry($name): ServiceRegistryInterface {

		if ($this->container->has($name)) {
			return $this->container->get($name);
		}

		throw new \Exception(sprintf("service not found for %s", $name));
	}
}
