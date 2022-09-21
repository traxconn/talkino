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
        $talkino_utility = new Talkino_Utility();
        
        $is_global_schedule_online_status = false;
        
        // Declare the bundle class to load html to render chatbox.
        if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
		    $talkino_scheduler = new Talkino_Scheduler();

            // Call the function to check schedule online status via current weekday and time. 
		    $is_global_schedule_online_status = $talkino_scheduler->check_global_schedule_online_status();
        }

		// Call to query agent data.
        $talkino_agent_manager->query_agent_data();

		// Retrieve the channel output from agents.
		$whatsapp_output = $talkino_agent_manager->get_whatsapp_output();
        $facebook_output = $talkino_agent_manager->get_facebook_output();
        $telegram_output = $talkino_agent_manager->get_telegram_output();
        $phone_output = $talkino_agent_manager->get_phone_output();
        $email_output = $talkino_agent_manager->get_email_output();

        $show_chatbox = false; 
        $data = array();

        if ( empty ( get_option( 'talkino_channel_ordering' ) ) ) {

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

            $order = explode(',', get_option( 'talkino_channel_ordering' ) );

            $first_output = '';
            $second_output = '';
            $third_output = '';
            $fourth_output = '';
            $fifth_output = '';

            switch ( $order[0] ) {
                
                case "talkino_whatsapp":
                    $first_output = $whatsapp_output;
                    break;

                case "talkino_facebook":
                    $first_output = $facebook_output;
                    break;

                case "talkino_telegram":
                    $first_output = $telegram_output;
                    break;

                case "talkino_phone":
                    $first_output = $phone_output;
                    break;

                case "talkino_email":
                    $first_output = $email_output;
                    break;

                
                default:
                    $first_output = $whatsapp_output;

            }

            switch ( $order[1] ) {

                case "talkino_whatsapp":
                    $second_output = $whatsapp_output;
                    break;

                case "talkino_facebook":
                    $second_output = $facebook_output;
                    break;

                case "talkino_telegram":
                    $second_output = $telegram_output;
                    break;

                case "talkino_phone":
                    $second_output = $phone_output;
                    break;

                case "talkino_email":
                    $second_output = $email_output;
                    break;
                        
                default:
                    $second_output = $facebook_output;

            }

            switch ( $order[2] ) {

                case "talkino_whatsapp":
                    $third_output = $whatsapp_output;
                    break;

                case "talkino_facebook":
                    $third_output = $facebook_output;
                    break;

                case "talkino_telegram":
                    $third_output = $telegram_output;
                    break;

                case "talkino_phone":
                    $third_output = $phone_output;
                    break;

                case "talkino_email":
                    $third_output = $email_output;
                    break;

                default:
                    $third_output = $telegram_output;
                    
            }

            switch ( $order[3] ) {

                case "talkino_whatsapp":
                    $fourth_output = $whatsapp_output;
                    break;

                case "talkino_facebook":
                    $fourth_output = $facebook_output;
                    break;

                case "talkino_telegram":
                    $fourth_output = $telegram_output;
                    break;

                case "talkino_phone":
                    $fourth_output = $phone_output;
                    break;

                case "talkino_email":
                    $fourth_output = $email_output;
                    break;

                default:
                    $fourth_output = $phone_output;
                    
            }

            switch ( $order[4] ) {

                case "talkino_whatsapp":
                    $fifth_output = $whatsapp_output;
                    break;

                case "talkino_facebook":
                    $fifth_output = $facebook_output;
                    break;

                case "talkino_telegram":
                    $fifth_output = $telegram_output;
                    break;

                case "talkino_phone":
                    $fifth_output = $phone_output;
                    break;

                case "talkino_email":
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
		// Get the page id.
		$page_id = get_queried_object_id();

		if ( !empty( get_option('talkino_chatbox_exclude_pages') ) && in_array( $page_id, get_option('talkino_chatbox_exclude_pages') ) ) {

			$show_chatbox = false;

		}

		if ( get_option('talkino_show_on_post') == 'off' && $talkino_utility->is_blog() ) {

			$show_chatbox = false;
			
		}

		// Check whether woocommerce is activated and whether is woocommerce page.
		if ( $talkino_utility->is_woocommerce_activated() && get_option( 'talkino_show_on_woocommerce_pages' ) == 'off' && is_woocommerce() ){

			$show_chatbox = false;

		}
		
		// Check whether is search page.
		if ( is_search() && get_option( 'talkino_show_on_search' ) == 'off' ) {

			$show_chatbox = false;

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

                    </style>';

                }

            }

        }

    }

}