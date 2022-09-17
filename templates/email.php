<?php
/**
 * Displays the body of email.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

?>
<div> 
    <?php echo esc_html( $data['user_message'] )?>
    <br>
    <?php echo esc_html( $data['user_name'] )?>
    <br>
    <?php echo esc_html( $data['user_email'] )?>
</div>