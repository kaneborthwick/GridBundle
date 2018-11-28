<?php

namespace GridBundle\Doctrine\ORM;

use Towersystems\Grid\Data\DriverInterface;
use Towersystems\Grid\Parameters;

class Driver implements DriverInterface {

	private $entityManager;

	public function __construct($entityManager) {
		$this->entityManager = $entityManager;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDataSource(array $configuration, Parameters $parameters) {
		if (!array_key_exists('class', $configuration)) {
			throw new \InvalidArgumentException('"class" must be configured.');
		}

		$repository = $this->entityManager
			->getRepository($configuration['class']);

		$queryBuilder = $repository->createQueryBuilder('o');

		return new DataSource($queryBuilder);
	}
}