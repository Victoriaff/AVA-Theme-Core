<?php

return array(
	'name' => esc_html__( 'Team Members', 'engine-hosting-core' ),
	'shortcode' => 'ava_team',
	'icon' => AVA_THEMECORE_URL.'32x32/team-section.png',
	'category' => esc_html__( 'Theme Elements', 'engine-hosting-core' ),
	'description' => esc_html__( 'Team members list', 'engine-hosting-core' ),
	'content_element' => true,
	'show_settings_on_create' => true,
	'params' => array(
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Heading', 'engine-hosting-core' ),
			'param_name' => 'heading',
			'admin_label' => true,
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Show members per row', 'engine-hosting-core' ),
			'param_name' => 'members_per_row',
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'CSS classes', 'engine-hosting-core' ),
			'param_name' => 'classes',
			'value' => '',
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'engine-hosting-core' ),
			'param_name' => 'el_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'group' => esc_html__('General', 'engine-hosting-core'),
			'description' => esc_html__( 'Unique identifier of this element', 'engine-hosting-core' ),
		),
	)
);


/*
vc_map( array(
	'name' => esc_html__( 'Team Members', 'engine-hosting-core' ),
	'base' => 'eh_team',
    'icon' => _EHICONS_URL_.'32x32/team-section.png',
	'category' => esc_html__( 'Theme Elements', 'engine-hosting-core' ),
	'description' => esc_html__( 'Team members list', 'engine-hosting-core' ),
    'content_element' => true,
    'show_settings_on_create' => true,
	'params' => array(

        array(
			'type' => 'textfield',
			'heading' => __( 'Heading', 'engine-hosting-core' ),
			'param_name' => 'heading',
			'admin_label' => true,
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
        array(
			'type' => 'textfield',
			'heading' => __( 'Show members per row', 'engine-hosting-core' ),
			'param_name' => 'members_per_row',
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
        array(
			'type' => 'textfield',
			'heading' => esc_html__( 'CSS classes', 'engine-hosting-core' ),
			'param_name' => 'classes',
			'value' => '',
			'group' => esc_html__('General', 'engine-hosting-core'),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'engine-hosting-core' ),
			'param_name' => 'el_id',
			'settings' => array(
				'auto_generate' => true,
			),
			'group' => esc_html__('General', 'engine-hosting-core'),
			'description' => esc_html__( 'Unique identifier of this element', 'engine-hosting-core' ),
		),
	)
));
*/
