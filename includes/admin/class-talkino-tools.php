<?php
/**
 * The tools to handle various functions.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
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
     * The function to upgrade plugin data.
     * 
     * @since    1.0.3
     */
    public function upgrade_plugin_data() {

        // Remove deprecated data of chatbox height.
        if ( get_option( 'talkino_chatbox_height' ) == true ) {
            
            delete_option( 'talkino_chatbox_height' );
		
		}  
        
        // Remove deprecated data of contact ordering.
        if ( get_option( 'talkino_contact_ordering' ) == true ) {
            
            delete_option( 'talkino_contact_ordering' );

            if ( get_option( 'talkino_channel_ordering' ) == false ) {
			
                // Add a new option of channel ordering.
                add_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );
            
            }
            
		}  
    
    }

    /**
	 * Reset data of plugin settings if the user activates the reset settings function on the setting.
	 *
	 * @since    1.1.1
	 */
	public static function reset_settings() {

        if ( get_option( 'talkino_reset_settings_status' ) == 'on' ) {

            /************* Settings *************/

            // Reset global online status. 
            update_option( 'talkino_global_online_status', 'Online' );
            
            // Reset global schedule data.
            $global_schedule_online_status_data = array(
                'monday_online_status' => 'on',
                'tuesday_online_status' => 'on',
                'wednesday_online_status' => 'on',
                'thursday_online_status' => 'on',
                'friday_online_status' => 'on',
                'saturday_online_status' => 'on',
                'sunday_online_status' => 'on',
                'monday_start_time' => '00:00',
                'monday_end_time' => '23:30',
                'tuesday_start_time' => '00:00',
                'tuesday_end_time' => '23:30',
                'wednesday_start_time' => '00:00',
                'wednesday_end_time' => '23:30',
                'thursday_start_time' => '00:00',
                'thursday_end_time' => '23:30',
                'friday_start_time' => '00:00',
                'friday_end_time' => '23:30',
                'saturday_start_time' => '00:00',
                'saturday_end_time' => '23:30',
                'sunday_start_time' => '00:00',
                'sunday_end_time' => '23:30'
            );

            update_option( 'talkino_global_schedule_online_status', $global_schedule_online_status_data );
            
            // Reset chatbox online subtitle.
            update_option( 'talkino_chatbox_online_subtitle', 'Let\'s get started to chat with us!' );
            
            // Reset chatbox away subtitle. 
            update_option( 'talkino_chatbox_away_subtitle', 'We are currently away!' );
            
            // Reset chatbox offline subtitle. 
            update_option( 'talkino_chatbox_offline_subtitle', 'Kindly please drop us a message and we will get back to you soon!' );
            
            // Reset agent not available message. 
            update_option( 'talkino_agent_not_available_message', 'All agents are not available.' );
            
            // Reset offline message. 
            update_option( 'talkino_offline_message', 'Sorry, we are currently offline.' );

            // Delete to reset exclude pages.
            delete_option( 'talkino_chatbox_exclude_pages' );
            
            // Reset show on post data. 	
            update_option( 'talkino_show_on_post', 'on' );

            // Reset show on search data. 
            update_option( 'talkino_show_on_search', 'on' );
            
            // Reset show on woocommerce shop, product, product category and tag pages data. 
            update_option( 'talkino_show_on_woocommerce_pages', 'on' );
            
            /************* Styles *************/

            // Reset chatbox style data. 
            update_option( 'talkino_chatbox_style', 'round' );
            
            // Reset chatbox position data. 
            update_option( 'talkino_chatbox_position', 'right' );
            
            // Reset show on desktop data. 
            update_option( 'talkino_show_on_desktop', 'on' );
            
            // Reset start chat method. 
            update_option( 'talkino_start_chat_method', '_blank' );
            
            // Reset show on mobile data. 
            update_option( 'talkino_show_on_mobile', 'on' );

            // Reset chatbox theme color for online status. 
            update_option( 'talkino_chatbox_online_theme_color', '#1e73be' );
            
            // Reset chatbox theme color for away status. 
            update_option( 'talkino_chatbox_away_theme_color', '#ffa500' );

            // Reset chatbox theme color for offline status. 
            update_option( 'talkino_chatbox_offline_theme_color', '#aec6cf' );
            
            // Reset chatbox background color. 
            update_option( 'talkino_chatbox_background_color', '#fff' );

            // Reset chatbox title color. 
            update_option( 'talkino_chatbox_title_color', '#fff' );
            
            // Reset chatbox subtitle color. 
            update_option( 'talkino_chatbox_subtitle_color', '#000' );

            /************* Ordering *************/

            // Reset agent ordering. 
            update_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );
            
            /************* Contact Form *************/

            // Reset contact form status. 
            update_option( 'talkino_contact_form_status', 'off' );
            
            // Reset email recipient. 
            update_option( 'talkino_email_recipient', get_option( 'admin_email' ) );
            
            // Reset email subject. 
            update_option( 'talkino_email_subject', 'Message from Contact Form' );
            
            // Reset sender message. 
            update_option( 'talkino_sender_message', '%%message%%' );
            
            // Reset sender name. 
            update_option( 'talkino_sender_name', 'From: %%sender_name%%' );
            
            // Reset sender email. 
            update_option( 'talkino_sender_email', 'Sender\'s Email: %%sender_email%%' );
            
            // Reset successful email sent message. 
            update_option( 'talkino_success_email_message', 'Email has been successfully sent out.' );
            
            // Reset failed email sent message. 
            update_option( 'talkino_fail_email_message', 'Email has been failed to sent out.' );
            
            // Reset recaptcha status. 
            update_option( 'talkino_recaptcha_status', 'off' );
            
            // Reset recaptcha site key. 
            update_option( 'talkino_recaptcha_site_key', '' );
            
            // Reset recaptcha secret key. 
            update_option( 'talkino_recaptcha_secret_key', '' );
            
            /************* Advanced *************/

            // Reset data uninstall status. 
            update_option( 'talkino_reset_settings_status', 'off' );

            // Reset data uninstall status. 
            update_option( 'talkino_data_uninstall_status', 'off' );

            // Call to display the message of reset settings successfully.
            $message = esc_html__( 'All settings data of Talkino has been reset successfully!', 'talkino' );
            $class = 'success';

            new Talkino_Notifier( $message, $class );
            
        }
		
	}

    /**
     * The function to generate time selector.
     * 
     * @since    1.0.0
     * @param    string    $schedule_time    The time that is selected and saved.
     */
    public function select_time( $schedule_time ) {

        $start_time_value = "00:00";
        $end_time_value = "23:30";

        $start_time_format_value = strtotime( $start_time_value );
        $end_time_format_value = strtotime( $end_time_value );
        $now_time = $start_time_format_value;
        
        while( $now_time <= $end_time_format_value ) {
            ?>
            
            <option value="<?php echo esc_attr( date( "H:i", $now_time ) )?>" <?php selected( date( "H:i", $now_time ), $schedule_time ); ?> > <?php echo esc_attr( date( "H:i", $now_time ) )?></option>
            
            <?php
            $now_time = strtotime( '+30 minutes', $now_time );
        }
        
    }

}