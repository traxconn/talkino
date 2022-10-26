<?php
/**
 * Displays the part of chatbox when away status.
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

	$talkino_chat_subtitle               = apply_filters( 'wpml_translate_single_string', get_option( 'talkino_chatbox_away_subtitle' ), 'talkino', 'Chatbox Away Subtitle' );
	$talkino_chatbox_button_text         = apply_filters( 'wpml_translate_single_string', get_option( 'talkino_chatbox_button_text' ), 'talkino', 'Chatbox Button Text' );

} else {

	$talkino_chat_subtitle               = get_option( 'talkino_chatbox_away_subtitle' );
	$talkino_chatbox_button_text         = get_option( 'talkino_chatbox_button_text' );

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
		<b><?php esc_html_e( 'Away', 'talkino' ); ?></b>
		<label class="talkino-chat-close" for="check">
				<i class="dashicons dashicons-minus talkino-chat-close-btn"></i>
		</label> 
	</div>
	<div class="talkino-chat-subtitle"> 
		<span><?php echo esc_html( $talkino_chat_subtitle ); ?></span> 
	</div>
	<div class="talkino-information-wrapper">
		<?php

		echo wp_kses_post( $data['first_output'] );
		echo wp_kses_post( $data['second_output'] );
		echo wp_kses_post( $data['third_output'] );
		echo wp_kses_post( $data['fourth_output'] );
		echo wp_kses_post( $data['fifth_output'] );

		?>
	</div>
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
