<?php
/**
 * The admin area to handle remove functions.
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
 * The admin area to handle remove functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Remover {

	/**
	 * The function to remove reporting data.
	 *
	 * @since    2.0.5
	 */
	public function remove_reporting_data() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'talkino_log'; 

		/********** Remove old report data in database **********/
		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) && $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {

			$duration = get_option( 'talkino_report_storage_duration' );

			$sql = null;
			
			if ( $duration == "3-months" ) {
				$sql = "DELETE FROM $table_name WHERE chat_date < DATE_ADD( CURRENT_TIMESTAMP, INTERVAL -3 MONTH )";
			}
			else if ( $duration == "6-months" ) {
				$sql = "DELETE FROM $table_name WHERE chat_date < DATE_ADD( CURRENT_TIMESTAMP, INTERVAL -6 MONTH )";
			}
			else if ( $duration == "12-months" ) {
				$sql = "DELETE FROM $table_name WHERE chat_date < DATE_ADD( CURRENT_TIMESTAMP, INTERVAL -1 YEAR )";
			}
			else if ( $duration == "24-months" ) {
				$sql = "DELETE FROM $table_name WHERE chat_date < DATE_ADD( CURRENT_TIMESTAMP, INTERVAL -2 YEAR )";
				
			}

			$wpdb->query( $sql );

		}
	
	}

}
