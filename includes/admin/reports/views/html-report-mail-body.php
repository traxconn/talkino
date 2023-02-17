<?php
/**
 * Displays the body of reporting email.
 *
 * @link       https://traxconn.com
 * @since      2.0.5
 * @package    Talkino
 * @subpackage Talkino/includes/admin/reports/views
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$site_title = get_bloginfo( 'name' );

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body>
        <p><?php esc_html_e( 'This email was sent from your website', 'talkino' );?> "<?php echo $site_title; ?>" <?php esc_html_e( 'by the Talkino plugin.', 'talkino' );?></p>
        <p>
            <?php esc_html_e( 'The following is the weekly report of the chat channels with the total clicks of your customers from', 'talkino' );?>
            <?php echo date( 'd-m-Y', strtotime( '-7 days' ) ); ?><?php esc_html_e( ' to ', 'talkino' );?><?php echo date( 'd-m-Y' ); ?>.   
        </p>

        <div>
            <h3 style="text-align: left;"><?php esc_html_e( 'Chat Channel Report', 'talkino' ); ?></h3>
            <table style="border-spacing: 0;">
                <tr>
                    <th style="background-color: #bfd3db; font-weight: bold; text-align: center; padding: 8px; border: 1px solid #ddd; width: 200px;"><?php esc_html_e( 'Chat Channel', 'talkino' );?></th>
                    <th style="background-color: #bfd3db; font-weight: bold; text-align: center; padding: 8px; border: 1px solid #ddd; width: 200px;"><?php esc_html_e( 'Total', 'talkino' );?></th>
                </tr>

                <?php

                if ( count( $data ) == 0 ) {
                ?>
                    <tr>
                        <td style="text-align: center; padding: 8px; border: 1px solid #ddd; border: 1px solid #ddd;"><?php echo esc_html( "-" ); ?></td>
                        <td style="text-align: center; padding: 8px; border: 1px solid #ddd; border: 1px solid #ddd;"><?php echo esc_html( "0" ); ?></td>
                    </tr>
                <?php
                }

                foreach ( $data as $data_id ) {
                    
                ?>
                    <tr>
                        <td style="text-align: center; padding: 8px; border: 1px solid #ddd; border: 1px solid #ddd;"><?php echo esc_html( $data_id['chat_channel'] ); ?></td>
                        <td style="text-align: center; padding: 8px; border: 1px solid #ddd; border: 1px solid #ddd;"><?php echo esc_html( $data_id['total'] ); ?></td>
                    </tr>
                <?php
            }
            ?>
            </table>
        </div>

        <p><?php esc_html_e( 'NOTE: You are using the free version of Talkino. Upgrade today to access more advanced reporting and other awesome features as below:', 'talkino' );?></p>

        <ul>
            <li><?php esc_html_e( 'Automated reply to customers with chatbot 24 hours a day and save cost on manpowers', 'talkino' );?></li>
            <li><?php esc_html_e( 'Supports shortcode to add widget button or box inside any post or WooCommerce page', 'talkino' );?></li>
            <li><?php esc_html_e( 'Blocking feature to help you to restrict users in certain countries from reaching you, especially countries where your service is not provided', 'talkino' );?></li>
            <li><?php esc_html_e( 'Online time schedule to display different agents at different times on the chatbox of your site', 'talkino' );?></li>
            <li><?php esc_html_e( 'Contact form to let users email to admin when chatbox is under offline mode and Google reCaptcha v3 to protect the form from spam', 'talkino' );?></li>
            <li><?php esc_html_e( 'Receive real-time reports with valuable insights on how customers are reaching your agents', 'talkino' );?></li>
            <li><?php esc_html_e( 'Data visualization of reporting in chart format', 'talkino' );?></li>
            <li><?php esc_html_e( 'Provide a support ticket system for you to get support from our team', 'talkino' );?></li>
        </ul>

        <p><?php esc_html_e( 'Click here to upgrade with Talkino Bundle:', 'talkino' );?></p>
        <a href="https://traxconn.com/plugins/talkino/" target="_blank">https://traxconn.com/plugins/talkino/</a> 

        <p><?php esc_html_e( 'If you don\'t want to receive reporting emails from Talkino, kindly please select "Receive Weekly Report" field as inactive in the Advanced tab of Talkino Settings.', 'talkino' );?></p>
       
    </body>
</html>