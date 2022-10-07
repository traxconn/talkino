<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'talkino',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Register string translation for wpml.
	 *
	 * @since    1.1.5
	 */
	public function register_wpml_string_translation() {

		// Editable text.
		do_action( 'wpml_register_single_string', 'talkino', 'Chatbox Online Subtitle', get_option( 'talkino_chatbox_online_subtitle' ) );
		do_action( 'wpml_register_single_string', 'talkino', 'Chatbox Away Subtitle', get_option( 'talkino_chatbox_away_subtitle' ) );
		do_action( 'wpml_register_single_string', 'talkino', 'Chatbox Offline Subtitle', get_option( 'talkino_chatbox_offline_subtitle' ) );
		do_action( 'wpml_register_single_string', 'talkino', 'Agent Not Available Message', get_option( 'talkino_agent_not_available_message' ) );
		do_action( 'wpml_register_single_string', 'talkino', 'Offline Message', get_option( 'talkino_offline_message' ) );

	}

}
