<?php

/**
 * PostTypes controller
 **/
class AVA_Theme_PostTypes {
	
	/**
	 * Constructor
	 **/
	public function __construct() {
		
		//add_action( 'init', array( $this, 'load_modules' ) );
	}
	/**
	 * Load modules
	 */
	public function load_modules() {
		$cfg_modules = ava_theme_core()->config( 'modules' );
		
		$modules = glob( AVA_THEMECORE_DIR . '/modules/*', GLOB_ONLYDIR );
		
		foreach ( $modules as $module ) {
			$basename = WPM_Utils::basename($module);
			if ( ! empty( $cfg_modules[ $basename ] ) ) {
				require_once( $module . '/' . $basename . '.php' );
			}
		}
	}
	
}
