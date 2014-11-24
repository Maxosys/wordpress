<?php
/**
 * Plugin Name: PIF Setup Wizard
 * Description: PassiveIncomeFormula Setup Wizard
 * Version: 1.0
 */

define("CONFIG_WIZARD_PATH", dirname(__FILE__));

require_once(CONFIG_WIZARD_PATH."/classes/userWebAddress.class.php"); // The admin config panel class
require_once(CONFIG_WIZARD_PATH."/classes/UserConfigGeneric.class.php"); // Generic stuff used by the user config wizard/manual shortcodes
require_once(CONFIG_WIZARD_PATH."/classes/AdminConfigPanel.class.php"); // The admin config panel class

require_once(CONFIG_WIZARD_PATH."/inc/constants.inc.php"); // Defines
require_once(CONFIG_WIZARD_PATH."/inc/shortcodes.inc.php"); // Shortcodes
require_once(CONFIG_WIZARD_PATH."/inc/menus.inc.php"); // Admin menu items


?>