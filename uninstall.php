<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - Check if the $_REQUEST['plugin'] content actually is talkino/talkino.php
 * - Check if the $_REQUEST['action'] content actually is delete-plugin
 * - Run a check_ajax_referer check to make sure it goes through authentication
 * - Run a current_user_can check to make sure current user can delete a plugin
 *
 * @todo Consider multisite. Once for a single site in the network, once sitewide.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Perform Uninstall Actions.
 *
 * If uninstall not called from WordPress,
 * If no uninstall action,
 * If not this plugin,
 * If no caps,
 * then exit.
 *
 * @since    1.0.0
 */
function tkn_uninstall() {

	if ( ! defined( 'WP_UNINSTALL_PLUGIN' )
		|| empty( $_REQUEST )
		|| ! isset( $_REQUEST['plugin'] )
		|| ! isset( $_REQUEST['action'] )
		|| 'talkino/talkino.php' !== $_REQUEST['plugin']
		|| 'delete-plugin' !== $_REQUEST['action']
		|| ! check_ajax_referer( 'updates', '_ajax_nonce' )
		|| ! current_user_can( 'activate_plugins' )
	) {

		exit;

	}

	/**
	 * It is now safe to perform uninstall actions here.
	 */
	remove_plugin_data();

}

/**
 * Remove plugin data.
 *
 * @since    1.0.0
 */
function remove_plugin_data() {

	if ( get_option( 'talkino_data_uninstall_status' ) == 'on' ) {

		// Remove plugin custom post type and post meta.
		global $wpdb;
		$wpdb->query( "DELETE post, postmeta FROM {$wpdb->prefix}posts post
					INNER JOIN {$wpdb->prefix}postmeta postmeta ON postmeta.post_id = post.ID
					WHERE post.post_type= 'talkino_agents'" );

	    // Remove plugin settings.

		/************* Settings *************/
		delete_option( 'talkino_global_online_status' );
		delete_option( 'talkino_global_schedule_online_status' );
		delete_option( 'talkino_chatbox_online_subtitle' );
		delete_option( 'talkino_chatbox_away_subtitle' );
		delete_option( 'talkino_chatbox_offline_subtitle' );
		delete_option( 'talkino_agent_not_available_message' );
		delete_option( 'talkino_offline_message' );
		delete_option( 'talkino_chatbox_exclude_pages' );
		delete_option( 'talkino_show_on_post' );
		delete_option( 'talkino_show_on_search' );
		delete_option( 'talkino_show_on_woocommerce_pages' );
		
		/************* Styles *************/
		delete_option( 'talkino_chatbox_style' );
		delete_option( 'talkino_chatbox_position' );
		delete_option( 'talkino_show_on_desktop' );
		delete_option( 'talkino_show_on_mobile' );
		delete_option( 'talkino_start_chat_method' );
		delete_option( 'talkino_chatbox_online_theme_color' );
		delete_option( 'talkino_chatbox_away_theme_color' );
		delete_option( 'talkino_chatbox_offline_theme_color' );
		delete_option( 'talkino_chatbox_background_color' );
		delete_option( 'talkino_chatbox_title_color' );
		delete_option( 'talkino_chatbox_subtitle_color' );

		/************* Ordering *************/
		delete_option( 'talkino_channel_ordering' );

		/************* Contact Form *************/
		delete_option( 'talkino_contact_form_status' );
		delete_option( 'talkino_email_recipient' );
		delete_option( 'talkino_email_subject' );
		delete_option( 'talkino_sender_message' );
		delete_option( 'talkino_sender_name' );
		delete_option( 'talkino_sender_email' );
		delete_option( 'talkino_success_email_message' );
		delete_option( 'talkino_fail_email_message' );
		delete_option( 'talkino_recaptcha_status' );
		delete_option( 'talkino_recaptcha_site_key' );
		delete_option( 'talkino_recaptcha_secret_key' );

		/************* Advanced *************/
		delete_option( 'talkino_reset_settings_status' );
		delete_option( 'talkino_data_uninstall_status' );
		
	}
	
}

tkn_uninstall();
