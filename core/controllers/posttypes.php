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

		// Register Custom Post Types and Taxonomies
		add_action( 'init', array( $this, 'register_custom_post_types' ), 5 );
	}
	/**
	 * Load modules
	 */
	public function load_modules() {
		$cfg_modules = AVA_Theme_Core()->config( 'modules' );
		
		$modules = glob( AVA_THEMECORE_DIR . '/modules/*', GLOB_ONLYDIR );
		
		foreach ( $modules as $module ) {
			$basename = WPM_Utils::basename($module);
			if ( ! empty( $cfg_modules[ $basename ] ) ) {
				require_once( $module . '/' . $basename . '.php' );
			}
		}
	}

	public function register_custom_post_types() {

		register_post_type( 'faq',
			array(
				//'label'             => esc_html__( 'Team Members', 'fruitfulblanktextdomain' ),
				'description'       => '',
				'public'            => false,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'capability_type'   => 'post',
				'hierarchical'      => true,
				'supports'          => array( 'title', 'editor', 'page-attributes' ),
				'rewrite'           => false,
				'has_archive'       => false,
				'query_var'         => true,
				'menu_position'     => 5,
				'capabilities'      => array(
					'publish_posts'       => 'edit_pages',
					'edit_posts'          => 'edit_pages',
					'edit_others_posts'   => 'edit_pages',
					'delete_posts'        => 'edit_pages',
					'delete_others_posts' => 'edit_pages',
					'read_private_posts'  => 'edit_pages',
					'edit_post'           => 'edit_pages',
					'delete_post'         => 'edit_pages',
					'read_post'           => 'edit_pages',
				),
				'labels'            => array(
					'name'               => esc_html__( 'FAQ', 'fruitfulblanktextdomain' ),
					'singular_name'      => esc_html__( 'FAQ', 'fruitfulblanktextdomain' ),
					'menu_name'          => esc_html__( 'FAQ', 'fruitfulblanktextdomain' ),
					'add_new'            => esc_html__( 'Add Item', 'fruitfulblanktextdomain' ),
					'add_new_item'       => esc_html__( 'Add New Item', 'fruitfulblanktextdomain' ),
					'all_items'          => esc_html__( 'All Items', 'fruitfulblanktextdomain' ),
					'edit_item'          => esc_html__( 'Edit Item', 'fruitfulblanktextdomain' ),
					'new_item'           => esc_html__( 'New Item', 'fruitfulblanktextdomain' ),
					'view_item'          => esc_html__( 'View Item', 'fruitfulblanktextdomain' ),
					'search_items'       => esc_html__( 'Search Items', 'fruitfulblanktextdomain' ),
					'not_found'          => esc_html__( 'No Items Found', 'fruitfulblanktextdomain' ),
					'not_found_in_trash' => esc_html__( 'No Items Found in Trash', 'fruitfulblanktextdomain' ),
					'parent_item_colon'  => esc_html__( 'Parent Item:', 'fruitfulblanktextdomain' )
				),
			)
		);
	}
	
}
