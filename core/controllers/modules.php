<?php

/**
 * Modules controller
 **/
class AVA_Theme_Modules {
	
	public $modules;
	
	/**
	 * Constructor
	 **/
	public function __construct() {
		
		add_action( 'init', array( $this, 'load_modules' ) );
	}
	
	/**
	 * Load modules
	 */
	public function load_modules() {
		
		do_action('ava_theme/modules/load/before', $this);
		
		$dir = AVA_THEMECORE_DIR . 'modules';
		$cfg_modules = AVA_Theme_Core()->config( 'modules' );
		
		
		$modules = glob( $dir . '/*', GLOB_ONLYDIR );
		//dump($modules);
		
		foreach ( $modules as $module ) {
			$basename = AVA_Utils::basename($module);
			
			$file = $module . '/' . $basename . '-module.php';
			if ( ! empty( $cfg_modules[ $basename ] ) &&  AVA_Utils::file_exists($file) ) {
				require_once $file;
				$className = 'AVA_Theme_' . $basename . '_Module';
				$this->modules[ $basename ] = new $className();
			}
		}
		
		do_action('ava_theme/modules/load/after', $this);
	}
	
}
