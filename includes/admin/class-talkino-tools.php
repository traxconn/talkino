<?php
/**
 * The tools to handle various functions.
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
 * The tools to handle various functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Tools {

	/**
	 * The function to generate time selector.
	 *
	 * @since    1.0.0
	 * @param    string $schedule_time    The time that is selected and saved.
	 */
	public function select_time( $schedule_time ) {

		$start_time_value = '00:00';
		$end_time_value   = '23:30';

		$start_time_format_value = strtotime( $start_time_value );
		$end_time_format_value   = strtotime( $end_time_value );
		$now_time                = $start_time_format_value;

		while ( $now_time <= $end_time_format_value ) {

			?>	
			<option value="<?php echo esc_attr( gmdate( 'H:i', $now_time ) ); ?>" <?php selected( gmdate( 'H:i', $now_time ), $schedule_time ); ?> > <?php echo esc_attr( gmdate( 'H:i', $now_time ) ); ?></option>	
			<?php
			$now_time = strtotime( '+30 minutes', $now_time );

		}

	}

	/**
	 * The function to request plugin review.
	 *
	 * @since    1.1.5
	 */
	public function request_plugin_review() {

		// Check plugin installation time.
		$install_date = get_option( 'talkino_activation_time' );
		$past_date    = strtotime( '-7 seconds' );

		if ( $past_date >= $install_date ) {
			add_action( 'admin_notices', array( $this, 'display_plugin_review_notice' ) );
		}

	}

	/**
	 * The function to display admin notice to ask for plugin review.
	 *
	 * @since    1.1.5
	 */
	public function display_plugin_review_notice() {

		global $current_screen;

		if ( 'talkino_agents' === $current_screen->post_type && get_option( 'talkino_dismiss_plugin_review_notice' ) === false ) {

			$review_url = 'https://wordpress.org/support/plugin/talkino/reviews/';
			$dismiss    = get_admin_url() . 'edit.php?post_type=talkino_agents&dismiss-plugin-review-notice=1';

			printf(
				'
                <div class="notice notice-info talkino"> 
                    <p>You have been using <b> Talkino </b> for a while. We hope you liked it! Please give us a quick rating as it works as a boost for us to keep working on the plugin!
                        <div>
                            <a href="%1$s" class="button button-primary talkino" target="_blank">Rate Now!</a>
                            <a href="%2$s" class="button button-secondary talkino">Already Done!</a>
                        </div>
                    </p>
                </div>',
				esc_url( $review_url ),
				esc_url( $dismiss )
			);

		}

	}

	/**
	 * The function to dismiss admin notice that ask for plugin review.
	 *
	 * @since    1.1.5
	 */
	public function dismiss_plugin_review_notice() {

		if ( isset( $_GET['dismiss-plugin-review-notice'] ) && ! empty( $_GET['dismiss-plugin-review-notice'] ) ) { // phpcs:ignore
			$dismiss = (int) $_GET['dismiss-plugin-review-notice']; // phpcs:ignore

			if ( 1 === $dismiss ) {
				add_option( 'talkino_dismiss_plugin_review_notice', true );
			}
		}

	}

}
