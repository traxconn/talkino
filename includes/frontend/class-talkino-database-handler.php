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
	public function talkino_insert_chatbox_log_data() {

        $talkino_utility_manager = new Talkino_Utility_Manager();
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'talkino_log';
        
        // Check whether the user has logged in.
        if ( is_user_logged_in() ) {
            $is_member = "Member";
        }
        else {
            $is_member = "Guest";
        }

        $country = "";

        // Get user ip address and check its location.
        $ip = $talkino_utility_manager->get_user_ip();

        $response = $talkino_utility_manager->check_location( $ip );        
        $response = json_decode( $response, 1 );

        if ( is_array( $response ) && ! is_wp_error( $response ) ) {
            
            $country =  $response['country_name'];
            $country = ucwords( strtolower( $country ) );

        }

        // Get the data from jquery.
        $agent_id = $_POST['agent_id'];
        $chat_channel = $_POST['chat_channel'];
        $chat_method = $_POST['chat_method'];
        $agent = $_POST['agent'];         
        $date = date( 'Y-m-d' );   
        
        if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {

            $wpdb->insert( $table_name, array(
                'agent_id' => $agent_id,
                'agent' => $agent,
                'chat_channel' => $chat_channel, 
                'chat_method' => $chat_method, 
                'is_member' => $is_member, 
                'ip' => $ip,  
                'country' => $country, 
                'chat_date' => $date
                )
            ); 

        }	
           
    }

}