<?php
/**
 * Displays the body of email.
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

?>
<div> 
	<?php echo esc_html( $data['user_message'] ); ?>
	<br>
	<?php echo esc_html( $data['user_name'] ); ?>
	<br>
	<?php echo esc_html( $data['user_email'] ); ?>
</div>
