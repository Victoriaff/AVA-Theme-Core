<?php

/**
  * Heading Shortcode
**/

// Map VC shortcode
//require_once 'config.php';

class AVA_Team_Shortcode extends AVA_Shortcode_Core {
	
	public $shortcode = 'ava_team';
	
	public function content( $atts, $content = null ) {
		return 'SC content';
	}
}

/*
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_eh_Team extends WPBakeryShortCode {

		protected function content( $atts, $content = null ) {

			$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

			if (!empty($atts['el_id'])) {
				$id = 'shortcode-' . $atts['el_id'];
			} else {
				$id='';
			}

			// Get data
			$args = array(
				'post_type'     => 'team',
				'post_status'   => 'publish',
				'meta_key'      => '_member_order',
				'orderby'       => 'meta_value_num',
				'order'         => 'ASC',
				'posts_per_page' => 1000
			);
			$list = new WP_Query( $args );
			//dd($list);
			$list = $list->posts;
			wp_reset_query();

			//dump($list);

			if (!empty($list)) {
				foreach ( $list as $key => $post ) {

					// Get member category
					$terms = wp_get_post_terms( $post->ID, 'team_cat' );

					// Get meta data
					$q = get_post_meta( $post->ID );
					$meta = array(
						'member_position' => is_array($terms) && !empty($terms[0]) ? $terms[0]->name:'',
						'member_link'    => !empty($q['_member_link'][0]) ? $q['_member_link'][0]:'',
						'member_order'=> !empty($q['_member_order'][0]) ? $q['_member_order'][0]:1,
					);
					$list[$key]->meta = $meta;

					// Get thumbnail data
					$thumbnail = array('url' => '', 'alt' => '');
					if (!empty($q['_thumbnail_id'][0])) {
						$thumb = get_post_meta( $q['_thumbnail_id'][0] );
						$thumbnail['url'] = !empty($thumb['_wp_attached_file'][0]) ? wp_upload_dir()['baseurl'].'/'.$thumb['_wp_attached_file'][0]:'';
						$thumbnail['alt'] = !empty($thumb['_wp_attachment_image_alt'][0]) ? $thumb['_wp_attachment_image_alt'][0]:'';
					}
					$list[$key]->thumbnail = $thumbnail;
				}
			}

			// Shortcode data to output
			$data = array(
				'id' => $id,
				'atts' => $atts,
				'content' => $content,
				'list' => $list,
				'wpb' => $this
			);

			//dd($data);

			return apply_filters( 'load_shortcode_tpl', 'view', $data, dirname( __FILE__ ).'/view/' );

		}

	}
}
*/

