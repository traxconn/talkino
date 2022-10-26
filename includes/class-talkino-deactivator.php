<?php
/**
 * Fired during plugin deactivation.
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
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @todo This should probably be in one "Setup" Class together with Activator class.
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Deactivator {

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
	public static function deactivate() {

		if ( false === self::get_request() || false === self::validate_request( self::$plugin ) || false === self::check_caps() ) {
			if ( isset( $_REQUEST['plugin'] ) ) {
				if ( ! check_admin_referer( 'deactivate-plugin_' . self::$request['plugin'] ) ) {
					exit;
				}

			} elseif ( isset( $_REQUEST['checked'] ) ) {
				if ( ! check_admin_referer( 'bulk-plugins' ) ) {
					exit;
				}
			}
		}

		/**
		 * The plugin is now safely deactivated.
		 * Perform deactivation actions here.
		 */

		// Call the function to unregister custom post type.
		self::unregister_custom_post_type();

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
				if ( false !== wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) ), 'deactivate-plugin_' . sanitize_text_field( wp_unslash( $_REQUEST['plugin'] ) ) ) ) {

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
	 * @param     string $plugin The Plugin folder/name.php.
	 *
	 * @return    bool    Return false if either plugin or action does not match, else true.
	 */
	private static function validate_request( $plugin ) {

		if ( isset( self::$request['plugin'] ) && $plugin === self::$request['plugin'] && 'deactivate' === self::$request['action'] ) {
			return true;

		} elseif ( isset( self::$request['plugins'] ) && 'deactivate-selected' === self::$request['action'] && in_array( $plugin, self::$request['plugins'], true ) ) {
			return true;
		}

		return false;

	}

	/**
	 * Check Capabilities.
	 *
	 * Ensure no one else but users with activate_plugins or above to be able to active this plugin.
	 *
	 * @since    1.0.0
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
	 * Unregister post type when deactivate plugin.
	 *
	 * @since    1.0.0
	 */
	private static function unregister_custom_post_type() {

		// Unregister the post type, so the rules are no longer in memory.
		unregister_post_type( 'talkino_agents' );

		// Clear the permalinks to remove post type's rules from the database.
		flush_rewrite_rules();

	}

}

