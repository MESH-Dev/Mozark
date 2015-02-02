<?php

/*------------------------------------------------------------
         --------------Portfolio Type------------
------------------------------------------------------------*/
function secret_portfolio() 
{
	/*---Portfolio custom post ----*/
	register_post_type( 'portfolio_item',
		array(
			'labels' => array(
				'name' => __( 'Portfolio' ,'secretlang'),
				'singular_name' => __( 'Project' ,'secretlang'),
				'add_new' => __( 'Add New Project' ,'secretlang'),
				'add_new_item' => __( 'Add New Project' ,'secretlang'),
				'edit' => __( 'Edit Project','secretlang' ),
				'edit_item' => __( 'Edit Project','secretlang' ),
			),
			'description' => __( 'Portfolio Items.','secretlang' ),
			'public' => true,
			'supports' => array( 'title', 'editor','thumbnail','page-attributes'),
			'rewrite' => array( 'slug' => 'item', 'with_front' => false ),
			'has_archive' => true,
			'show_in_menu' => true,
			'menu_position' => 15,
			'capability_type' => 'post',
			'menu_icon' => 'dashicons-portfolio',
			'taxonomies' => array('post_tag') 
		)
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio_item' ),
	array( 'hierarchical' => true, 'label' => "Categories","singular_label" => "Category" ) );	
	    // register_taxonomy( 'post_tags', array( 'portfolio_item' ),
	    // 	array( 'hierarchical' => true, 'label' => "Tags","singular_label" => "Tag" ) );	

}
