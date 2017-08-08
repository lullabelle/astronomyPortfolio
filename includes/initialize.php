<?php

// Define the core paths
/* purpose of initialise file is to include used classes,objects
functions and configuration on one file. Each site page, object
or class can include just this file rather than a list of files */

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'wamp64'.DS.'www'.DS.'astronomyPortfolio');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects


// load database-related classes




?>