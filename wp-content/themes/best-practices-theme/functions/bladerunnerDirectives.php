<?php

/* If you need to change the path of the wordpress templates. Do so here.
   Certain hosts (wpengine) require  the use of specific paths. Eg, /temp/{random_characters}/cache/blade
/*
add_filter('bladerunner/cache/path', function($path) {
    return '/some/other/path';
});*/

// Add support for @switch statements 
add_action('after_setup_theme', function () {
    $blade = \Bladerunner\Container::current('blade');
    $firstCaseInSwitch = true;

    $blade->compiler()->directive('switch', function ($expression) use (&$firstCaseInSwitch) {
        $firstCaseInSwitch = true;
        return "<?php switch({$expression}):";
    });

    $blade->compiler()->directive('case', function ($expression) use (&$firstCaseInSwitch) {
        if ($firstCaseInSwitch) {
            $firstCaseInSwitch = false;
            return "case {$expression}: ?>";
        }
        return "<?php case {$expression}: ?>";
    });

    $blade->compiler()->directive('default', function ($expression) {
        return '<?php default: ?>';
    });

    $blade->compiler()->directive('endswitch', function ($expression) {
        return '<?php endswitch; ?>';
    });
});
