<?php

if ( ! class_exists( 'AVA_Theme_Team_Module' ) ) {
	class AVA_Theme_Team_Module extends AVA_Theme_Module {
		
		public $module = 'team';
		
		public $version = '1.0';
		
		
		/**
		 * Constructor
		 */
		public function __construct() {
			
			parent::__construct();
			
			$this->init();
		}
		
		/**
		 * Initilization
		 */
		public function init() {
		
		}
	}
		
}



