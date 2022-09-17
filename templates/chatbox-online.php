<?php
/**
 * Displays the part of chatbox when online status.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
<input type="checkbox" id="check"> 
<label class="talkino-chat-btn" for="check"> 
    <div class="talkino-icon">
        <i class="fa-solid fa-comment"></i>
    </div>
    <div class="talkino-rectangle-label"><?php esc_html_e( 'Chat Now', 'talkino' ) ?></div>
    <i class="fa fa-close talkino-close"></i> 
</label>

<div class="talkino-chat-wrapper">
    <div class="talkino-chat-title">
        <b><?php esc_html_e( get_option( 'talkino_global_online_status' ), 'talkino' ); ?></b>
    </div>
    
    <div class="talkino-chat-subtitle"> 
        <span><?php esc_html_e( get_option( 'talkino_chatbox_online_subtitle' ), 'talkino' ); ?></span> 
    </div>
    
    <div class="talkino-information-wrapper">
        <?php 

        // If there is no agent available.
        if ( $data['first_output'] == '' && $data['second_output'] == '' && $data['third_output'] == '' && $data['fourth_output'] == '' && $data['fifth_output'] == '' ) {

            ?>
                <div class="talkino-notice"><i> <?php esc_html_e( get_option( 'talkino_agent_not_available_message' ), 'talkino' );?> </i></div>
            <?php

        }
        else {

            echo wp_kses_post( $data['first_output'] );
            echo wp_kses_post( $data['second_output'] );
            echo wp_kses_post( $data['third_output'] );
            echo wp_kses_post( $data['fourth_output'] );
            echo wp_kses_post( $data['fifth_output'] );

        }

        ?>
    </div>
</div>