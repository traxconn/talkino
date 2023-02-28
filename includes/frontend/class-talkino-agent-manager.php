<?php
/**
 * The class to manage agents.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The class to manage agents.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/frontend
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Agent_Manager {

	/**
	 * The output of whatsapp.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $whatsapp_output    The output of whatsapp.
	 */
	public $whatsapp_output;

	/**
	 * The output of messenger.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $messenger_output    The output of messenger.
	 */
	public $messenger_output;

	/**
	 * The output of telegram.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $telegram_output    The output of telegram.
	 */
	public $telegram_output;

	/**
	 * The output of phone number.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $phone_output    The output of phone number.
	 */
	public $phone_output;

	/**
	 * The output of email.
	 *
	 * @since     1.0.0
	 * @access    public
	 * @var       string       $email_output    The output of email.
	 */
	public $email_output;

	/**
	 * Query agent's data by direct layout.
	 *
	 * @since    1.0.0
	 */
	public function query_agent_direct_data() {

		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
			$talkino_bundle_scheduler = new Talkino_Bundle_Scheduler();
		}

		$whatsapp_data         = '';
		$messenger_data         = '';
		$telegram_data         = '';
		$phone_data            = '';
		$email_data            = '';

		$whatsapp_url = 'https://wa.me/';

		// Prepare the query arguments.
		$args = array(
			'post_type'      => 'talkino_agents',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'meta_key'       => 'talkino_agent_ordering',
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
		);

		// Declare query object.
		$loop = new WP_Query( $args );

		// Start to query agent's data.
		while ( $loop->have_posts() ) :

			$loop->the_post();

			$post_id                              = get_the_ID();
			$is_agent_schedule_activate_status_on = false;
			$is_agent_schedule_online_status      = false;

			if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
				// Check whether the time schedule of agent is activated.
				if ( get_post_meta( $post_id, 'talkino_agent_schedule_activate_status', true ) === 'on' ) {

					$is_agent_schedule_activate_status_on = true;
					$is_agent_schedule_online_status      = $talkino_bundle_scheduler->check_agent_schedule_online_status( $post_id );

				}
			}

			$name = "";
			$full_name = "";
			$job_title = "";

			if ( ! empty( get_the_title() ) ) {
				// Retrieve and restrict the agent name to 20 characters.
				$name = strlen( get_the_title() ) > 20 ? substr( get_the_title(), 0, 20 ) . '...' : get_the_title();
				$full_name = get_the_title();
			}
			
			if ( ! empty( get_post_meta( $post_id, 'talkino_job_title', true ) ) ) {
				$job_title = get_post_meta( $post_id, 'talkino_job_title', true );
			}
			else {
				$job_title = "-----";
			}

			$target    = get_option( 'talkino_start_chat_method' );

			// Check whether the time schedule of agent is deactivated or both schedule online status and time schedule of agent is activated.
			if ( ( $full_name != 'Untitled' && $full_name != '' && false === $is_agent_schedule_activate_status_on ) || ( $full_name != 'Untitled' && $full_name != '' && true === $is_agent_schedule_online_status && true === $is_agent_schedule_activate_status_on ) ) {

				// Ensure only query the data if there is whatsapp id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) ) {

					$whatsapp_id                 = get_post_meta( $post_id, 'talkino_whatsapp_id', true );
					$whatsapp_pre_filled_message = rawurlencode( get_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', true ) );

					$whatsapp_data .= "
                    <a class='talkino-chat-direct-information' href='" . $whatsapp_url . $whatsapp_id . '?text=' . $whatsapp_pre_filled_message . "' target='" . $target . "' title='" . esc_html__( 'Chat on WhatsApp', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$whatsapp_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$whatsapp_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$whatsapp_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/whatsapp-icon.png' . "' alt='WhatsApp icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on WhatsApp', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
							<span class='talkino-hidden-chat-channel-type'>Whatsapp</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is facebook id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ) {

					$facebook_id = get_post_meta( $post_id, 'talkino_facebook_id', true );

					$messenger_data .= "
                    <a class='talkino-chat-direct-information' href='https://m.me/" . $facebook_id . "' target='" . $target . "' title='" . esc_html__( 'Chat on Messenger', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$messenger_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$messenger_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$messenger_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/messenger-icon.png' . "' alt='Messenger icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Messenger', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
							<span class='talkino-hidden-chat-channel-type'>Messenger</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is telegram id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) ) {

					$telegram_id = get_post_meta( $post_id, 'talkino_telegram_id', true );

					$telegram_data .= "
                    <a class='talkino-chat-direct-information' href='https://t.me/" . $telegram_id . "' target='" . $target . "' title='" . esc_html__( 'Chat on Telegram', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$telegram_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$telegram_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$telegram_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/telegram-icon.png' . "' alt='Telegram icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Telegram', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
							<span class='talkino-hidden-chat-channel-type'>Telegram</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if it is mobile view or it is desktop view and talkino_phone_show_only_on_mobile_status is off.
				if ( ( wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) ) || ( ! wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) && ! empty( get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) ) && get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) === 'off'  ) ) {

					$phone_number = get_post_meta( $post_id, 'talkino_phone_number', true );

					$phone_data .= "
                    <a class='talkino-chat-direct-information' href='tel:" . $phone_number . "' title='" . esc_html__( 'Chat on Phone', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$phone_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$phone_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$phone_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/phone-icon.png' . "' alt='Phone icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Phone', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
							<span class='talkino-hidden-chat-channel-type'>Phone</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is telegram id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) {

					$email = get_post_meta( $post_id, 'talkino_email', true );

					$email_data .= "
                    <a class='talkino-chat-direct-information' href='mailto:" . $email . "' title='" . esc_html__( 'Chat on Email', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$email_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$email_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$email_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/email-icon.png' . "' alt='Email icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat on Email', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
							<span class='talkino-hidden-chat-channel-type'>Email</span>
                        </div>
                    </a>
                    ";

				}
			}

			// Show offline agents.
			else if ( $full_name != 'Untitled' && $full_name != '' && get_option( 'talkino_show_offline_agents' ) == 'show' ) {

				// Ensure only query the data if there is whatsapp id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) ) {

					$whatsapp_data .= "
                    <a class='talkino-chat-direct-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$whatsapp_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$whatsapp_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$whatsapp_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/whatsapp-icon.png' . "' alt='WhatsApp icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is facebook id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ) {

					$messenger_data .= "
                    <a class='talkino-chat-direct-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$messenger_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$messenger_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$messenger_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/messenger-icon.png' . "' alt='Messenger icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is telegram id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) ) {

					$telegram_data .= "
                    <a class='talkino-chat-direct-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$telegram_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$telegram_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$telegram_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/telegram-icon.png' . "' alt='Telegram icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if it is mobile view or it is desktop view and talkino_phone_show_only_on_mobile_status is off.
				if ( ( wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) ) || ( ! wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) && ! empty( get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) ) && get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) === 'off'  ) ) {

					$phone_data .= "
                    <a class='talkino-chat-direct-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$phone_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$phone_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$phone_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/phone-icon.png' . "' alt='Phone icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

				// Ensure only query the data if there is telegram id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) {

					$email_data .= "
                    <a class='talkino-chat-direct-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$email_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$email_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$email_data .= "

                            <img class='talkino-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/email-icon.png' . "' alt='Email icon' />
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

			}

		endwhile;

		$this->whatsapp_output = $whatsapp_data;
		$this->messenger_output = $messenger_data;
		$this->telegram_output = $telegram_data;
		$this->phone_output    = $phone_data;
		$this->email_output    = $email_data;

		wp_reset_postdata();

	}

	/**
	 * Get whatsapp output.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The output of whatsapp.
	 */
	public function get_whatsapp_output() {
		return $this->whatsapp_output;
	}

	/**
	 * Get messenger output.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The output of messenger.
	 */
	public function get_messenger_output() {
		return $this->messenger_output;
	}

	/**
	 * Get telegram output.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The output of telegram.
	 */
	public function get_telegram_output() {
		return $this->telegram_output;
	}

	/**
	 * Get phone number output.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The output of phone number.
	 */
	public function get_phone_output() {
		return $this->phone_output;
	}

	/**
	 * Get email output.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The output of email.
	 */
	public function get_email_output() {
		return $this->email_output;
	}

	/**
	 * Query agent's data by modern layout.
	 *
	 * @since    2.0.5
	 * 
	 * @return    string    Output of modern data.
	 */
	public function query_agent_modern_data() {

		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
			$talkino_bundle_scheduler = new Talkino_Bundle_Scheduler();
		}

		$output = '';

		// Prepare the query arguments.
		$args = array(
			'post_type'      => 'talkino_agents',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'meta_key'       => 'talkino_agent_ordering',
			'orderby'        => 'meta_value_num',
			'order'          => 'ASC',
		);

		// Declare query object.
		$loop = new WP_Query( $args );

		// Start to query agent's data.
		while ( $loop->have_posts() ) :

			$loop->the_post();

			$post_id                              = get_the_ID();
			$is_agent_schedule_activate_status_on = false;
			$is_agent_schedule_online_status      = false;

			$name = "";
			$full_name = "";
			$job_title = "";

			if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

				// Check whether the time schedule of agent is activated.
				if ( get_post_meta( $post_id, 'talkino_agent_schedule_activate_status', true ) === 'on' ) {

					$is_agent_schedule_activate_status_on = true;
					$is_agent_schedule_online_status      = $talkino_bundle_scheduler->check_agent_schedule_online_status( $post_id );

				}
			}

			if ( ! empty( get_the_title() ) ) {

				// Retrieve and restrict the agent name to 20 characters.
				$name = strlen( get_the_title() ) > 20 ? substr( get_the_title(), 0, 20 ) . '...' : get_the_title();
				$full_name = get_the_title();

			}
			
			if ( ! empty( get_post_meta( $post_id, 'talkino_job_title', true ) ) ) {
				$job_title = get_post_meta( $post_id, 'talkino_job_title', true );
			}
			else {
				$job_title = "-----";
			}

			$target    = get_option( 'talkino_start_chat_method' );

			// Check whether the time schedule of agent is deactivated or both schedule online status and time schedule of agent is activated.
			if ( ( $full_name != 'Untitled' && $full_name != '' && false === $is_agent_schedule_activate_status_on ) || ( $full_name != 'Untitled' && $full_name != '' && true === $is_agent_schedule_online_status && true === $is_agent_schedule_activate_status_on ) ) {

				// Ensure only query the data if there is id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ||
				! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) {

					$output .= "
                    <a class='talkino-chat-modern-information' title='" . esc_html__( 'Chat Now', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$output .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$output .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$output .= "
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Chat Now', 'talkino' ) . "</span>
							<span class='talkino-hidden-agent-id'>" . $post_id . " </span>
							<span class='talkino-hidden-full-name'>" . $full_name . " </span>
                        </div>
                    </a>
                    ";

				}

			}

			// Show offline agents.
			else if ( $full_name != 'Untitled' && $full_name != '' && get_option( 'talkino_show_offline_agents' ) == 'show' ) {

				// Ensure only query the data if there is whatsapp id.
				if ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ||
				! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) || ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) {

					$output .= "
                    <a class='talkino-chat-modern-information-offline' title='" . esc_html__( 'Offline', 'talkino' ) . "'>
                        <div class='talkino-chat-avatar'>";

						// Check if contains avatar image.
					if ( has_post_thumbnail() ) {
						$output .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' alt='" . $name . "' />";

					} else {
						$output .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' alt='Avatar icon' />";
					}

						$output .= "
                        </div>

                        <div class='talkino-chat-info'>
                            <span class='talkino-chat-name'>" . $name . "</span>
                            <span class='talkino-chat-job-title'>" . $job_title . "</span>
                            <span class='talkino-chat-channel'>" . esc_html__( 'Offline', 'talkino' ) . "</span>
                        </div>
                    </a>
                    ";

				}

			}

		endwhile;

		wp_reset_postdata();

		return $output;

	}

	/**
	 * Draw modern layout.
	 *
	 * @since    2.0.5
	 */
	public function talkino_draw_agent_profile() {

		$talkino_ordering_manager = new Talkino_Ordering_Manager();

		$agent_id = $_POST['agent_id'];
		$welcome_message = esc_html__( 'Hello, how can I help you? Let\'s contact me to further discuss!', 'talkino' );
		$whatsapp_output = "";
		$messenger_output = "";
		$telegram_output = "";
		$phone_output = "";
		$email_output = "";

		// Prepare the query arguments.
		$args = array(
			'post_type'      => 'talkino_agents',
			'post_status'    => 'publish',
			'p' 		     => $agent_id,
		);
		
		// Declare query object.
		$loop = new WP_Query( $args );

		// Start to query agent's data.
		while ( $loop->have_posts() ) :
			
			$loop->the_post();
			$post_id = get_the_ID();
			
			$name = strlen( get_the_title() ) > 20 ? substr( get_the_title(), 0, 20 ) . '...' : get_the_title();
			$full_name = get_the_title();

			$target = get_option( 'talkino_start_chat_method' );

			if ( ! empty( get_post_meta( $post_id, 'talkino_welcome_message', true ) ) ) {
				$welcome_message = get_post_meta( $post_id, 'talkino_welcome_message', true );
			}

			// Ensure only query the data if there is whatsapp id.
			if ( ! empty( get_post_meta( $post_id, 'talkino_whatsapp_id', true ) ) ) {

				$whatsapp_url 				 = 'https://wa.me/';
				$whatsapp_id                 = get_post_meta( $post_id, 'talkino_whatsapp_id', true );
				$whatsapp_pre_filled_message = rawurlencode( get_post_meta( $post_id, 'talkino_whatsapp_pre_filled_message', true ) );

				
				$whatsapp_output = "
					<a class='talkino-agent-profile-link' href='" . $whatsapp_url . $whatsapp_id . '?text=' . $whatsapp_pre_filled_message . "' target='" . $target . "' title='" . esc_html__( 'Chat on WhatsApp', 'talkino' ) . "'>
						<img class='talkino-agent-profile-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/agent-whatsapp-icon.png' . "' alt='WhatsApp icon' /><span class='talkino-hidden-agent-id'>" . $post_id . " </span><span class='talkino-hidden-full-name'>" . $full_name . " </span><span class='talkino-hidden-chat-channel-type'>Whatsapp</span></a>";

			}

			// Ensure only query the data if there is facebook id.
			if ( ! empty( get_post_meta( $post_id, 'talkino_facebook_id', true ) ) ) {

				$facebook_id = get_post_meta( $post_id, 'talkino_facebook_id', true );

				$messenger_output = "
					<a class='talkino-agent-profile-link' href='https://m.me/" . $facebook_id . "' target='" . $target . "' title='" . esc_html__( 'Chat on Messenger', 'talkino' ) . "'>
						<img class='talkino-agent-profile-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/agent-messenger-icon.png' . "' alt='Messenger icon' /><span class='talkino-hidden-agent-id'>" . $post_id . " </span><span class='talkino-hidden-full-name'>" . $full_name . " </span><span class='talkino-hidden-chat-channel-type'>Messenger</span></a>";
		
			}

			// Ensure only query the data if there is telegram id.
			if ( ! empty( get_post_meta( $post_id, 'talkino_telegram_id', true ) ) ) {

				$telegram_id = get_post_meta( $post_id, 'talkino_telegram_id', true );

				$telegram_output = "
						<a class='talkino-agent-profile-link' href='https://t.me/" . $telegram_id . "' target='" . $target . "' title='" . esc_html__( 'Chat on Telegram', 'talkino' ) . "'>
							<img class='talkino-agent-profile-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/agent-telegram-icon.png' . "' alt='Telegram icon' /><span class='talkino-hidden-agent-id'>" . $post_id . " </span><span class='talkino-hidden-full-name'>" . $full_name . " </span><span class='talkino-hidden-chat-channel-type'>Telegram</span></a>";

			}

			// Ensure only query the data if it is mobile view or it is desktop view and talkino_phone_show_only_on_mobile_status is off.
			if ( ( wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) ) || ( ! wp_is_mobile() && ! empty( get_post_meta( $post_id, 'talkino_phone_number', true ) ) && ! empty( get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) ) && get_post_meta( $post_id, 'talkino_phone_show_only_on_mobile_status', true ) === 'off'  ) ) {

				$phone_number = get_post_meta( $post_id, 'talkino_phone_number', true );

				$phone_output = "
						<a class='talkino-agent-profile-link' href='tel:" . $phone_number . "' title='" . esc_html__( 'Chat on Phone', 'talkino' ) . "'>
							<img class='talkino-agent-profile-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/agent-phone-icon.png' . "' alt='Phone icon' /><span class='talkino-hidden-agent-id'>" . $post_id . " </span><span class='talkino-hidden-full-name'>" . $full_name . " </span><span class='talkino-hidden-chat-channel-type'>Phone</span></a>";

			}

			// Ensure only query the data if there is email id.
			if ( ! empty( get_post_meta( $post_id, 'talkino_email', true ) ) ) {

				$email = get_post_meta( $post_id, 'talkino_email', true );

				$email_output = "
						<a class='talkino-agent-profile-link' href='mailto:" . $email . "' title='" . esc_html__( 'Chat on Email', 'talkino' ) . "'>
							<img class='talkino-agent-profile-channel-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/agent-email-icon.png' . "' alt='Email icon' /><span class='talkino-hidden-agent-id'>" . $post_id . " </span><span class='talkino-hidden-full-name'>" . $full_name . " </span><span class='talkino-hidden-chat-channel-type'>Email</span></a>";

			}
			
		endwhile;

		wp_reset_postdata();

		// Sort ordering of chat channels.
		$data = $talkino_ordering_manager->sort_chat_channels_ordering( $whatsapp_output, $messenger_output, $telegram_output, $phone_output, $email_output );

		$thumbnail_data= "";

		if ( has_post_thumbnail() ) {
			$thumbnail_data .= "<img src='" . get_the_post_thumbnail_url( $post_id, array( 70, 70 ) ) . "' />";

		} else {
			$thumbnail_data .= "<img src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/default.png' . "' />";
		}

		$output = 	"
					<div class='talkino-agent-bubble-chat-wrapper'>
						<div class='talkino-agent-profile-avatar'>" . $thumbnail_data . "</div>
						<div class='talkino-talk-bubble talkino-tri-right left-top'>
							<div class='talkino-talktext'>
								<p>" . $welcome_message . "</p>
								<p>" . 
									wp_kses_post( $data['first_output'] ) . 
									wp_kses_post( $data['second_output'] ) . 
									wp_kses_post( $data['third_output'] ) . 
									wp_kses_post( $data['fourth_output'] ) .
									wp_kses_post( $data['fifth_output'] ) .	
								"</p>
							</div>
						</div>
					</div>";

		// Convert the result data to json format and return the result with json format.
		echo wp_kses_post( $output );
		
		// Terminate the script.
		die();

	}

}
