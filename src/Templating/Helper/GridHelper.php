<?php

namespace GridBundle\Templating\Helper;

use Towersystems\Grid\Definition\Field;
use Towersystems\Grid\Renderer\GridRendererInterface;
use Towersystems\Grid\View\GridView;

/**
 *
 */
class GridHelper {
	/**
	 * @var GridRendererInterface
	 */
	private $gridRenderer;

	/**
	 * [__construct description]
	 *
	 * @param GridRendererInterface $gridRenderer [description]
	 */
	function __construct(GridRendererInterface $gridRenderer) {
		$this->gridRenderer = $gridRenderer;
	}

	/**
	 * @param GridView $gridView
	 * @param string $template
	 *
	 * @return mixed
	 */
	public function renderGrid(GridView $gridView, $template = null) {
		return $this->gridRenderer->render($gridView, $template);
	}

	/**
	 * @param GridView $gridView
	 * @param Field $field
	 * @param mixed $data
	 *
	 * @return mixed
	 */
	public function renderField(GridView $gridView, Field $field, $data) {
		return $this->gridRenderer->renderField($gridView, $field, $data);
	}

	/**
	 * [renderFilter description]
	 *
	 * @param  GridView $gridView [description]
	 * @param  Filter   $filter   [description]
	 * @return [type]             [description]
	 */
	public function renderFilter(GridView $gridView, Filter $filter) {
		return $this->gridRenderer->renderFilter($gridView, $filter);
	}
}