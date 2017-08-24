<?php
//php constatnt that defines directory separator for windows \ or linux /
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

//path to application
defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', DS.'wamp64'.DS.'www'.DS.'astronomyPortfolio');
//path to includes files
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
	
require_once(LIB_PATH.DS.'config.php');
require_once(LIB_PATH.DS.'functions.php');
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS."user.php");
require_once(LIB_PATH.DS."photograph.php");


?>