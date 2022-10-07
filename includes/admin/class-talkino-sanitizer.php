<?php
/**
 * The tools to handle sanitize functions.
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
 * The tools to handle sanitize functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Sanitizer {

	/**
	 * The function to sanitize checkbox of agent schedule online status.
	 *
	 * @since    1.0.0
	 * @param    string $agent_schedule_online_status    The agent schedule online status.
	 *
	 * @return   string    The sanitized agent schedule online status.
	 */
	public function sanitize_agent_schedule_online_status( $agent_schedule_online_status ) {

		if ( 'on' === $agent_schedule_online_status || 'off' === $agent_schedule_online_status ) {
			$agent_schedule_online_status = $agent_schedule_online_status;

		} else {
			$agent_schedule_online_status = 'off';

		}

		return $agent_schedule_online_status;

	}

	/**
	 * The function to sanitize start time and end time of agent time schedule.
	 *
	 * @since    1.0.0
	 * @param    string $agent_schedule_time    The agent schedule time.
	 *
	 * @return   string    The sanitized agent schedule time.
	 */
	public function sanitize_agent_schedule_time( $agent_schedule_time ) {

		$start_time_value = '00:00';
		$end_time_value   = '23:30';

		$start_time_format_value = strtotime( $start_time_value );
		$end_time_format_value   = strtotime( $end_time_value );
		$time                    = $start_time_format_value;
		$time_range              = array();

		// Sanitize the time range of dropdown box.
		while ( $time <= $end_time_format_value ) {

			array_push( $time_range, gmdate( 'H:i', $time ) );
			$time = strtotime( '+30 minutes', $time );

		}

		// Monday field.
		if ( in_array( $agent_schedule_time, $time_range, true ) ) {
			$agent_schedule_time = $agent_schedule_time;

		} else {
			$agent_schedule_time = '00:00';

		}

		return $agent_schedule_time;

	}

	/**
	 * The function to sanitize whatsapp format of phone number.
	 *
	 * @since    1.0.0
	 * @param    string $phone    The phone number.
	 *
	 * @return   string    The sanitized phone number.
	 */
	public function sanitize_whatsapp_phone_number( $phone ) {

		$phone = preg_replace( '/[^0-9]+/', '', $phone );
		return $phone;

	}

	/**
	 * The function to sanitize phone number.
	 *
	 * @since    1.0.0
	 * @param    string $phone    The phone number.
	 *
	 * @return   string    The sanitized phone number.
	 */
	public function sanitize_phone_number( $phone ) {

		$phone = preg_replace( '/[^\d+]/', '', $phone );
		return $phone;

	}

}
