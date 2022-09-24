<?php
/**
 * The admin area to handle notification of the plugin.
 *
 * @link       https://traxconn.com
 * @since      1.1.1
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin area to handle notification of the plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Notifier {

    private string $message;
    private string $class;

	/**
	 * Initialize class.
	 *
	 * @since    1.1.1
     * @param    string    $schedule_time    The time that is selected and saved.
	 */
	public function __construct( string $message, string $class ) {
		
        $this->message = $message;
        $this->class = $class;

		add_action( 'admin_notices', array( $this, 'render_notice' ) );

	}

	/**
	 * Displays notification on the admin screen.
	 *
	 * @return void
	 */
	public function render_notice() {

        switch ( $this->class ){

            case 'success':		
                printf( '<div class="notice notice-success is-dismissible"><p><b>%s</p></b></div>', esc_html( $this->message ) );    
                break;

            case 'info':		
                printf( '<div class="notice notice-info is-dismissible"><p><b>%s</p></b></div>', esc_html( $this->message ) );
                break;

            case 'warning':		
                printf( '<div class="notice notice-warning is-dismissible"><p><b>%s</p></b></div>', esc_html( $this->message ) );
                break;

            case 'error':		
                printf( '<div class="notice notice-error is-dismissible"><p><b>%s</p></b></div>', esc_html( $this->message ) );
                break;

            default:
                break;

        }

    }

}
