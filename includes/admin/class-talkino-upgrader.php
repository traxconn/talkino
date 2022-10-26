<?php
/**
 * The admin area to handle upgrade functions.
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
 * The admin area to handle upgrade functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Upgrader {

	/**
	 * The function to upgrade plugin data.
	 *
	 * @since    1.0.3
	 */
	public function upgrade_plugin_data() {

		/********** Add new data **********/
		// Add chatbox activation if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_activation' ) === false ) {
			add_option( 'talkino_chatbox_activation', 'active' );
		}

		// Add chatbox button text if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_text' ) === false ) {
			add_option( 'talkino_chatbox_button_text', 'Chat Now' );
		}

		// Add chatbox animation if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_animation' ) === false ) {
			add_option( 'talkino_chatbox_animation', 'fadein' );
		}

		// Add chatbox z-index if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_z_index' ) === false ) {
			add_option( 'talkino_chatbox_z_index', '9999999' );
		}

		// Add chatbox icon color for online status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_online_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_online_icon_color', '#fff' );
		}

		// Add chatbox icon color for away status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_away_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_away_icon_color', '#fff' );
		}

		// Add chatbox icon color for offline status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_offline_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_offline_icon_color', '#fff' );
		}

		// Add chatbox button color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_color' ) === false ) {
			add_option( 'talkino_chatbox_button_color', '#727779' );
		}

		// Add chatbox button text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_text_color' ) === false ) {
			add_option( 'talkino_chatbox_button_text_color', '#fff' );
		}

		// Add agent field background color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_field_background_color' ) === false ) {
			add_option( 'talkino_agent_field_background_color', '#f0f0f1' );
		}

		// Add agent field hover background color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_field_hover_background_color' ) === false ) {
			add_option( 'talkino_agent_field_hover_background_color', '#dfdfdf' );
		}

		// Add agent name text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_name_text_color' ) === false ) {
			add_option( 'talkino_agent_name_text_color', '#222' );
		}

		// Add agent job title text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_job_title_text_color' ) === false ) {
			add_option( 'talkino_agent_job_title_text_color', '#888' );
		}

		// Add agent channel text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_channel_text_color' ) === false ) {
			add_option( 'talkino_agent_channel_text_color', '#888' );
		}

		// Add show on 404 data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_show_on_404' ) === false ) {
			add_option( 'talkino_show_on_404', 'on' );
		}

		// Add user visibility data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_user_visibility' ) === false ) {
			add_option( 'talkino_user_visibility', 'all' );
		}

		// Add credit data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_credit' ) === false ) {
			add_option( 'talkino_credit', 'on' );
		}

		/********** Update data based on plugin version **********/
		// Add talkino version data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_version' ) === false ) {

			add_option( 'talkino_version', '1.2' );
			update_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );
			update_option( 'talkino_global_online_status', strtolower( get_option( 'talkino_global_online_status' ) ) );


		} elseif ( get_option( 'talkino_version' ) === '1.1' ) {

			update_option( 'talkino_version', '1.2' );
			update_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );
			update_option( 'talkino_global_online_status', strtolower( get_option( 'talkino_global_online_status' ) ) );

		}

		/********** Remove deprecated data and add new replacement data **********/ 
		// Remove deprecated data of contact ordering.
		if ( get_option( 'talkino_contact_ordering' ) !== false ) {
			delete_option( 'talkino_contact_ordering' );

			// Add a new option of channel ordering.
			if ( get_option( 'talkino_channel_ordering' ) === false ) {
				add_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );
			}
		}

		/********** Remove deprecated data **********/
		// Remove deprecated data of chatbox height.
		if ( get_option( 'talkino_chatbox_height' ) !== false ) {
			delete_option( 'talkino_chatbox_height' );
		}

		// Remove deprecated data of load font awesome deferred.
		if ( get_option( 'talkino_load_font_awesome_deferred' ) !== false ) {
			delete_option( 'talkino_load_font_awesome_deferred' );
		}

	}

}
