<?php
/**
 * Fired during plugin activation.
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
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @todo This should probably be in one class together with Deactivator Class.
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Activator {

	/**
	 * The $_REQUEST during plugin activation.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       array      $request    The $_REQUEST array during plugin activation.
	 */
	private static $request = array();

	/**
	 * The $_REQUEST['plugin'] during plugin activation.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       string     $plugin    The $_REQUEST['plugin'] value during plugin activation.
	 */
	private static $plugin = TALKINO_BASE_NAME;

	/**
	 * Activate the plugin.
	 *
	 * Checks if the plugin was (safely) activated.
	 * Place to add any custom action during plugin activation.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( false === self::get_request() || false === self::validate_request( self::$plugin ) || false === self::check_caps() ) {
			if ( isset( $_REQUEST['plugin'] ) ) {
				if ( ! check_admin_referer( 'activate-plugin_' . self::$request['plugin'] ) ) {
					exit;
				}

			} elseif ( isset( $_REQUEST['checked'] ) ) {
				if ( ! check_admin_referer( 'bulk-plugins' ) ) {
					exit;
				}
			}
		}

		/**
		 * The plugin is now safely activated.
		 * Perform activation actions here.
		 */

		// Call the function to add plugin default data.
		self::add_plugin_default_data();

		// Call the function to add plugin installation time.
		self::save_plugin_activation_time();

	}

	/**
	 * Get the request.
	 *
	 * Gets the $_REQUEST array and checks if necessary keys are set.
	 * Populates self::request with necessary and sanitized values.
	 *
	 * @since     1.0.0
	 *
	 * @return    bool|array    Return false or self::$request array.
	 */
	private static function get_request() {

		if ( ! empty( $_REQUEST ) && isset( $_REQUEST['_wpnonce'] ) && isset( $_REQUEST['action'] ) ) {
			if ( isset( $_REQUEST['plugin'] ) ) {
				if ( false !== wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ), 'activate-plugin_' . sanitize_text_field( wp_unslash( $_REQUEST['plugin'] ) ) ) ) {

					self::$request['plugin'] = sanitize_text_field( wp_unslash( $_REQUEST['plugin'] ) );
					self::$request['action'] = sanitize_text_field( wp_unslash( $_REQUEST['action'] ) );

					return self::$request;

				}

			} elseif ( isset( $_REQUEST['checked'] ) ) {
				if ( false !== wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ), 'bulk-plugins' ) ) {

					self::$request['action']  = sanitize_text_field( wp_unslash( $_REQUEST['action'] ) );
					self::$request['plugins'] = array_map( 'sanitize_text_field', wp_unslash( $_REQUEST['checked'] ) );

					return self::$request;
					
				}
			}

		} else {
			return false;
		}

	}

	/**
	 * Validate the Request data.
	 *
	 * Validates the $_REQUESTed data is matching this plugin and action.
	 *
	 * @since     1.0.0
	 * @param     string $plugin    The Plugin folder/name.php.
	 *
	 * @return    bool    Return false if either plugin or action does not match, else true.
	 */
	private static function validate_request( $plugin ) {

		if ( isset( self::$request['plugin'] ) && $plugin === self::$request['plugin'] && 'activate' === self::$request['action'] ) {
			return true;

		} elseif ( isset( self::$request['plugins'] ) && 'activate-selected' === self::$request['action'] && in_array( $plugin, self::$request['plugins'], true ) ) {
			return true;
		}

		return false;

	}

	/**
	 * Check Capabilities.
	 *
	 * Ensure no one else but users with activate_plugins or above to be able to active this plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    bool    Return false if no caps, else true.
	 */
	private static function check_caps() {

		if ( current_user_can( 'activate_plugins' ) ) {
			return true;
		}

		return false;

	}

	/**
	 * Add plugin default data if these options do not exist.
	 *
	 * @since    1.0.0
	 */
	private static function add_plugin_default_data() {

		// Global options.
		// Add talkino version if it does not exist.
		if ( get_option( 'talkino_version' ) === false ) {
			add_option( 'talkino_version', '1.2' );
		}

		// Settings options.
		// Add chatbox activation if it does not exist.
		if ( get_option( 'talkino_chatbox_activation' ) === false ) {
			add_option( 'talkino_chatbox_activation', 'active' );
		}

		// Add global online status if it does not exist.
		if ( get_option( 'talkino_global_online_status' ) === false ) {
			add_option( 'talkino_global_online_status', 'online' );
		}

		// Add global schedule data if they do not exist.
		if ( get_option( 'talkino_global_schedule_online_status' ) === false ) {

			$global_schedule_online_status_data = array(
				'monday_online_status'    => 'on',
				'tuesday_online_status'   => 'on',
				'wednesday_online_status' => 'on',
				'thursday_online_status'  => 'on',
				'friday_online_status'    => 'on',
				'saturday_online_status'  => 'on',
				'sunday_online_status'    => 'on',
				'monday_start_time'       => '00:00',
				'monday_end_time'         => '23:30',
				'tuesday_start_time'      => '00:00',
				'tuesday_end_time'        => '23:30',
				'wednesday_start_time'    => '00:00',
				'wednesday_end_time'      => '23:30',
				'thursday_start_time'     => '00:00',
				'thursday_end_time'       => '23:30',
				'friday_start_time'       => '00:00',
				'friday_end_time'         => '23:30',
				'saturday_start_time'     => '00:00',
				'saturday_end_time'       => '23:30',
				'sunday_start_time'       => '00:00',
				'sunday_end_time'         => '23:30',
			);

			add_option( 'talkino_global_schedule_online_status', $global_schedule_online_status_data );

		}

		// Add chatbox online subtitle if it does not exist.
		if ( get_option( 'talkino_chatbox_online_subtitle' ) === false ) {
			add_option( 'talkino_chatbox_online_subtitle', 'Let\'s get started to chat with us!' );
		}

		// Add chatbox away subtitle if it does not exist.
		if ( get_option( 'talkino_chatbox_away_subtitle' ) === false ) {
			add_option( 'talkino_chatbox_away_subtitle', 'We are currently away!' );
		}

		// Add chatbox offline subtitle if it does not exist.
		if ( get_option( 'talkino_chatbox_offline_subtitle' ) === false ) {
			add_option( 'talkino_chatbox_offline_subtitle', 'Thank you for getting in touch. We are currently out of the office.' );
		}

		// Add offline message if it does not exist.
		if ( get_option( 'talkino_offline_message' ) === false ) {
			add_option( 'talkino_offline_message', 'Sorry, there is no agent available.' );
		}

		// Add chatbox button text if it does not exist.
		if ( get_option( 'talkino_chatbox_button_text' ) === false ) {
			add_option( 'talkino_chatbox_button_text', 'Chat Now' );
		}

		// Styles options.
		// Add chatbox style data if it does not exist.
		if ( get_option( 'talkino_chatbox_style' ) === false ) {
			add_option( 'talkino_chatbox_style', 'round' );
		}

		// Add chatbox position data if it does not exist.
		if ( get_option( 'talkino_chatbox_position' ) === false ) {
			add_option( 'talkino_chatbox_position', 'right' );
		}

		// Add chatbox icon data if it does not exist.
		if ( get_option( 'talkino_chatbox_icon' ) === false ) {
			add_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );
		}

		// Add chatbox animation data if it does not exist.
		if ( get_option( 'talkino_chatbox_animation' ) === false ) {
			add_option( 'talkino_chatbox_animation', 'fadein' );
		}

		// Add start chat method if it does not exist.
		if ( get_option( 'talkino_start_chat_method' ) === false ) {
			add_option( 'talkino_start_chat_method', '_blank' );
		}

		// Add chatbox z-index if it does not exist.
		if ( get_option( 'talkino_chatbox_z_index' ) === false ) {
			add_option( 'talkino_chatbox_z_index', '9999999' );
		}

		// Add chatbox theme color for online status if it does not exist.
		if ( get_option( 'talkino_chatbox_online_theme_color' ) === false ) {
			add_option( 'talkino_chatbox_online_theme_color', '#1e73be' );
		}

		// Add chatbox icon color for online status if it does not exist.
		if ( get_option( 'talkino_chatbox_online_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_online_icon_color', '#fff' );
		}

		// Add chatbox theme color for away status if it does not exist.
		if ( get_option( 'talkino_chatbox_away_theme_color' ) === false ) {
			add_option( 'talkino_chatbox_away_theme_color', '#ff6000' );
		}

		// Add chatbox icon color for away status if it does not exist.
		if ( get_option( 'talkino_chatbox_away_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_away_icon_color', '#fff' );
		}

		// Add chatbox theme color for offline status if it does not exist.
		if ( get_option( 'talkino_chatbox_offline_theme_color' ) === false ) {
			add_option( 'talkino_chatbox_offline_theme_color', '#727779' );
		}

		// Add chatbox icon color for offline status if it does not exist.
		if ( get_option( 'talkino_chatbox_offline_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_offline_icon_color', '#fff' );
		}

		// Add chatbox background color if it does not exist.
		if ( get_option( 'talkino_chatbox_background_color' ) === false ) {
			add_option( 'talkino_chatbox_background_color', '#f0f0f1' );
		}

		// Add chatbox title color if it does not exist.
		if ( get_option( 'talkino_chatbox_title_color' ) === false ) {
			add_option( 'talkino_chatbox_title_color', '#fff' );
		}

		// Add chatbox subtitle color if it does not exist.
		if ( get_option( 'talkino_chatbox_subtitle_color' ) === false ) {
			add_option( 'talkino_chatbox_subtitle_color', '#000' );
		}

		// Add chatbox button color if it does not exist.
		if ( get_option( 'talkino_chatbox_button_color' ) === false ) {
			add_option( 'talkino_chatbox_button_color', '#727779' );
		}

		// Add chatbox button text color if it does not exist.
		if ( get_option( 'talkino_chatbox_button_text_color' ) === false ) {
			add_option( 'talkino_chatbox_button_text_color', '#fff' );
		}

		// Add contact form notice text color if it does not exist.
		if ( get_option( 'talkino_contact_form_notice_text_color' ) === false ) {
			add_option( 'talkino_contact_form_notice_text_color', '#008000' );
		}

		// Add google recaptcha notice text color if it does not exist.
		if ( get_option( 'talkino_google_recaptcha_notice_text_color' ) === false ) {
			add_option( 'talkino_google_recaptcha_notice_text_color', '#000' );
		}

		// Add google recaptcha link text color if it does not exist.
		if ( get_option( 'talkino_google_recaptcha_link_text_color' ) === false ) {
			add_option( 'talkino_google_recaptcha_link_text_color', '#0000ff' );
		}

		// Add credit text color if it does not exist.
		if ( get_option( 'talkino_credit_text_color' ) === false ) {
			add_option( 'talkino_credit_text_color', '#888' );
		}

		// Add agent field background color if it does not exist.
		if ( get_option( 'talkino_agent_field_background_color' ) === false ) {
			add_option( 'talkino_agent_field_background_color', '#fff' );
		}

		// Add agent field hover background color if it does not exist.
		if ( get_option( 'talkino_agent_field_hover_background_color' ) === false ) {
			add_option( 'talkino_agent_field_hover_background_color', '#dfdfdf' );
		}
		
		// Add agent name text color if it does not exist.
		if ( get_option( 'talkino_agent_name_text_color' ) === false ) {
			add_option( 'talkino_agent_name_text_color', '#222' );
		}

		// Add agent job title text color if it does not exist.
		if ( get_option( 'talkino_agent_job_title_text_color' ) === false ) {
			add_option( 'talkino_agent_job_title_text_color', '#888' );
		}

		// Add agent channel text color if it does not exist.
		if ( get_option( 'talkino_agent_channel_text_color' ) === false ) {
			add_option( 'talkino_agent_channel_text_color', '#888' );
		}
				
		// Ordering options.
		// Add agent ordering if it does not exist.
		if ( get_option( 'talkino_channel_ordering' ) === false ) {
			add_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );
		}

		// Display options.
		// Add show on post data if it does not exist.
		if ( get_option( 'talkino_show_on_post' ) === false ) {
			add_option( 'talkino_show_on_post', 'on' );
		}

		// Add show on search data if it does not exist.
		if ( get_option( 'talkino_show_on_search' ) === false ) {
			add_option( 'talkino_show_on_search', 'on' );
		}

		// Add show on 404 data if it does not exist.
		if ( get_option( 'talkino_show_on_404' ) === false ) {
			add_option( 'talkino_show_on_404', 'on' );
		}

		// Add show on woocommerce shop, product, product category and tag pages data if it does not exist.
		if ( get_option( 'talkino_show_on_woocommerce_pages' ) === false ) {
			add_option( 'talkino_show_on_woocommerce_pages', 'on' );
		}

		// Add show on desktop data if it does not exist.
		if ( get_option( 'talkino_show_on_desktop' ) === false ) {
			add_option( 'talkino_show_on_desktop', 'on' );
		}

		// Add show on mobile data if it does not exist.
		if ( get_option( 'talkino_show_on_mobile' ) === false ) {
			add_option( 'talkino_show_on_mobile', 'on' );
		}

		// Add user visibility data if it does not exist.
		if ( get_option( 'talkino_user_visibility' ) === false ) {
			add_option( 'talkino_user_visibility', 'all' );
		}

		// Contact Form options.
		// Add contact form status if it does not exist.
		if ( get_option( 'talkino_contact_form_status' ) === false ) {
			add_option( 'talkino_contact_form_status', 'off' );
		}

		// Add email recipient if it does not exist.
		if ( get_option( 'talkino_email_recipient' ) === false ) {
			add_option( 'talkino_email_recipient', get_option( 'admin_email' ) );
		}

		// Add email subject if it does not exist.
		if ( get_option( 'talkino_email_subject' ) === false ) {
			add_option( 'talkino_email_subject', 'Message from Contact Form' );
		}

		// Add sender message if it does not exist.
		if ( get_option( 'talkino_sender_message' ) === false ) {
			add_option( 'talkino_sender_message', '%%message%%' );
		}

		// Add sender name if it does not exist.
		if ( get_option( 'talkino_sender_name' ) === false ) {
			add_option( 'talkino_sender_name', 'From: %%sender_name%%' );
		}

		// Add sender email if it does not exist.
		if ( get_option( 'talkino_sender_email' ) === false ) {
			add_option( 'talkino_sender_email', 'Sender\'s Email: %%sender_email%%' );
		}

		// Add successful email sent message if it does not exist.
		if ( get_option( 'talkino_success_email_message' ) === false ) {
			add_option( 'talkino_success_email_message', 'Email has been successfully sent out.' );
		}

		// Add failed email sent message if it does not exist.
		if ( get_option( 'talkino_fail_email_message' ) === false ) {
			add_option( 'talkino_fail_email_message', 'Email has been failed to sent out.' );
		}

		// Add recaptcha status if it does not exist.
		if ( get_option( 'talkino_recaptcha_status' ) === false ) {
			add_option( 'talkino_recaptcha_status', 'off' );
		}

		// Add recaptcha site key if it does not exist.
		if ( get_option( 'talkino_recaptcha_site_key' ) === false ) {
			add_option( 'talkino_recaptcha_site_key', '' );
		}

		// Add recaptcha secret key if it does not exist.
		if ( get_option( 'talkino_recaptcha_secret_key' ) === false ) {
			add_option( 'talkino_recaptcha_secret_key', '' );
		}

		// Credit options.
		// Add credit data if it does not exist.
		if ( get_option( 'talkino_credit' ) === false ) {
			add_option( 'talkino_credit', 'on' );
		}

		// Advanced options.
		// Add reset settings status data if it does not exist.
		if ( get_option( 'talkino_reset_settings_status' ) === false ) {
			add_option( 'talkino_reset_settings_status', 'off' );
		}

		// Add data uninstall status if it does not exist.
		if ( get_option( 'talkino_data_uninstall_status' ) === false ) {
			add_option( 'talkino_data_uninstall_status', 'off' );
		}

	}

	/**
	 * The function to save the plugin activation time.
	 *
	 * @since    1.1.5
	 */
	private static function save_plugin_activation_time() {

		$activation_time = strtotime( 'now' );
		add_option( 'talkino_activation_time', $activation_time );

	}

}

