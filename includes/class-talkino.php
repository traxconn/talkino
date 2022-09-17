<?php
/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * frontend side of the site and the admin area.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * frontend site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since     1.0.0
	 * @access    protected
	 * @var       Talkino_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since     1.0.0
	 * @access    protected
	 * @var       string       $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The unique prefix of this plugin.
	 *
	 * @since     1.0.0
	 * @access    protected
	 * @var       string       $plugin_prefix    The string used to uniquely prefix technical functions of this plugin.
	 */
	protected $plugin_prefix;

	/**
	 * The current version of the plugin.
	 *
	 * @since     1.0.0
	 * @access    protected
	 * @var       string       $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the frontend side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		if ( defined( 'TALKINO_VERSION' ) ) {

			$this->version = TALKINO_VERSION;

		} else {

			$this->version = '1.0.0';

		}

		$this->plugin_name = 'talkino';
		$this->plugin_prefix = 'tkn_';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_frontend_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function load_dependencies() {

		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-talkino-loader.php';

		// The class responsible for defining internationalization functionality of the plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-talkino-i18n.php';

		// The class responsible for loading template file of the plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-talkino-file-loader.php';
		
		// The class to handle log of the plugin.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-talkino-logger.php';

		// The class responsible for defining all actions that occur in the admin area.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-post-type.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/meta-boxes/class-talkino-meta-boxes.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-tools.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/admin/class-talkino-sanitizer.php';
		
		// The class responsible for defining all actions that occur in the frontend side of the site.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-talkino-frontend.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-talkino-chatbox.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-talkino-agent-manager.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/frontend/class-talkino-utility.php';

		$this->loader = new Talkino_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Talkino_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function set_locale() {

		$plugin_i18n = new Talkino_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality of the plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function define_admin_hooks() {

		// Declare all the classes objects.
		$talkino_admin = new Talkino_Admin( $this->get_plugin_name(), $this->get_plugin_prefix(), $this->get_version() );
		$talkino_post_type = new Talkino_Post_Type();
		$talkino_meta_boxes = new Talkino_Meta_Boxes();
		$talkino_customizer = new Talkino_Customizer();
		$talkino_settings = new Talkino_Settings();

		// Enqueue all the scripts and stylesheets.
		$this->loader->add_action( 'admin_enqueue_scripts', $talkino_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $talkino_admin, 'enqueue_scripts' );

		// Register hook to create custom post type.
		$this->loader->add_action( 'init', $talkino_post_type, 'create_custom_post_type' );

		// Register hook to create meta boxes.
		$this->loader->add_action( 'add_meta_boxes_talkino_agents', $talkino_meta_boxes, 'add_meta_boxes' );

		// Register hook to save meta box data.
		$this->loader->add_action( 'save_post', $talkino_meta_boxes, 'save_meta_box', 10, 2 );

		// Register hook to hide 'save draft', 'preview button', 'visibility field', 'quick edit' and 'view' for agent post type.
        $this->loader->add_action( 'admin_head', $talkino_customizer, 'hide_buttons_on_post_type' );

        // Register hook to remove 'quick edit' and 'view' for agent post type at the list.
		$this->loader->add_filter( 'post_row_actions', $talkino_customizer, 'remove_actions_on_post_type', 10, 2 );

		// Register hook to change the title's placeholder of custom post type.
		$this->loader->add_filter( 'enter_title_here', $talkino_customizer, 'change_title_text' );

		// Register hook to change the notification message of custom post type.
		$this->loader->add_filter( 'post_updated_messages', $talkino_customizer, 'edit_post_updated_messages' );

		// Register hook to change the notification message on bulk of custom post type.
		$this->loader->add_filter( 'bulk_post_updated_messages', $talkino_customizer, 'edit_bulk_post_updated_messages', 10, 2 );

		// Register hook to create settings of submenu page 
		$this->loader->add_action( 'admin_menu', $talkino_settings, 'create_settings_submenu_page' );

        // Register settings section and fields
		$this->loader->add_action( 'admin_init', $talkino_settings, 'settings_init' );

		// Register hook to process contact ordering via ajax actions.
		$this->loader->add_action( 'wp_ajax_talkino_update_contact_order_list', $talkino_settings, 'talkino_update_contact_order_list' ); 

		// Register hook to process agent ordering via ajax actions.
		$this->loader->add_action( 'wp_ajax_talkino_update_agent_order_list', $talkino_settings, 'talkino_update_agent_order_list' ); 

	}

	/**
	 * Register all of the hooks related to the frontend functionality of the plugin.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function define_frontend_hooks() {

		$talkino_frontend = new Talkino_Frontend( $this->get_plugin_name(), $this->get_plugin_prefix(), $this->get_version() );
		$talkino_chatbox = new Talkino_Chatbox();

		$this->loader->add_action( 'wp_enqueue_scripts', $talkino_frontend, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $talkino_frontend, 'enqueue_scripts' );

		// Register hook to initialize chatbox.
		$this->loader->add_filter( 'wp_head', $talkino_chatbox, 'chatbox_init' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since    1.0.0
	 * 
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The unique prefix of the plugin used to uniquely prefix technical functions.
	 *
	 * @since    1.0.0
	 * 
	 * @return    string    The prefix of the plugin.
	 */
	public function get_plugin_prefix() {
		return $this->plugin_prefix;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since    1.0.0
	 * 
	 * @return    Talkino_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since    1.0.0
	 * 
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
