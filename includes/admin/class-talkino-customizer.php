<?php
/**
 * The admin area to customize admin part of plugin.
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
 * The admin area to customize admin part of plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Customizer {

	/**
	 * Hide 'save draft', 'preview button', 'visibility field', 'quick edit' and 'view' for agent post type
	 *
	 * @since    1.0.0
	 */
	public function hide_buttons_on_post_type() {

		global $current_screen;

		if ( 'talkino_agents' === $current_screen->post_type ) {

			echo '<style>
                #save-action, #visibility, #post-preview {
                    display:none;
                }
                </style>';

		}

	}

	/**
	 * Remove 'quick edit' and 'view' for agent post type at the list.
	 *
	 * @since    1.0.0
	 * @param    string[] $actions    An array of row action links.
	 * @param    WP_Post  $post      Post object.
	 */
	public function remove_actions_on_post_type( $actions, $post ) {

		if ( 'talkino_agents' === $post->post_type ) {

			unset( $actions['inline hide-if-no-js'] );
			unset( $actions['view'] );

		}

		return $actions;
	}

	/**
	 * Change the title's placeholder of custom post type.
	 *
	 * @since     1.0.0
	 * @param     string $title    The title of placeholder.
	 *
	 * @return    string    The new title of placeholder.
	 */
	public function change_title_text( $title ) {

		$screen = get_current_screen();

		if ( 'talkino_agents' === $screen->post_type ) {
			$title = esc_html__( 'Enter agent\'s name', 'talkino' );
		}

		return $title;

	}

	/**
	 * Change the notification message of custom post type.
	 *
	 * @since     1.0.0
	 * @param     string $messages    The notification message of custom post type.
	 *
	 * @return    string    The updated notification message.
	 */
	public function edit_post_updated_messages( $messages ) {

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['talkino_agents'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => esc_html__( 'Agent updated. Please clear your cache if you are using any caching plugin.', 'talkino' ),
			2  => esc_html__( 'Agent field updated.', 'talkino' ),
			3  => esc_html__( 'Agent field deleted.', 'talkino' ),
			4  => esc_html__( 'Agent updated.', 'talkino' ),
			5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Agent restored to revision from %s', 'talkino' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => esc_html__( 'Agent published. Please clear your cache if you are using any caching plugin.', 'talkino' ),
			7  => esc_html__( 'Agent saved.', 'talkino' ),
			8  => esc_html__( 'Agent submitted.', 'talkino' ),
			9  => sprintf( esc_html__( 'Agent scheduled for: <strong>%1$s</strong>.', 'talkino' ), date_i18n( esc_html( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
			10 => esc_html__( 'Agent draft updated.', 'talkino' ),
		);

		return $messages;

	}

	/**
	 * Change the notification message on bulk of custom post type.
	 *
	 * @since     1.0.0
	 * @param     array[] $bulk_messages    Arrays of messages.
	 * @param     int[]   $bulk_counts      Array of item counts for each message.
	 *
	 * @return    array[]    Arrays of messages.
	 */
	public function edit_bulk_post_updated_messages( $bulk_messages, $bulk_counts ) {

		$bulk_messages['talkino_agents'] = array(
			'updated'   => _n( '%s agent updated.', '%s agents updated.', $bulk_counts['updated'], 'talkino' ),
			'locked'    => _n( '%s agent not updated, somebody is editing it.', '%s agents not updated, somebody is editing them.', $bulk_counts['locked'], 'talkino' ),
			'deleted'   => _n( '%s agent permanently deleted.', '%s agents permanently deleted.', $bulk_counts['deleted'], 'talkino'),
			'trashed'   => _n( '%s agent moved to the Trash. Please clear your cache if you are using any caching plugin.', '%s agents moved to the Trash. Please clear your cache if you are using any cache plugin.', $bulk_counts['trashed'], 'talkino' ),
			'untrashed' => _n( '%s agent restored from the Trash.', '%s agents restored from the Trash.', $bulk_counts['untrashed'], 'talkino' ),
		);

		return $bulk_messages;

	}

	/**
	 * Add links to plugins page
	 *
	 * @since    2.0.0
	 * @param    array $links    current plugin links.
	 * 
	 * @return   array    $links    new plugin links. 
	 */
	public function add_plugin_links( $links ) {

		$links['add_new_agent'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( admin_url() . "post-new.php?post_type=talkino_agents" ),
			esc_html__( 'Add New Agent', 'talkino' )
		);

		$links['plugin_settings'] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( admin_url() . "edit.php?post_type=talkino_agents&page=talkino_settings_page" ),
			esc_html__( 'Settings', 'talkino' )
		);

		$links['premium'] = sprintf(
			'<a href="%1$s" target="_blank" style="font-weight:bold; color:#f9603a; ">%2$s</a>',
			esc_url( "https://traxconn.com/plugins/talkino" ),
			esc_html__( 'Premium', 'talkino' )
		);

		return $links;

	}

}
