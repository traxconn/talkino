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

		// Remove deprecated data of chatbox height.
		if ( get_option( 'talkino_chatbox_height' ) === true ) {
			delete_option( 'talkino_chatbox_height' );
		}

		// Remove deprecated data of contact ordering.
		if ( get_option( 'talkino_contact_ordering' ) === true ) {
			delete_option( 'talkino_contact_ordering' );

			// Add a new option of channel ordering.
			if ( get_option( 'talkino_channel_ordering' ) === false ) {
				add_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );
			}
		}

		// Add talkino version data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_version' ) === false ) {
			add_option( 'talkino_version', '1.1' );
		}

		// Add chatbox icon data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_icon' ) === false ) {
			add_option( 'talkino_chatbox_icon', 'fa fa-comment' );
		}

		// Add chatbox button text if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_text' ) === false ) {
			add_option( 'talkino_chatbox_button_text', 'Chat Now' );
		}

		// Add load font awesome deferred data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_load_font_awesome_deferred' ) === false ) {
			add_option( 'talkino_load_font_awesome_deferred', 'on' );
		}

	}

}
