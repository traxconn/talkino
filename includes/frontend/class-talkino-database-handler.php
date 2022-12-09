<?php
/**
 * The class to handle the database via ajax.
 *
 * @link       https://traxconn.com
 * @since      2.0.3
 * @package    Talkino-Bundle
 * @subpackage Talkino-Bundle/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The class to handle the database via ajax.
 *
 * @package    Talkino-Bundle
 * @subpackage Talkino-Bundle/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Database_Handler {

    /**
	 * Insert data to table.
	 *
	 * @since    2.0.3
	 */
	public function insert_chatbox_log_data() {

        global $wpdb;
        $table_name = $wpdb->prefix . 'talkino_chatbox_log';

        // Call utility class to get country name.
        $talkino_utility = new Talkino_Utility();
        $country = $talkino_utility->get_country();
        
        $wpdb->show_errors();

        // Check whether the user has logged in.
        if ( is_user_logged_in() ) {
            $is_member = 1;
        }
        else {
            $is_member = 0;
        }

        // Get the data from jquery.
        $chat_channel = $_POST['chat_channel'];
        $agent = $_POST['agent'];         
        $date = date( 'Y-m-d' );   
        
        
        if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {

            $wpdb->insert( $table_name, array(
                'chat_channel' => $chat_channel, 
                'is_member' => $is_member, 
                'agent' => $agent, 
                'country' => $country, 
                'date' => $date
                )
            ); 

            if( $wpdb->last_error !== '' ) {
            $wpdb->print_error();
            }

        }	
           
    }

}