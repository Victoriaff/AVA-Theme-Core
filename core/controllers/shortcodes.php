<?php

/**
 * Shortcodes controller
 **/
class AVA_Theme_Shortcodes {

	/**
	 * Constructor
	**/
	public function __construct() {

		// add shortcodes
		add_action( 'vc_after_init', array( $this, 'register_vc_shortcodes') );
		add_action( 'vc_after_init', array( $this, 'register_vc_shortcode_params') );

		// AJAX actions for shortcodes
		$this->setup_shortcodes_ajax_actions();
        
        // Load shortcode template
		add_filter( 'load_shortcode_tpl', array( $this, 'load_shortcode_tpl' ), 10, 3 );
	}

	/**
		Custom theme shortcodes
	**/
	public function register_vc_shortcodes() {

		if( function_exists( 'vc_map') ) {

			$shortcodes = glob( AVA_THEMECORE_DIR . 'shortcodes/*' , GLOB_ONLYDIR );

			foreach( $shortcodes as $shortcode ) {
				$shortcode_name = str_replace( '-', '_', basename( $shortcode ));

				if( in_array( $shortcode_name, $shortcodes ) ) {
					continue;
				}

				require_once( $shortcode . '/shortcode.php' );

			}

		}

	}

	/**
		AJAX actions for shortcodes
	**/
	public function setup_shortcodes_ajax_actions() {

		$shortcodes = glob( AVA_THEMECORE_DIR . 'shortcodes/*' , GLOB_ONLYDIR );

		foreach( $shortcodes as $shortcode ) {
			$shortcode_name = str_replace( '-', '_', basename( $shortcode ));

			if( in_array( $shortcode_name, $shortcodes ) ) {
				continue;
			}

			$ajax_file = $shortcode . '/ajax.php';

			if( file_exists( $ajax_file ) ) {
				require_once( $ajax_file );
			}

		}

	}
    
    /*
    * Template connect function
    * Used in shortcodes and in global views
    *
    * @param mixed $template The path to template file without .php. Can be string or array of strings.
    * @param array $data Data that need to output in templeate file
    * @return string Output view data
    */
    public function load_shortcode_tpl( $template, $data = array(), $views_dir = AVA_THEMECORE_DIR . 'shortcodes/' ) {

        if( !is_array( $template) ){

            ob_start();
            require( $views_dir . $template . '.php' );
            $output = ob_get_clean();

        } else{

            foreach( $template as $name => $value ){
                ob_start();
                require( $views_dir . $value . '.php' );
                $output[$name] = ob_get_clean();
            }

        }

        return isset( $output) ? $output : '';
    }

	/**
	Register custom VC params
	 **/
	public function register_vc_shortcode_params() {
		vc_add_shortcode_param( 'eh_chapter', array( $this, 'eh_chapter_param' ) );
	}

	public function eh_chapter_param( $settings, $value ) {
		return '<div class="eh-chapter">'.$settings['title'].'</div>';
	}

	public function get_css_class( $css, $data ) {
		$css_class = trim(apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $data['wpb']->settings('base'), $data['atts'] ));
		$css_class .= !empty($data['atts']['classes']) && trim($data['atts']['classes']) ? (($css_class ? ' ':'') . trim($data['atts']['classes'])):'';

		return $css_class;
	}
}
