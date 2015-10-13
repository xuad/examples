<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

$GLOBALS['TL_DCA']['tl_car'] = [
	'config' => [
		'dataContainer' => 'Table',
		'switchToEdit' => true,
		'enableVersioning' => true,
		'sql' => [
			'keys' => [
				'id' => 'primary',
			]
		]
	],
	'list' => [
		'sorting' => [
			'mode' => 1,
			'fields' => ['name'],
			'headerFields' => ['name'],
			'flag' => 1,
			'panelLayout' => 'debug;filter;sort,search,limit',
		],
		'label' => [
			'fields' => ['brand'], ['name'],
			'format' => '%s %s',
			'showColumns' => true,
		],
		'global_operations' => [
			'all' => [
				'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href' => 'act=select',
				'class' => 'header_edit_all',
				'attributes' => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			]
		],
		'operations' => [
			'toggle' => [
				'label' => &$GLOBALS['TL_LANG']['tl_car']['toggle'],
				'icon' => 'visible.gif',
				'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
			],
			'edit' => [
				'label' => &$GLOBALS['TL_LANG']['tl_car']['edit'],
				'href' => 'act=edit',
				'icon' => 'edit.gif',
			],
			'copy' => [
				'label' => &$GLOBALS['TL_LANG']['tl_car']['copy'],
				'href' => 'act=copy',
				'icon' => 'copy.gif',
			],
			'delete' => [
				'label' => &$GLOBALS['TL_LANG']['tl_car']['delete'],
				'href' => 'act=delete',
				'icon' => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			],
			'show' => [
				'label' => &$GLOBALS['TL_LANG']['tl_simpleguestbook']['show'],
				'href' => 'act=show',
				'icon' => 'show.gif'
			]
		]
	],
	'palettes' => [
		'__selector__' => [],
		'default' => '
			brand,
			name,
			alias'
	],
	'subpalettes' => [
		'' => ''
	],
	'fields' => [
		'id' => [
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		],
		'tstamp' => [
			'sql' => "int(10) unsigned NOT NULL default '0'"
		],
		'name' => [
			'label' => &$GLOBALS['TL_LANG']['tl_car']['name'],
			'exclude' => true,
			'search' => true,
			'sorting' => true,
			'flag' => 1,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'brand' => [
			'label' => &$GLOBALS['TL_LANG']['tl_car']['brand'],
			'exclude' => true,
			'search' => true,
			'sorting' => true,
			'flag' => 1,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		'alias' => [
			'label' => &$GLOBALS['TL_LANG']['tl_car']['alias'],
			'exclude' => true,
			'search' => true,
			'inputType' => 'text',
			'eval' => ['rgxp' => 'alias', 'unique' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
			'save_callback' => [
				function ($varValue, DataContainer $dataContainer)
				{
					return \System::getContainer()->get('xuad_car.datacontainer.car')->generateAlias($varValue, $dataContainer);
				}
			],
			'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		],
	]
];