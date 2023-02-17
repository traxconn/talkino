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

	if ( get_option( 'talkino_data_uninstall_status' ) === 'on' ) {

		// Remove plugin custom post type and post meta.
		$all_agents = get_posts(
			array(
				'post_type'   => 'talkino_agents',
				'numberposts' => -1,
			)
		);

		foreach ( $all_agents as $each_agent ) {
			wp_delete_post( $each_agent->ID, true );
		}

		// Remove plugin settings.
		// Global options.
		delete_option( 'talkino_version' );

		// Settings options.
		delete_option( 'talkino_chatbox_activation' );
		delete_option( 'talkino_global_online_status' );
		delete_option( 'talkino_global_schedule_online_status' );
		delete_option( 'talkino_chatbox_online_subtitle' );
		delete_option( 'talkino_chatbox_away_subtitle' );
		delete_option( 'talkino_chatbox_offline_subtitle' );
		delete_option( 'talkino_offline_message' );
		delete_option( 'talkino_chatbox_button_text' );
		delete_option( 'talkino_chatbox_exclude_pages' );

		// Styles options.
		delete_option( 'talkino_chatbox_layout' );
		delete_option( 'talkino_chatbox_style' );
		delete_option( 'talkino_chatbox_position' );
		delete_option( 'talkino_chatbox_icon' );
		delete_option( 'talkino_chatbox_animation' );
		delete_option( 'talkino_start_chat_method' );
		delete_option( 'talkino_chatbox_z_index' );
		delete_option( 'talkino_chatbox_online_theme_color' );
		delete_option( 'talkino_chatbox_online_icon_color' );
		delete_option( 'talkino_chatbox_away_theme_color' );
		delete_option( 'talkino_chatbox_away_icon_color' );
		delete_option( 'talkino_chatbox_offline_theme_color' );
		delete_option( 'talkino_chatbox_offline_icon_color' );
		delete_option( 'talkino_chatbox_background_color' );
		delete_option( 'talkino_chatbox_title_color' );
		delete_option( 'talkino_chatbox_subtitle_color' );
		delete_option( 'talkino_chatbox_button_color' );
		delete_option( 'talkino_chatbox_button_text_color' );
		delete_option( 'talkino_bubble_background_color' );
		delete_option( 'talkino_contact_form_notice_text_color' );
		delete_option( 'talkino_google_recaptcha_notice_text_color' );
		delete_option( 'talkino_google_recaptcha_link_text_color' );
		delete_option( 'talkino_credit_text_color' );
		delete_option( 'talkino_agent_field_background_color' );
		delete_option( 'talkino_agent_field_hover_background_color' );
		delete_option( 'talkino_agent_name_text_color' );
		delete_option( 'talkino_agent_job_title_text_color' );
		delete_option( 'talkino_agent_channel_text_color' );

		// Ordering options.
		delete_option( 'talkino_channel_ordering' );

		// Display options.
		delete_option( 'talkino_show_on_post' );
		delete_option( 'talkino_show_on_search' );
		delete_option( 'talkino_show_on_404' );
		delete_option( 'talkino_show_on_woocommerce_pages' );
		delete_option( 'talkino_show_on_desktop' );
		delete_option( 'talkino_show_on_mobile' );
		delete_option( 'talkino_user_visibility' );
		delete_option( 'talkino_show_offline_agents' );
		delete_option( 'talkino_activate_country_block' );
		delete_option( 'talkino_country_restriction' );

		// Integration options.
		delete_option( 'talkino_typebot_status' );
		delete_option( 'talkino_typebot_link' );
		delete_option( 'talkino_ga_status' );
		delete_option( 'talkino_ga_measurement' );
		delete_option( 'talkino_ga_api' );

		// Contact Form options.
		delete_option( 'talkino_contact_form_status' );
		delete_option( 'talkino_email_recipient' );
		delete_option( 'talkino_email_subject' );
		delete_option( 'talkino_sender_message' );
		delete_option( 'talkino_sender_name' );
		delete_option( 'talkino_sender_email' );
		delete_option( 'talkino_sender_phone' );
		delete_option( 'talkino_success_email_message' );
		delete_option( 'talkino_fail_email_message' );
		delete_option( 'talkino_recaptcha_status' );
		delete_option( 'talkino_recaptcha_site_key' );
		delete_option( 'talkino_recaptcha_secret_key' );

		// Advanced options.
		delete_option( 'talkino_reset_settings_status' );
		delete_option( 'talkino_data_uninstall_status' );
		delete_option( 'talkino_credit' );
		delete_option( 'talkino_report_storage_duration' );
		delete_option( 'talkino_receive_weekly_report' );

		// Admin plugin review notice options.
		delete_option( 'talkino_activation_time' );
		delete_option( 'talkino_dismiss_plugin_review_notice' );

		// Remove database table.
		global $wpdb;
    	$table_name = $wpdb->prefix . 'talkino_log'; 
    	$sql = "DROP TABLE IF EXISTS $table_name";
		
    	$result = $wpdb->query( $sql );

	}

}

tkn_uninstall();
