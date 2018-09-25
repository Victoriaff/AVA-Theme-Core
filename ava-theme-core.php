<?php
/**
 * AVA Theme Core
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since                1.0
 * @package              AVA Theme Core
 *
 * @wordpress-plugin
 * Plugin Name:          AVA Theme Core
 * Plugin URI:           https://ava-theme.ava-team.com
 * Description:          Core functional for AVA Theme By AVA-Team.com
 * Version:              1.0
 * Author:               AVA-Team
 * Author URI:           https://ava-team.com/
 * License:              GPL-2.0+
 * License URI:          http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:          ava-theme-core
 * Domain Path:          /languages
 */

//No direct access
defined( 'ABSPATH' ) or die();

define( 'AVA_THEMECORE_CACHE_TIME', '100720181000' );
define( 'AVA_THEMECORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'AVA_THEMECORE_URL', plugin_dir_url( __FILE__ ) );

//include_once( AVA_THEMECORE_DIR . 'core/controllers/shortcodes.php' );
//include_once( AVA_THEMECORE_DIR . 'core/controllers/modules.php' );
//include_once( AVA_THEMECORE_DIR . 'core/controller/metaboxes.php' );
//include_once( AVA_THEMECORE_DIR . 'core/controllers/widgets.php' );
include_once( AVA_THEMECORE_DIR . 'core/helpers/utils.php' );

class AVA_Theme_Core {
	
	private static $instance;
	
	public $controller;
	
	public $model;
	
	public $posttypes;
	
	public $widgets;
	
	
	/**
	 * Constructor
	 **/
	private function __construct() {
		
		register_activation_hook( __FILE__, array( $this, 'activation_plugin' ) );
		
		register_deactivation_hook( __FILE__, array( $this, 'deactivation_plugin' ) );
		
		// load assets
		//add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
		
		
	}
	
	/**
	 * Init
	 **/
	public function init() {
		
		// Load core scripts
		AVA_Utils::loader( array(
			'core/controllers',
			'core/helpers',
			'core/models',
		));
		
		$this->controller = new stdClass();
		$this->model      = new stdClass();
		
		// Filesystem model
		require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
		require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
		$this->model->filesystem = new WP_Filesystem_Direct( null );
		
		// Register Custom Post Types and Taxonomies
		//add_action( 'init', array( $this, 'register_post_status'), 5);
		
		/**
		 * Models
		 */
		//$this->model->module = new AVA_Theme_Module();
		
		/**
		 * Controllers
		 */
		$this->controller->modules = new AVA_Theme_Modules();
		//$this->controller->posttypes = new AVA_Theme_PostTypes();
		//$this->controller->metaboxes = new AVA_Theme_Metaboxes();
		//$this->controller->shortcodes = new AVA_Theme_Shortcodes();
		//$this->controller->widgets = new AVA_Theme_Widgets();
		
		
		
		if ( is_admin() ) {
			// Controllers for admin part only
			require_once AVA_THEMECORE_DIR . 'core/controllers/admin.php';
			$this->controller->backend = new AVA_Theme_Core_Admin();
		}
		
		// load assets
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
		
		
	}
	
	/**
	 * Plugins loaded
	 *
	 */
	public function plugins_loaded() {
		
		/*
		add_action('AVAFW_Core/init', function() {
			dump('... AVAFW_Core/init ...');
		});
		*/
	
		/*
		// Set shortcodes directory
		add_action('AVAFW_Core/dir/shortcodes', function($args) {
			return array( AVA_THEMECORE_DIR . 'shortcodes' );
		});
		
		// Set widgets directory
		add_action('AVAFW_Core/dir/widgets', function($args) {
			return array( AVA_THEMECORE_DIR . 'widgets' );
		});
		
		if (class_exists('AVA_Framework')) {
			$this->avafw = new AVA_Framework();
		}
		*/
	}
	
	
	/**
	 * Get the instance
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! ( self::$instance instanceof self ) ) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}
	
	/**
	 * Get config value
	 *
	 */
	public function config( $key = null ) {
		if ( function_exists( 'ava_theme' ) ) {
			return ava_theme()->config( $key );
		}
	}
	
	/**
	 * Get options
	 *
	 */
	public function options( $key = null ) {
		if ( function_exists( 'ava_theme' ) ) {
			return ava_theme()->options( $key );
		}
	}
	
	
	/**
	 * Load JavaScript and CSS files in a front-end
	 **/
	function load_assets() {
		wp_enqueue_script( 'eh-core-main', AVA_THEMECORE_URL . 'assets/js/main.js', array( 'jquery' ), AVA_THEMECORE_CACHE_TIME, true );
	}
	
	/**
	 * Plugin activation
	 */
	public function activation_plugin() {
	}
	
	/**
	 * Plugin deactivation
	 */
	public function deactivation_plugin() {
		//
	}
	
	/**
	 * Plugin uninstall
	 */
	public static function uninstall_plugin() {
		//
	}
	
	/**
	 * Register post status
	 **/
	public function register_post_status() {
		// Paid invoices
		register_post_status(
			'paid',
			array(
				'label'                     => __( 'Paid', 'engine-hosting-core' ),
				'public'                    => false,
				'exclude_from_search'       => true,
				'show_in_admin_all_list'    => false,
				'show_in_admin_status_list' => false
			)
		);
	}
	
	/** Set default order column for table list */
	public function posts_extranet_orderby( $query ) {
		
		if ( ! empty( $query->query['post_type'] ) && in_array( $query->query['post_type'], array(
				'pricing_list',
				'team'
			) ) ) {
			if ( $query->get( 'orderby' ) == '' ) {
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'ASC' );
			}
		}
	}
	
	/** Team Members customization */
	public function set_team_columns( $columns ) {
		$custom_columns = array(
			'link'  => __( 'Link', 'engine-hosting-core' ),
			'order' => __( 'Order', 'engine-hosting-core' )
		);
		$columns        = $this->array_insert( $columns, 'date', $custom_columns );
		
		return $columns;
	}
	
	public function team_column( $column, $post_id ) {
		
		switch ( $column ) {
			case 'link' :
				echo get_post_meta( $post_id, '_member_link', true );
				break;
			
			case 'order' :
				$pos = get_post_meta( $post_id, '_member_order', true );
				echo $pos ? $pos : 1;
				break;
		}
	}
	
	
	/**
	 * Insert array into other array ( suppor assoc arrays )
	 *
	 * @param $array Source array
	 * @param $position Position ( key )
	 * @param $insert Inserted array
	 */
	public function array_insert( $array, $position, $insert ) {
		if ( is_int( $position ) ) {
			array_splice( $array, $position, 0, $insert );
		} else {
			$pos   = array_search( $position, array_keys( $array ) );
			$array = array_merge(
				array_slice( $array, 0, $pos ),
				$insert,
				array_slice( $array, $pos )
			);
		}
		
		return $array;
	}
	
}

if ( ! function_exists( 'ava_theme_core' ) ) {
	function ava_theme_core() {
		return AVA_Theme_Core::instance();
	}
}
ava_theme_core()->init();

//require_once _EHPLUGIN_DIR_ . '/core/library/metaboxes/eh-mb-users.php';
//require_once _EHPLUGIN_DIR_ . '/core/library/metaboxes/init.php';

add_action('shutdown', function() {
	//dump(ava_theme_core()->posttypes);
});
