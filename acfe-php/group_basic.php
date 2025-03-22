<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_basic',
	'title' => 'Basic',
	'fields' => array(
		array(
			'key' => 'field_67de726201dc5',
			'label' => 'Featured Image',
			'name' => 'profile_img',
			'aria-label' => '',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'uploader' => '',
			'return_format' => 'array',
			'library' => 'all',
			'acfe_thumbnail' => 1,
			'acfe_settings' => '',
			'acfe_validate' => array(
				'67de888b6b015' => array(
					'acfe_validate_location' => '',
					'acfe_validate_rules_and' => '',
					'acfe_validate_error' => '',
				),
			),
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
			'acfe_permissions' => array(
				0 => 'administrator',
				1 => 'editor',
				2 => 'author',
				3 => 'contributor',
			),
			'allow_in_bindings' => 0,
			'preview_size' => 'medium',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'all',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'field',
	'hide_on_screen' => array(
		0 => 'block_editor',
		1 => 'discussion',
		2 => 'comments',
		3 => 'revisions',
		4 => 'slug',
		5 => 'author',
		6 => 'format',
		7 => 'page_attributes',
		8 => 'featured_image',
		9 => 'categories',
		10 => 'tags',
		11 => 'send-trackbacks',
	),
	'active' => true,
	'description' => 'Guests, Features, Tickets, Partners, Pages, Taxonomy & Blog (temporary)',
	'show_in_rest' => 1,
	'acfe_display_title' => 'basic',
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_permissions' => array(
		0 => 'administrator',
		1 => 'editor',
		2 => 'author',
		3 => 'contributor',
	),
	'acfe_form' => 1,
	'acfe_meta' => '',
	'acfe_note' => 'A starting off point to standardize all content',
	'modified' => 1742637316,
));

endif;