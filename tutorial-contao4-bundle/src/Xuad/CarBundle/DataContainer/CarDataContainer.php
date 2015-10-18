<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Xuad\CarBundle\DataContainer;

use Contao\DataContainer;
use Doctrine\ORM\EntityManager;
use Xuad\CarBundle\Service\CarService;

/**
 * @ORM\Entity
 * @ORM\Table(name="tl_car")
 */
class CarDataContainer
{
	/**
	 * @var EntityManager
	 */
	private $entityManager;

	/**
	 * @var CarService
	 */
	private $carService;

	/**
	 * Constructor.
	 *
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 * @param \Xuad\CarBundle\Service\CarService $carService
	 */
	public function __construct(EntityManager $entityManager, CarService  $carService)
	{
		$this->entityManager = $entityManager;
		$this->carService = $carService;
	}

	/**
	 * Generate alias
	 *
	 * @param $varValue
	 * @param \Contao\DataContainer $dc
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		if ($varValue === '')
		{
			$autoAlias = true;

			$varValue = \StringUtil::generateAlias($dc->activeRecord->brand . '-' . $dc->activeRecord->name);
		}

		$carList = $this->carService->findByAlias($varValue);

		// Check whether the news alias exists
		if (count($carList) > 1 && $autoAlias === false)
		{
			throw new \Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if (count($carList) > 0 && $autoAlias === true)
		{
			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
}
