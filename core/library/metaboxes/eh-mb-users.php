<?php 

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category Engine Hosting
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'eh_users_mtb');
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function eh_users_mtb( array $meta_boxes ) {
	global $eh_core;
    
    $countries = !empty($eh_core) ? $eh_core::$countries:array();

	$meta_boxes[] = array(
		'id'            => 'user_edit',
		'title'         => esc_html__( 'User Profile', 'engine-hosting' ),
		'pages'         => array( 'user' ), 
		'show_names'    => true,
		'spotter_styles' 	=> true, 
		'class'			=> 'user-profiles',
		'fields'        => array(
			array(
				'name'     => esc_html__( 'Extra User Info', 'engine-hosting' ),
				'id'       => '_eh_user_' . 'extra_info',
				'type'     => 'title',
				'on_front' => false,
			),
			/*
			array(
				'name'    => esc_html__( 'Avatar', 'engine-hosting' ),
				'id'      => '_eh_user_' . 'avatar',
				'type'    => 'file',
				'save_id' => true,
				'allow' => array( 'url', 'attachment' )
			),
            */
			
            array(
				'name'    => esc_html__( 'Country', 'engine-hosting' ),
				'id'      => '_eh_user_' . 'country',
				'type'    => 'select',
                'options' => array('' => __('Select country', 'engine-hosting')) + $countries
			),
            
			array(
				'name' => esc_html__( 'State', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'state',
				'type' => 'text',
			),
			
			array(
				'name' => esc_html__( 'City', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'city',
				'type' => 'text',
			),
			
			array(
				'name' => esc_html__( 'Address', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'address',
				'type' => 'text',
			),
			
			array(
				'name' => esc_html__( 'ZIP', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'zip',
				'type' => 'text',
			),
			/*
			array(
				'name' => esc_html__( 'Additional Address Line', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'add_address',
				'type' => 'text',
			),
			*/
			
            /*
			array(
				'name' => esc_html__( 'Facebook URL', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'facebookurl',
				'type' => 'text_url',
			),
			
			array(
				'name' => esc_html__( 'Twitter URL', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'twitterurl',
				'type' => 'text_url',
			),
			
			array(
				'name' => esc_html__( 'Google+ URL', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'googleplusurl',
				'type' => 'text_url',
			),
			
			array(
				'name' => esc_html__( 'Linkedin URL', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'linkedinurl',
				'type' => 'text_url',
			),
			
			array(
				'name' => esc_html__( 'Pinterest URL', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'pinteresturl',
				'type' => 'text_url',
			),
            */
			
			array(
				'name' => esc_html__( 'Phone', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'tel',
				'type' => 'text_medium',
			),
			
			array(
				'name' => esc_html__( 'Mobile', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'mob',
				'type' => 'text_medium',
			),
			
            /*
			array(
				'name' => esc_html__( 'Skype', 'engine-hosting' ),
				'id'   => '_eh_user_' . 'skype',
				'type' => 'text_medium',
			),
            */
            /*
			array(
				'id'      => '_eh_user_' . 'package_id',
				'name'    => esc_html__( 'Current package', 'engine-hosting' ),
				'subname'	=> esc_html__('We do not recommend to change the package, it can cause conflict to members and membership system', 'engine-hosting'),
				'type'    => 'select',
				'options' => $arr_packages,
			)
            */
			
		)
	);
	
	return $meta_boxes;
	
}	