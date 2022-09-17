<?php
/**
 * Displays the part of chatbox when offline status.
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
        <span><?php esc_html_e( get_option( 'talkino_chatbox_offline_subtitle' ), 'talkino' ); ?></span> 
    </div>
    
    <form id="talkino_contact_form" name="talkino_contact_form" method="post">
    <?php echo wp_nonce_field( 'talkino_contact_form_nonce_action', 'talkino_contact_form_nonce_field' ); ?>
        <input type="hidden" name="talkino_googlerecaptcha" id="talkino_googlerecaptcha" required>
        <div class="form-group talkino">
            <input type="text" name="talkino_contact_form_name" id="talkino_contact_form_name" class ="form-control talkino" placeholder="<?php esc_html_e( 'Enter your name', 'talkino' ) ?>" />
        </div>
        <div class="form-group talkino">
            <input type="email" name ="talkino_contact_form_email" id="talkino_contact_form_email" class="form-control talkino" placeholder="<?php esc_html_e( 'Enter your email', 'talkino' ) ?>" />
        </div> 
        <div class="form-group talkino">
            <textarea name="talkino_contact_form_message" id="talkino_contact_form_message" class="form-control talkino" rows="3" placeholder="<?php esc_html_e( 'Enter your message', 'talkino' ) ?>" ></textarea>
        </div>
        <br>
        <div class="spinner-border talkino"></div>
        <p id="talkino-contact-form-notice"></p>

        <?php 
        if( get_option( 'talkino_recaptcha_status' ) == 'on' && get_option( 'talkino_recaptcha_site_key' ) != '' && get_option( 'talkino_recaptcha_secret_key' ) != '') {
        ?>
            <div class="talkino-google-recaptcha-notice">
            <small>This site is protected by reCAPTCHA and the Google 
                <a href="https://policies.google.com/privacy">Privacy Policy</a> and
                <a href="https://policies.google.com/terms">Terms of Service</a> apply.
            </small>
            <br>
            </div>  
            <?php  
        }
        ?>

        <input type="button" class="btn btn-primary submit talkino" id="talkino_submit_button" value="<?php esc_html_e( 'Submit', 'talkino' )?>">
    </form>
</div>