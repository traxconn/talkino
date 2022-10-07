<?php
/**
 * The frontend functionality of the plugin.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The frontend functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks to
 * enqueue the frontend stylesheet and JavaScript.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Frontend {

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
	 * @param    string $plugin_name      The name of the plugin.
	 * @param    string $plugin_prefix    The unique prefix of this plugin.
	 * @param    string $version          The version of this plugin.
	 */
	public function __construct( $plugin_name, $plugin_prefix, $version ) {

		$this->plugin_name   = $plugin_name;
		$this->plugin_prefix = $plugin_prefix;
		$this->version       = $version;

	}

	/**
	 * Register the stylesheets for the frontend side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/css/talkino-frontend.css', array(), $this->version, 'all' );

		// Enqueue bootstrap and font awesome css for chatbox.
		wp_enqueue_style( 'bootstrap-min-css', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/bootstrap-5.2.1-dist/css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'fontawesome-min-css', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/fontawesome-free-6.2.0-web/css/all.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the frontend side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/js/talkino-frontend.js', array( 'jquery' ), $this->version, true );

		// Enqueue the google recaptcha script if google recaptcha settings are activated.
		if ( get_option( 'talkino_recaptcha_status' ) === 'on' && get_option( 'talkino_recaptcha_site_key' ) !== '' && get_option( 'talkino_recaptcha_secret_key' ) !== '' ) {
			wp_enqueue_script( 'google-recaptcha-js', '//www.google.com/recaptcha/api.js?render=' . get_option( 'talkino_recaptcha_site_key' ), array( 'jquery' ), $this->version, true );
		}

		// Pass $php_vars array to javascript as php object for contact form.
		$ajax_url = array(
			'ajax_url'                  => admin_url( 'admin-ajax.php' ),
			'activate_recaptcha_status' => get_option( 'talkino_recaptcha_status' ),
			'recaptcha_site_key'        => get_option( 'talkino_recaptcha_site_key' ),
			'recaptcha_secret_key'      => get_option( 'talkino_recaptcha_secret_key' ),
			'invalid_site_key_message'  => esc_html__( 'Invalid Google reCaptcha v3 site key!', 'talkino' ),
		);

		wp_localize_script( $this->plugin_name, 'ajax_object', $ajax_url );

	}

}
