<?php

if ( ! class_exists( 'AVA_PostType' ) ) {
	
	class AVA_PostType {
		
		public $type;
		public $module = 'default';
		
		public $title;
		public $singular;
		public $plural;
		public $fields;
		public $menu_icon;
		
		public $description = '';
		public $public = true;
		public $show_ui = true;
		public $show_in_menu = true;
		public $show_in_nav_menus = true;
		public $menu_position = 5;
		public $capability_type = 'post';
		public $hierarchical = false;
		public $supports = array( 'title', 'editor', 'thumbnail', 'comments', 'author', 'revisions' );
		public $rewrite = false;
		public $has_archive = false;
		public $query_var = false;
		public $can_export = true;
		public $exclude_from_search = false;
		
		public function register() {
			
			do_action( 'ava_theme/posttype/register/before', $this );
			
			if ( isset( $this->hierarchical ) && $this->hierarchical ) {
				$this->supports[] = 'page-attributes';
			}
			
			register_post_type(
				$this->type,
				array(
					'description'           => $this->description,
					'public'                => $this->public,
					'show_ui'               => $this->show_ui,
					'show_in_menu'          => $this->show_in_menu,
					'show_in_nav_menus'     => $this->show_in_nav_menus,
					'menu_position'         => $this->menu_position,
					'capability_type'       => $this->capability_type,
					'hierarchical'          => $this->hierarchical,
					'supports'              => $this->supports,
					'rewrite'               => $this->rewrite,
					'has_archive'           => $this->has_archive,
					'query_var'             => $this->query_var,
					'can_export'            => $this->can_export,
					'exclude_from_search'   => $this->exclude_from_search,
					'menu_icon'             => $this->menu_icon,
					//'taxonomies'            => array( $tag ),
					'labels'                => array(
						'name'               => $this->plural,
						'singular_name'      => $this->singular,
						'menu_name'          => $this->plural,
						'all_items'          => __( 'All', '{domain}' ) . ' ' . $this->plural,
						'add_new'            => __( 'Add New', '{domain}' ) . ' ' . $this->singular,
						'add_new_item'       => __( 'Add New', '{domain}' ) . ' ' . $this->singular,
						'edit_item'          => __( 'Edit', '{domain}' ) . ' ' . $this->singular,
						'new_item'           => __( 'New', '{domain}' ) . ' ' . $this->singular,
						'view_item'          => __( 'View', '{domain}' ) . ' ' . $this->singular,
						'search_items'       => __( 'Edit', '{domain}' ) . ' ' . $this->singular,
						'not_found'          => __( 'No', '{domain}' ) . ' ' . $this->plural . ' ' . __( 'found', '{domain}' ),
						'not_found_in_trash' => __( 'No', '{domain}' ) . ' ' . $this->plural . ' ' . __( 'found in Trash', '{domain}' )
					),
				)
			);
				
			/*
			if ( $this->type != 'intense_templates' && $this->type != 'intense_snippets' ) {
				add_post_type_support( $this->type, 'post-formats' );
			}
			*/
			
			/*
			if ( function_exists( "register_field_group" ) && $this->type != 'intense_snippets' ) {
				$postType    = $this->type;
				$show_fields = 1;
				
				if ( $this->type == 'intense_post' ) {
					$postType = 'post';
					
					if ( isset( Intense()->options['intense_cpt_post_options'] ) && ! Intense()->options['intense_cpt_post_options'] ) {
						$show_fields = 0;
					}
				}
				
				if ( $show_fields && ! empty( $this->fields ) ) {
					register_field_group( array(
						'id'         => 'acf_' . strtolower( $this->singular ) . '-options',
						'title'      => $this->singular . ' ' . __( 'Options', '{domain}' ),
						'fields'     => $this->fields,
						'location'   => array(
							array(
								array(
									'param'    => 'post_type',
									'operator' => '==',
									'value'    => $postType,
									'order_no' => 0,
									'group_no' => 0,
								),
							),
						),
						'options'    => array(
							'position'       => 'normal',
							'layout'         => 'default',
							'hide_on_screen' => ( ! empty( $this->hide_on_screen ) ? $this->hide_on_screen : array() ),
						),
						'menu_order' => 0,
					) );
				}
			}
			
			if ( isset( $this->category_taxonomy_key ) && $this->category_taxonomy_key != '' ) {
				$this->register_category_taxonomy( $this->category_taxonomy_key );
			}
			*/
			
			if ( is_array( $this->taxonomies ) ) {
				foreach ( $this->taxonomies as $key => $taxonomy ) {
					if ( is_array( $taxonomy ) ) {
						$this->register_taxonomy( $taxonomy['key'], $taxonomy['singular'], $taxonomy['plural'] );
					}
				}
			}
			
			do_action( 'ava_theme/posttype/register/after', $this );
		}
		
		public function register_category_taxonomy( $key ) {
			register_taxonomy( $key,
				$this->type,
				array(
					'hierarchical' => true,
					'label'        => $this->singular . ' ' . __( 'Categories', '{domain}' ),
					'query_var'    => true,
					'rewrite'      => array( 'slug' => strtolower( $this->plural ) )
				) );
		}
		
		public function register_taxonomy( $key, $singular, $plural ) {
			$labels                  = array();
			$labels['name']          = $plural;
			$labels['singular_name'] = $singular;
			$labels['search_items']  = __( 'Search', '{domain}' ) . ' ' . $plural;
			$labels['add_new_item']  = __( 'Add New', '{domain}' ) . ' ' . $singular;
			$labels['new_item_name'] = __( 'New', '{domain}' ) . ' ' . $singular . ' ' . __( 'Name', '{domain}' );
			$labels['menu_name']     = $plural;
			
			register_taxonomy( $key,
				$this->type,
				array(
					'hierarchical' => true,
					'label'        => $plural,
					'labels'       => $labels,
					'query_var'    => true,
					'rewrite'      => array( 'slug' => strtolower( $plural ) ),
				) );
		}
		
		public function get_excerpt( $limit ) {
			$excerpt = explode( ' ', get_the_excerpt(), $limit );
			
			return $this->get_clean_excerpt( $excerpt, $limit );
		}
		
		protected function get_clean_excerpt( $excerpt, $limit ) {
			if ( count( $excerpt ) >= $limit ) {
				array_pop( $excerpt );
				$excerpt = implode( " ", $excerpt ) . '...';
			} else {
				$excerpt = implode( " ", $excerpt );
			}
			
			$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
			
			return $excerpt;
		}
		
		public function get_content( $limit ) {
			$content = get_the_content();
			
			return $this->get_clean_content( $content, $limit );
		}
		
		protected function get_clean_content( $content, $limit ) {
			$original_content = preg_replace( "~(?:\[/?)[^/\]]+/?\]~s", '', $content );
			
			$content = explode( ' ', $original_content, $limit );
			
			if ( count( $content ) >= $limit ) {
				array_pop( $content );
				$content = implode( " ", $content ) . '...';
			} else {
				$content = implode( " ", $content );
			}
			
			$content = apply_filters( 'the_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
			
			return $content;
		}
		
		public function get_subtitle() {
			return '';
		}
		
		public function get_link_fields() {
			$fields = array();
			
			foreach ( $this->fields as $key => $field ) {
				if ( $field['type'] === 'intense_url' ) {
					$fields[] = array( "key" => $field['name'], "value" => $field['label'] );
				}
			}
			
			return $fields;
		}
		
		public function get_link( $type ) {
			if ( $type == 'none' ) {
				return null;
			} else if ( $type == 'single' || empty( $type ) ) {
				return get_permalink();
			} else {
				return get_field( $type );
			}
		}
		
		public function get_image_field() {
			foreach ( $this->fields as $key => $field ) {
				if ( ! empty( $field['is_post_type_image'] ) ) {
					return $field['name'];
				}
			}
			
			return null;
		}
	}
	
	/*
	class Intense_Post_Types {
		function __construct() {
			add_action( 'init', array( "Intense_Post_Types", "register" ) );
			add_filter( 'enter_title_here', array( "Intense_Post_Types", "get_title" ) );
			add_filter( 'template_include', array( "Intense_Post_Types", "content_single" ) );
		}
		
		public static function get_search_paths() {
			$search_paths = array(
				'intense' => INTENSE_PLUGIN_FOLDER . '/custom-post-types/'
			);
			
			$search_paths = apply_filters( 'intense/custom_post_types/search_paths', $search_paths );
			
			return $search_paths;
		}
		
		
		public static function load_custom_post_types() {
			WP_Filesystem();
			global $wp_filesystem;
			
			$custom_post_type_list = array();
			
			$search_paths = Intense_Post_Types::get_search_paths();
			
			foreach ( $search_paths as $path_key => $path ) {
				$path_directories = scandir( $path );
				
				foreach ( $path_directories as $cpt_directory ) {
					if ( $cpt_directory === '.' or $cpt_directory === '..' ) {
						continue;
					}
					
					if ( is_dir( $path . $cpt_directory ) ) {
						$cpt_files = scandir( $path . $cpt_directory );
						
						foreach ( $cpt_files as $key => $cpt_file ) {
							if ( $cpt_file === '.' or $cpt_file === '..' ) {
								continue;
							}
							
							if ( substr( $cpt_file, - strlen( ".php" ) ) == ".php" ) {
								$cpt_title      = str_replace( '.php', '', $cpt_file );
								$cpt_title      = ucwords( str_replace( '-', ' ', $cpt_title ) );
								$cpt_class_name = "Intense_Post_Type_" . ucfirst( $cpt_title );
								
								$custom_post_type_list[ $cpt_class_name ]['path']        = $path . $cpt_directory . '/' . $cpt_file;
								$custom_post_type_list[ $cpt_class_name ]['directory']   = $cpt_directory;
								$custom_post_type_list[ $cpt_class_name ]['option_name'] = 'intense_cpt_' . strtolower( $cpt_title );
								
								if ( version_compare( phpversion(), '5.3.0', '<' ) ) {
									require_once $path . $cpt_directory . '/' . $cpt_file;
								}
								
								if ( file_exists( $path . $cpt_directory . '/settings.json' ) ) {
									try {
										$settings                                 = json_decode( $wp_filesystem->get_contents( $path . $cpt_directory . '/settings.json' ), true );
										$custom_post_type_list[ $cpt_class_name ] = array_merge( $custom_post_type_list[ $cpt_class_name ], $settings );
									} catch ( Exception $e ) {
									}
								}
							}
						}
					}
				}
			}
			
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			if ( ! is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				unset( $custom_post_type_list['Intense_Post_Type_Product'] );
			}
			
			if ( ! is_plugin_active( 'easy-digital-downloads/easy-digital-downloads.php' ) ) {
				unset( $custom_post_type_list['Intense_Post_Type_Downloads'] );
			}
			
			ksort( $custom_post_type_list );
			
			return $custom_post_type_list;
		}
		
		public static function list_post_types() {
			
			foreach ( Intense()->post_type_list as $class_name => $custom_post_type ) {
				if ( isset( Intense()->options['intense_active_cpt'][ $custom_post_type['option_name'] ] ) && Intense()->options['intense_active_cpt'][ $custom_post_type['option_name'] ] ) {
					$post_types[ strtolower( $class_name ) ] = $class_name;
				}
			}
			
			$post_types['intense_post_type_post'] = "Intense_Post_Type_Post";
			
			return $post_types;
		}
		
		function is_type_enabled( $type ) {
			$post_type = $this->get_post_type( $type );
			
			if ( isset( $post_type ) ) {
				return true;
			} else {
				return false;
			}
		}
		
		function get_post_type( $type ) {
			if ( false === $post_type = wp_cache_get( 'Intense_Post_Types::get_post_type_' . $type ) ) {
				$post_type = null;
				$type      = str_replace( "intense_post_type_", "", strtolower( $type ) );
				$class     = "Intense_Post_Type_" . ucfirst( str_replace( 'intense_', '', $type ) );
				
				if ( isset( Intense()->post_type_list[ $class ] ) ) {
					$post_type = new $class;
				}
				
				wp_cache_add( 'Intense_Post_Types::get_post_type_' . $type, $post_type );
			}
			
			return $post_type;
		}
		
		public static function register() {
			
			$post_types = Intense_Post_Types::list_post_types();
			
			foreach ( $post_types as $key => $value ) {
				$custom_post_type = Intense()->post_types->get_post_type( $key );
				$custom_post_type->register();
			}
		}
		
		public static function register_all() {
			foreach ( Intense()->post_type_list as $class_name => $custom_post_type ) {
				$post_types[ strtolower( $class_name ) ] = $class_name;
				$custom_post_type                        = Intense()->post_types->get_post_type( $class_name );
				$custom_post_type->register();
			}
		}
		
		public static function get_title( $title ) {
			
			$screen    = get_current_screen();
			$type      = $screen->post_type;
			$post_type = Intense()->post_types->get_post_type( $type );
			
			if ( isset( $post_type ) ) {
				$title = $post_type->title;
			}
			
			return $title;
		}
		
		public static function content_single( $single_template ) {
			global $post;
			
			require INTENSE_PLUGIN_FOLDER . '/custom-post-types/templates/templates.php';
			
			$post_type = Intense()->post_types->get_post_type( get_post_type() );
			
			if ( is_single() && ! is_page() && ! empty( $post_type ) && get_post_type() != 'intense_templates' ) {
				$postTypeType    = $post_type->type;
				$template_folder = $postTypeType;
				
				if ( $postTypeType == 'intense_post' ) {
					$template_folder = 'post';
				} elseif ( $postTypeType == 'product' ) {
					$postTypeType = 'products';
				} elseif ( $postTypeType == 'download' ) {
					$postTypeType = 'downloads';
				}
				
				if ( get_field( $postTypeType . '_single_template' ) != '' ) {
					$template = get_field( 'intense_' . str_replace( 'intense_', '', get_post_type() ) . '_single_template' );
				} else if ( isset( Intense()->options[ 'intense_cpt_' . str_replace( 'intense_', '', $postTypeType ) . '_single' ] ) ) {
					$template = Intense()->options[ 'intense_cpt_' . str_replace( 'intense_', '', $postTypeType ) . '_single' ];
				} else {
					$template = null;
				}
				
				// if the template is numeric then it is a templates that they have saved in WordPress
				if ( is_numeric( str_replace( "template_", "", $template ) ) ) {
					$template_post  = get_post( str_replace( "template_", "", $template ) );
					$found_template = Intense_Post_Type_Templates::get_template_cache( $template_post->ID );
				} else {
					$found_template = intense_locate_plugin_template( '/custom-post/' . $template_folder . '/single/' . $template . '.php' );
				}
				
				if ( ! empty( $found_template ) ) {
					$single_template = $found_template;
				}
				
				// If you aren't in the loop then setup post data.
				if ( ! in_the_loop() ) {
					setup_postdata( $post );
				}
			}
			
			return $single_template;
		}
	}
	*/
}
