<?php

namespace GridBundle\Doctrine\ORM;

use Towersystems\Grid\Data\DataSourceInterface;
use Towersystems\Grid\Data\DataSourceProviderInterface;
use Towersystems\Grid\Definition\Grid;
use Towersystems\Grid\Parameters;

class ORMDataSourceProvider implements DataSourceProviderInterface {

	/** @var [type] [description] */
	private $ormDriver;

	/**
	 * [__construct description]
	 *
	 * @param Driver $ormDriver [description]
	 */
	public function __construct(Driver $ormDriver) {
		$this->ormDriver = $ormDriver;
	}

	/**
	 * [getDataSource description]
	 *
	 * @param  Grid       $grid       [description]
	 * @param  Parameters $parameters [description]
	 * @return DataSourceInterface                 [description]
	 */
	public function getDataSource(Grid $grid, Parameters $parameters): DataSourceInterface {
		return $this->ormDriver->getDataSource($grid->getDriverConfiguration(), $parameters);
	}

}