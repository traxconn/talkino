<?php
/**
 * The class to manage agents.
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
 * The class to manage agents.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Agent_Manager {

    /**
	 * The output of whatsapp.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $whatsapp_output    The output of whatsapp.
	 */
    public $whatsapp_output;

    /**
	 * The output of facebook.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $facebook_output    The output of facebook.
	 */
    public $facebook_output;

    /**
	 * The output of telegram.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $telegram_output    The output of telegram.
	 */
    public $telegram_output;

    /**
	 * The output of phone number.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $phone_output    The output of phone number.
	 */
    public $phone_output;

    /**
	 * The output of email.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $email_output    The output of email.
	 */
    public $email_output;

    /**
	 * Query agent's data.
	 *
	 * @since    1.0.0
	 */
    public function query_agent_data() {

        if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) { 

            $talkino_scheduler = new Talkino_Scheduler();
        
        }

        $whatsapp_data = '';
        $facebook_data = '';
        $telegram_data = '';
        $phone_data = '';
        $email_data = '';
        $this->no_agent_output = '';

        $whatsapp_url = 'https://wa.me/';

        // Prepare the query arguments.
        $args = array(  
            'post_type' => 'talkino_agents',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_key'   => 'talkino_agent_ordering',
            'orderby'    => 'meta_value_num',
            'order'      => 'ASC'
        );
    
        // Declare query object.
        $loop = new WP_Query( $args ); 

        // Start to query agent's data.
        while ( $loop->have_posts() ) : $loop->the_post(); 

            $post_id = get_the_ID();
            $is_agent_schedule_activate_status_on = false;
            $is_agent_schedule_online_status = false;

            if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

                // Check whether the time schedule of agent is activated
                if ( get_post_meta( $post_id, 'talkino_agent_schedule_activate_status', true ) == 'on' ) {

                    $is_agent_schedule_activate_status_on = true;
                    $is_agent_schedule_online_status  = $talkino_scheduler->check_agent_schedule_online_status( $post_id );

                }
                
            }
            
            // Check whether the time schedule of agent is deactivated or both schedule online status and time schedule of agent is activated
            if ( $is_agent_schedule_activate_status_on == false || ( $is_agent_schedule_online_status == true && $is_agent_schedule_activate_status_on == true ) ) {

                // Retrieve and restrict the agent name to 20 characters.
                $name= strlen( get_the_title() ) > 20 ? substr( get_the_title(), 0, 20 )."..." : get_the_title();
            
                $job_title = get_post_meta( $post_id, 'talkino_job_title', true );
                $target = get_option( 'talkino_start_chat_method' );

                // Ensure only query the data if there is whatsapp id.
                if ( ! empty ( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) ) {
                     
                    $whatsapp_id = get_post_meta( $post_id, 'talkino_whatsapp_id', true );
                    $whatsapp_pre_filled_message = urlencode( get_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', true ) );

                    $whatsapp_data .= "
                    <a class='talkino-chat-information' href='" . $whatsapp_url . $whatsapp_id . "?text=" . $whatsapp_pre_filled_message . "' target='" . $target . "' title='Chat on Whatsapp'>
                        <div class='talkino-chat-avatar'>";

                        // Check if contains avatar image.
                        if ( has_post_thumbnail() ){
                        
                            $whatsapp_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";
                    
                        }
                        else {
                        
                            $whatsapp_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
                        
                        }
                            
                        $whatsapp_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/whatsapp-icon.png' . "' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on WhatsApp', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

                }

                // Ensure only query the data if there is facebook id.
                if ( ! empty ( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ) {
            
                    $facebook_id = get_post_meta( $post_id, 'talkino_facebook_id', true );
                   
                    $facebook_data .= "
                    <a class='talkino-chat-information' href='https://m.me/" . $facebook_id . "' target='" . $target . "' title='Chat on Facebook'>
                        <div class='talkino-chat-avatar'>";

                        // Check if contains avatar image.
                        if ( has_post_thumbnail() ){
                        
                            $facebook_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";
                    
                        }
                        else {
                        
                            $facebook_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
                        
                        }
                            
                        $facebook_data .= "
                        
                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/facebook-icon.png' . "' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Facebook', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";
                    
                }

                // Ensure only query the data if there is telegram id.
                if ( ! empty ( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) ) {
            
                    $telegram_id = get_post_meta( $post_id, 'talkino_telegram_id', true );
                   
                    $telegram_data .= "
                    <a class='talkino-chat-information' href='https://t.me/" . $telegram_id . "' target='" . $target . "' title='Chat on Telegram'>
                        <div class='talkino-chat-avatar'>";

                        // Check if contains avatar image.
                        if ( has_post_thumbnail() ){
                        
                            $telegram_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";
                    
                        }
                        else {
                        
                            $telegram_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
                        
                        }
                            
                        $telegram_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/telegram-icon.png' . "' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Telegram', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";
                    
                }

                // Ensure only query the data if there is phone number.
                if ( wp_is_mobile() && ! empty ( get_post_meta( $post_id, 'talkino_phone_number', true ) ) ) {
                     
                    $phone_number = get_post_meta( $post_id, 'talkino_phone_number', true );
                   
                    $phone_data .= "
                    <a class='talkino-chat-information' href='tel:" . $phone_number . "' title='Chat on Phone'>
                        <div class='talkino-chat-avatar'>";

                        // Check if contains avatar image.
                        if ( has_post_thumbnail() ){
                        
                            $phone_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";
                    
                        }
                        else {
                        
                            $phone_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
                        
                        }
                            
                        $phone_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/phone-icon.png' . "' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Phone', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

                }

                // Ensure only query the data if there is telegram id.
                if ( ! empty ( get_post_meta( $post_id, 'talkino_email', true ) ) ) {
            
                    $email = get_post_meta( $post_id, 'talkino_email', true );
                   
                    $email_data .= "
                    <a class='talkino-chat-information' href='mailto:" . $email ."' title='Chat on Email'>
                        <div class='talkino-chat-avatar'>";

                        // Check if contains avatar image.
                        if ( has_post_thumbnail() ){
                        
                            $email_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";
                    
                        }
                        else {
                        
                            $email_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
                        
                        }
                            
                        $email_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/email-icon.png' . "' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Email', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

                }

            }

        endwhile;
    
        $this->whatsapp_output = $whatsapp_data;
        $this->facebook_output = $facebook_data;
        $this->telegram_output = $telegram_data;
		$this->phone_output = $phone_data;
        $this->email_output = $email_data;

        wp_reset_postdata(); 

    }

    /**
	 * Get whatsapp output.
	 *
	 * @since     1.0.0
	 * @return    string    $this->whatsapp_output    The output of whatsapp.
	 */
    public function get_whatsapp_output() {

        return $this->whatsapp_output;

    }

    /**
	 * Get facebook output.
	 *
	 * @since     1.0.0
	 * @return    string    $this->facebook_output    The output of facebook.
	 */
    public function get_facebook_output() {

        return $this->facebook_output;

    }

    /**
	 * Get telegram output.
	 *
	 * @since     1.0.0
	 * @return    string    $this->telegram_output    The output of telegram.
	 */
    public function get_telegram_output() {

        return $this->telegram_output;

    }

    /**
	 * Get phone number output.
	 *
	 * @since     1.0.0
	 * @return    string    $this->phone_output    The output of phone number.
	 */
    public function get_phone_output() {

        return $this->phone_output;

    }

    /**
	 * Get email output.
	 *
	 * @since     1.0.0
	 * @return    string    $this->email_output    The output of email.
	 */
    public function get_email_output() {

        return $this->email_output;

    }

}