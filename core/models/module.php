<?php

if ( ! class_exists( 'AVA_Theme_Module' ) ) {
	
	class AVA_Theme_Module {
		
		public $module;
		
		public $version = '1.0';
		
		public $posttypes;
		
		public $shortcodes;
		
		public $widgets;
		
		public $templates;
		
		
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->load();
		}
		
		/**
		 * Initilization
		 */
		public function init() {
		}
		
		/**
		 * Load core files
		 */
		public function load() {
			
			$dir = AVA_THEMECORE_DIR . 'modules/' . $this->module;
			//dump( $dir );
			
			// Load post types
			if ( is_dir( $dir . '/posttypes' ) ) {
				foreach ( glob( $dir . '/posttypes/*.php' ) as $file ) {
					@require_once $file;
					
					$posttype = str_replace( array('.php','-'), array('','_'), AVA_Utils::basename($file));
					$className = $posttype . '_PostType';
					
					if ( class_exists( $className ) && empty($this->posttypes[$posttype]) ) {
						$this->posttypes[$posttype] = new $className();

						AVA_Theme_Core()->posttypes[$posttype] = $this->posttypes[$posttype];
					}
				}
			}
			
		}
	}
}
