<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_notepad',
	'title' => 'Notepad',
	'fields' => array(
		array(
			'key' => 'field_67de742420e3e',
			'label' => 'Notes',
			'name' => 'notes',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => 'Notes dedicated to this page/post ONLY.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'acfe_textarea_code' => 0,
			'maxlength' => '',
			'allow_in_bindings' => 0,
			'rows' => 4,
			'placeholder' => 'Post code/seasonal content/tasks/ideas HERE',
			'new_lines' => '',
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
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'field',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => 'Notepad',
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_form' => 1,
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1742632265,
));

endif;