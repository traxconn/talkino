<?php
/**
 * The admin area to handle the meta boxes.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin area to handle the meta boxes.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Meta_Boxes {

	/**
	 * Create meta boxes.
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes() {

		add_meta_box(
			'talkino_contact_details',
			'Contact Details',
			array( $this, 'contact_meta_box_callback' ),
			'talkino_agents',
			'normal',
			'default'
		);

		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

			add_meta_box(
				'talkino_options',
				'Options',
				array( $this, 'options_meta_box_callback' ),
				'talkino_agents',
				'normal',
				'default'
			);

		}

	}

	/**
	 * Callback function to retrieve global and contact data and load the template file.
	 *
	 * @since    1.0.0
	 */
	public function contact_meta_box_callback() {

		// Call the class to load html to render meta boxes.
		$talkino_file_loader = new Talkino_File_Loader();

		global $post;
		$post_id = $post->ID;

		// Get the meta value to display on existing meta box.
		$job_title                   = ( ! empty( get_post_meta( $post_id, 'talkino_job_title', true ) ) ) ? get_post_meta( $post_id, 'talkino_job_title', true ) : '';
		$whatsapp_id                 = ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) ) ? get_post_meta( $post_id, 'talkino_whatsapp_id', true ) : '';
		$whatsapp_pre_filled_message = ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', true ) ) ) ? get_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', true ) : '';
		$facebook_id                 = ( ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ) ? get_post_meta( $post_id, 'talkino_facebook_id', true ) : '';
		$telegram_id                 = ( ! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) ) ? get_post_meta( $post_id, 'talkino_telegram_id', true ) : '';
		$phone_number                = ( ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) ) ? get_post_meta( $post_id, 'talkino_phone_number', true ) : '';
		$email                       = ( ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) ? get_post_meta( $post_id, 'talkino_email', true ) : '';

		// Make sure the contents of the form came from the location on the current site and not somewhere else.
		wp_nonce_field( basename( __FILE__ ), 'talkino_chatbox_nonce' );

		$contact_data = array(
			'job_title'                   => $job_title,
			'whatsapp_id'                 => $whatsapp_id,
			'whatsapp_pre_filled_message' => $whatsapp_pre_filled_message,
			'facebook_id'                 => $facebook_id,
			'telegram_id'                 => $telegram_id,
			'phone_number'                => $phone_number,
			'email'                       => $email,
		);

		// Load html to render contact meta box.
		$talkino_file_loader->load_meta_box_template_file( 'html-meta-box-contact.php', $contact_data );

	}

	/**
	 * Callback function to retrieve options data and load the template file.
	 *
	 * @since    1.0.0
	 */
	public function options_meta_box_callback() {

		// Call the class to load html to render meta boxes.
		$talkino_file_loader = new Talkino_File_Loader();

		global $post;
		$post_id = $post->ID;

		// Get the meta value to display on existing meta box.
		$agent_schedule_activate_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_activate_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_activate_status', true ) : 'off';

		$agent_schedule_monday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_monday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_monday_online_status', true ) : 'off';
		$agent_schedule_monday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_monday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_monday_start_time', true ) : '00:00';
		$agent_schedule_monday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_monday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_monday_end_time', true ) : '23:30';

		$agent_schedule_tuesday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_online_status', true ) : 'off';
		$agent_schedule_tuesday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_start_time', true ) : '00:00';
		$agent_schedule_tuesday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_tuesday_end_time', true ) : '23:30';

		$agent_schedule_wednesday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_online_status', true ) : 'off';
		$agent_schedule_wednesday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_start_time', true ) : '00:00';
		$agent_schedule_wednesday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_wednesday_end_time', true ) : '23:30';

		$agent_schedule_thursday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_thursday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_thursday_online_status', true ) : 'off';
		$agent_schedule_thursday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_thursday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_thursday_start_time', true ) : '00:00';
		$agent_schedule_thursday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_thursday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_thursday_end_time', true ) : '23:30';

		$agent_schedule_friday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_friday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_friday_online_status', true ) : 'off';
		$agent_schedule_friday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_friday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_friday_start_time', true ) : '00:00';
		$agent_schedule_friday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_friday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_friday_end_time', true ) : '23:30';

		$agent_schedule_saturday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_saturday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_saturday_online_status', true ) : 'off';
		$agent_schedule_saturday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_saturday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_saturday_start_time', true ) : '00:00';
		$agent_schedule_saturday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_saturday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_saturday_end_time', true ) : '23:30';

		$agent_schedule_sunday_online_status = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_sunday_online_status', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_sunday_online_status', true ) : 'off';
		$agent_schedule_sunday_start_time    = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_sunday_start_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_sunday_start_time', true ) : '00:00';
		$agent_schedule_sunday_end_time      = ( ! empty( get_post_meta( $post_id, 'talkino_agent_schedule_sunday_end_time', true ) ) ) ? get_post_meta( $post_id, 'talkino_agent_schedule_sunday_end_time', true ) : '23:30';

		// Make sure the contents of the form came from the location on the current site and not somewhere else.
		wp_nonce_field( basename( __FILE__ ), 'talkino_chatbox_nonce' );

		$options_data = array(
			'agent_schedule_activate_status'         => $agent_schedule_activate_status,

			'agent_schedule_monday_online_status'    => $agent_schedule_monday_online_status,
			'agent_schedule_monday_start_time'       => $agent_schedule_monday_start_time,
			'agent_schedule_monday_end_time'         => $agent_schedule_monday_end_time,

			'agent_schedule_tuesday_online_status'   => $agent_schedule_tuesday_online_status,
			'agent_schedule_tuesday_start_time'      => $agent_schedule_tuesday_start_time,
			'agent_schedule_tuesday_end_time'        => $agent_schedule_tuesday_end_time,

			'agent_schedule_wednesday_online_status' => $agent_schedule_wednesday_online_status,
			'agent_schedule_wednesday_start_time'    => $agent_schedule_wednesday_start_time,
			'agent_schedule_wednesday_end_time'      => $agent_schedule_wednesday_end_time,

			'agent_schedule_thursday_online_status'  => $agent_schedule_thursday_online_status,
			'agent_schedule_thursday_start_time'     => $agent_schedule_thursday_start_time,
			'agent_schedule_thursday_end_time'       => $agent_schedule_thursday_end_time,

			'agent_schedule_friday_online_status'    => $agent_schedule_friday_online_status,
			'agent_schedule_friday_start_time'       => $agent_schedule_friday_start_time,
			'agent_schedule_friday_end_time'         => $agent_schedule_friday_end_time,

			'agent_schedule_saturday_online_status'  => $agent_schedule_saturday_online_status,
			'agent_schedule_saturday_start_time'     => $agent_schedule_saturday_start_time,
			'agent_schedule_saturday_end_time'       => $agent_schedule_saturday_end_time,

			'agent_schedule_sunday_online_status'    => $agent_schedule_sunday_online_status,
			'agent_schedule_sunday_start_time'       => $agent_schedule_sunday_start_time,
			'agent_schedule_sunday_end_time'         => $agent_schedule_sunday_end_time,
		);

		// Load html to render options meta box.
		$talkino_file_loader->load_meta_box_template_file( 'html-meta-box-options.php', $options_data );

	}

	/**
	 * Save data for meta boxes.
	 *
	 * @since    1.0.0
	 * @param    string  $post_id    Id of the post.
	 * @param    WP_Post $post      Post object.
	 */
	// phpcs:disable
	public function save_meta_box( $post_id, $post ) {

		// Call the class to sanitize post meta.
		$talkino_sanitizer = new Talkino_Sanitizer();

		// Verify nonce.
		if ( ! isset( $_POST['talkino_chatbox_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['talkino_chatbox_nonce'] ) ), basename( __FILE__ ) ) ) {
			return $post_id;
		}

		// Get the post type object.
		$post_type = get_post_type_object( $post->post_type );

		// Check if the current user has permission to edit the post.
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		// Sanitize the contact data.
		$job_title                   = ( isset( $_POST['talkino_job_title'] ) ) ? sanitize_text_field( wp_unslash( $_POST['talkino_job_title'] ) ) : '';
		$whatsapp_id                 = ( isset( $_POST['talkino_whatsapp_id'] ) ) ? $talkino_sanitizer->sanitize_whatsapp_phone_number( wp_unslash( $_POST['talkino_whatsapp_id'] ) ) : '';
		$whatsapp_pre_filled_message = ( isset( $_POST['talkino_whatsapp_pre_filled_message'] ) ) ? sanitize_text_field( wp_unslash( $_POST['talkino_whatsapp_pre_filled_message'] ) ) : '';
		$facebook_id                 = ( isset( $_POST['talkino_facebook_id'] ) ) ? sanitize_text_field( wp_unslash( $_POST['talkino_facebook_id'] ) ) : '';
		$telegram_id                 = ( isset( $_POST['talkino_telegram_id'] ) ) ? sanitize_text_field( wp_unslash( $_POST['talkino_telegram_id'] ) ) : '';
		$phone_number                = ( isset( $_POST['talkino_phone_number'] ) ) ? $talkino_sanitizer->sanitize_phone_number( wp_unslash( $_POST['talkino_phone_number'] ) ) : '';
		$email                       = ( isset( $_POST['talkino_email'] ) ) ? sanitize_email( wp_unslash( $_POST['talkino_email'] ) ) : '';

		// Sanitize the options data.
		$agent_schedule_activate_status = ( isset( $_POST['talkino_agent_schedule_activate_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_activate_status'] ) ) : 'off';

		$agent_schedule_monday_online_status = ( isset( $_POST['talkino_agent_schedule_monday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_monday_online_status'] ) ) : 'off';
		$agent_schedule_monday_start_time    = ( isset( $_POST['talkino_agent_schedule_monday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_monday_start_time'] ) ) : '00:00';
		$agent_schedule_monday_end_time      = ( isset( $_POST['talkino_agent_schedule_monday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_monday_end_time'] ) ) : '23:30';

		$agent_schedule_tuesday_online_status = ( isset( $_POST['talkino_agent_schedule_tuesday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_tuesday_online_status'] ) ) : 'off';
		$agent_schedule_tuesday_start_time    = ( isset( $_POST['talkino_agent_schedule_tuesday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_tuesday_start_time'] ) ) : '00:00';
		$agent_schedule_tuesday_end_time      = ( isset( $_POST['talkino_agent_schedule_tuesday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_tuesday_end_time'] ) ) : '23:30';

		$agent_schedule_wednesday_online_status = ( isset( $_POST['talkino_agent_schedule_wednesday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_wednesday_online_status'] ) ) : 'off';
		$agent_schedule_wednesday_start_time    = ( isset( $_POST['talkino_agent_schedule_wednesday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_wednesday_start_time'] ) ) : '00:00';
		$agent_schedule_wednesday_end_time      = ( isset( $_POST['talkino_agent_schedule_wednesday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_wednesday_end_time'] ) ) : '23:30';

		$agent_schedule_thursday_online_status = ( isset( $_POST['talkino_agent_schedule_thursday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_thursday_online_status'] ) ) : 'off';
		$agent_schedule_thursday_start_time    = ( isset( $_POST['talkino_agent_schedule_thursday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_thursday_start_time'] ) ) : '00:00';
		$agent_schedule_thursday_end_time      = ( isset( $_POST['talkino_agent_schedule_thursday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_thursday_end_time'] ) ) : '23:30';

		$agent_schedule_friday_online_status = ( isset( $_POST['talkino_agent_schedule_friday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_friday_online_status'] ) ) : 'off';
		$agent_schedule_friday_start_time    = ( isset( $_POST['talkino_agent_schedule_friday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_friday_start_time'] ) ) : '00:00';
		$agent_schedule_friday_end_time      = ( isset( $_POST['talkino_agent_schedule_friday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_friday_end_time'] ) ) : '23:30';

		$agent_schedule_saturday_online_status = ( isset( $_POST['talkino_agent_schedule_saturday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_saturday_online_status'] ) ) : 'off';
		$agent_schedule_saturday_start_time    = ( isset( $_POST['talkino_agent_schedule_saturday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_saturday_start_time'] ) ) : '00:00';
		$agent_schedule_saturday_end_time      = ( isset( $_POST['talkino_agent_schedule_saturday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_saturday_end_time'] ) ) : '23:30';

		$agent_schedule_sunday_online_status = ( isset( $_POST['talkino_agent_schedule_sunday_online_status'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_online_status( wp_unslash( $_POST['talkino_agent_schedule_sunday_online_status'] ) ) : 'off';
		$agent_schedule_sunday_start_time    = ( isset( $_POST['talkino_agent_schedule_sunday_start_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_sunday_start_time'] ) ) : '00:00';
		$agent_schedule_sunday_end_time      = ( isset( $_POST['talkino_agent_schedule_sunday_end_time'] ) ) ? $talkino_sanitizer->sanitize_agent_schedule_time( wp_unslash( $_POST['talkino_agent_schedule_sunday_end_time'] ) ) : '23:30';

		// Update contact post data.
		update_post_meta( $post_id, 'talkino_job_title', $job_title );
		update_post_meta( $post_id, 'talkino_whatsapp_id', $whatsapp_id );
		update_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', $whatsapp_pre_filled_message );
		update_post_meta( $post_id, 'talkino_facebook_id', $facebook_id );
		update_post_meta( $post_id, 'talkino_telegram_id', $telegram_id );
		update_post_meta( $post_id, 'talkino_phone_number', $phone_number );
		update_post_meta( $post_id, 'talkino_email', $email );

		// Update options post meta.
		update_post_meta( $post_id, 'talkino_agent_schedule_activate_status', $agent_schedule_activate_status );

		update_post_meta( $post_id, 'talkino_agent_schedule_monday_online_status', $agent_schedule_monday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_monday_start_time', $agent_schedule_monday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_monday_end_time', $agent_schedule_monday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_tuesday_online_status', $agent_schedule_tuesday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_tuesday_start_time', $agent_schedule_tuesday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_tuesday_end_time', $agent_schedule_tuesday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_wednesday_online_status', $agent_schedule_wednesday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_wednesday_start_time', $agent_schedule_wednesday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_wednesday_end_time', $agent_schedule_wednesday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_thursday_online_status', $agent_schedule_thursday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_thursday_start_time', $agent_schedule_thursday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_thursday_end_time', $agent_schedule_thursday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_friday_online_status', $agent_schedule_friday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_friday_start_time', $agent_schedule_friday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_friday_end_time', $agent_schedule_friday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_saturday_online_status', $agent_schedule_saturday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_saturday_start_time', $agent_schedule_saturday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_saturday_end_time', $agent_schedule_saturday_end_time );

		update_post_meta( $post_id, 'talkino_agent_schedule_sunday_online_status', $agent_schedule_sunday_online_status );
		update_post_meta( $post_id, 'talkino_agent_schedule_sunday_start_time', $agent_schedule_sunday_start_time );
		update_post_meta( $post_id, 'talkino_agent_schedule_sunday_end_time', $agent_schedule_sunday_end_time );

		// Add agent ordering post meta for sorting purpose if it does not exist.
		if ( empty( get_post_meta( $post_id, 'talkino_agent_ordering', true ) ) ) {
			add_post_meta( $post_id, 'talkino_agent_ordering', 1 );
		}

	}
	// phpcs:enable
}
