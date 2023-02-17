<?php
/**
 * The admin area to handle reporting functions.
 *
 * @link       https://traxconn.com
 * @since      2.0.5
 * @package    Talkino
 * @subpackage Talkino/includes/admin/reports
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin area to handle reporting functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin/reports
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Reporter {

    /**
	 * The function to query and return the chat channel data.
	 *
	 * @since    2.0.5
	 * 
	 * @return    array    chat channel data.
	 */
	public function get_weekly_chat_channel_data() {
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'talkino_log';

		$result = $wpdb->get_results( "SELECT COUNT(*) AS total, chat_channel FROM $table_name WHERE chat_date >= DATE_ADD( CURRENT_TIMESTAMP, INTERVAL -7 DAY ) GROUP BY chat_channel;" );
		
		$data = array();

		if ( ! is_null( $result ) && empty( $wpdb->last_error ) ) {

			foreach ( $result as $row ) {

				// Escape the row data from database. 
				$esc_row = array();
				$esc_row['total'] = esc_html( $row->total );
				$esc_row['chat_channel'] = esc_html( $row->chat_channel );

				$data[] = $esc_row;
				
			}
		
		}

		return $data;

	}
	
}