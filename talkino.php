<?php
/**
 * Main file of Talkino.
 *
 * @link              https://traxconn.com/
 * @since             1.0.0
 * @package           Talkino
 *
 * @wordpress-plugin
 * Plugin Name:       Talkino
 * Plugin URI:        https://traxconn.com/
 * Description:       Talkino allows you to integrate multi social messengers and contact into your website and enable your users to contact you using multi social messengers' accounts.
 * Version:           2.0.0
 * Author:            Traxconn
 * Requires at least: 4.9
 * Requires PHP:      7.3
 * Tested up to:      6.1
 * Author URI:        https://traxconn.com/user/traxconn/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       talkino
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'TALKINO_VERSION', '2.0.0' );

/**
 * Define the Plugin basename.
 */
define( 'TALKINO_BASE_NAME', plugin_basename( __FILE__ ) );

/**
 * Define the plugin directory path.
 */
define( 'TALKINO_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function tkn_activate() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-talkino-activator.php';
	Talkino_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 */
function tkn_deactivate() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-talkino-deactivator.php';
	Talkino_Deactivator::deactivate();

}

register_activation_hook( __FILE__, 'tkn_activate' );
register_deactivation_hook( __FILE__, 'tkn_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and frontend site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-talkino.php';

/**
 * The core plugin class that is used to call is_plugin_active api.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function tkn_run() {

	$plugin = new Talkino();
	$plugin->run();

}

tkn_run();
