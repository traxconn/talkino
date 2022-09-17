<?php
/**
 * Displays the messenger metabox.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>

<div>
    <p>
        <label><b><?php esc_html_e( 'Job Title:', 'talkino' ) ?></b></label>
        <input type="text" name="talkino_job_title" maxlength="25" class="widefat" value="<?php echo esc_attr( $data['job_title'] ) ?>"/>
        <label><i><?php esc_html_e( 'The job position of the agent.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'WhatsApp ID:', 'talkino' ) ?></b></label>
        <input type="tel" name="talkino_whatsapp_id" class="widefat" value="<?php echo esc_attr( $data['whatsapp_id'] ) ?>" />
        <label><i><?php esc_html_e( 'Use full phone number in international format or leave it empty to deactivate WhatsApp.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'WhatsApp Pre-filled Message:', 'talkino' ) ?></b></label>
        <input type="text" name="talkino_whatsapp_pre_filled_message" class="widefat" value="<?php echo esc_attr( $data['whatsapp_pre_filled_message'] ) ?>" />
        <label><i><?php esc_html_e( 'A pre-filled message that will automatically appear in the text field of a WhatsApp chat.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'Facebook Username/ Page Name:', 'talkino' ) ?></b></label>
        <input type="text" name="talkino_facebook_id" class="widefat" value="<?php echo esc_attr( $data['facebook_id'] ) ?>" />
        <label><i><?php esc_html_e( 'A username is the web address for your profile or Page. Leave it empty if you want to deactivate it.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'Telegram Username:', 'talkino' ) ?></b></label>
        <input type="text" name="talkino_telegram_id" class="widefat" value="<?php echo esc_attr( $data['telegram_id'] ) ?>" />
        <label><i><?php esc_html_e( 'Enter Telegram username. Leave it empty if you want to deactivate it.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'Phone Number:', 'talkino' ) ?></b></label>
        <input type="tel" name="talkino_phone_number" class="widefat" value="<?php echo esc_attr( $data['phone_number'] ) ?>" />
        <label><i><?php esc_html_e( 'Key in phone number or leave it empty if you want to deactivate it. Note: Only shown on mobile or tablet devices.', 'talkino' ) ?></i></label>
    </p>
    <p>
        <label><b><?php esc_html_e( 'Email:', 'talkino' ) ?></b></label>
        <input type="email" name="talkino_email" class="widefat" value="<?php echo esc_attr( $data['email'] ) ?>" />
        <label><i><?php esc_html_e( 'Personal or company email address. Leave it empty if you want to deactivate it.', 'talkino' ) ?></i></label>
    </p>
</div>