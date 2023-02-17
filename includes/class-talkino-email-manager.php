<?php
/**
 * The class to handle the email.
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
 * The class to handle the email.
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Email_Manager {

	/**
	 * Send email.
	 *
	 * @since    2.0.5
	 * @param    string $email      The admin email address.
	 * @param    string $message    The message of the email.
	 */
	public function send_report_mail( $email, $message ) {

		$to      = '';
		$subject = '';
		$headers = array( 'Content-Type: text/html; charset=UTF-8' );

		$to = get_option( 'admin_email' );
		$subject = 'Report from Talkino';

		wp_mail( $to, $subject, $message, $headers );

	}

}
