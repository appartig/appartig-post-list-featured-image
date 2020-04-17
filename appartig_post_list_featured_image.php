<?php
	
	/*
		Plugin Name: AppArtig Post List Featured Image
		Description: Plugin for showing the featured image in the Post/Page Listview
		Version:     0.0.1
		Author:      AppArtig e.U.
		Author URI:  https://www.appartig.at
		License:     APPARTIG/AGB
		License URI: https://www.appartig.at/agb
		Text Domain: aafi
	*/


	/******************************************************
	** Defines
	******************************************************/

	define ("AAFI_THUMBNAIL_NAME", "aafi-featured-image-list-view");


	/******************************************************
	** Install
	******************************************************/

	register_activation_hook(__FILE__, function(){ });


	/******************************************************
	** Uninstall
	******************************************************/

	register_deactivation_hook(__FILE__, function(){ });


	/******************************************************
	** Add Thumbnail Size
	******************************************************/

	add_image_size(AAFI_THUMBNAIL_NAME, 180, 120, array('center', 'center'));


	/******************************************************
	** Add CSS for Column Width
	******************************************************/

	add_action('admin_head', function () 
	{
		echo '<style type="text/css"> .column-featured-image { width: 200px } </style>';
	});
	

	/******************************************************
	** Column Header
	******************************************************/

	add_filter( 'manage_page_posts_columns', 'aafi_add_column_header' );
	add_filter( 'manage_posts_columns', 'aafi_add_column_header' );

	function aafi_add_column_header ($columns)
	{

		$new_columns = array_slice($columns, 0, 1, true) + array("featured-image" => __( 'Bild', 'aafi' )) + array_slice($columns, 1, count($columns)-1, true);
		return $new_columns;
	}
		

	/******************************************************
	** Column Content
	******************************************************/

	add_action( 'manage_page_posts_custom_column', 'aafi_add_column_content', 10, 2  );
	add_action( 'manage_posts_custom_column', 'aafi_add_column_content', 10, 2  );

	function aafi_add_column_content ($column, $post_id)
	{
		echo get_the_post_thumbnail($post_id, AAFI_THUMBNAIL_NAME);
	}
