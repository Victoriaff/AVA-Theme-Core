<?php

/**
 * Utils
 **/
if ( ! class_exists( 'AVA_Utils' ) ) {
	
	class AVA_Utils {
		
		/**
		 * Load scripts
		 *
		 * @param $paths
		 */
		public static function loader( $dirs = array() ) {
			foreach($dirs as $dir) {
				$files = glob( AVA_THEMECORE_DIR . $dir . '/*.php' );
				foreach ( $files as $file ) {
					@require_once $file;
				}
			}
		}
		
		/**
		 * Get basename
		 *
		 * @param $filename
		 *
		 * @return string
		 */
		public static function basename( $filename ) {
			return preg_replace( '/^.+[\\\\\\/]/', '', $filename );
		}
		
		/**
		 * File exists
		 *
		 * @param $filename
		 *
		 * @return boolean
		 */
		public static function file_exists( $filename ) {
			return file_exists( $filename );
		}
	
		/**
		 * Get post categories list
		 **/
		public static function get_categories( $separator = ', ' ) {
			
			$post_type = get_post_type();
			
			switch ( $post_type ) {
				default:
				case 'post':
					return self::get_valid_category_list( $separator );
					break;
			}
			
		}
		
		/**
		 * Get valid categories list
		 **/
		public static function get_valid_category_list( $separator = ', ' ) {
			$s = str_replace( ' rel="category"', '', get_the_category_list( $separator ) );
			$s = str_replace( ' rel="category tag"', '', $s );
			
			return $s;
		}
		
		/**
		 * Get valid tags list
		 **/
		public static function get_valid_tags_list( $separator = ', ' ) {
			$s = str_replace( ' rel="tag"', '', get_the_tag_list( '', $separator, '' ) );
			
			return $s;
		}
		
		/**
		 * Make sure that Visual Composer is active
		 **/
		public static function is_vc() {
			return
				in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ||
				array_key_exists( 'js_composer/js_composer.php', get_site_option( 'active_sitewide_plugins' ) );
		}
		
		/**
		 * Make sure that Unyson Framework plugin is active
		 **/
		public static function is_unyson() {
			return in_array( 'unyson/unyson.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
		}
		
		/**
		 * Make sure that WooCommerce plugin is active
		 **/
		public static function is_woocommerce() {
			return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
		}
		
		/**
		 * Get array of menus
		 */
		public static function get_menus_list( $args = null ) {
			$menus = wp_get_nav_menus();
			
			$return = array();
			foreach ( $menus as $menu ) {
				$return[ $menu->name ] = $menu->slug;
			}
			
			return $return;
		}
		
		/**
		 * Get menu object by menu slug
		 */
		public static function get_menu_obj( $slug ) {
			$menus = wp_get_nav_menus();
			
			foreach ( $menus as $menu ) {
				if ( $menu->slug == $slug ) {
					return $menu;
				}
			}
			
			return null;
		}
		
		/**
		 * Get image URL by its attachment ID
		 */
		public static function get_attachment_data( $ids, $size = 'full' ) {
			$data = array();
			
			if ( ! empty( $ids ) ) {
				if ( ! is_array( $ids ) ) {
					$ids = array( $ids );
				}
				
				foreach ( $ids as $attachment_id ) {
					$url = wp_get_attachment_image_src( $attachment_id, $size );
					$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
					
					$data[] = array(
						'url' => ! empty( $url[0] ) ? $url[0] : '',
						'alt' => ! empty( $alt ) ? $alt : ''
					);
				}
			} else {
				return $data = array( array( 'url' => '', 'alt' => '' ) );
			}
			
			return $data;
		}
		
		/**
		 * Insert array into other array ( suppor assoc arrays )
		 *
		 * @param $array Source array
		 * @param $position Position ( key )
		 * @param $insert Inserted array
		 */
		public static function array_insert( $array, $position, $insert ) {
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
		
		/**
		 * Parse Link parameter
		 *
		 * @param $param
		 *
		 * @return array
		 */
		public static function parse_link( $param ) {
			$result = array( 'url' => '', 'title' => '', 'target' => '', 'rel' => '' );
			
			preg_match_all( '/([a-z]+):([^\|]+)/', $param, $p );
			
			foreach ( (array) $p[1] as $index => $value ) {
				$result[ $p[1][ $index ] ] = urldecode( $p[2][ $index ] );
			}
			
			return $result;
		}
		
	}
}
