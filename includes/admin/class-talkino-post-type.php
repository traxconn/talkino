<?php
/**
 * The admin area to handle custom post type of the plugin.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin area to handle custom post type of the plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Post_Type {

	/**
	 * Create the custom post type
	 *
	 * @since    1.0.0
	 */
	public function create_custom_post_type() {

		$labels = array(
			'name'                  => esc_html_x( 'Agents', 'Name of the post type shown in the title', 'talkino' ),
			'singular_name'         => esc_html__( 'Agent', 'talkino' ),
			'menu_name'             => esc_html__( 'Talkino', 'talkino' ),
			'name_admin_bar'        => esc_html__( 'Talkino', 'talkino' ),
			'add_new'               => esc_html__( 'Add New', 'talkino' ),
			'add_new_item'          => esc_html__( 'Add New Agent', 'talkino' ),
			'new_item'              => esc_html__( 'New Agent', 'talkino' ),
			'edit_item'             => esc_html__( 'Edit Agent', 'talkino' ),
			'view_item'             => esc_html__( 'View Agent', 'talkino' ),
			'view_items'            => esc_html__( 'View Agents', 'talkino' ),
			'all_items'             => esc_html__( 'All Agents', 'talkino' ),
			'search_items'          => esc_html__( 'Search Agents', 'talkino' ),
			'not_found'             => esc_html__( 'No Agents Found', 'talkino' ),
			'not_found_in_trash'    => esc_html__( 'No Agents found in Trash', 'talkino' ),
			'featured_image'        => esc_html__( 'Agent image', 'talkino' ),
			'set_featured_image'    => esc_html__( 'Set agent image with ratio of 1:1', 'talkino' ),
			'remove_featured_image' => esc_html__( 'Remove agent image', 'talkino' ),
			'use_featured_image'    => esc_html__( 'Use as agent image', 'talkino' ),
			'insert_into_item'      => esc_html__( 'Insert into agent', 'talkino' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this agent', 'talkino' ),
		);

		$args = array(
			'label'                 => esc_html_x( 'Agents', 'Name of the post type shown in the menu', 'talkino' ),
			'labels'                => $labels,
			'description'           => '',
			'public'                => false,
			'hierarchical'          => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_nav_menus'     => false,
			'show_in_admin_bar'     => false, 
			'show_in_rest'          => true,
			'rest_base'             => '',
			'rest_controller_class' => 'WP_REST_Posts_Controller',
			'menu_icon'             => 'dashicons-format-chat',
			'capability_type'       => 'post',
			'map_meta_cap'          => true,
			'supports'              => array( 'title', 'thumbnail' ),
			'has_archive'           => false,
			'rewrite'               => array(
				'slug'       		=> 'talkino_agents',
				'with_front' 		=> false,
			),
			'query_var'             => false,
			'delete_with_user'      => false,
			'show_in_graphql'       => false,
		);

		// Register the agent post type.
		register_post_type( 'talkino_agents', $args );

		// Clear the permalinks after the post type has been registered.
		flush_rewrite_rules();

	}

}
