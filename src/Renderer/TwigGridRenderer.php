<?php

namespace GridBundle\Renderer;

use GridBundle\Form\Registry\FormTypeRegistryInterface;
use Towersystems\Grid\Definition\Field;
use Towersystems\Grid\Definition\Filter;
use Towersystems\Grid\Renderer\GridRendererInterface;
use Towersystems\Grid\View\GridViewInterface;
use Towersystems\Resource\Registry\ServiceRegistryInterface;

class TwigGridRenderer implements GridRendererInterface {

	/** @var [type] [description] */
	private $twig;

	/** @var [type] [description] */
	private $defaultTemplate;

	/** @var [type] [description] */
	private $fieldsRegistry;

	/** @var [type] [description] */
	private $filterTemplates;

	/**
	 * [__construct description]
	 *
	 * @param \Twig_Environment $twig            [description]
	 * @param [type]            $defaultTemplate [description]
	 */
	public function __construct(
		\Twig_Environment $twig,
		$defaultTemplate,
		ServiceRegistryInterface $fieldsRegistry,
		FormTypeRegistryInterface $formTypeRegistry,
		array $filterTemplates = []
	) {
		$this->twig = $twig;
		$this->defaultTemplate = $defaultTemplate;
		$this->fieldsRegistry = $fieldsRegistry;
		$this->filterTemplates = $filterTemplates;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(GridViewInterface $gridView, $template = null) {
		return $this->twig->render($template ?: $this->defaultTemplate, ['grid' => $gridView]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function renderField(GridViewInterface $gridView, Field $field, $data) {
		/** @var FieldTypeInterface $fieldType */
		$fieldType = $this->fieldsRegistry->get($field->getType());

		return $fieldType->render($field, $data, $field->getOptions());
	}

	/**
	 * {@inheritdoc}
	 */
	public function renderFilter(GridViewInterface $gridView, Filter $filter) {

	}

	/**
	 * @param Filter $filter
	 *
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	private function getFilterTemplate(Filter $filter) {

		$template = $filter->getTemplate();

		if (null !== $template) {
			return $template;
		}

		$type = $filter->getType();

		if (!isset($this->filterTemplates[$type])) {
			throw new \InvalidArgumentException(sprintf('Missing template for filter type "%s".', $type));
		}

		return $this->filterTemplates[$type];

	}
}