<?php
/**
 * The admin-specific functionality of the plugin.
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
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the admin-facing stylesheet and JavaScript.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       string     $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The unique prefix of this plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       string     $plugin_prefix    The string used to uniquely prefix technical functions of this plugin.
	 */
	private $plugin_prefix;

	/**
	 * The version of this plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       string     $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name      The name of this plugin.
	 * @param    string $plugin_prefix    The unique prefix of this plugin.
	 * @param    string $version          The version of this plugin.
	 */
	public function __construct( $plugin_name, $plugin_prefix, $version ) {

		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version       = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook_suffix    The current admin page.
	 */
	public function enqueue_styles( $hook_suffix ) {

		global $current_screen;

		if ( 'talkino_agents' === $current_screen->post_type ) {

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/css/talkino-admin.css', array(), $this->version, 'all' );

			// Enqueue font awesome css for admin area.
			wp_enqueue_style( 'fontawesome-min-css', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/fontawesome-free-6.2.0-web/css/all.min.css', array(), '6.2.0', 'all' );

		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook_suffix    The current admin page.
	 */
	public function enqueue_scripts( $hook_suffix ) {

		global $current_screen;

		if ( 'talkino_agents' === $current_screen->post_type ) {

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/js/talkino-admin.js', array( 'jquery' ), $this->version, false );

			// Add the color picker css file.
			wp_enqueue_style( 'wp-color-picker' );

			// Make sure to add the wp-color-picker dependecy to js file.
			wp_enqueue_script( 'color-picker-js', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/js/color-picker.js', array( 'jquery', 'wp-color-picker' ), $this->version, true );

			// Enqueue jquery for sorting.
			wp_enqueue_script( 'jquery-ui-sortable', false, array( 'jquery-ui-core', 'jquery' ), $this->version, true );

			// Enqueue jquery for picking icon.
			wp_enqueue_script( 'icon_picker_js', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/js/icon-picker.js', array( 'jquery' ), $this->version, true );

			// Pass $php_vars array to javascript as php object for channel ordering.
			$ajax_url = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
			wp_localize_script( $this->plugin_name, 'ajax_object', $ajax_url );

		}

	}

}
