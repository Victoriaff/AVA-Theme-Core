<?php

if ( ! class_exists( 'AVA_Team_PostType' ) ) {
	
	class AVA_Team_PostType extends AVA_PostType {
		
		function __construct( $options = array() ) {
			
			$name_singular = ( isset( $options['name_singular'] ) ? $options['name_singular'] : __( 'Member', '{domain}' ) );
			$name_plural   = ( isset( $options['name_plural'] ) ? $options['name_plural'] : __( 'Team', '{domain}' ) );
			
			$this->type                  = 'ava_team';
			$this->module                = 'team';
			
			$this->title                 = 'Enter ' . $name_singular . ' Name';
			$this->singular              = $name_singular;
			$this->plural                = $name_plural;
			$this->menu_icon             = 'dashicons-groups';
			$this->hierarchical          = true;
			$this->rewrite               = array( 'slug' => strtolower( $this->singular ) );
			
			$this->category_taxonomy_key = 'faq_category';
			
			$this->taxonomies            = array(
				array(
					'key'      => 'ava_team_position',
					'singular' => __( 'Position', '{domain}' ),
					'plural'   => __( 'Positions', '{domain}' )
				),
				array(
					'key'      => 'ava_team_skills',
					'singular' => __( 'Skill', '{domain}' ),
					'plural'   => __( 'Skills', '{domain}' )
				)
			);
			
			$this->fields                = array(
				/*
				array(
					'key'           => 'field_1g67080h615k7h0',
					'label'         => __( 'Single Post Template', '{domain}' ),
					'name'          => 'intense_team_single_template',
					'type'          => 'select',
					'choices'       => array_merge(
						array( '' => '' ),
						intense_locate_available_plugin_templates( '/custom-post/intense_team/single/' ),
						intense_locate_single_cpt_templates( 'team', true )
					),
					'default_value' => '',
					'allow_null'    => 0,
					'multiple'      => 0,
				),
				*/
				array(
					'key'           => 'field_52d0e73f47bd5',
					'label'         => __( 'Member Title', '{domain}' ),
					'name'          => 'intense_member_title',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_54iku6y3f47bd5',
					'label'         => __( 'Member Role', '{domain}' ),
					'name'          => 'intense_member_role',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'                => 'field_52t727b1gy3lp',
					'label'              => __( 'Member Photo', '{domain}' ),
					'name'               => 'intense_member_photo',
					'type'               => 'image',
					'column_width'       => 40,
					'save_format'        => 'object',
					'preview_size'       => 'thumbnail',
					'library'            => 'all',
					'is_post_type_image' => 1
				),
				array(
					'key'           => 'field_52d0e7c647bd7',
					'label'         => __( 'Image Shadow', '{domain}' ),
					'name'          => 'intense_member_image_shadow',
					'type'          => 'select',
					'choices'       => array(
						1  => 1,
						2  => 2,
						3  => 3,
						4  => 4,
						5  => 5,
						6  => 6,
						7  => 7,
						8  => 8,
						9  => 9,
						10 => 10,
						11 => 11,
						12 => 12,
						13 => 13,
						14 => 14,
					),
					'default_value' => '',
					'allow_null'    => 1,
					'multiple'      => 0,
				),
				array(
					'key'           => 'field_56asg761ec9ac1eb',
					'label'         => __( 'Employer', 'intense' ),
					'name'          => 'intense_member_employer',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_58juh9c9ac1eb',
					'label'         => __( 'Address', 'intense' ),
					'name'          => 'intense_member_address',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52fhyt5481mh',
					'label'         => __( 'Email', '{domain}' ),
					'name'          => 'intense_member_email',
					'type'          => 'email',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52h6lop0912hn',
					'label'         => __( 'Personal Phone', 'intense' ),
					'name'          => 'intense_member_personal_phone',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52h6lomi761trg',
					'label'         => __( 'Office Phone', 'intense' ),
					'name'          => 'intense_member_office_phone',
					'type'          => 'text',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_50pokib9ac1ef',
					'label'         => __( 'Website', 'intense' ),
					'name'          => 'intense_member_website',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e80c47bd8',
					'label'         => __( 'Facebook', '{domain}' ),
					'name'          => 'intense_member_facebook',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e8d947bd9',
					'label'         => __( 'Google Plus', '{domain}' ),
					'name'          => 'intense_member_googleplus',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e90047bda',
					'label'         => __( 'Twitter', '{domain}' ),
					'name'          => 'intense_member_twitter',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e87ahtrg53',
					'label'         => __( 'Instagram', '{domain}' ),
					'name'          => 'intense_member_instagram',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e0po72ed1q',
					'label'         => __( 'Youtube', '{domain}' ),
					'name'          => 'intense_member_youtube',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e91947bdb',
					'label'         => __( 'Dribbble', '{domain}' ),
					'name'          => 'intense_member_dribbble',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'           => 'field_52d0e93947bdc',
					'label'         => __( 'Linked In', '{domain}' ),
					'name'          => 'intense_member_linkedin',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array(
					'key'          => 'field_52d0e96147bdd',
					'label'        => __( 'Custom Social Icon', '{domain}' ),
					'name'         => 'intense_member_custom_social_icon',
					'type'         => 'image',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
				),
				array(
					'key'           => 'field_52d0e99c47bde',
					'label'         => __( 'Custom Social Icon Link', '{domain}' ),
					'name'          => 'intense_member_custom_social_link',
					'type'          => 'intense_url',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
			);
		}
	}
}
