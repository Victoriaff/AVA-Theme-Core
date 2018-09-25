<?php

/**
 * Backend controller
 **/
class AVA_Theme_Core_Admin {

	/**
	 * Constructor
	**/
	function __construct() {
		// Disable VC front-end
		add_action( 'vc_before_init', array( $this, 'setup_vc') );
	}

	/**
	 * Setup Visual Composer
	 * disable front-end mode
	**/
	function setup_vc() {

		if( function_exists( 'vc_disable_frontend') ) {
			vc_disable_frontend();
		}

		if ( function_exists('vc_set_default_editor_post_types')) {
			$list = array(
				'page',
				'composerlayout',
				'forms',
			);
			vc_set_default_editor_post_types( $list );
		}

		if( function_exists( 'vc_add_shortcode_param') ) {
			vc_add_shortcode_param( 'chapter', function ( $settings, $value ) {

				return '<div>' . esc_attr( $settings['heading'] ) . '</div>';
			}
			);
		}

	}
}
