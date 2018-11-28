<?php

namespace GridBundle\Handler;

use Psr\Http\Server\MiddlewareInterface;
use Towersystems\Grid\Parameters;
use Zend\Diactoros\Response\HtmlResponse;

class TestHandler implements MiddlewareInterface {

	/**
	 * [$emailSender description]
	 * @var [type]
	 */
	protected $gridProvider;

	/**
	 * [$gridViewFactory description]
	 * @var [type]
	 */
	protected $gridViewFactory;

	/**
	 * [$templates description]
	 * @var [type]
	 */
	protected $templates;

	/**
	 * [__construct description]
	 * @param [type] $container [description]
	 * @param [type] $config    [description]
	 */
	public function __construct(
		$templates,
		$gridProvider,
		$gridViewFactory
	) {
		$this->templates = $templates;
		$this->gridProvider = $gridProvider;
		$this->gridViewFactory = $gridViewFactory;
	}

	/**
	 * {@iheritdoc}
	 */
	public function process(
		\Psr\Http\Message\ServerRequestInterface $request,
		\Psr\Http\Server\RequestHandlerInterface $handler)
	: \Psr\Http\Message\ResponseInterface{

		$parameters = new Parameters($request->getQueryParams());
		$grid = $this->gridProvider->get("app_subscriptions");
		$gridView = $this->gridViewFactory->create($grid, $parameters);

		return new HtmlResponse(
			$this->templates->render('grid::test', [
				'gridView' => $gridView,
			])
		);

	}

}