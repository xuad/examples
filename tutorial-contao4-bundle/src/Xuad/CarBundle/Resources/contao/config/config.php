<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

/**
 * Backend modules
 */
array_insert($GLOBALS['BE_MOD']['XuadCars'], 1 ,[
	'XuadCarsManageCars' => [
		'tables' => ['tl_car'],
		'icon' => 'bundles/xuadcar/icon.png',
		'table' => ['TableWizard', 'importTable'],
		'list' => ['ListWizard', 'importList']
	]
]);

/**
 * Frontend modules
 */
$GLOBALS['FE_MOD']['XuadCars']['ModuleCarList'] = 'Xuad\\CarBundle\\Module\\ModuleCarList';