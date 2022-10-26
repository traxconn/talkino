<?php
/**
 * Displays the part of chatbox when offline status.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/templates
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( is_plugin_active( 'wpml-string-translation/plugin.php' ) ) {

	$talkino_chat_subtitle   = apply_filters( 'wpml_translate_single_string', get_option( 'talkino_chatbox_offline_subtitle' ), 'talkino', 'Chatbox Offline Subtitle' );
	$talkino_offline_message = apply_filters( 'wpml_translate_single_string', get_option( 'talkino_offline_message' ), 'talkino', 'Offline Message' );
	$talkino_chatbox_button_text         = apply_filters( 'wpml_translate_single_string', get_option( 'talkino_chatbox_button_text' ), 'talkino', 'Chatbox Button Text' );

} else {

	$talkino_chat_subtitle   = get_option( 'talkino_chatbox_offline_subtitle' );
	$talkino_offline_message = get_option( 'talkino_offline_message' );
	$talkino_chatbox_button_text = get_option( 'talkino_chatbox_button_text' );

}

?>
<input type="checkbox" id="check"> 
<label class="talkino-chat-btn" for="check"> 
	<div class="talkino-icon">
		<i class="dashicons <?php echo esc_html( get_option( 'talkino_chatbox_icon' ) ); ?> round talkino"></i>
	</div>
	<div class="talkino-rectangle-label">
		<?php echo esc_html( $talkino_chatbox_button_text ); ?><i class="dashicons <?php echo esc_html( get_option( 'talkino_chatbox_icon' ) ); ?> rectangle talkino"></i>
	</div>
</label>
<div class="talkino-chat-wrapper">
	<div class="talkino-chat-title">
		<b><?php esc_html_e( 'Offline', 'talkino' ); ?></b>
		<label class="talkino-chat-close" for="check">
			<i class="dashicons dashicons-minus talkino-chat-close-btn"></i>
		</label> 
	</div>
	<div class="talkino-chat-subtitle"> 
		<span><?php echo esc_html( $talkino_chat_subtitle ); ?></span> 
	</div>	
	<form id="talkino_contact_form" name="talkino_contact_form" method="post">
	<?php wp_nonce_field( 'talkino_contact_form_nonce_action', 'talkino_contact_form_nonce_field' ); ?>
		<input type="hidden" name="talkino_googlerecaptcha" id="talkino_googlerecaptcha" required>
		<div class="form-group talkino">
			<input type="text" name="talkino_contact_form_name" id="talkino_contact_form_name" class ="form-control talkino" placeholder="<?php esc_html_e( 'Enter your name', 'talkino' ); ?>" />
		</div>
		<div class="form-group talkino">
			<input type="email" name ="talkino_contact_form_email" id="talkino_contact_form_email" class="form-control talkino" placeholder="<?php esc_html_e( 'Enter your email', 'talkino' ); ?>" />
		</div> 
		<div class="form-group talkino">
			<textarea name="talkino_contact_form_message" id="talkino_contact_form_message" class="form-control talkino" rows="3" placeholder="<?php esc_html_e( 'Enter your message', 'talkino' ); ?>" ></textarea>
		</div>
		<br>
		<div class="spinner-border talkino"></div>
		<p id="talkino-contact-form-notice"></p>
		<?php
		if ( get_option( 'talkino_recaptcha_status' ) === 'on' && get_option( 'talkino_recaptcha_site_key' ) !== '' && get_option( 'talkino_recaptcha_secret_key' ) !== '' ) {

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
		<input type="button" class="talkino-submit-button" id="talkino_submit_button" value="<?php esc_html_e( 'Submit', 'talkino' ); ?>">
	</form>
	<?php 
	if ( get_option( 'talkino_credit' ) === 'on' ) {
	?>
	<div class="talkino-footer-wrapper">
		<a class="talkino-credit-link" href="https://traxconn.com/plugins/talkino/" target=”_blank”>Powered by Talkino</a> 
	</div>
	<?php
	}
	?>
</div>
