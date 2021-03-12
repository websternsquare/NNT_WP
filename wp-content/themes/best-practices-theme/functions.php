<?php
/**
 * This serves as the main function file for the theme. Functionality should be broken out into reasonable chunks and included here.
 * Note: No code should be added directly to this file!
 */

require_once __DIR__ . '/theme-extensions/bladerunner/bladerunner.php';
require_once __DIR__ . '/theme-extensions/wp-h5bp-htaccess/wp-h5bp-htaccess.php';

/* TODO:: Get this package installed through autoloading */
require_once __DIR__ . '/functions/class-wp-bootstrap-navwalker.php';

require_once __DIR__ . '/functions/acfHooks.php';
require_once __DIR__ . '/functions/wordpressFunctions.php';
require_once __DIR__ . '/functions/UIHelperFunctions.php';
require_once __DIR__ . '/functions/searchFunctions.php';
require_once __DIR__ . '/functions/SimpleLoggerHooks.php';
require_once __DIR__ . '/functions/breadcrumbFunction.php';
require_once __DIR__ . '/functions/performanceOptimizations.php';
require_once __DIR__ . '/functions/bladerunnerDirectives.php';