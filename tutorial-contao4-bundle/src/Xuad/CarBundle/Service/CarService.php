<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Xuad\CarBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * Class CarService
 * @package Xuad\CarBundle\Service
 */
class CarService
{
	/**
	 * @var EntityManager
	 */
	private $entityManager;

	/**
	 * CarService constructor.
	 *
	 * @param EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * Find car by alias
	 *
	 * @param $alias
	 *
	 * @return array|\Xuad\CarBundle\Entity\Car[]
	 */
	public function findByAlias($alias)
	{
		$carList = $this->entityManager->getRepository('XuadCarBundle:Car')->findBy(['alias' => $alias]);

		return $carList;
	}

	/**
	 * Find all cars
	 *
	 * @return array|\Xuad\CarBundle\Entity\Car[]
	 */
	public function findAll()
	{
		$carList = $this->entityManager->getRepository('XuadCarBundle:Car')->findAll();

		return $carList;
	}
}