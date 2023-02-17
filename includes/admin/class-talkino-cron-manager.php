<?php
/**
 * The class to handle cron schedule function.
 *
 * @link       https://traxconn.com
 * @since      2.0.5
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The class to handle cron schedule function.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Cron_Manager {

	/**
	 * Initialize cron job for reporting.
	 *
	 * @since    2.0.5
	 */
	public function init_cron_reporting() {

		$time_delay = 604800;

		// Schedule a cron action if it's not already scheduled
		if ( ! wp_next_scheduled( 'talkino_cron_reporting' ) && get_option( 'talkino_receive_weekly_report' ) === 'active' ) {
			wp_schedule_event( time() + $time_delay, 'every_week', 'talkino_cron_reporting' );
		}
		else if ( get_option( 'talkino_receive_weekly_report' ) === 'inactive' ){
			wp_clear_scheduled_hook( "talkino_cron_reporting" ); 
		}
			
	}

	/**
	 * Schedule cron job interval for reporting.
	 *
	 * @since    2.0.5
	 */
	public function talkino_cron_reporting( $schedules ) {
		$schedules['every_week'] = array(
				'interval'  => 604800,
				'display'   => __( 'Every week', 'talkino' )
		);

		return $schedules;
	}

	/**
	 * Schedule cron job action for reporting.
	 *
	 * @since    2.0.5
	 */
	public function talkino_cron_reporting_action() {

		if ( ! is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

			$talkino_reporter = new Talkino_Reporter();
			$talkino_file_loader = new Talkino_File_Loader();
			$talkino_email_manager = new Talkino_Email_Manager();

			$chat_channel_data = $talkino_reporter->get_weekly_chat_channel_data();

			// Get the email template with combined email data.
			$message = $talkino_file_loader->get_report_email_template_file( 'html-report-mail-body.php', $chat_channel_data );

			// Send email to admin.
			$talkino_email_manager->send_report_mail( get_option( 'admin_email' ), $message );

		} 
		else {

			$talkino_bundle_reporter = new Talkino_Bundle_Reporter();
			$talkino_bundle_file_loader = new Talkino_Bundle_File_Loader();
			$talkino_bundle_email_manager = new Talkino_Bundle_Email_Manager();

			$chat_channel_data = $talkino_bundle_reporter->get_chat_channel_data( 'one_week' );
			$visitor_data = $talkino_bundle_reporter->get_visitor_data( 'one_week' );
			$agent_data = $talkino_bundle_reporter->get_agent_data( 'one_week' );
			$country_data = $talkino_bundle_reporter->get_country_data( 'one_week' );

			// Assign the data from talkino bundle reporter and pass it to html rendering file.
			$data = array(
				'chat_channel_data'  => $chat_channel_data,
				'visitor_data' => $visitor_data,
				'agent_data'  => $agent_data,
				'country_data'  => $country_data
			);

			// Get the email template with combined email data.
			$message = $talkino_bundle_file_loader->get_report_email_template_file( 'html-bundle-report-mail-body.php', $data );

			// Send email to admin.
			$talkino_bundle_email_manager->send_report_mail( get_option( 'admin_email' ), $message );

		}
		
	}

}
