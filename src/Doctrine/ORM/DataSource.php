<?php

namespace GridBundle\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Towersystems\Grid\Data\DataSourceInterface;
use Towersystems\Grid\Parameters;

/**
 *
 */
class DataSource implements DataSourceInterface {

	/**
	 * @var QueryBuilder
	 */
	private $queryBuilder;

	/**
	 * @var ExpressionBuilderInterface
	 */
	private $expressionBuilder;

	/**
	 * [__construct description]
	 *
	 * @param QueryBuilder $queryBuilder [description]
	 */
	function __construct(QueryBuilder $queryBuilder) {
		$this->queryBuilder = $queryBuilder;
		$this->expressionBuilder = new ExpressionBuilder($queryBuilder);
	}

	/**
	 * {@inheritdoc}
	 */
	public function restrict($expression, $condition = DataSourceInterface::CONDITION_AND) {
		switch ($condition) {
			case DataSourceInterface::CONDITION_AND:
				$this->queryBuilder->andWhere($expression);
				break;
			case DataSourceInterface::CONDITION_OR:
				$this->queryBuilder->orWhere($expression);
				break;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getExpressionBuilder() {
		return $this->expressionBuilder;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getData(Parameters $parameters) {
		$paginator = new Pagerfanta(new DoctrineORMAdapter($this->queryBuilder, false, false));
		$paginator->setNormalizeOutOfRangePages(true);
		$paginator->setCurrentPage($parameters->get('page', 1));

		return $paginator;
	}

}