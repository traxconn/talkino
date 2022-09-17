<?php
/**
 * The class to handle the chatbox.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The class to handle the chatbox.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Chatbox {

    /**
     * Initialize the chatbox.
     * 
     * @since    1.0.0
     */
    public function chatbox_init() {

        // Declare the class to load html to render chatbox.
        $talkino_file_loader = new Talkino_File_Loader();
		$talkino_agent_manager = new Talkino_Agent_Manager();
        
        $is_global_schedule_online_status = false;
        
        // Declare the bundle class to load html to render chatbox.
        if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
		    $talkino_scheduler = new Talkino_Scheduler();

            // Call the function to check schedule online status via current weekday and time. 
		    $is_global_schedule_online_status = $talkino_scheduler->check_global_schedule_online_status();
        }

		// Call to query agent data.
        $talkino_agent_manager->query_agent_data();

		// Retrieve the contact output from agents.
		$whatsapp_output = $talkino_agent_manager->get_whatsapp_output();
        $facebook_output = $talkino_agent_manager->get_facebook_output();
        $telegram_output = $talkino_agent_manager->get_telegram_output();
        $phone_output = $talkino_agent_manager->get_phone_output();
        $email_output = $talkino_agent_manager->get_email_output();

        $show_chatbox = false; 
        $data = array();

        if ( empty ( get_option( 'talkino_contact_ordering' ) ) ) {

            // Assign the data from agents and pass it to html rendering file.
            $data = array(
                'first_output' => $whatsapp_output,
                'second_output' => $facebook_output,
                'third_output' => $telegram_output,
                'fourth_output' => $phone_output,
                'fifth_output' => $email_output
            );
        } 
        else {

            $order = explode(',', get_option( 'talkino_contact_ordering' ) );

            $first_output = '';
            $second_output = '';
            $third_output = '';
            $fourth_output = '';
            $fifth_output = '';

            switch ( $order[0] ) {
                
                case "Whatsapp":
                    $first_output = $whatsapp_output;
                    break;

                case "Facebook":
                    $first_output = $facebook_output;
                    break;

                case "Telegram":
                    $first_output = $telegram_output;
                    break;

                case "Phone":
                    $first_output = $phone_output;
                    break;

                case "Email":
                    $first_output = $email_output;
                    break;

                
                default:
                    $first_output = $whatsapp_output;

            }

            switch ( $order[1] ) {

                case "Whatsapp":
                    $second_output = $whatsapp_output;
                    break;

                case "Facebook":
                    $second_output = $facebook_output;
                    break;

                case "Telegram":
                    $second_output = $telegram_output;
                    break;

                case "Phone":
                    $second_output = $phone_output;
                    break;

                case "Email":
                    $second_output = $email_output;
                    break;
                        
                default:
                    $second_output = $facebook_output;

            }

            switch ( $order[2] ) {

                case "Whatsapp":
                    $third_output = $whatsapp_output;
                    break;

                case "Facebook":
                    $third_output = $facebook_output;
                    break;

                case "Telegram":
                    $third_output = $telegram_output;
                    break;

                case "Phone":
                    $third_output = $phone_output;
                    break;

                case "Email":
                    $third_output = $email_output;
                    break;

                default:
                    $third_output = $telegram_output;
                    
            }

            switch ( $order[3] ) {

                case "Whatsapp":
                    $fourth_output = $whatsapp_output;
                    break;

                case "Facebook":
                    $fourth_output = $facebook_output;
                    break;

                case "Telegram":
                    $fourth_output = $telegram_output;
                    break;

                case "Phone":
                    $fourth_output = $phone_output;
                    break;

                case "Email":
                    $fourth_output = $email_output;
                    break;

                default:
                    $fourth_output = $phone_output;
                    
            }

            switch ( $order[4] ) {

                case "Whatsapp":
                    $fifth_output = $whatsapp_output;
                    break;

                case "Facebook":
                    $fifth_output = $facebook_output;
                    break;

                case "Telegram":
                    $fifth_output = $telegram_output;
                    break;

                case "Phone":
                    $fifth_output = $phone_output;
                    break;

                case "Email":
                    $fifth_output = $email_output;
                    break;

                default:
                    $fifth_output = $email_output;
                    
            }
            
            // Assign the data from agents and pass it to html rendering file.
            $data = array(
                'first_output' => $first_output,
                'second_output' => $second_output,
                'third_output' => $third_output,
                'fourth_output' => $fourth_output,
                'fifth_output' => $fifth_output
            );
        }

        // Check whether is mobile.
        if( wp_is_mobile() ) {

            if ( get_option( 'talkino_show_on_mobile' ) == 'on' ) {
                
                $show_chatbox = true;

            }

        }
        else {

            if ( get_option( 'talkino_show_on_desktop' ) == 'on' ) {
            
                $show_chatbox = true;

            }

        }

        // Check whether to display or hide chatbox on pages
        if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

            $talkino_display_controller = new Talkino_Display_Controller();
            $show_chatbox = $talkino_display_controller->is_page_display( $show_chatbox );
        
        }
		
        // Ensure that it is show on chatbox.
        if ( $show_chatbox == true ) {

            // Global online status is online and schedule is available.
            if( ( ! is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) && get_option( 'talkino_global_online_status' ) == 'Online') || ( get_option( 'talkino_global_online_status' ) == 'Online' && $is_global_schedule_online_status == true ) ) {

                $talkino_file_loader->load_chatbox_template_file( 'chatbox-online.php', $data );

            } 

            // Global online status is away and schedule is available.
            elseif( ( ! is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) && get_option( 'talkino_global_online_status' ) == 'Away') || ( get_option( 'talkino_global_online_status' ) == 'Away' && $is_global_schedule_online_status == true ) ) { 
                
                $talkino_file_loader->load_chatbox_template_file( 'chatbox-away.php', $data );    
            
            }

            // Global online status if offline or schedule is not available.
            else {

                // Function to show contact form when offline.
                if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) && get_option( 'talkino_contact_form_status' ) == 'on' ) { 
                
                    $talkino_file_loader->load_chatbox_template_file( 'contact-form.php', $data );    
                
                }
                else {
                    
                    $talkino_file_loader->load_chatbox_template_file( 'chatbox-offline.php', $data ); 

                }
            
            }   

            // Call the function to render chatbox style.
            $this->render_chatbox_style();

        }

    }

    /**
     * Render the chatbox using setting style options.
     * 
     * @since    1.0.0
     */
    public function render_chatbox_style() {

        // Chatbox under round style.
        if( get_option( 'talkino_chatbox_style' ) == 'round' ) {

            if ( get_option( 'talkino_chatbox_position' ) == 'left' ) {

                if( get_option( 'talkino_global_online_status' ) == 'Online' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        left: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';
                
                }
                elseif( get_option( 'talkino_global_online_status' ) == 'Away' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        left: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                } 
                else {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        left: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }

            }
            else { // Right position.

                if( get_option( 'talkino_global_online_status' ) == 'Online' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        right: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';
                
                }
                elseif( get_option( 'talkino_global_online_status' ) == 'Away' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        right: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                } 
                else { 

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        width: 50px;
                        height: 50px;
                        right: 15px;
                        bottom: 30px;
                        border-radius: 50px;
                    }

                    .talkino-rectangle-label {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 100px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }

            }

        }

        // Chatbox under rectangle style.
        else {

            if ( get_option( 'talkino_chatbox_position' ) == 'left' ) {

                if( get_option( 'talkino_global_online_status' ) == 'Online' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        left: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }
                elseif( get_option( 'talkino_global_online_status' ) == 'Away' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        left: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                } 
                else {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        left: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        left: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }
            }
            else { //Right position.

                if( get_option( 'talkino_global_online_status' ) == 'Online' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        right: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_online_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }
                elseif( get_option( 'talkino_global_online_status' ) == 'Away' ) {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        right: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_away_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ) . ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                } 
                else {

                    echo 
                    '<style>
                    .talkino-chat-btn {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        min-width: 80px;
                        height: 40px;
                        right: 15px;
                        bottom: 0;
                        border-radius: 0;
                    }

                    .fa-solid.fa-comment {
                        display: none;
                    }

                    .talkino-chat-wrapper {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_background_color' ) ) . ';
                        right: 20px;
                        bottom: 60px;
                    }

                    .talkino-chat-title {
                        background-color: ' . esc_attr( get_option( 'talkino_chatbox_offline_theme_color' ) ) . ';
                        color: ' . esc_attr( get_option( 'talkino_chatbox_title_color' ) ) . ';
                    }

                    .talkino-chat-subtitle {
                        color: ' . esc_attr( get_option( 'talkino_chatbox_subtitle_color' ) ). ';
                    }

                    .talkino-information-wrapper {
                        max-height: ' . esc_attr( get_option( 'talkino_chatbox_height' ) ) . 'px;
                    }
                    </style>';

                }

            }

        }

    }

}