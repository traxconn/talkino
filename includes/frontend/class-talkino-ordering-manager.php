<?php
/**
 * The function to handle the ordering functions.
 *
 * @link       https://traxconn.com
 * @since      2.0.5
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The function to handle the ordering functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Ordering_Manager {
/**
	 * Sort ordering of chat channels.
	 *
	 * @since    2.0.5
	 *
	 * @return   array    The data of output.
	 */
	public function sort_chat_channels_ordering( $whatsapp_output, $messenger_output, $telegram_output, $phone_output, $email_output ) {

		if ( empty( get_option( 'talkino_channel_ordering' ) ) ) {

			// Assign the data from agents and pass it to html rendering file.
			$data = array(
				'first_output'  => $whatsapp_output,
				'second_output' => $messenger_output,
				'third_output'  => $telegram_output,
				'fourth_output' => $phone_output,
				'fifth_output'  => $email_output,
			);

		} else {

			$order = explode( ',', get_option( 'talkino_channel_ordering' ) );

			$first_output  = '';
			$second_output = '';
			$third_output  = '';
			$fourth_output = '';
			$fifth_output  = '';

			switch ( $order[0] ) {

				case 'talkino-whatsapp':
					$first_output = $whatsapp_output;
					break;

				case 'talkino-messenger':
					$first_output = $messenger_output;
					break;

				case 'talkino-telegram':
					$first_output = $telegram_output;
					break;

				case 'talkino-phone':
					$first_output = $phone_output;
					break;

				case 'talkino-email':
					$first_output = $email_output;
					break;

				default:
					$first_output = $whatsapp_output;

			}

			switch ( $order[1] ) {

				case 'talkino-whatsapp':
					$second_output = $whatsapp_output;
					break;

				case 'talkino-messenger':
					$second_output = $messenger_output;
					break;

				case 'talkino-telegram':
					$second_output = $telegram_output;
					break;

				case 'talkino-phone':
					$second_output = $phone_output;
					break;

				case 'talkino-email':
					$second_output = $email_output;
					break;

				default:
					$second_output = $messenger_output;

			}

			switch ( $order[2] ) {

				case 'talkino-whatsapp':
					$third_output = $whatsapp_output;
					break;

				case 'talkino-messenger':
					$third_output = $messenger_output;
					break;

				case 'talkino-telegram':
					$third_output = $telegram_output;
					break;

				case 'talkino-phone':
					$third_output = $phone_output;
					break;

				case 'talkino-email':
					$third_output = $email_output;
					break;

				default:
					$third_output = $telegram_output;

			}

			switch ( $order[3] ) {

				case 'talkino-whatsapp':
					$fourth_output = $whatsapp_output;
					break;

				case 'talkino-messenger':
					$fourth_output = $messenger_output;
					break;

				case 'talkino-telegram':
					$fourth_output = $telegram_output;
					break;

				case 'talkino-phone':
					$fourth_output = $phone_output;
					break;

				case 'talkino-email':
					$fourth_output = $email_output;
					break;

				default:
					$fourth_output = $phone_output;

			}

			switch ( $order[4] ) {

				case 'talkino-whatsapp':
					$fifth_output = $whatsapp_output;
					break;

				case 'talkino-messenger':
					$fifth_output = $messenger_output;
					break;

				case 'talkino-telegram':
					$fifth_output = $telegram_output;
					break;

				case 'talkino-phone':
					$fifth_output = $phone_output;
					break;

				case 'talkino-email':
					$fifth_output = $email_output;
					break;

				default:
					$fifth_output = $email_output;

			}

			// Assign the data from agents and pass it to html rendering file.
			$data = array(
				'first_output'  => $first_output,
				'second_output' => $second_output,
				'third_output'  => $third_output,
				'fourth_output' => $fourth_output,
				'fifth_output'  => $fifth_output,
			);

		}

		return $data;
        
	}

}