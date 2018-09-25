<?php

class AVA_Theme_Metaboxes {

	function __construct() {
		/**
		 * ACF plugin and add-ons 
		 */
		
		if( !class_exists('ACF') ) {
			add_filter( 'acf/settings/path', array( __CLASS__, 'acf_path' ), 200 );
			add_filter( 'acf/settings/dir', array( __CLASS__, 'acf_dir' ), 200 );
			add_filter( 'acf/settings/show_updates', array( __CLASS__, 'acf_show_updates' ), 200 );
			include_once( AVA_THEMECORE_DIR . '/vendor/advanced-custom-fields-pro/acf.php' );
		}

		/*
		if ( !class_exists( 'acf_field_rgba_color' ) ) {
			include_once( INTENSE_PLUGIN_FOLDER . '/inc/plugins/acf-rgba-color/acf-rgba-color-v5.php' );
		}
		*/

		//$showACF = isset( Intense()->options['intense_show_acf']) ? Intense()->options['intense_show_acf'] : "0";
		//$show_media_box = ( isset( Intense()->options['intense_show_featured_media_metabox'] ) ? Intense()->options['intense_show_featured_media_metabox'] : 1 );
		$show_media_box = 1;
		//$defaultVideoType = ( isset( Intense()->options['intense_featured_video_type'] ) ? Intense()->options['intense_featured_video_type'] : '' );
		$defaultVideoType = '';
		//$defaultImageType = ( isset( Intense()->options['intense_featured_image_type'] ) ? Intense()->options['intense_featured_image_type'] : 'standard' );
		$defaultImageType = 'standard';

		/*
		if ( $showACF === '0' ) {
			define( 'ACF_LITE' , true );
		}
		*/

		if ( $show_media_box ) {
			if ( function_exists( "register_field_group" ) ) {
				register_field_group(array (
					'id' => 'acf_intense_featured-media',
					'title' => 'Featured Media',
					'fields' => array (
						array (
							'key' => 'field_54ax7327ko5yd',
							'label' => 'Gallery',
							'name' => '',
							'type' => 'tab',
							'placement' => 'left'
						),
						array (
							'key' => 'field_54acba1d5bea7',
							'label' => 'Featured Gallery',
							'name' => 'intense_featured_gallery',
							'type' => 'gallery',
							'preview_size' => 'thumbnail',
							'library' => 'all',
						),
						
						array (
							'key' => 'field_54ab7245ee55b',
							'label' => 'Gallery Image Options',
							'name' => '',
							'type' => 'tab',
							'placement' => 'left'
						),
						array (
							'key' => 'field_52d03acda142f',
							'label' => __( 'Image Type', 'intense' ),
							'name' => 'intense_featured_image_type',
							'type' => 'select',
							'choices' => array (
								'standard' => 'Standard',
								'picstrip' => 'Picstrip',
								'caman' => 'Caman',
								'adipoli' => 'Adipoli',
							),
							'default_value' => $defaultImageType,
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52d03b15a1430',
							'label' => __( 'Shadow', 'intense' ),
							'name' => 'intense_image_shadow',
							'type' => 'select',
							'choices' => array (
								1 => 1,
								2 => 2,
								3 => 3,
								4 => 4,
								5 => 5,
								6 => 6,
								7 => 7,
								8 => 8,
								9 => 9,
								10 => 10,
								11 => 11,
								12 => 12,
								13 => 13,
								14 => 14,
							),
							'default_value' => '',
							'allow_null' => 1,
							'multiple' => 0,
						),
						array (
							'key' => 'field_5461a9e74fdca',
							'label' => 'Hover Effect Type',
							'name' => 'intense_hover_effect_type',
							'type' => 'select',
							'choices' => array (
								'effeckt' => 'Effeckt',
								'subtle' => 'Subtle',
							),
							'default_value' => '',
							'allow_null' => 1,
							'multiple' => 0,
						),
						array (
							'key' => 'field_5461aa9c4fdcb',
							'label' => 'Subtle Hover Effect',
							'name' => 'intense_subtle_hover_effect',
							'type' => 'select',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_5461a9e74fdca',
										'operator' => '==',
										'value' => 'subtle',
									),
								),
								'allorany' => 'all',
							),
							'choices' => array (
								'none' => 'None',
								'apollo' => 'Apollo',
								'bubba' => 'Bubba',
								'chico' => 'Chico',
								'dexter' => 'Dexter',
								'duke' => 'Duke',
								'goliath' => 'Goliath',
								'hera' => 'Hera',
								'honey' => 'Honey',
								'jazz' => 'Jazz',
								'julia' => 'Julia',
								'kira' => 'Kira',
								'layla' => 'Layla',
								'lexi' => 'Lexi',
								'lily' => 'Lily',
								'marley' => 'Marley',
								'milo' => 'Milo',
								'ming' => 'Ming',
								'moses' => 'Moses',
								'oscar' => 'Oscar',
								'phoebe' => 'Phoebe',
								'romeo' => 'Romeo',
								'roxy' => 'Roxy',
								'ruby' => 'Ruby',
								'sadie' => 'Sadie',
								'sarah' => 'Sarah',
								'selena' => 'Selena',
								'steve' => 'steve',
								'terry' => 'Terry',
								'winston' => 'Winston',
								'zoe' => 'Zoe'
							),
							'default_value' => '',
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52dj3b6fa1430',
							'label' => __( 'Effeckt Hover Effect', 'intense' ),
							'name' => 'intense_hover_effect',
							'type' => 'select',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '!=',
										'value' => 'adipoli',
									),
									array (
										'field' => 'field_5461a9e74fdca',
										'operator' => '==',
										'value' => 'effeckt',
									),
								),
								'allorany' => 'any',
							),
							'choices' => array (
								0 => 'None',
								1 => 'Appear',
								2 => 'Slide Up',
								3 => 'Sqkwoosh',
								4 => 'Slide Side',
								5 => 'Cover',
								6 => 'Fall In',
								7 => 'Two-Step',
								8 => 'Move',
								9 => 'Scale',
								10 => 'Flip',
							),
							'default_value' => '',
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52d03ce87ef5f',
							'label' => __( 'Effect Color', 'intense' ),
							'name' => 'intense_effect_color',
							'type' => 'color_picker',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52dj3b6fa1430',
										'operator' => '!=',
										'value' => '0',
									),
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '!=',
										'value' => 'adipoli',
									),
									array (
										'field' => 'field_5461a9e74fdca',
										'operator' => '==',
										'value' => 'effeckt',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => '#000000',
						),
						array (
							'key' => 'field_52d03e442dd87',
							'label' => __( 'Effect Opacity', 'intense' ),
							'name' => 'intense_effect_opacity',
							'type' => 'number',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52dj3b6fa1430',
										'operator' => '!=',
										'value' => '0',
									),
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '!=',
										'value' => 'adipoli',
									),
									array (
										'field' => 'field_5461a9e74fdca',
										'operator' => '==',
										'value' => 'effeckt',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => 80,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
						array (
							'key' => 'field_52d03f0972b11',
							'label' => __( 'Caman Effect', 'intense' ),
							'name' => 'intense_caman_effect',
							'type' => 'select',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'caman',
									),
								),
								'allorany' => 'all',
							),
							'choices' => array (
								'vintage' => 'Vintage',
								'lomo' => 'Lomo',
								'clarity' => 'Clarity',
								'sinCity' => 'Sin City',
								'sunrise' => 'Sunrise',
								'crossProcess' => 'Cross Process',
								'orangePeel' => 'Orange Peel',
								'love' => 'Love',
								'grungy' => 'Grungy',
								'jarques' => 'Jarques',
								'pinhole' => 'Pinhole',
								'oldBoot' => 'Old Boot',
								'glowingSun' => 'Glowing Sun',
								'hazyDays' => 'Hazy Days',
								'herMajesty' => 'Her Majesty',
								'nostalgia' => 'Nostalgia',
								'hemingway' => 'Hemingway',
								'concentrate' => 'Concentrate',
								'posterize' => 'Posterize',
								'emboss' => 'Emboss',
							),
							'default_value' => '',
							'allow_null' => 1,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52d040e7f8404',
							'label' => __( 'Start Effect', 'intense' ),
							'name' => 'intense_adipoli_start_effect',
							'type' => 'select',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'adipoli',
									),
								),
								'allorany' => 'all',
							),
							'choices' => array (
								'transparent' => 'Transparent',
								'normal' => 'Normal',
								'overlay' => 'Overlay',
								'grayscale' => 'Grayscale',
							),
							'default_value' => '',
							'allow_null' => 1,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52d0412ef8405',
							'label' => __( 'Hover Effect', 'intense' ),
							'name' => 'intense_adipoli_hover_effect',
							'type' => 'select',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'adipoli',
									),
								),
								'allorany' => 'all',
							),
							'choices' => array (
								'normal' => 'Normal',
								'popout' => 'Popout',
								'sliceDown' => 'Slice Down',
								'sliceDownLeft' => 'Slice Down Left',
								'sliceUp' => 'Slice Up',
								'sliceUpLeft' => 'Slice Up Left',
								'sliceUpRandom' => 'Slice Up Random',
								'sliceUpDown' => 'Slice Up Down',
								'sliceUpDownLeft' => 'Slice Up Down Left',
								'fold' => 'Fold',
								'foldLeft' => 'Fold Left',
								'boxRandom' => 'Box Random',
								'boxRain' => 'Box Rain',
								'boxRainReverse' => 'Box Rain Reverse',
								'boxRainGrow' => 'Box Rain Grow',
								'boxRainGrowReverse' => 'Box Rain Grow Reverse',
							),
							'default_value' => '',
							'allow_null' => 1,
							'multiple' => 0,
						),
						array (
							'key' => 'field_52d041adf8406',
							'label' => __( 'Splits', 'intense' ),
							'name' => 'intense_picstrip_splits',
							'type' => 'number',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'picstrip',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => 5,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => 1,
							'max' => 20,
							'step' => 1,
						),
						array (
							'key' => 'field_52d041e1f8407',
							'label' => __( 'Horizontal Gutter', 'intense' ),
							'name' => 'intense_picstrip_hgutter',
							'type' => 'number',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'picstrip',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => 10,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => 1,
							'max' => 150,
							'step' => 1,
						),
						array (
							'key' => 'field_52d0421ff8408',
							'label' => __( 'Vertical Gutter', 'intense' ),
							'name' => 'intense_picstrip_vgutter',
							'type' => 'number',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_52d03acda142f',
										'operator' => '==',
										'value' => 'picstrip',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => 5,
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => 1,
							'max' => 150,
							'step' => 1,
						),
						array (
							'key' => 'field_54ab7327ee55d',
							'label' => 'Audio',
							'name' => '',
							'type' => 'tab',
							'placement' => 'left'
						),
						array (
							'key' => 'field_57156e72h8b5h',
							'label' => __( 'Audio URL', 'intense' ),
							'name' => 'intense_featured_audio_url',
							'type' => 'text',
							'instructions' => __( 'Enter the URL to the audio.', 'intense' ),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'html',
							'maxlength' => '',
						),
						array (
							'key' => 'field_54gy7327ej568',
							'label' => 'Video',
							'name' => '',
							'type' => 'tab',
							'placement' => 'left'
						),
						array (
							'key' => 'field_531568d8f4b89',
							'label' => __( 'Type', 'intense' ),
							'name' => 'intense_featured_video_type',
							'type' => 'select',
							'required' => 0,
							'choices' => array (
								'' => 'Select a video type',
								'wordpress' => __( 'WordPress', 'intense' ),
								'bliptv' => __( 'Blip.tv', 'intense' ),
								'collegehumor' => __( 'College Humor', 'intense' ),
								'flickr' => __( 'Flickr', 'intense' ),
								'funnyordie' => __( 'FunnyOrDie.com', 'intense' ),
								'hulu' => __( 'Hulu', 'intense' ),
								'qik' => __( 'Qik', 'intense' ),
								'revision3' => __( 'Revision3', 'intense' ),
								'screenr' => __( 'Screenr', 'intense' ),
								'ted' => __( 'Ted', 'intense' ),
								'viddler' => __( 'Viddler', 'intense' ),
								'vimeo' => __( 'Vimeo', 'intense' ),
								'wordpresstv' => __( 'WordPress.tv', 'intense'),
								'youtube' => __( 'YouTube', 'intense' ),
							),
							'default_value' => $defaultVideoType,
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_53156da5f4b90',
							'label' => __( 'Video Size', 'intense' ),
							'name' => 'intense_featured_video_size',
							'type' => 'select',
							'choices' => array (
								'auto' => __( 'Auto', 'intense' ),
								'wide' => __( 'Wide (16:9)', 'intense' ),
								'standard' => __( 'Standard (4:3)', 'intense' ),
								'square' => __( 'Square (1:1)', 'intense' ),
							),
							'default_value' => '',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '!=',
										'value' => '',
									),
								),
								'allorany' => 'all',
							),
							'allow_null' => 0,
							'multiple' => 0,
						),
						array (
							'key' => 'field_53156a81f4b8c',
							'label' => __( 'Poster Image', 'intense' ),
							'name' => 'intense_featured_video_poster_image',
							'type' => 'image',
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '==',
										'value' => 'wordpress',
									),
								),
								'allorany' => 'all',
							),
							'save_format' => 'id',
							'preview_size' => 'thumbnail',
							'library' => 'all',
						),
						array (
							'key' => 'field_53156af9f4b8d',
							'label' => __( 'MP4 Video', 'intense' ),
							'name' => 'intense_featured_video_mp4',
							'type' => 'file',
							'instructions' => __( 'Select an MP4 video from your media library.', 'intense' ),
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '==',
										'value' => 'wordpress',
									),
								),
								'allorany' => 'all',
							),
							'save_format' => 'url',
							'library' => 'all',
						),
						array (
							'key' => 'field_53156cf7f4b8e',
							'label' => __( 'OGV Video', 'intense' ),
							'name' => 'intense_featured_video_ogv',
							'type' => 'file',
							'instructions' => __( 'Select an OGV video from your media library.', 'intense' ),
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '==',
										'value' => 'wordpress',
									),
								),
								'allorany' => 'all',
							),
							'save_format' => 'url',
							'library' => 'all',
						),
						array (
							'key' => 'field_53156d00f4b8f',
							'label' => __( 'WebM Video', 'intense' ),
							'name' => 'intense_featured_video_webm',
							'type' => 'file',
							'instructions' => __( 'Select an WebM video from your media library.', 'intense' ),
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '==',
										'value' => 'wordpress',
									),
								),
								'allorany' => 'all',
							),
							'save_format' => 'url',
							'library' => 'all',
						),
						array (
							'key' => 'field_53156e72f4b91',
							'label' => __( 'Video URL', 'intense' ),
							'name' => 'intense_featured_video_url',
							'type' => 'text',
							'instructions' => __( 'Enter the URL to the video.', 'intense' ),
							'conditional_logic' => array (
								'status' => 1,
								'rules' => array (
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '!=',
										'value' => 'wordpress',
									),
									array (
										'field' => 'field_531568d8f4b89',
										'operator' => '!=',
										'value' => '',
									),
								),
								'allorany' => 'all',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'formatting' => 'html',
							'maxlength' => '',
						),
					),
					'location' => array (
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'post',
								'order_no' => 0,
								'group_no' => 0,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'page',
								'order_no' => 0,
								'group_no' => 1,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_clients',
								'order_no' => 0,
								'group_no' => 2,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_coupons',
								'order_no' => 0,
								'group_no' => 3,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_events',
								'order_no' => 0,
								'group_no' => 4,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_locations',
								'order_no' => 0,
								'group_no' => 5,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_news',
								'order_no' => 0,
								'group_no' => 6,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_portfolio',
								'order_no' => 0,
								'group_no' => 7,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_project',
								'order_no' => 0,
								'group_no' => 8,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_recipes',
								'order_no' => 0,
								'group_no' => 9,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'intense_team',
								'order_no' => 0,
								'group_no' => 10,
							),
						),
						array (
							array (
								'param' => 'post_type',
								'operator' => '==',
								'value' => 'download',
								'order_no' => 0,
								'group_no' => 10,
							),
						),
					),
					'options' => array (
						'position' => 'normal',
						'layout' => 'default',
						'hide_on_screen' => array (
						),
					),
					'menu_order' => 3,
				));
			}
		}
	}

	public static function acf_path( $setting ) {
	    return AVA_THEMECORE_DIR . '/vendor/advanced-custom-fields-pro/';
	}

	public static function acf_dir( $setting ) {
	    return AVA_THEMECORE_URL . '/vendor/advanced-custom-fields-pro/';
	}

	public static function acf_show_updates( $setting ) {
	    return false;
	}	
}
