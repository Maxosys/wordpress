<?php

/*
 * Plugin Name: PIF Analytics
 * Description: Website Analytics
 * Version: 1.0
 */

// start analytics working

define("CONFIG_ANALYTICS_PATH", dirname(__FILE__));


require_once(CONFIG_ANALYTICS_PATH."/classes/MostRecent.class.php"); // The most recent panel class

require_once(CONFIG_ANALYTICS_PATH."/inc/shortcode.inc.php"); // Shortcodes



//require_once(CONFIG_WIZARD_PATH."/classes/UserConfigGeneric.class.php"); // Generic stuff used by the user config wizard/manual shortcodes
//require_once(CONFIG_WIZARD_PATH."/classes/AdminConfigPanel.class.php"); // The admin config panel class

//require_once(CONFIG_WIZARD_PATH."/inc/constants.inc.php"); // Defines

//require_once(CONFIG_WIZARD_PATH."/inc/menus.inc.php"); // Admin menu items


?>