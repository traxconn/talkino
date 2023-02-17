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

		wp_enqueue_style( 'talkino-frontend', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/css/talkino-frontend.css', array(), $this->version, 'all' );

		// Enqueue dashicons for chatbox.
		wp_enqueue_style( 'dashicons' );
	
	}

	/**
	 * Register the JavaScript for the frontend side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'talkino-frontend', plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/js/talkino-frontend.js', array( 'jquery' ), $this->version, true );

		// Ajax script for frontend and pass the Google Analytics data.
		$ajax_url = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'talkino-frontend', 'talkino_frontend_ajax_object', $ajax_url );

	}

}
