<?php

/**
 * Autoload the different classes as needed
 */
spl_autoload_register(function ($class) {
 
	/*
	$dirs = array(
		'core/controllers',
		'core/helpers',
		'core/models',
	);
	
	foreach($dirs as $dir) {
		$file = AVA_THEMECORE_DIR . $dir . '/'. $class,
	}
	
    if ( isset( Intense()->shortcode_list[ $class ] ) ) {
        include Intense()->shortcode_list[ $class ]['path'];
    } else if ( isset( Intense()->post_type_list[ $class ] ) ) {
        include Intense()->post_type_list[ $class ]['path'];
    } else if ( isset( Intense()->widget_list[ $class ] ) ) {
        include Intense()->widget_list[ $class ]['path'];
    }
	*/
    
});
