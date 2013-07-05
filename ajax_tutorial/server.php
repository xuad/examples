<?php

/**
 * xuad.net tutorial: ajax_tutorial
 *
 * Copyright (c) Patrick Mosch
 *
 * @link http://xuad.net
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

// Benoetigter AjaxController wird eingebunden
require_once 'classes/AjaxController.php';

// Neue Instanz des Controllers anlegen
$ajaxController = new AjaxController();

// Controller ausfuehren
echo $ajaxController->execute();
?>
