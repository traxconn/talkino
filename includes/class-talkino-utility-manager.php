<?php
/**
 * The function to handle the utility functions.
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
 * The function to handle the utility functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Utility_Manager {

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

		if ( isset( $_GET['dismiss-plugin-review-notice'] ) && ! empty( $_GET['dismiss-plugin-review-notice'] ) ) {
			
			$dismiss = ( int ) $_GET['dismiss-plugin-review-notice'];

			if ( 1 === $dismiss ) {
				add_option( 'talkino_dismiss_plugin_review_notice', true );
			}
			
		}

	}

	/**
	 * Check whether is blog page.
	 *
	 * @since    1.0.0
	 *
	 * @return   bool    The result of whether is blog page.
	 */
	public function is_blog() {
		return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && 'post' === get_post_type();
	}

	/**
	 * Check whether woocommerce is activated.
	 *
	 * @since    1.0.0
	 *
	 * @return   bool    The result of whether woocommerce is activated.
	 */
	public function is_woocommerce_activated() {

		if ( class_exists( 'WooCommerce' ) ) {
			return true;

		} else {
			return false;
		}

	}

	/**
	 * Function to replaces the keywords with contact form data in a string.
	 *
	 * @since     1.0.0
	 * @param     string $phrase               The string.
	 * @param     array  $contact_form_data    The Word that is used to replace.
	 *
	 * @return    string    The replaced string.
	 */
	public function replace_contact_form_text( $phrase, $contact_form_data ) {

		$keyword = array( '%%sender_name%%', '%%sender_email%%', '%%sender_phone%%', '%%message%%' );
		$phrase  = str_replace( $keyword, $contact_form_data, $phrase );

		return $phrase;

	}

	/**
	 * Retrieve user IP address.
	 *
	 * @since    1.1.0
	 *
	 * @return   string    The IP address of user.
	 */
	public function get_user_ip() {

		$ipaddress = '';
		if ( getenv( 'HTTP_CLIENT_IP' ) )
			$ipaddress = getenv( 'HTTP_CLIENT_IP' );

		else if( getenv( 'HTTP_X_FORWARDED_FOR' ) )
			$ipaddress = getenv( 'HTTP_X_FORWARDED_FOR' );

		else if( getenv( 'HTTP_X_FORWARDED' ) )
			$ipaddress = getenv( 'HTTP_X_FORWARDED' );

		else if( getenv( 'HTTP_FORWARDED_FOR' ) )
			$ipaddress = getenv( 'HTTP_FORWARDED_FOR' );

		else if( getenv( 'HTTP_FORWARDED' ) )
			$ipaddress = getenv( 'HTTP_FORWARDED' );

		else if( getenv( 'REMOTE_ADDR' ) )
			$ipaddress = getenv( 'REMOTE_ADDR' );

		else
			$ipaddress = 'UNKNOWN';
			
		return $ipaddress;

	}

	/**
	 * Check location by IP.
	 *
	 * @since    1.1.0
	 *
	 * @return   string    The response.
	 */
	public function check_location( $ip ) {
		
		$response = wp_remote_get( 'https://api.hostip.info/get_json.php?ip=' . $ip );
		$body     = wp_remote_retrieve_body( $response );
		
		return $body; 
	}

}
