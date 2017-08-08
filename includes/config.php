<?php
// set up databses connection constants
// checks first if constant is already defined, if so do nothing

defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER') ? null : define("DB_USER", "Joanne");
defined('DB_PASS') ? null : define("DB_PASS", "Amadeus");
defined('DB_NAME') ? null : define("DB_NAME", "astro_gallery");
?>