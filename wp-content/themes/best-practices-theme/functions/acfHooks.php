<?php 

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
 
    // update path
    $path = get_stylesheet_directory() . '/theme-extensions/advanced-custom-fields-pro/';
    
    // return
    return $path;
    
}
 

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
 
    // update path
    $dir = get_stylesheet_directory_uri() . '/theme-extensions/advanced-custom-fields-pro/';
    
    // return
    return $dir;
    
}

// 4. Include ACF
include_once(get_stylesheet_directory() . '/theme-extensions/advanced-custom-fields-pro/acf.php');
