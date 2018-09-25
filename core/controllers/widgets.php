<?php

/**
 * Widgets controller
 **/
class AVA_Theme_Widgets {

	/**
	 * Constructor
	**/
	function __construct() {

		$this->load_widgets();
		
		// register widgets
		add_action( 'widgets_init', array( $this, 'register_widgets'));
	}

	/**
		Custom theme shortcodes
	**/
	function load_widgets() {

		$widgets = glob( AVA_THEMECORE_DIR . '/widgets/*' , GLOB_ONLYDIR );

		foreach( $widgets as $widget ) {
			require_once( $widget . '/widget.php' );
		}
	}
	
	/**
	 * Register widgets
	 */
	public function register_widgets() {
		register_widget( 'WPM_Widget_Popular_Posts' );
	}

}
