<?php
/**
 * The admin area to handle settings of the plugin.
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
 * The admin area to handle settings of the plugin.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Settings {

	/**
	 * Create settings page of submenu to link to agent post type.
	 *
	 * @since    1.0.0
	 */
	public function create_settings_submenu_page() {

		add_submenu_page( 'edit.php?post_type=talkino_agents', esc_html__( 'Talkino Settings', 'talkino' ), esc_html__( 'Settings', 'talkino' ), 'manage_options', 'talkino_settings_page', array( $this, 'settings_page_callback' ) );
		add_submenu_page( 'edit.php?post_type=talkino_agents', esc_html__( 'Extensions', 'talkino' ), '<span style="color:coral">' . esc_html__( 'Extensions', 'talkino' ) . '</span>', 'manage_options', 'talkino_extensions_page', array( $this, 'extensions_page_callback' ) );

	}

	/**
	 * Render the settings page.
	 *
	 * @since    1.0.0
	 */
	public function settings_page_callback() {

		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$default_tab = null;
		$tab         = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : $default_tab;

		?>
		<div class="wrap">
			<!-- Title of settings. -->
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<!-- Tabs of settings. -->
			<nav class="nav-tab-wrapper">
				<a href="?post_type=talkino_agents&page=talkino_settings_page" class="nav-tab <?php if ( null === $tab ) : ?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Settings', 'talkino' ); ?></a>
				<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=styles" class="nav-tab <?php if ( 'styles' === $tab ) : ?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Styles', 'talkino' ); ?></a>
				<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=ordering" class="nav-tab <?php if ( 'ordering' === $tab ) : ?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Ordering', 'talkino' ); ?></a>
				<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=display" class="nav-tab <?php if ( 'display' === $tab ) : ?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Display', 'talkino' ); ?></a>
				<?php
				// Display contact form tab for talkino bundle.
				if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {
					?>
					<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=contact-form" class="nav-tab <?php if ( 'contact-form' === $tab ) : ?>
						nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Contact Form', 'talkino' ); ?></a>
					<?php
				}
				?>
				<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=credit" class="nav-tab <?php if ( 'credit' === $tab ) : ?>
				nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Credit', 'talkino' ); ?></a>
				<a href="?post_type=talkino_agents&page=talkino_settings_page&tab=advanced" class="nav-tab <?php if ( 'advanced' === $tab ) : ?>
					nav-tab-active<?php endif; ?>"><?php esc_html_e( 'Advanced', 'talkino' ); ?></a>
			</nav>			
			<div class="tab-content">
				<?php
				// Display all tabs for talkino bundle.
				if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

					switch ( $tab ) :

						case 'styles':
							?>
						<div class="wrap">
							<form action="options.php" method="post">
								<?php
								// Show error or update message.
								settings_errors();

								// Output security fields for the registered styles page.
								settings_fields( 'talkino_styles_page' );

								// Output styles sections and fields.
								do_settings_sections( 'talkino_styles_page' );

								// Output save settings button.
								submit_button( esc_html__( 'Save Settings', 'talkino' ) );
								?>
							</form>
						</div>
							<?php
							break;

						case 'ordering':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered styles page.
									settings_fields( 'talkino_ordering_page' );

									// Output styles sections and fields.
									do_settings_sections( 'talkino_ordering_page' );

									?>
								</form>
							</div>
							<?php
							break;

						case 'display':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered advanced page.
									settings_fields( 'talkino_display_page' );

									// Output advanced sections and fields.
									do_settings_sections( 'talkino_display_page' );

									// Output save settings button.
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );

									?>
								</form>
							</div>
							<?php
							break;

						case 'contact-form':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered contact form page.
									settings_fields( 'talkino_contact_form_page' );

									// Output contact form sections and fields.
									do_settings_sections( 'talkino_contact_form_page' );
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );

									?>
								</form>
							</div>
							<?php
							break;

						case 'credit':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered advanced page.
									settings_fields( 'talkino_credit_page' );

									// Output advanced sections and fields.
									do_settings_sections( 'talkino_credit_page' );

									// Output save settings button.
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );
									?>
								</form>
							</div>
							<?php
							break;

						case 'advanced':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered advanced page.
									settings_fields( 'talkino_advanced_page' );

									// Output advanced sections and fields.
									do_settings_sections( 'talkino_advanced_page' );

									// Output save settings button.
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );
									?>
								</form>
							</div>
							<?php
							break;

						default:
							?>
						<div class="wrap">
							<form action="options.php" method="post">
								<?php
								// Show error or update message.
								settings_errors();

								// Output security fields for the registered setting page.
								settings_fields( 'talkino_settings_page' );

								// Output setting sections and fields.
								do_settings_sections( 'talkino_settings_page' );

								// Output save settings button.
								submit_button( esc_html__( 'Save Settings', 'talkino' ) );
								?>
							</form>
						</div>
							<?php
							break;

					endswitch;

				} else { // Display the basic tabs for talkino.

					switch ( $tab ) :

						case 'styles':
							?>
						<div class="wrap">
							<form action="options.php" method="post">
								<?php
								// Show error or update message.
								settings_errors();

								// Output security fields for the registered styles page.
								settings_fields( 'talkino_styles_page' );

								// Output styles sections and fields.
								do_settings_sections( 'talkino_styles_page' );

								// Output save settings button.
								submit_button( esc_html__( 'Save Settings', 'talkino' ) );
								?>
							</form>
						</div>
							<?php
							break;

						case 'ordering':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered styles page.
									settings_fields( 'talkino_ordering_page' );

									// Output styles sections and fields.
									do_settings_sections( 'talkino_ordering_page' );

									?>
								</form>
							</div>
							<?php
							break;

						case 'display':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered advanced page.
									settings_fields( 'talkino_display_page' );

									// Output advanced sections and fields.
									do_settings_sections( 'talkino_display_page' );

									// Output save settings button.
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );

									?>
								</form>
							</div>
							<?php
							break;

						case 'credit':
							?>
							<div class="wrap">
								<form action="options.php" method="post">
									<?php
									// Show error or update message.
									settings_errors();

									// Output security fields for the registered advanced page.
									settings_fields( 'talkino_credit_page' );

									// Output advanced sections and fields.
									do_settings_sections( 'talkino_credit_page' );

									// Output save settings button.
									submit_button( esc_html__( 'Save Settings', 'talkino' ) );
									?>
								</form>
							</div>
							<?php
							break;

							case 'advanced':
								?>
								<div class="wrap">
									<form action="options.php" method="post">
										<?php
										// Show error or update message.
										settings_errors();
	
										// Output security fields for the registered advanced page.
										settings_fields( 'talkino_advanced_page' );
	
										// Output advanced sections and fields.
										do_settings_sections( 'talkino_advanced_page' );
	
										// Output save settings button.
										submit_button( esc_html__( 'Save Settings', 'talkino' ) );
										?>
									</form>
								</div>
								<?php
								break;

						default:
							?>
						<div class="wrap">
							<form action="options.php" method="post">
								<?php
								// Show error or update message.
								settings_errors();

								// Output security fields for the registered setting page.
								settings_fields( 'talkino_settings_page' );

								// Output setting sections and fields.
								do_settings_sections( 'talkino_settings_page' );

								// Output save settings button.
								submit_button( esc_html__( 'Save Settings', 'talkino' ) );
								?>
							</form>
						</div>
							<?php
							break;

					endswitch;

				}
				?>
			</div>
		</div>
		<?php

	}

	/**
	 * Render the extensions page.
	 *
	 * @since    1.1.1
	 */
	public function extensions_page_callback() {

		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Call the class to load html to render extension page.
		$talkino_file_loader = new Talkino_File_Loader();

		// Load html to render extension page.
		$talkino_file_loader->load_extensions_template_file( 'html-extensions.php' );

	}

	/**
	 * Initialize the section and fields of setting page.
	 *
	 * @since    1.0.0
	 */
	public function settings_init() {

		// Call the class to check whether Woocommerce is activated.
		$talkino_utility = new Talkino_Utility();

		/** Sections */
		// Register global online status section in the talkino settings page.
		add_settings_section(
			'talkino_global_online_status_section',
			esc_html__( 'Chatbox Online Status', 'talkino' ),
			array( $this, 'global_online_status_section_callback' ),
			'talkino_settings_page'
		);

		// Register text section in the talkino settings page.
		add_settings_section(
			'talkino_text_section',
			esc_html__( 'Chatbox Text', 'talkino' ),
			array( $this, 'text_section_callback' ),
			'talkino_settings_page'
		);

		// Register style section in the talkino styles page.
		add_settings_section(
			'talkino_styles_section',
			esc_html__( 'Styles', 'talkino' ),
			array( $this, 'styles_section_callback' ),
			'talkino_styles_page'
		);

		// Register template section in the talkino styles page.
		add_settings_section(
			'talkino_template_section',
			esc_html__( 'Template', 'talkino' ),
			array( $this, 'template_section_callback' ),
			'talkino_styles_page'
		);

		// Register chatbox color section in the talkino styles page.
		add_settings_section(
			'talkino_chatbox_color_section',
			esc_html__( 'Chatbox Color', 'talkino' ),
			array( $this, 'color_section_callback' ),
			'talkino_styles_page'
		);

		// Register agent field color section in the talkino styles page.
		add_settings_section(
			'talkino_agent_field_color_section',
			esc_html__( 'Agent Field Color', 'talkino' ),
			array( $this, 'agent_field_color_section_callback' ),
			'talkino_styles_page'
		);

		// Register ordering section in the talkino ordering page.
		add_settings_section(
			'talkino_ordering_section',
			esc_html__( 'Ordering', 'talkino' ),
			array( $this, 'ordering_section_callback' ),
			'talkino_ordering_page'
		);

		// Register display section in the talkino page.
		add_settings_section(
			'talkino_display_section',
			esc_html__( 'Pages Display', 'talkino' ),
			array( $this, 'display_section_callback' ),
			'talkino_display_page'
		);

		// Register display section in the talkino page.
		add_settings_section(
			'talkino_visibility_section',
			esc_html__( 'Visibility', 'talkino' ),
			array( $this, 'visibility_section_callback' ),
			'talkino_display_page'
		);

		// Register contact form section in the talkino contact form page.
		add_settings_section(
			'talkino_contact_form_section',
			esc_html__( 'Contact Form', 'talkino' ),
			array( $this, 'contact_form_section_callback' ),
			'talkino_contact_form_page'
		);

		// Register google recaptcha section in the talkino contact form page.
		add_settings_section(
			'talkino_google_recaptcha_section',
			esc_html__( 'Google reCaptcha v3', 'talkino' ),
			array( $this, 'google_recaptcha_section_callback' ),
			'talkino_contact_form_page'
		);

		// Register credit section in the talkino credit page.
		add_settings_section(
			'talkino_credit_section',
			esc_html__( 'Credit', 'talkino' ),
			array( $this, 'credit_section_callback' ),
			'talkino_credit_page'
		);

		// Register advanced section in the talkino advanced page.
		add_settings_section(
			'talkino_advanced_section',
			esc_html__( 'Advanced', 'talkino' ),
			array( $this, 'advanced_section_callback' ),
			'talkino_advanced_page'
		);

		/** Settings */
		// Register chatbox activation field.
		register_setting(
			'talkino_settings_page',
			'talkino_chatbox_activation',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_chatbox_activation' ),
				'default'           => '',
			)
		);

		// Add chatbox activation field.
		add_settings_field(
			'chatbox_activation_id',
			esc_html__( 'Chatbox Activation Status:', 'talkino' ),
			array( $this, 'chatbox_activation_field_callback' ),
			'talkino_settings_page',
			'talkino_global_online_status_section'
		);

		// Register global online status field.
		register_setting(
			'talkino_settings_page',
			'talkino_global_online_status',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_global_online_status' ),
				'default'           => '',
			)
		);

		// Add global online status field.
		add_settings_field(
			'global_online_status_id',
			esc_html__( 'Global Online Status:', 'talkino' ),
			array( $this, 'global_online_status_field_callback' ),
			'talkino_settings_page',
			'talkino_global_online_status_section'
		);

		// Display global schedule online status field for talkino bundle.
		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

			// Register global schedule online status option field.
			register_setting(
				'talkino_settings_page',
				'talkino_global_schedule_online_status',
				array(
					'type'              => 'array',
					'sanitize_callback' => array( $this, 'sanitize_global_schedule_online_status' ),
				)
			);

			// Add global schedule online status option field.
			add_settings_field(
				'global_schedule_id',
				esc_html__( 'Online Schedule:', 'talkino' ),
				array( $this, 'global_schedule_online_status_field_callback' ),
				'talkino_settings_page',
				'talkino_global_online_status_section'
			);

		}

		// Register chatbox online subtitle field.
		register_setting(
			'talkino_settings_page',
			'talkino_chatbox_online_subtitle',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add chatbox online subtitle field.
		add_settings_field(
			'talkino_chatbox_online_subtitle_id',
			esc_html__( 'Subtitle Text for Online Status:', 'talkino' ),
			array( $this, 'chatbox_online_subtitle_field_callback' ),
			'talkino_settings_page',
			'talkino_text_section'
		);

		// Register chatbox away subtitle field.
		register_setting(
			'talkino_settings_page',
			'talkino_chatbox_away_subtitle',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add chatbox online subtitle field.
		add_settings_field(
			'talkino_chatbox_away_subtitle_id',
			esc_html__( 'Subtitle Text for Away Status:', 'talkino' ),
			array( $this, 'chatbox_away_subtitle_field_callback' ),
			'talkino_settings_page',
			'talkino_text_section'
		);

		// Register chatbox away subtitle field.
		register_setting(
			'talkino_settings_page',
			'talkino_chatbox_offline_subtitle',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add chatbox online subtitle field.
		add_settings_field(
			'talkino_chatbox_offline_subtitle_id',
			esc_html__( 'Subtitle Text for Offline Status:', 'talkino' ),
			array( $this, 'chatbox_offline_subtitle_field_callback' ),
			'talkino_settings_page',
			'talkino_text_section'
		);

		// Register offline message option field.
		register_setting(
			'talkino_settings_page',
			'talkino_offline_message',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add offline message option field.
		add_settings_field(
			'offline_message_id',
			esc_html__( 'Offline Message:', 'talkino' ),
			array( $this, 'offline_message_field_callback' ),
			'talkino_settings_page',
			'talkino_text_section'
		);

		// Register chatbox button text option field.
		register_setting(
			'talkino_settings_page',
			'talkino_chatbox_button_text',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add chatbox button text option field.
		add_settings_field(
			'chatbox_button_text_message_id',
			esc_html__( 'Chatbox Button Text:', 'talkino' ),
			array( $this, 'chatbox_button_text_field_callback' ),
			'talkino_settings_page',
			'talkino_text_section'
		);

		/** Styles */
		// Register chatbox style option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_style',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_chatbox_style' ),
			)
		);

		// Add chatbox style option field.
		add_settings_field(
			'talkino_chatbox_style_id',
			esc_html__( 'Chatbox Style:', 'talkino' ),
			array( $this, 'chatbox_style_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Register chatbox position option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_position',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_chatbox_position' ),
			)
		);

		// Add chatbox position option field.
		add_settings_field(
			'talkino_chatbox_position_id',
			esc_html__( 'Chatbox Position:', 'talkino' ),
			array( $this, 'chatbox_position_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Register chatbox icon option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_icon',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => '',
			)
		);

		// Add chatbox icon option field.
		add_settings_field(
			'start_chatbox_icon_id',
			esc_html__( 'Chatbox Icon:', 'talkino' ),
			array( $this, 'chatbox_icon_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Register chatbox animation option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_animation',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_chatbox_animation' ),
			)
		);

		// Add chatbox animation option field.
		add_settings_field(
			'talkino_chatbox_animation_id',
			esc_html__( 'Chatbox Animation:', 'talkino' ),
			array( $this, 'chatbox_animation_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Register start chat method field.
		register_setting(
			'talkino_styles_page',
			'talkino_start_chat_method',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_start_chat_method' ),
				'default'           => '',
			)
		);

		// Add start chat method field.
		add_settings_field(
			'start_chat_method_id',
			esc_html__( 'Start Chatting Method:', 'talkino' ),
			array( $this, 'start_chat_method_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Register chatbox z-index field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_z_index',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_chatbox_z_index' ),
				'default'           => '',
			)
		);

		// Add chatbox z-index field.
		add_settings_field(
			'chatbox_z_index_id',
			esc_html__( 'Chatbox z-index:', 'talkino' ),
			array( $this, 'chatbox_z_index_field_callback' ),
			'talkino_styles_page',
			'talkino_styles_section'
		);

		// Add template color option field.
		add_settings_field(
			'talkino_template_color_id',
			esc_html__( 'Template Color:', 'talkino' ),
			array( $this, 'template_color_field_callback' ),
			'talkino_styles_page',
			'talkino_template_section'
		);

		// Register chatbox theme color option field for online status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_online_theme_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox theme color option field for online status.
		add_settings_field(
			'talkino_chatbox_online_theme_color_id',
			esc_html__( 'Theme Color for Online Status:', 'talkino' ),
			array( $this, 'chatbox_online_theme_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox icon color option field for online status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_online_icon_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox icon color option field for online status.
		add_settings_field(
			'talkino_chatbox_online_icon_color_id',
			esc_html__( 'Icon Color for Online Status:', 'talkino' ),
			array( $this, 'chatbox_online_icon_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox theme color option field for away status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_away_theme_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox theme color option field for away status.
		add_settings_field(
			'talkino_chatbox_away_theme_color_id',
			esc_html__( 'Theme Color for Away Status:', 'talkino' ),
			array( $this, 'chatbox_away_theme_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox icon color option field for away status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_away_icon_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox icon color option field for away status.
		add_settings_field(
			'talkino_chatbox_away_icon_color_id',
			esc_html__( 'Icon Color for Away Status:', 'talkino' ),
			array( $this, 'chatbox_away_icon_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox theme color option field for offline status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_offline_theme_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox theme color option field for offline status.
		add_settings_field(
			'talkino_chatbox_offline_theme_color_id',
			esc_html__( 'Theme Color for Offline Status:', 'talkino' ),
			array( $this, 'chatbox_offline_theme_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox icon color option field for offline status.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_offline_icon_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox icon color option field for offline status.
		add_settings_field(
			'talkino_chatbox_offline_icon_color_id',
			esc_html__( 'Icon Color for Offline Status:', 'talkino' ),
			array( $this, 'chatbox_offline_icon_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox background color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_background_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox background color option field.
		add_settings_field(
			'talkino_chatbox_background_color_id',
			esc_html__( 'Background Color:', 'talkino' ),
			array( $this, 'chatbox_background_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox title color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_title_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox title color option field.
		add_settings_field(
			'talkino_chatbox_title_color_id',
			esc_html__( 'Title Color:', 'talkino' ),
			array( $this, 'chatbox_title_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		// Register chatbox subtitle color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_chatbox_subtitle_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add chatbox subtitle color option field.
		add_settings_field(
			'talkino_chatbox_subtitle_color_id',
			esc_html__( 'Subtitle Color:', 'talkino' ),
			array( $this, 'chatbox_subtitle_color_field_callback' ),
			'talkino_styles_page',
			'talkino_chatbox_color_section'
		);

		if ( is_plugin_active( 'talkino-bundle/talkino-bundle.php' ) ) {

			// Register button color option field.
			register_setting(
				'talkino_styles_page',
				'talkino_chatbox_button_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			// Add button color option field.
			add_settings_field(
				'talkino_chatbox_button_color_id',
				esc_html__( 'Button Color:', 'talkino' ),
				array( $this, 'chatbox_button_color_field_callback' ),
				'talkino_styles_page',
				'talkino_chatbox_color_section'
			);

			// Register button color option field.
			register_setting(
				'talkino_styles_page',
				'talkino_chatbox_button_text_color',
				array(
					'sanitize_callback' => 'sanitize_hex_color',
				)
			);

			// Add button color option field.
			add_settings_field(
				'talkino_chatbox_button_text_color_id',
				esc_html__( 'Button Text Color:', 'talkino' ),
				array( $this, 'chatbox_button_text_color_field_callback' ),
				'talkino_styles_page',
				'talkino_chatbox_color_section'
			);

		}

		// Register agent field background color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_agent_field_background_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add agent field background color option field.
		add_settings_field(
			'talkino_agent_field_background_color_id',
			esc_html__( 'Field Background Color:', 'talkino' ),
			array( $this, 'agent_field_background_color_field_callback' ),
			'talkino_styles_page',
			'talkino_agent_field_color_section'
		);

		// Register agent field hover background color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_agent_field_hover_background_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add agent field hover background color option field.
		add_settings_field(
			'talkino_agent_field_hover_background_color_id',
			esc_html__( 'Field Hover Background Color:', 'talkino' ),
			array( $this, 'agent_field_hover_background_color_field_callback' ),
			'talkino_styles_page',
			'talkino_agent_field_color_section'
		);

		// Register agent name text color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_agent_name_text_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add agent name text color option field.
		add_settings_field(
			'talkino_agent_name_text_color_id',
			esc_html__( 'Name Text Color:', 'talkino' ),
			array( $this, 'agent_name_text_color_field_callback' ),
			'talkino_styles_page',
			'talkino_agent_field_color_section'
		);

		// Register agent job title text color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_agent_job_title_text_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add agent job title text color option field.
		add_settings_field(
			'talkino_agent_job_title_text_color_id',
			esc_html__( 'Job Title Text Color:', 'talkino' ),
			array( $this, 'agent_job_title_text_color_field_callback' ),
			'talkino_styles_page',
			'talkino_agent_field_color_section'
		);

		// Register agent channel text color option field.
		register_setting(
			'talkino_styles_page',
			'talkino_agent_channel_text_color',
			array(
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add agent channel text color option field.
		add_settings_field(
			'talkino_agent_channel_text_color_id',
			esc_html__( 'Channel Text Color:', 'talkino' ),
			array( $this, 'agent_channel_text_color_field_callback' ),
			'talkino_styles_page',
			'talkino_agent_field_color_section'
		);

		/** Ordering */
		// Add channel ordering option field.
		add_settings_field(
			'channel_ordering_id',
			esc_html__( 'Ordering of Chat Channels:', 'talkino' ),
			array( $this, 'channel_ordering_field_callback' ),
			'talkino_ordering_page',
			'talkino_ordering_section'
		);

		// Add agent ordering option field.
		add_settings_field(
			'agent_ordering_id',
			esc_html__( 'Ordering of Agents:', 'talkino' ),
			array( $this, 'agent_ordering_field_callback' ),
			'talkino_ordering_page',
			'talkino_ordering_section'
		);

		/** Display */
		// Register checkbox exclude pages option field.
		register_setting(
			'talkino_display_page',
			'talkino_chatbox_exclude_pages',
			array(
				'type' => 'array',
			)
		);

		// Add checkbox exclude pages option field.
		add_settings_field(
			'chatbox_exclude_pages_id',
			esc_html__( 'Exclude Pages from Chatbox Display:', 'talkino' ),
			array( $this, 'chatbox_exclude_pages_field_callback' ),
			'talkino_display_page',
			'talkino_display_section'
		);

		// Register show on post option field.
		register_setting(
			'talkino_display_page',
			'talkino_show_on_post',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_show_on_post' ),
			)
		);

		// Add show on post option field.
		add_settings_field(
			'show_on_post_id',
			esc_html__( 'Show on Blog and Post Pages:', 'talkino' ),
			array( $this, 'show_on_post_field_callback' ),
			'talkino_display_page',
			'talkino_display_section'
		);

		// Register show on search option field.
		register_setting(
			'talkino_display_page',
			'talkino_show_on_search',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_show_on_search' ),
			)
		);

		// Add show on search option field.
		add_settings_field(
			'show_on_search_id',
			esc_html__( 'Show on Search Page:', 'talkino' ),
			array( $this, 'show_on_search_field_callback' ),
			'talkino_display_page',
			'talkino_display_section'
		);

		// Register show on 404 option field.
		register_setting(
			'talkino_display_page',
			'talkino_show_on_404',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_show_on_404' ),
			)
		);

		// Add show on 404 option field.
		add_settings_field(
			'show_on_404_id',
			esc_html__( 'Show on 404 Page:', 'talkino' ),
			array( $this, 'show_on_404_field_callback' ),
			'talkino_display_page',
			'talkino_display_section'
		);

		// Check whether woocommerce is activated.
		if ( $talkino_utility->is_woocommerce_activated() ) {

			// Register show on woocommerce shop, product, product category and tag pages option field.
			register_setting(
				'talkino_display_page',
				'talkino_show_on_woocommerce_pages',
				array(
					'type'              => 'string',
					'sanitize_callback' => array( $this, 'sanitize_show_on_woocommerce_pages' ),
				)
			);

			// Add show on woocommerce shop, product, product category and tag pages option field.
			add_settings_field(
				'show_on_woocommerce_pages_id',
				esc_html__( 'Show on Woocommerce Pages:', 'talkino' ),
				array( $this, 'show_on_woocommerce_pages_field_callback' ),
				'talkino_display_page',
				'talkino_display_section'
			);
		}

		// Register show on desktop option field.
		register_setting(
			'talkino_display_page',
			'talkino_show_on_desktop',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_show_on_desktop' ),
			)
		);

		// Add show on desktop option field.
		add_settings_field(
			'show_on_desktop_id',
			esc_html__( 'Show on Desktop:', 'talkino' ),
			array( $this, 'show_on_desktop_field_callback' ),
			'talkino_display_page',
			'talkino_visibility_section'
		);

		// Register show on mobile option field.
		register_setting(
			'talkino_display_page',
			'talkino_show_on_mobile',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_show_on_mobile' ),
			)
		);

		// Add show on mobile option field.
		add_settings_field(
			'show_on_mobile_id',
			esc_html__( 'Show on Mobile:', 'talkino' ),
			array( $this, 'show_on_mobile_field_callback' ),
			'talkino_display_page',
			'talkino_visibility_section'
		);

		// Register user_visibility option field.
		register_setting(
			'talkino_display_page',
			'talkino_user_visibility',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_user_visibility' ),
			)
		);

		// Add user_visibility option field.
		add_settings_field(
			'user_visibility_id',
			esc_html__( 'User Visibility:', 'talkino' ),
			array( $this, 'user_visibility_field_callback' ),
			'talkino_display_page',
			'talkino_visibility_section'
		);


		/** Contact Form */
		// Register contact form status option field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_contact_form_status',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_contact_form_status' ),
			)
		);

		// Add contact form status option field.
		add_settings_field(
			'talkino_contact_form_status_id',
			esc_html__( 'Show Contact Form When Offline:', 'talkino' ),
			array( $this, 'contact_form_status_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register email recipient field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_email_recipient',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_email',
			)
		);

		// Add email recipient field.
		add_settings_field(
			'talkino_email_recipient_id',
			esc_html__( 'Email Recipient:', 'talkino' ),
			array( $this, 'email_recipient_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register email subject field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_email_subject',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add email subject field.
		add_settings_field(
			'talkino_email_subject_id',
			esc_html__( 'Email Subject:', 'talkino' ),
			array( $this, 'email_subject_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register sender message field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_sender_message',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_textarea_field',
			)
		);

		// Add sender message field.
		add_settings_field(
			'talkino_sender_message_id',
			esc_html__( 'Sender\'s Message:', 'talkino' ),
			array( $this, 'sender_message_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register sender name field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_sender_name',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add sender message field.
		add_settings_field(
			'talkino_sender_name_id',
			esc_html__( 'Sender\'s Name:', 'talkino' ),
			array( $this, 'sender_name_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register sender email field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_sender_email',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add sender message field.
		add_settings_field(
			'talkino_sender_email_id',
			esc_html__( 'Sender\'s Email:', 'talkino' ),
			array( $this, 'sender_email_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register successful email sent message field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_success_email_message',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add successful email sent message field.
		add_settings_field(
			'talkino_success_email_message_id',
			esc_html__( 'Successful Email Sent Message:', 'talkino' ),
			array( $this, 'success_email_message_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register failed email sent message field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_fail_email_message',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add failed email sent message field.
		add_settings_field(
			'talkino_fail_email_message_id',
			esc_html__( 'Failed Email Sent Message:', 'talkino' ),
			array( $this, 'fail_email_message_field_callback' ),
			'talkino_contact_form_page',
			'talkino_contact_form_section'
		);

		// Register recaptcha status option field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_recaptcha_status',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_recaptcha_status' ),
			)
		);

		// Add recaptcha status option field.
		add_settings_field(
			'talkino_recaptcha_status_id',
			esc_html__( 'Activate Google reCaptcha v3:', 'talkino' ),
			array( $this, 'recaptcha_status_field_callback' ),
			'talkino_contact_form_page',
			'talkino_google_recaptcha_section'
		);

		// Register recaptcha site key field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_recaptcha_site_key',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add recaptcha site key field.
		add_settings_field(
			'talkino_recaptcha_site_key_id',
			esc_html__( 'Google reCaptcha v3 Site Key:', 'talkino' ),
			array( $this, 'recaptcha_site_key_field_callback' ),
			'talkino_contact_form_page',
			'talkino_google_recaptcha_section'
		);

		// Register recaptcha secret key field.
		register_setting(
			'talkino_contact_form_page',
			'talkino_recaptcha_secret_key',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		// Add recaptcha secret key field.
		add_settings_field(
			'talkino_recaptcha_secret_key_id',
			esc_html__( 'Google reCaptcha v3 Secret Key:', 'talkino' ),
			array( $this, 'recaptcha_secret_key_field_callback' ),
			'talkino_contact_form_page',
			'talkino_google_recaptcha_section'
		);

		/** Credit */
		// Register credit option field.
		register_setting(
			'talkino_credit_page',
			'talkino_credit',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_credit' ),
			)
		);

		// Add credit option field.
		add_settings_field(
			'credit_id',
			esc_html__( 'Enable credit display:', 'talkino' ),
			array( $this, 'credit_field_callback' ),
			'talkino_credit_page',
			'talkino_credit_section'
		);

		/** Advanced */
		// Register reset settings status option field.
		register_setting(
			'talkino_advanced_page',
			'talkino_reset_settings_status',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_reset_settings_status' ),
			)
		);

		// Add reset settings status option field.
		add_settings_field(
			'reset_settings_status_id',
			esc_html__( 'Reset Settings:', 'talkino' ),
			array( $this, 'reset_settings_status_field_callback' ),
			'talkino_advanced_page',
			'talkino_advanced_section'
		);

		// Register data uninstall status option field.
		register_setting(
			'talkino_advanced_page',
			'talkino_data_uninstall_status',
			array(
				'type'              => 'string',
				'sanitize_callback' => array( $this, 'sanitize_data_uninstall_status' ),
			)
		);

		// Add data uninstall status option field.
		add_settings_field(
			'data_uninstall_status_id',
			esc_html__( 'Remove Data on Uninstall:', 'talkino' ),
			array( $this, 'data_uninstall_status_field_callback' ),
			'talkino_advanced_page',
			'talkino_advanced_section'
		);

	}

	/********************************* Sections *********************************/
	/**
	 * Callback function to render the online status section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of online status section.
	 */
	public function global_online_status_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Global settings to handle online status and schedule of chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the text section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of text section.
	 */
	public function text_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Edit the text of chatbox and its display.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the styles section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of styles section.
	 */
	public function styles_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Customize the style of the chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the template section.
	 *
	 * @since    2.0.0
	 * @param    array $args    The arguments of template section.
	 */
	public function template_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Options of template for the chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the chatbox color section.
	 *
	 * @since    2.0.0
	 * @param    array $args    The arguments of chatbox color section.
	 */
	public function color_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Customize the colors of the chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the agent field color section.
	 *
	 * @since    2.0.0
	 * @param    array $args    The arguments of agent field color section.
	 */
	public function agent_field_color_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Customize the colors of the agent field.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the ordering section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of ordering section.
	 */
	public function ordering_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Just drag and drop to arrange the ordering of chat channels and agents. It will be saved automatically.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the display section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of display section.
	 */
	public function display_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Manage the pages, post, search and WooCommerce pages to display or hide chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the visibility section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of visibility section.
	 */
	public function visibility_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Manage the chatbox visibility on desktop and mobile.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the contact form section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of contact form section.
	 */
	public function contact_form_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Settings to activate and handle contact form when chatbox is offline.', 'talkino' ); ?></p>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'For the fields of "Sender\'s Message", "Sender\'s Name" and "Sender\'s Email", %%sender_name%% represents sender\'s name, %%sender_email%% represents sender\'s email and %%message%% represents message.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the google recaptcha section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of google recaptcha section.
	 */
	public function google_recaptcha_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Enable Google reCaptcha v3 on the contact form.', 'talkino' ); ?>
		<?php esc_html_e( 'Please refer', 'talkino' ); ?><a href="https://www.google.com/recaptcha/admin/create" target=”_blank” > here </a><?php esc_html_e( 'to create Google reCaptcha v3 site key and secret key.', 'talkino' ); ?>  
		</p>
		<?php

	}

	/**
	 * Callback function to render the credit section.
	 *
	 * @since    2.0.0
	 * @param    array $args    The arguments of credit section.
	 */
	public function credit_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'The credit settings to control the option of displaying credit on the chatbox.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render the advanced section.
	 *
	 * @since    1.0.0
	 * @param    array $args    The arguments of advanced section.
	 */
	public function advanced_section_callback( $args ) {

		?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'The advanced settings to control the option of reset settings and uninstallation.', 'talkino' ); ?></p>
		<?php

	}

	/********************************* Settings *********************************/
	/**
	 * Callback function to render chatbox activation field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_activation_field_callback() {

		$chatbox_activation_field = get_option( 'talkino_chatbox_activation' );

		?>
		<select name="talkino_chatbox_activation" class="regular-text">
			<option value="active" <?php selected( 'active', $chatbox_activation_field ); ?>><?php esc_html_e( 'Active', 'talkino' ); ?></option>
			<option value="inactive" <?php selected( 'inactive', $chatbox_activation_field ); ?>><?php esc_html_e( 'Inactive', 'talkino' ); ?></option>
		</select>
		<?php

	}

	/**
	 * Sanitize function to validate the chatbox activation field.
	 *
	 * @since     1.0.0
	 * @param     string $chatbox_activation    The chatbox_activation.
	 *
	 * @return    string    The validated value of chatbox_activation.
	 */
	public function sanitize_chatbox_activation( $chatbox_activation ) {

		if ( 'active' !== $chatbox_activation && 'inactive' !== $chatbox_activation ) {

			$chatbox_activation = 'active';

			// Notify the user on invalid input.
			add_settings_error( 'talkino_chatbox_activation', 'invalid_chatbox_activation_value', esc_html__( 'Oops, you have inserted invalid input of chatbox activation field!', 'talkino' ), 'error' );

		}

		return $chatbox_activation;

	}

	/**
	 * Callback function to render global online status field.
	 *
	 * @since    1.0.0
	 */
	public function global_online_status_field_callback() {

		$global_online_status_field = get_option( 'talkino_global_online_status' );

		?>
		<select name="talkino_global_online_status" class="regular-text">
			<option value="online" <?php selected( 'online', $global_online_status_field ); ?>><?php esc_html_e( 'Online', 'talkino' ); ?></option>
			<option value="away" <?php selected( 'away', $global_online_status_field ); ?>><?php esc_html_e( 'Away', 'talkino' ); ?></option>
			<option value="offline" <?php selected( 'offline', $global_online_status_field ); ?>><?php esc_html_e( 'Offline', 'talkino' ); ?></option>
		</select>
		<?php

	}

	/**
	 * Sanitize function to validate the global online status field.
	 *
	 * @since     1.0.0
	 * @param     string $global_online_status    The global_online_status.
	 *
	 * @return    string    The validated value of global_online_status.
	 */
	public function sanitize_global_online_status( $global_online_status ) {

		if ( 'online' !== $global_online_status && 'away' !== $global_online_status && 'offline' !== $global_online_status ) {

			$global_online_status = 'online';

			// Notify the user on invalid input.
			add_settings_error( 'talkino_global_online_status', 'invalid_global_online_status_value', esc_html__( 'Oops, you have inserted invalid input of global online status field!', 'talkino' ), 'error' );

		}

		return $global_online_status;

	}

	/**
	 * Callback function to render global schedule field.
	 *
	 * @since    1.0.0
	 */
	public function global_schedule_online_status_field_callback() {

		// Declare the class to use various functions.
		$talkino_tools = new Talkino_Tools();

		$global_online_schedule_field = get_option( 'talkino_global_schedule_online_status' );

		// Declare the values of weekday checkbox.
		$is_monday_checked    = ( ! empty( $global_online_schedule_field['monday_online_status'] ) && 'on' === $global_online_schedule_field['monday_online_status'] ) ? 'checked' : '';
		$is_tuesday_checked   = ( ! empty( $global_online_schedule_field['tuesday_online_status'] ) && 'on' === $global_online_schedule_field['tuesday_online_status'] ) ? 'checked' : '';
		$is_wednesday_checked = ( ! empty( $global_online_schedule_field['wednesday_online_status'] ) && 'on' === $global_online_schedule_field['wednesday_online_status'] ) ? 'checked' : '';
		$is_thursday_checked  = ( ! empty( $global_online_schedule_field['thursday_online_status'] ) && 'on' === $global_online_schedule_field['thursday_online_status'] ) ? 'checked' : '';
		$is_friday_checked    = ( ! empty( $global_online_schedule_field['friday_online_status'] ) && 'on' === $global_online_schedule_field['friday_online_status'] ) ? 'checked' : '';
		$is_saturday_checked  = ( ! empty( $global_online_schedule_field['saturday_online_status'] ) && 'on' === $global_online_schedule_field['saturday_online_status'] ) ? 'checked' : '';
		$is_sunday_checked    = ( ! empty( $global_online_schedule_field['sunday_online_status'] ) && 'on' === $global_online_schedule_field['sunday_online_status'] ) ? 'checked' : '';

		// Declare the values of weekday's start time and end time.
		$global_online_schedule_field['monday_start_time']    = ( ! empty( $global_online_schedule_field['monday_start_time'] ) ) ? $global_online_schedule_field['monday_start_time'] : '00:00';
		$global_online_schedule_field['monday_end_time']      = ( ! empty( $global_online_schedule_field['monday_end_time'] ) ) ? $global_online_schedule_field['monday_end_time'] : '23:30';
		$global_online_schedule_field['tuesday_start_time']   = ( ! empty( $global_online_schedule_field['tuesday_start_time'] ) ) ? $global_online_schedule_field['tuesday_start_time'] : '00:00';
		$global_online_schedule_field['tuesday_end_time']     = ( ! empty( $global_online_schedule_field['tuesday_end_time'] ) ) ? $global_online_schedule_field['tuesday_end_time'] : '23:30';
		$global_online_schedule_field['wednesday_start_time'] = ( ! empty( $global_online_schedule_field['wednesday_start_time'] ) ) ? $global_online_schedule_field['wednesday_start_time'] : '00:00';
		$global_online_schedule_field['wednesday_end_time']   = ( ! empty( $global_online_schedule_field['wednesday_end_time'] ) ) ? $global_online_schedule_field['wednesday_end_time'] : '23:30';
		$global_online_schedule_field['thursday_start_time']  = ( ! empty( $global_online_schedule_field['thursday_start_time'] ) ) ? $global_online_schedule_field['thursday_start_time'] : '00:00';
		$global_online_schedule_field['thursday_end_time']    = ( ! empty( $global_online_schedule_field['thursday_end_time'] ) ) ? $global_online_schedule_field['thursday_end_time'] : '23:30';
		$global_online_schedule_field['friday_start_time']    = ( ! empty( $global_online_schedule_field['friday_start_time'] ) ) ? $global_online_schedule_field['friday_start_time'] : '00:00';
		$global_online_schedule_field['friday_end_time']      = ( ! empty( $global_online_schedule_field['friday_end_time'] ) ) ? $global_online_schedule_field['friday_end_time'] : '23:30';
		$global_online_schedule_field['saturday_start_time']  = ( ! empty( $global_online_schedule_field['saturday_start_time'] ) ) ? $global_online_schedule_field['saturday_start_time'] : '00:00';
		$global_online_schedule_field['saturday_end_time']    = ( ! empty( $global_online_schedule_field['saturday_end_time'] ) ) ? $global_online_schedule_field['saturday_end_time'] : '23:30';
		$global_online_schedule_field['sunday_start_time']    = ( ! empty( $global_online_schedule_field['sunday_start_time'] ) ) ? $global_online_schedule_field['sunday_start_time'] : '00:00';
		$global_online_schedule_field['sunday_end_time']      = ( ! empty( $global_online_schedule_field['sunday_end_time'] ) ) ? $global_online_schedule_field['sunday_end_time'] : '23:30';

		?>
		<!-- Monday field -->
		<input name="talkino_global_schedule_online_status[monday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_monday_online_status" name="talkino_global_schedule_online_status[monday_online_status]" type="checkbox" <?php echo esc_attr( $is_monday_checked ); ?> value='on' /> <?php esc_html_e( 'Monday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[monday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['monday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[monday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['monday_end_time'] );
				?>
				</select>
			</p>	

		<!-- Tuesday field -->
		<p>
		<input name="talkino_global_schedule_online_status[tuesday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_tuesday_online_status" name="talkino_global_schedule_online_status[tuesday_online_status]" type="checkbox" <?php echo esc_attr( $is_tuesday_checked ); ?> value='on' /> <?php esc_html_e( 'Tuesday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[tuesday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['tuesday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[tuesday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['tuesday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Wednesday field -->
		<p>
		<input name="talkino_global_schedule_online_status[wednesday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_wednesday_online_status" name="talkino_global_schedule_online_status[wednesday_online_status]" type="checkbox" <?php echo esc_attr( $is_wednesday_checked ); ?> value='on' /> <?php esc_html_e( 'Wednesday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[wednesday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['wednesday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[wednesday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['wednesday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Thursday field -->
		<p>
		<input name="talkino_global_schedule_online_status[thursday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_thursday_online_status" name="talkino_global_schedule_online_status[thursday_online_status]" type="checkbox" <?php echo esc_attr( $is_thursday_checked ); ?> value='on' /> <?php esc_html_e( 'Thursday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[thursday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['thursday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[thursday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['thursday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Friday field -->
		<p>
		<input name="talkino_global_schedule_online_status[friday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_friday_online_status" name="talkino_global_schedule_online_status[friday_online_status]" type="checkbox" <?php echo esc_attr( $is_friday_checked ); ?> value='on' /> <?php esc_html_e( 'Friday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[friday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['friday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[friday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['friday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Saturday field -->
		<p>
		<input name="talkino_global_schedule_online_status[saturday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_saturday_online_status" name="talkino_global_schedule_online_status[saturday_online_status]" type="checkbox" <?php echo esc_attr( $is_saturday_checked ); ?> value='on' /> <?php esc_html_e( 'Saturday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[saturday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['saturday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[saturday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['saturday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Sunday field -->
		<p>
		<input name="talkino_global_schedule_online_status[sunday_online_status]" type="hidden" value='off' />
		<input id="talkino_global_schedule_sunday_online_status" name="talkino_global_schedule_online_status[sunday_online_status]" type="checkbox" <?php echo esc_attr( $is_sunday_checked ); ?> value='on' /> <?php esc_html_e( 'Sunday', 'talkino' ); ?>
			<p>
				<select name="talkino_global_schedule_online_status[sunday_start_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['sunday_start_time'] );
				?>
				</select>

				<select name="talkino_global_schedule_online_status[sunday_end_time]">
				<?php
					$talkino_tools->select_time( $global_online_schedule_field['sunday_end_time'] );
				?>
				</select>
			</p>
		</p>

		<!-- Button to select all boxes -->
		<br>
		<button type="button" class="button button-primary" name="talkino_global_schedule_selector" id="talkino_global_schedule_selector" /><?php esc_html_e( 'Select all days', 'talkino' ); ?></button>
		<?php

	}

	/**
	 * Sanitize function to validate the global online status field.
	 *
	 * @since     1.0.0
	 * @param     string $global_schedule_online_status    The global schedule online status.
	 *
	 * @return    string    The validated value of global schedule online status.
	 */
	public function sanitize_global_schedule_online_status( $global_schedule_online_status ) {

		$start_time_value = '00:00';
		$end_time_value   = '23:30';

		$start_time_format_value = strtotime( $start_time_value );
		$end_time_format_value   = strtotime( $end_time_value );
		$time                    = $start_time_format_value;
		$time_range              = array();

		// Sanitize the checkbox of weekday.
		// Monday field.
		if ( ! empty( $global_schedule_online_status['monday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['monday_online_status'] || 'off' === $global_schedule_online_status['monday_online_status'] ) {
				$global_schedule_online_status['monday_online_status'] = $global_schedule_online_status['monday_online_status'];

			} else {

				$global_schedule_online_status['monday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Tuesday field.
		if ( ! empty( $global_schedule_online_status['tuesday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['tuesday_online_status'] || 'off' === $global_schedule_online_status['tuesday_online_status'] ) {
				$global_schedule_online_status['tuesday_online_status'] = $global_schedule_online_status['tuesday_online_status'];

			} else {

				$global_schedule_online_status['tuesday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Wednesday field.
		if ( ! empty( $global_schedule_online_status['wednesday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['wednesday_online_status'] || 'off' === $global_schedule_online_status['wednesday_online_status'] ) {
				$global_schedule_online_status['wednesday_online_status'] = $global_schedule_online_status['wednesday_online_status'];

			} else {

				$global_schedule_online_status['wednesday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Thursday field.
		if ( ! empty( $global_schedule_online_status['thursday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['thursday_online_status'] || 'off' === $global_schedule_online_status['thursday_online_status'] ) {
				$global_schedule_online_status['thursday_online_status'] = $global_schedule_online_status['thursday_online_status'];

			} else {

				$global_schedule_online_status['thursday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Friday field.
		if ( ! empty( $global_schedule_online_status['friday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['friday_online_status'] || 'off' === $global_schedule_online_status['friday_online_status'] ) {
				$global_schedule_online_status['friday_online_status'] = $global_schedule_online_status['friday_online_status'];

			} else {

				$global_schedule_online_status['friday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Saturday field.
		if ( ! empty( $global_schedule_online_status['saturday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['saturday_online_status'] || 'off' === $global_schedule_online_status['saturday_online_status'] ) {
				$global_schedule_online_status['saturday_online_status'] = $global_schedule_online_status['saturday_online_status'];

			} else {

				$global_schedule_online_status['saturday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Sunday field.
		if ( ! empty( $global_schedule_online_status['sunday_online_status'] ) ) {
			if ( 'on' === $global_schedule_online_status['sunday_online_status'] || 'off' === $global_schedule_online_status['sunday_online_status'] ) {
				$global_schedule_online_status['sunday_online_status'] = $global_schedule_online_status['sunday_online_status'];

			} else {

				$global_schedule_online_status['sunday_online_status'] = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_global_schedule_online_status', 'invalid_global_schedule_online_status_value', esc_html__( 'Oops, you have inserted invalid input of online schedule field!', 'talkino' ), 'error' );

			}
		}

		// Sanitize the time range of dropdown box.
		while ( $time <= $end_time_format_value ) {

			array_push( $time_range, gmdate( 'H:i', $time ) );
			$time = strtotime( '+30 minutes', $time );

		}

		// Monday field.
		if ( in_array( $global_schedule_online_status['monday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['monday_start_time'] = $global_schedule_online_status['monday_start_time'];

		} else {
			$global_schedule_online_status['monday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['monday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['monday_end_time'] = $global_schedule_online_status['monday_end_time'];

		} else {
			$global_schedule_online_status['monday_end_time'] = '23:30';
		}

		// Tuesday field.
		if ( in_array( $global_schedule_online_status['tuesday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['tuesday_start_time'] = $global_schedule_online_status['tuesday_start_time'];

		} else {
			$global_schedule_online_status['tuesday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['tuesday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['tuesday_end_time'] = $global_schedule_online_status['tuesday_end_time'];

		} else {
			$global_schedule_online_status['tuesday_end_time'] = '23:30';
		}

		// Wednesday field.
		if ( in_array( $global_schedule_online_status['wednesday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['wednesday_start_time'] = $global_schedule_online_status['wednesday_start_time'];

		} else {
			$global_schedule_online_status['wednesday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['wednesday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['wednesday_end_time'] = $global_schedule_online_status['wednesday_end_time'];

		} else {
			$global_schedule_online_status['wednesday_end_time'] = '23:30';
		}

		// Thursday field.
		if ( in_array( $global_schedule_online_status['thursday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['thursday_start_time'] = $global_schedule_online_status['thursday_start_time'];

		} else {
			$global_schedule_online_status['thursday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['thursday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['thursday_end_time'] = $global_schedule_online_status['thursday_end_time'];

		} else {
			$global_schedule_online_status['thursday_end_time'] = '23:30';
		}

		// Friday field.
		if ( in_array( $global_schedule_online_status['friday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['friday_start_time'] = $global_schedule_online_status['friday_start_time'];

		} else {
			$global_schedule_online_status['friday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['friday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['friday_end_time'] = $global_schedule_online_status['friday_end_time'];

		} else {
			$global_schedule_online_status['friday_end_time'] = '23:30';
		}

		// Saturday field.
		if ( in_array( $global_schedule_online_status['saturday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['saturday_start_time'] = $global_schedule_online_status['saturday_start_time'];

		} else {
			$global_schedule_online_status['saturday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['saturday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['saturday_end_time'] = $global_schedule_online_status['saturday_end_time'];

		} else {
			$global_schedule_online_status['saturday_end_time'] = '23:30';
		}

		// Sunday field.
		if ( in_array( $global_schedule_online_status['sunday_start_time'], $time_range, true ) ) {
			$global_schedule_online_status['sunday_start_time'] = $global_schedule_online_status['sunday_start_time'];

		} else {
			$global_schedule_online_status['sunday_start_time'] = '00:00';
		}

		if ( in_array( $global_schedule_online_status['sunday_end_time'], $time_range, true ) ) {
			$global_schedule_online_status['sunday_end_time'] = $global_schedule_online_status['sunday_end_time'];

		} else {
			$global_schedule_online_status['sunday_end_time'] = '23:30';
		}

		return $global_schedule_online_status;

	}

	/**
	 * Callback function to render text area field of subtitle for online status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_online_subtitle_field_callback() {

		$chatbox_online_subtitle = get_option( 'talkino_chatbox_online_subtitle' );
		?>
		<textarea name="talkino_chatbox_online_subtitle" class="large-text" maxlength="100" rows="2"><?php echo isset( $chatbox_online_subtitle ) ? esc_textarea( $chatbox_online_subtitle ) : ''; ?></textarea>
		<?php

	}

	/**
	 * Callback function to render text area field of subtitle for away status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_away_subtitle_field_callback() {

		$chatbox_away_subtitle = get_option( 'talkino_chatbox_away_subtitle' );
		?>
		<textarea name="talkino_chatbox_away_subtitle" class="large-text" maxlength="100" rows="2"><?php echo isset( $chatbox_away_subtitle ) ? esc_textarea( $chatbox_away_subtitle ) : ''; ?></textarea>
		<?php

	}

	/**
	 * Callback function to render text area field of subtitle for offline status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_offline_subtitle_field_callback() {

		$chatbox_offline_subtitle = get_option( 'talkino_chatbox_offline_subtitle' );
		?>
		<textarea name="talkino_chatbox_offline_subtitle" class="large-text" maxlength="100" rows="2"><?php echo isset( $chatbox_offline_subtitle ) ? esc_textarea( $chatbox_offline_subtitle ) : ''; ?></textarea>
		<?php

	}

	/**
	 * Callback function to render text area field of offline message.
	 *
	 * @since    1.0.0
	 */
	public function offline_message_field_callback() {

		$offline_message = get_option( 'talkino_offline_message' );
		?>
		<textarea name="talkino_offline_message" class="large-text" maxlength="100" rows="2"><?php echo isset( $offline_message ) ? esc_textarea( $offline_message ) : ''; ?></textarea>
		<?php

	}

	/**
	 * Callback function to render text area field of chatbox button field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_button_text_field_callback() {

		$chatbox_button_text = get_option( 'talkino_chatbox_button_text' );
		?>
		<textarea name="talkino_chatbox_button_text" class="large-text" maxlength="50" rows="2"><?php echo isset( $chatbox_button_text ) ? esc_textarea( $chatbox_button_text ) : ''; ?></textarea>
		<?php

	}

	/********************************* Styles *********************************/
	/**
	 * Callback function to render chatbox style field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_style_field_callback() {

		$chatbox_style_field = get_option( 'talkino_chatbox_style' );
		?>
		<p>
			<label for="round">
				<input type="radio" name="talkino_chatbox_style" value="round" <?php checked( 'round', $chatbox_style_field ); ?>/> <?php esc_html_e( 'Round style', 'talkino' ); ?>
			</label>
		</p>
		<p>
			<label for="rectangle">
				<input type="radio" name="talkino_chatbox_style" value="rectangle" <?php checked( 'rectangle', $chatbox_style_field ); ?>/> <?php esc_html_e( 'Rectangle style', 'talkino' ); ?> 
			</label>
		</p>
		<?php

	}

	/**
	 * Sanitize function to validate the chatbox style field.
	 *
	 * @since     1.0.0
	 * @param     string $chatbox_style    The chatbox style.
	 *
	 * @return    string    The validated value of chatbox style.
	 */
	public function sanitize_chatbox_style( $chatbox_style ) {

		// Sanitize the checkbox.
		if ( ! empty( $chatbox_style ) ) {
			if ( 'round' === $chatbox_style || 'rectangle' === $chatbox_style ) {
				$chatbox_style = $chatbox_style;

			} else {

				$chatbox_style = 'round';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_chatbox_style', 'invalid_chatbox_style_value', esc_html__( 'Oops, you have inserted invalid input of chatbox style field!', 'talkino' ), 'error' );

			}
		}

		return $chatbox_style;

	}

	/**
	 * Callback function to render chatbox position field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_position_field_callback() {

		$chatbox_position_field = get_option( 'talkino_chatbox_position' );
		?>
		<p>
			<label for="left">
				<input type="radio" name="talkino_chatbox_position" value="left" <?php checked( 'left', $chatbox_position_field ); ?>/> <?php esc_html_e( 'Left Position', 'talkino' ); ?>
			</label>
		</p>
		<p>
			<label for="right">
				<input type="radio" name="talkino_chatbox_position" value="right" <?php checked( 'right', $chatbox_position_field ); ?>/> <?php esc_html_e( 'Right Position', 'talkino' ); ?> 
			</label>
		</p>
		<?php

	}

	/**
	 * Sanitize function to validate the chatbox position field.
	 *
	 * @since     1.0.0
	 * @param     string $chatbox_position    The chatbox position.
	 *
	 * @return    string    The validated value of chatbox position.
	 */
	public function sanitize_chatbox_position( $chatbox_position ) {

		// Sanitize the checkbox.
		if ( ! empty( $chatbox_position ) ) {
			if ( 'left' === $chatbox_position || 'right' === $chatbox_position ) {
				$chatbox_position = $chatbox_position;

			} else {

				$chatbox_position = 'right';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_chatbox_position', 'invalid_chatbox_position_value', esc_html__( 'Oops, you have inserted invalid input of chatbox position field!', 'talkino' ), 'error' );

			}
		}

		return $chatbox_position;

	}

	/**
	 * Callback function to render chatbox icon field.
	 *
	 * @since    1.1.4
	 */
	public function chatbox_icon_field_callback() {

		$chatbox_icon_field = get_option( 'talkino_chatbox_icon' );

		?>
		<span id="talkino-icon-container">
			<i id="talkino-icon-preview" class="dashicons <?php echo esc_html( $chatbox_icon_field ); ?> talkino"></i>
		</span>

		<input class="regular-text" type="hidden" id="talkino_dashicons_picker" name="talkino_chatbox_icon" readonly value="<?php echo isset( $chatbox_icon_field ) ? esc_attr( $chatbox_icon_field ) : 'dashicons-format-chat'; ?>"/>
		<input type="button" data-target="#talkino_dashicons_picker" class="button dashicons-picker" value="Choose Icon" />	
		<?php

	}

	/**
	 * Callback function to render chatbox animation field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_animation_field_callback() {

		$chatbox_animation_field = get_option( 'talkino_chatbox_animation' );
		?>
		<p>
			<label for="no">
				<input type="radio" name="talkino_chatbox_animation" value="no" <?php checked( 'no', $chatbox_animation_field ); ?>/> <?php esc_html_e( 'No animation', 'talkino' ); ?>
			</label>
		</p>
		<p>
			<label for="fadein">
				<input type="radio" name="talkino_chatbox_animation" value="fadein" <?php checked( 'fadein', $chatbox_animation_field ); ?>/> <?php esc_html_e( 'Fade in', 'talkino' ); ?> 
			</label>
		</p>
		<p>
			<label for="slideup">
				<input type="radio" name="talkino_chatbox_animation" value="slideup" <?php checked( 'slideup', $chatbox_animation_field ); ?>/> <?php esc_html_e( 'Slide up', 'talkino' ); ?> 
			</label>
		</p>
		<?php

	}

	/**
	 * Sanitize function to validate the chatbox animation field.
	 *
	 * @since     1.0.0
	 * @param     string $chatbox_animation    The chatbox animation.
	 *
	 * @return    string    The validated value of chatbox animation.
	 */
	public function sanitize_chatbox_animation( $chatbox_animation_field ) {

		// Sanitize the radio field.
		if ( ! empty( $chatbox_animation_field ) ) {
			if ( 'no' === $chatbox_animation_field || 'fadein' === $chatbox_animation_field || 'slideup' === $chatbox_animation_field ) {
				$chatbox_animation_field = $chatbox_animation_field;

			} else {

				$chatbox_animation_field = 'fadein';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_chatbox_animation', 'invalid_chatbox_animation_value', esc_html__( 'Oops, you have inserted invalid input of chatbox animation field!', 'talkino' ), 'error' );

			}
		}

		return $chatbox_animation_field;

	}

	/**
	 * Callback function to render start chat method field.
	 *
	 * @since    1.0.0
	 */
	public function start_chat_method_field_callback() {

		$start_chat_method_field = get_option( 'talkino_start_chat_method' );

		?>
		<select name="talkino_start_chat_method" class="regular-text">
			<option value="_blank" <?php selected( '_blank', $start_chat_method_field ); ?>><?php esc_html_e( 'Open in new window or tab', 'talkino' ); ?></option>
			<option value="_self" <?php selected( '_self', $start_chat_method_field ); ?>><?php esc_html_e( 'Open in same window or tab', 'talkino' ); ?></option>
		</select>
		<?php

	}

	/**
	 * Sanitize function to validate the start chat method field.
	 *
	 * @since     1.0.0
	 * @param     string $start_chat_method    The start chat method.
	 *
	 * @return    string    The validated value of start chat method.
	 */
	public function sanitize_start_chat_method( $start_chat_method ) {

		if ( '_blank' !== $start_chat_method && '_self' !== $start_chat_method ) {

			$start_chat_method = '_blank';

			// Notify the user on invalid input.
			add_settings_error( 'talkino_start_chat_method', 'invalid_start_chat_method_value', esc_html__( 'Oops, you have inserted invalid input of start chatting method field!', 'talkino' ), 'error' );

		}

		return $start_chat_method;

	}

	/**
	 * Callback function to render chatbox z-index field.
	 *
	 * @since    2.0.0
	 */
	public function chatbox_z_index_field_callback() {

		$chatbox_z_index_field = get_option( 'talkino_chatbox_z_index' );

		?>
		<input type="text" name="talkino_chatbox_z_index" class="regular-text" value="<?php echo isset( $chatbox_z_index_field ) ? esc_attr( $chatbox_z_index_field ) : '9999999'; ?>" />
		<p><?php esc_html_e( 'The z-index property specifies the stack order of an element (which element should be placed in front of, or behind the others). Increase the z-index so that the chatbox will be displayed in front of other elements.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Sanitize function to validate the chatbox z-index field.
	 *
	 * @since     2.0.0
	 * @param     string $z_index    The chatbox z-index.
	 *
	 * @return    string    The validated value of chatbox z-index.
	 */
	public function sanitize_chatbox_z_index( $z_index ) {

		if ( ! preg_match('/^[0-9+-]*$/', $z_index) ) {

			$z_index = '9999999';

			// Notify the user on invalid input.
			add_settings_error( 'talkino_chatbox_z_index', 'invalid_chatbox_z_index_value', esc_html__( 'Oops, you have inserted invalid input of chatbox z-index field!', 'talkino' ), 'error' );

		}

		return $z_index;

	}

	/**
	 * Callback function to render template color.
	 *
	 * @since    2.0.0
	 */
	public function template_color_field_callback() {

		?>
		<button type="button" id="talkino_template_color_default" style="background-color: #1e73be; border-color: #1e73be;" class="button button-primary" name="talkino_template_color_default" /><?php esc_html_e( 'Default', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_sky" style="background-color: #00c3ff; border-color: #00c3ff; margin-left: 4px;" class="button button-primary" name="talkino_template_color_sky" /><?php esc_html_e( 'Sky', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_fashion" style="background-color: #6e3abb; border-color: #6e3abb; margin-left: 4px;" class="button button-primary" name="talkino_template_color_fashion" /><?php esc_html_e( 'Fashion', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_passion" style="background-color: #dd3333; border-color: #dd3333; margin-left: 4px;" class="button button-primary" name="talkino_template_color_passion" /><?php esc_html_e( 'Passion', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_confidence" style="background-color: #ff8100; border-color: #ff8100; margin-left: 4px;" class="button button-primary" name="talkino_template_color_confidence" /><?php esc_html_e( 'Confidence', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_sunshine" style="background-color: #ffb300; border-color: #ffb300; margin-left: 4px;" class="button button-primary" name="talkino_template_color_sunshine" /><?php esc_html_e( 'Sunshine', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_forest" style="background-color: #185121; border-color: #185121; margin-left: 4px;" class="button button-primary" name="talkino_template_color_forest" /><?php esc_html_e( 'Forest', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_mint" style="background-color: #7ecc7e; border-color: #7ecc7e; margin-left: 4px;" class="button button-primary" name="talkino_template_color_mint" /><?php esc_html_e( 'Mint', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_coffee" style="background-color: #863d26; border-color: #863d26; margin-left: 4px;" class="button button-primary" name="talkino_template_color_coffee" /><?php esc_html_e( 'Coffee', 'talkino' ); ?></button>
		<button type="button" id="talkino_template_color_midnight" style="background-color: #2b2827; border-color: #2b2827; margin-left: 4px;" class="button button-primary" name="talkino_template_color_midnight" /><?php esc_html_e( 'Midnight', 'talkino' ); ?></button>
		<p><?php esc_html_e( 'Select the color template to change the chatbox layout or you can customize your own color template with below settings.', 'talkino' ); ?></p>
		<?php

	}

	/**
	 * Callback function to render chatbox theme color for online status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_online_theme_color_field_callback() {

		$chatbox_online_theme_color_field = get_option( 'talkino_chatbox_online_theme_color' );

		?>
		<input type="text" id="talkino_chatbox_online_theme_color" name="talkino_chatbox_online_theme_color" class="color-picker" value="<?php echo isset( $chatbox_online_theme_color_field ) ? esc_attr( $chatbox_online_theme_color_field ) : '#1e73be'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox icon color for online status.
	 *
	 * @since    2.0.0
	 */
	public function chatbox_online_icon_color_field_callback() {

		$chatbox_online_icon_color_field = get_option( 'talkino_chatbox_online_icon_color' );

		?>
		<input type="text" id="talkino_chatbox_online_icon_color" name="talkino_chatbox_online_icon_color" class="color-picker" value="<?php echo isset( $chatbox_online_icon_color_field ) ? esc_attr( $chatbox_online_icon_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox theme color for away status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_away_theme_color_field_callback() {

		$chatbox_away_theme_color_field = get_option( 'talkino_chatbox_away_theme_color' );

		?>
		<input type="text" id="talkino_chatbox_away_theme_color" name="talkino_chatbox_away_theme_color" class="color-picker" value="<?php echo isset( $chatbox_away_theme_color_field ) ? esc_attr( $chatbox_away_theme_color_field ) : '#ffa500'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox icon color for away status.
	 *
	 * @since    2.0.0
	 */
	public function chatbox_away_icon_color_field_callback() {

		$chatbox_away_icon_color_field = get_option( 'talkino_chatbox_away_icon_color' );

		?>
		<input type="text" id="talkino_chatbox_away_icon_color" name="talkino_chatbox_away_icon_color" class="color-picker" value="<?php echo isset( $chatbox_away_icon_color_field ) ? esc_attr( $chatbox_away_icon_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox theme color for offline status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_offline_theme_color_field_callback() {

		$chatbox_offline_theme_color_field = get_option( 'talkino_chatbox_offline_theme_color' );

		?>
		<input type="text" id="talkino_chatbox_offline_theme_color" name="talkino_chatbox_offline_theme_color" class="color-picker" value="<?php echo isset( $chatbox_offline_theme_color_field ) ? esc_attr( $chatbox_offline_theme_color_field ) : '#aec6cf'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox icon color for offline status.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_offline_icon_color_field_callback() {

		$chatbox_offline_icon_color_field = get_option( 'talkino_chatbox_offline_icon_color' );

		?>
		<input type="text" id="talkino_chatbox_offline_icon_color" name="talkino_chatbox_offline_icon_color" class="color-picker" value="<?php echo isset( $chatbox_offline_icon_color_field ) ? esc_attr( $chatbox_offline_icon_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox background color.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_background_color_field_callback() {

		$chatbox_background_color_field = get_option( 'talkino_chatbox_background_color' );

		?>
		<input type="text" id="talkino_chatbox_background_color" name="talkino_chatbox_background_color" class="color-picker" value="<?php echo isset( $chatbox_background_color_field ) ? esc_attr( $chatbox_background_color_field ) : '#f0f0f1'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox title color.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_title_color_field_callback() {

		$chatbox_title_color_field = get_option( 'talkino_chatbox_title_color' );

		?>
		<input type="text" id="talkino_chatbox_title_color" name="talkino_chatbox_title_color" class="color-picker" value="<?php echo isset( $chatbox_title_color_field ) ? esc_attr( $chatbox_title_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox subtitle color.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_subtitle_color_field_callback() {

		$chatbox_subtitle_color_field = get_option( 'talkino_chatbox_subtitle_color' );

		?>
		<input type="text" id="talkino_chatbox_subtitle_color" name="talkino_chatbox_subtitle_color" class="color-picker" value="<?php echo isset( $chatbox_subtitle_color_field ) ? esc_attr( $chatbox_subtitle_color_field ) : '#000'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox button color.
	 *
	 * @since    2.0.0
	 */
	public function chatbox_button_color_field_callback() {

		$chatbox_button_color_field = get_option( 'talkino_chatbox_button_color' );

		?>
		<input type="text" id="talkino_chatbox_button_color" name="talkino_chatbox_button_color" class="color-picker" value="<?php echo isset( $chatbox_button_color_field ) ? esc_attr( $chatbox_button_color_field ) : '#727779'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render chatbox button text color.
	 *
	 * @since    2.0.0
	 */
	public function chatbox_button_text_color_field_callback() {

		$chatbox_button_text_color_field = get_option( 'talkino_chatbox_button_text_color' );

		?>
		<input type="text" id="talkino_chatbox_button_text_color" name="talkino_chatbox_button_text_color" class="color-picker" value="<?php echo isset( $chatbox_button_text_color_field ) ? esc_attr( $chatbox_button_text_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render agent field background color.
	 *
	 * @since    2.0.0
	 */
	public function agent_field_background_color_field_callback() {

		$agent_field_background_color_field = get_option( 'talkino_agent_field_background_color' );

		?>
		<input type="text" id="talkino_agent_field_background_color" name="talkino_agent_field_background_color" class="color-picker" value="<?php echo isset( $agent_field_background_color_field ) ? esc_attr( $agent_field_background_color_field ) : '#fff'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render agent field hover background color.
	 *
	 * @since    2.0.0
	 */
	public function agent_field_hover_background_color_field_callback() {

		$agent_field_hover_background_color_field = get_option( 'talkino_agent_field_hover_background_color' );

		?>
		<input type="text" id="talkino_agent_field_hover_background_color" name="talkino_agent_field_hover_background_color" class="color-picker" value="<?php echo isset( $agent_field_hover_background_color_field ) ? esc_attr( $agent_field_hover_background_color_field ) : '#dfdfdf'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render agent name text color.
	 *
	 * @since    2.0.0
	 */
	public function agent_name_text_color_field_callback() {

		$agent_name_text_color_field = get_option( 'talkino_agent_name_text_color' );

		?>
		<input type="text" id="talkino_agent_name_text_color" name="talkino_agent_name_text_color" class="color-picker" value="<?php echo isset( $agent_name_text_color_field ) ? esc_attr( $agent_name_text_color_field ) : '#222'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render agent job title text color.
	 *
	 * @since    2.0.0
	 */
	public function agent_job_title_text_color_field_callback() {

		$agent_job_title_text_color_field = get_option( 'talkino_agent_job_title_text_color' );

		?>
		<input type="text" id="talkino_agent_job_title_text_color" name="talkino_agent_job_title_text_color" class="color-picker" value="<?php echo isset( $agent_job_title_text_color_field ) ? esc_attr( $agent_job_title_text_color_field ) : '#888'; ?>"/>
		<?php

	}

	/**
	 * Callback function to render agent channel text color.
	 *
	 * @since    2.0.0
	 */
	public function agent_channel_text_color_field_callback() {

		$agent_channel_text_color_field = get_option( 'talkino_agent_channel_text_color' );

		?>
		<input type="text" id="talkino_agent_channel_text_color" name="talkino_agent_channel_text_color" class="color-picker" value="<?php echo isset( $agent_channel_text_color_field ) ? esc_attr( $agent_channel_text_color_field ) : '#888'; ?>"/>
		<?php

	}

	/********************************* Ordering *********************************/
	/**
	 * Callback function to render channel ordering field.
	 *
	 * @since    1.0.0
	 */
	public function channel_ordering_field_callback() {

		?>
		<div class='wrap'>
			<form name="talkino_channel_ordering_form" method="post" action=""> 
				<ul id="talkino_channel_ordering_list">
				<?php
				$order = explode( ',', get_option( 'talkino_channel_ordering' ) );

				if ( empty( get_option( 'talkino_channel_ordering' ) ) ) {

					?>
					<li id='talkino_whatsapp' class='talkino_lineitem'>Whatsapp</li>
					<li id='talkino_facebook' class='talkino_lineitem'>Facebook</li>
					<li id='talkino_telegram' class='talkino_lineitem'>Telegram</li>
					<li id='talkino_phone' class='talkino_lineitem'>Phone</li>
					<li id='talkino_email' class='talkino_lineitem'>Email</li>
					<?php

				} else {
					foreach ( $order as $id ) {

						$chat_channel = '';
						$channel_icon = '';

						switch ( $id ) {

							case 'talkino_whatsapp':
								$chat_channel = 'WhatsApp';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/whatsapp-icon.png' . "' > ";
								break;

							case 'talkino_facebook':
								$chat_channel = 'Facebook';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/facebook-icon.png' . "' > ";
								break;

							case 'talkino_telegram':
								$chat_channel = 'Telegram';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/telegram-icon.png' . "' > ";
								break;

							case 'talkino_phone':
								$chat_channel = 'Phone';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/phone-icon.png' . "' > ";
								break;

							case 'talkino_email':
								$chat_channel = 'Email';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/email-icon.png' . "' > ";
								break;

							default:
								$chat_channel = 'WhatsApp';
								$channel_icon = "<img class='talkino-ordering-icon' src='" . plugin_dir_url( TALKINO_BASE_NAME ) . 'assets/images/whatsapp-icon.png' . "' > ";

						}

						?>
						<li id='<?php echo esc_attr( $id ); ?>' class='talkino_lineitem'><?php echo wp_kses_post( $channel_icon ); ?><?php echo esc_attr( $chat_channel ); ?></li>
						<?php

					}
				}
				?>
				</ul>
			</form>
		</div>
		<?php

	}

	/**
	 * Action function to sort channel order list.
	 *
	 * @since    1.0.0
	 */
	public function talkino_update_channel_order_list() {
		update_option( 'talkino_channel_ordering', sanitize_text_field( $_POST['order'] ) );
	}

	/**
	 * Callback function to render agent ordering field.
	 *
	 * @since    1.0.0
	 */
	public function agent_ordering_field_callback() {

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
		if ( $loop->have_posts() ) {

			?>
			<div class='wrap'>
				<form name="talkino_agent_ordering_form" method="post" action="">  
					<ul id="talkino_agent_ordering_list">
					<?php
					// Start to query agent's data.
					while ( $loop->have_posts() ) :

						$loop->the_post();

						$post_id = get_the_ID();

						// Retrieve and restrict the agent name to 20 characters.
						$name = strlen( get_the_title() ) > 20 ? substr( get_the_title(), 0, 20 ) . '...' : get_the_title();

						echo "<li id='" . esc_attr( $post_id ) . "' class='talkino_lineitem'><i class='dashicons dashicons-admin-users talkino'></i>
                        " . esc_attr( $name ) . '</li>';

					endwhile;

					wp_reset_postdata();

					?>
					</ul>
				</form>
			</div>
			<?php

		} else {
			echo '<p>' . esc_html__( 'There is currently no agent.', 'talkino' ) . '</p>';
		}

	}

	/**
	 * Action function to sort agent order list.
	 *
	 * @since    1.0.0
	 */
	public function talkino_update_agent_order_list() {

		$order   = explode( ',', sanitize_text_field( $_POST['order'] ) );
		$counter = 1;

		foreach ( $order as $post_id ) {

			update_post_meta( $post_id, 'talkino_agent_ordering', $counter );
			$counter ++;

		}

	}

	/********************************* Display *********************************/
	/**
	 * Callback function to render chatbox exclude pages field.
	 *
	 * @since    1.0.0
	 */
	public function chatbox_exclude_pages_field_callback() {

		$chatbox_exclude_pages = get_option( 'talkino_chatbox_exclude_pages' );
		$pages                 = get_pages();

		?>
		<?php foreach ( $pages as $page ) { ?>
			<?php
			$is_checked      = ( ! empty( $chatbox_exclude_pages ) && in_array( $page->ID, $chatbox_exclude_pages ) ) ? 'checked' : '';
			$talkino_utility = new Talkino_Utility();

			// If woocommerce is active, exclude the page that is set as blog page on theme and woocommerce shop page.
			if ( $talkino_utility->is_woocommerce_activated() ) {
				if ( get_option( 'page_for_posts' ) !== $page->ID && get_option( 'woocommerce_shop_page_id' ) !== $page->ID ) {

					?>
					<p>
						<input name="talkino_chatbox_exclude_pages[]" type="checkbox" <?php echo esc_attr( $is_checked ); ?> value='<?php echo esc_attr( $page->ID ); ?>' /> <?php echo esc_attr( $page->post_title ); ?>
					</p>
					<?php

				}

			} else { // If woocommerce is not active, exclude the page that is set as blog page on theme.
				if ( get_option( 'page_for_posts' ) !== $page->ID ) {

					?>
					<p>
						<input name="talkino_chatbox_exclude_pages[]" type="checkbox" <?php echo esc_attr( $is_checked ); ?> value='<?php echo esc_attr( $page->ID ); ?>' /> <?php echo esc_attr( $page->post_title ); ?>
					</p>
					<?php

				}
			}
		};

	}

	/**
	 * Callback function to render show on post field.
	 *
	 * @since    1.0.0
	 */
	public function show_on_post_field_callback() {

		$show_on_post_field      = get_option( 'talkino_show_on_post' );
		$is_show_on_post_checked = ( ! empty( $show_on_post_field ) && 'on' === $show_on_post_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_post" type="hidden" value='off'/>
		<input name="talkino_show_on_post" type="checkbox" <?php echo esc_attr( $is_show_on_post_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on blog and post pages.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on post field.
	 *
	 * @since     1.0.0
	 * @param     string $show_on_post    The show on post value.
	 *
	 * @return    string    The validated value of show on post.
	 */
	public function sanitize_show_on_post( $show_on_post ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_post ) ) {
			if ( 'on' === $show_on_post || 'off' === $show_on_post ) {
				$show_on_post = $show_on_post;

			} else {

				$show_on_post = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_post', 'invalid_show_on_post_value', esc_html__( 'Oops, you have inserted invalid input of show on post field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_post;

	}

	/**
	 * Callback function to render show on search field.
	 *
	 * @since    1.0.0
	 */
	public function show_on_search_field_callback() {

		$show_on_search_field      = get_option( 'talkino_show_on_search' );
		$is_show_on_search_checked = ( ! empty( $show_on_search_field ) && 'on' === $show_on_search_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_search" type="hidden" value='off'/>
		<input name="talkino_show_on_search" type="checkbox" <?php echo esc_attr( $is_show_on_search_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on search page.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on search field.
	 *
	 * @since     1.0.0
	 * @param     string $show_on_search    The show on search value.
	 *
	 * @return    string    The validated value of show on search.
	 */
	public function sanitize_show_on_search( $show_on_search ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_search ) ) {
			if ( 'on' === $show_on_search || 'off' === $show_on_search ) {
				$show_on_search = $show_on_search;

			} else {

				$show_on_search = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_search', 'invalid_show_on_search_value', esc_html__( 'Oops, you have inserted invalid input of show on search page field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_search;

	}

	/**
	 * Callback function to render show on 404 field.
	 *
	 * @since    2.0.0
	 */
	public function show_on_404_field_callback() {

		$show_on_404_field      = get_option( 'talkino_show_on_404' );
		$is_show_on_404_checked = ( ! empty( $show_on_404_field ) && 'on' === $show_on_404_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_404" type="hidden" value='off'/>
		<input name="talkino_show_on_404" type="checkbox" <?php echo esc_attr( $is_show_on_404_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on 404 page.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on 404 field.
	 *
	 * @since     2.0.0
	 * @param     string $show_on_404    The show on 404 value.
	 *
	 * @return    string    The validated value of show on 404.
	 */
	public function sanitize_show_on_404( $show_on_404 ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_404 ) ) {
			if ( 'on' === $show_on_404 || 'off' === $show_on_404 ) {
				$show_on_404 = $show_on_404;

			} else {

				$show_on_404 = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_404', 'invalid_show_on_404_value', esc_html__( 'Oops, you have inserted invalid input of show on 404 page field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_404;

	}

	/**
	 * Callback function to render show on woocommerce shop and product pages field.
	 *
	 * @since    1.0.0
	 */
	public function show_on_woocommerce_pages_field_callback() {

		$show_on_woocommerce_pages_field      = get_option( 'talkino_show_on_woocommerce_pages' );
		$is_show_on_woocommerce_pages_checked = ( ! empty( $show_on_woocommerce_pages_field ) && 'on' === $show_on_woocommerce_pages_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_woocommerce_pages" type="hidden" value='off'/>
		<input name="talkino_show_on_woocommerce_pages" type="checkbox" <?php echo esc_attr( $is_show_on_woocommerce_pages_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on WooCommerce shop, product, product category and tag pages.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on woocommerce shop, product, product category and tag pages field.
	 *
	 * @since     1.0.0
	 * @param     string $show_on_woocommerce_pages_field    The show on woocommerce shop and product pages value.
	 *
	 * @return    string    The validated value of show on woocommerce shop and product pages.
	 */
	public function sanitize_show_on_woocommerce_pages( $show_on_woocommerce_pages_field ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_woocommerce_pages_field ) ) {
			if ( 'on' === $show_on_woocommerce_pages_field || 'off' === $show_on_woocommerce_pages_field ) {
				$show_on_woocommerce_pages_field = $show_on_woocommerce_pages_field;

			} else {

				$show_on_woocommerce_pages_field = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_woocommerce_pages', 'invalid_show_on_woocommerce_pages_value', esc_html__( 'Oops, you have inserted invalid input of show on woocommerce shop and product pages field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_woocommerce_pages_field;

	}

	/**
	 * Callback function to render show on desktop field.
	 *
	 * @since    1.0.0
	 */
	public function show_on_desktop_field_callback() {

		$show_on_desktop_field      = get_option( 'talkino_show_on_desktop' );
		$is_show_on_desktop_checked = ( ! empty( $show_on_desktop_field ) && 'on' === $show_on_desktop_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_desktop" type="hidden" value='off'/>
		<input name="talkino_show_on_desktop" type="checkbox" <?php echo esc_attr( $is_show_on_desktop_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on desktop.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on desktop field.
	 *
	 * @since     1.0.0
	 * @param     string $show_on_desktop    The show on desktop value.
	 *
	 * @return    string    The validated value of show on desktop.
	 */
	public function sanitize_show_on_desktop( $show_on_desktop ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_desktop ) ) {
			if ( 'on' === $show_on_desktop || 'off' === $show_on_desktop ) {
				$show_on_desktop = $show_on_desktop;

			} else {

				$show_on_desktop = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_desktop', 'invalid_show_on_desktop_value', esc_html__( 'Oops, you have inserted invalid input of show on desktop field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_desktop;

	}

	/**
	 * Callback function to render show on mobile field.
	 *
	 * @since    1.0.0
	 */
	public function show_on_mobile_field_callback() {

		$show_on_mobile_field      = get_option( 'talkino_show_on_mobile' );
		$is_show_on_mobile_checked = ( ! empty( $show_on_mobile_field ) && 'on' === $show_on_mobile_field ) ? 'checked' : '';

		?>
		<input name="talkino_show_on_mobile" type="hidden" value='off'/>
		<input name="talkino_show_on_mobile" type="checkbox" <?php echo esc_attr( $is_show_on_mobile_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino chatbox to show on mobile.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the show on mobile field.
	 *
	 * @since     1.0.0
	 * @param     string $show_on_mobile    The show on mobile value.
	 *
	 * @return    string    The validated value of show on mobile.
	 */
	public function sanitize_show_on_mobile( $show_on_mobile ) {

		// Sanitize the checkbox.
		if ( ! empty( $show_on_mobile ) ) {
			if ( 'on' === $show_on_mobile || 'off' === $show_on_mobile ) {
				$show_on_mobile = $show_on_mobile;

			} else {

				$show_on_mobile = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_show_on_mobile', 'invalid_show_on_mobile_value', esc_html__( 'Oops, you have inserted invalid input of show on mobile field!', 'talkino' ), 'error' );

			}
		}

		return $show_on_mobile;

	}

	/**
	 * Callback function to render user visibility field.
	 *
	 * @since    2.0.0
	 */
	public function user_visibility_field_callback() {

		$user_visibility_field = get_option( 'talkino_user_visibility' );

		?>
		<select name="talkino_user_visibility" class="regular-text">
			<option value="all" <?php selected( 'all', $user_visibility_field ); ?>><?php esc_html_e( 'All users', 'talkino' ); ?></option>
			<option value="loggedin" <?php selected( 'loggedin', $user_visibility_field ); ?>><?php esc_html_e( 'Logged in users only', 'talkino' ); ?></option>
		</select>
		<?php

	}

	/**
	 * Sanitize function to validate the user visibility field.
	 *
	 * @since     2.0.0
	 * @param     string $user_visibility_field    The user visibility_field.
	 *
	 * @return    string    The validated value of user visibility_field.
	 */
	public function sanitize_user_visibility( $user_visibility_field ) {

		if ( 'all' !== $user_visibility_field && 'loggedin' !== $user_visibility_field ) {

			$user_visibility_field = 'all';

			// Notify the user on invalid input.
			add_settings_error( 'talkino_user_visibility', 'invalid_user_visibility_value', esc_html__( 'Oops, you have inserted invalid input of user visibility field!', 'talkino' ), 'error' );

		}

		return $user_visibility_field;

	}

	/********************************* Contact Form *********************************/
	/**
	 * Callback function to render contact form status field.
	 *
	 * @since    1.0.0
	 */
	public function contact_form_status_field_callback() {

		$contact_form_status_field      = get_option( 'talkino_contact_form_status' );
		$is_contact_form_status_checked = ( ! empty( $contact_form_status_field ) && 'on' === $contact_form_status_field ) ? 'checked' : '';

		?>
		<input name="talkino_contact_form_status" type="hidden" value='off'/>
		<input name="talkino_contact_form_status" type="checkbox" <?php echo esc_attr( $is_contact_form_status_checked ); ?> value='on' /> <?php esc_html_e( 'Activate the contact form for allowing users to email to admin when the Talkino chatbox is offline.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the contact form status field.
	 *
	 * @since     1.0.0
	 * @param     string $contact_form_status    The contact form status.
	 *
	 * @return    string    The validated value of contact form status.
	 */
	public function sanitize_contact_form_status( $contact_form_status ) {

		// Sanitize the checkbox.
		if ( ! empty( $contact_form_status ) ) {
			if ( 'on' === $contact_form_status || 'off' === $contact_form_status ) {
				$contact_form_status = $contact_form_status;

			} else {

				$contact_form_status = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_contact_form_status', 'invalid_contact_form_status_value', esc_html__( 'Oops, you have inserted invalid input of contact form field!', 'talkino' ), 'error' );

			}
		}

		return $contact_form_status;

	}

	/**
	 * Callback function to render text field of email recipient.
	 *
	 * @since    1.0.0
	 */
	public function email_recipient_field_callback() {

		$email_recipient = get_option( 'talkino_email_recipient' );

		?>
		<input type="text" name="talkino_email_recipient" class="regular-text" value="<?php echo isset( $email_recipient ) ? esc_attr( $email_recipient ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text field of email subject.
	 *
	 * @since    1.0.0
	 */
	public function email_subject_field_callback() {

		$email_subject = get_option( 'talkino_email_subject' );

		?>
		<input type="text" name="talkino_email_subject" class="regular-text" value="<?php echo isset( $email_subject ) ? esc_attr( $email_subject ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text area field of sender message.
	 *
	 * @since    1.0.0
	 */
	public function sender_message_field_callback() {

		$sender_message = get_option( 'talkino_sender_message' );

		?>
		<textarea name="talkino_sender_message" class="large-text" maxlength="100" rows="2"><?php echo isset( $sender_message ) ? esc_textarea( $sender_message ) : ''; ?></textarea>
		<?php

	}

	/**
	 * Callback function to render text field of sender name.
	 *
	 * @since    1.0.0
	 */
	public function sender_name_field_callback() {

		$sender_name = get_option( 'talkino_sender_name' );

		?>
		<input type="text" name="talkino_sender_name" class="regular-text" value="<?php echo isset( $sender_name ) ? esc_attr( $sender_name ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text field of sender email.
	 *
	 * @since    1.0.0
	 */
	public function sender_email_field_callback() {

		$sender_email = get_option( 'talkino_sender_email' );

		?>
		<input type="text" name="talkino_sender_email" class="regular-text" value="<?php echo isset( $sender_email ) ? esc_attr( $sender_email ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text field of successful email sent message.
	 *
	 * @since    1.0.0
	 */
	public function success_email_message_field_callback() {

		$success_email_message = get_option( 'talkino_success_email_message' );

		?>
		<input type="text" name="talkino_success_email_message" class="regular-text" value="<?php echo isset( $success_email_message ) ? esc_attr( $success_email_message ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text field of failed email sent message.
	 *
	 * @since    1.0.0
	 */
	public function fail_email_message_field_callback() {

		$fail_email_message = get_option( 'talkino_fail_email_message' );

		?>
		<input type="text" name="talkino_fail_email_message" class="regular-text" value="<?php echo isset( $fail_email_message ) ? esc_attr( $fail_email_message ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render Google Recaptcha status field.
	 *
	 * @since    1.0.0
	 */
	public function recaptcha_status_field_callback() {

		$recaptcha_status_field      = get_option( 'talkino_recaptcha_status' );
		$is_recaptcha_status_checked = ( ! empty( $recaptcha_status_field ) && 'on' === $recaptcha_status_field ) ? 'checked' : '';

		?>
		<input name="talkino_recaptcha_status" type="hidden" value='off'/>
		<input name="talkino_recaptcha_status" type="checkbox" <?php echo esc_attr( $is_recaptcha_status_checked ); ?> value='on' /> <?php esc_html_e( 'Activate Google reCAPTCHA (v3) on contact form.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the google recaptcha status field.
	 *
	 * @since     1.0.0
	 * @param     string $recaptcha_status    The recaptcha status.
	 *
	 * @return    string    The validated value of recaptcha status.
	 */
	public function sanitize_recaptcha_status( $recaptcha_status ) {

		// Sanitize the checkbox.
		if ( ! empty( $recaptcha_status ) ) {
			if ( 'on' === $recaptcha_status || 'off' === $recaptcha_status ) {
				$recaptcha_status = $recaptcha_status;

			} else {

				$recaptcha_status = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_recaptcha_status', 'invalid_recaptcha_status_value', esc_html__( 'Oops, you have inserted invalid input of recaptcha field!', 'talkino' ), 'error' );

			}
		}

		return $recaptcha_status;

	}

	/**
	 * Callback function to render text field of recaptcha site key.
	 *
	 * @since    1.0.0
	 */
	public function recaptcha_site_key_field_callback() {

		$recaptcha_site_key = get_option( 'talkino_recaptcha_site_key' );

		?>
		<input type="text" name="talkino_recaptcha_site_key" class="regular-text" value="<?php echo isset( $recaptcha_site_key ) ? esc_attr( $recaptcha_site_key ) : ''; ?>" />
		<?php

	}

	/**
	 * Callback function to render text field of recaptcha secret key.
	 *
	 * @since    1.0.0
	 */
	public function recaptcha_secret_key_field_callback() {

		$recaptcha_secret_key = get_option( 'talkino_recaptcha_secret_key' );

		?>
		<input type="text" name="talkino_recaptcha_secret_key" class="regular-text" value="<?php echo isset( $recaptcha_secret_key ) ? esc_attr( $recaptcha_secret_key ) : ''; ?>" />
		<?php

	}

	/********************************* Credit *********************************/
	/**
	 * Callback function to render credit field.
	 *
	 * @since    2.0.0
	 */
	public function credit_field_callback() {

		$credit_field      = get_option( 'talkino_credit' );
		$is_credit_checked = ( ! empty( $credit_field ) && 'on' === $credit_field ) ? 'checked' : '';

		?>
		<input name="talkino_credit" type="hidden" value='off'/>
		<input name="talkino_credit" type="checkbox" <?php echo esc_attr( $is_credit_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino plugin to display credit on the chatbox.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the credit field.
	 *
	 * @since     2.0.0
	 * @param     string $credit_field    The credit.
	 *
	 * @return    string    The validated value of credit.
	 */
	public function sanitize_credit( $credit_field ) {

		// Sanitize the checkbox.
		if ( ! empty( $credit_field ) ) {
			if ( 'on' === $credit_field || 'off' === $credit_field ) {
				$credit_field = $credit_field;

			} else {

				$credit_field = 'on';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_credit', 'invalid_credit_value', esc_html__( 'Oops, you have inserted invalid input of credit field!', 'talkino' ), 'error' );

			}
		}

		return $credit_field;

	}

	/********************************* Advanced *********************************/
	/**
	 * Callback function to render reset settings status field.
	 *
	 * @since    1.1.1
	 */
	public function reset_settings_status_field_callback() {

		$reset_settings_status_field      = get_option( 'talkino_reset_settings_status' );
		$is_reset_settings_status_checked = ( ! empty( $reset_settings_status_field ) && 'on' === $reset_settings_status_field ) ? 'checked' : '';

		?>
		<input name="talkino_reset_settings_status" type="hidden" value='off'/>
		<input name="talkino_reset_settings_status" type="checkbox" <?php echo esc_attr( $is_reset_settings_status_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino plugin to reset all data of settings to default.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the reset settings status field.
	 *
	 * @since     1.1.1
	 * @param     string $reset_settings_status    The reset settings status.
	 *
	 * @return    string    The validated value of reset settings status.
	 */
	public function sanitize_reset_settings_status( $reset_settings_status ) {

		// Sanitize the checkbox.
		if ( ! empty( $reset_settings_status ) ) {
			if ( 'on' === $reset_settings_status || 'off' === $reset_settings_status ) {
				$reset_settings_status = $reset_settings_status;

			} else {

				$reset_settings_status = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_reset_settings_status', 'invalid_reset_settings_status_value', esc_html__( 'Oops, you have inserted invalid input of reset settings field!', 'talkino' ), 'error' );

			}
		}

		return $reset_settings_status;

	}

	/**
	 * Callback function to render data uninstall status field.
	 *
	 * @since    1.0.0
	 */
	public function data_uninstall_status_field_callback() {

		$data_uninstall_status_field      = get_option( 'talkino_data_uninstall_status' );
		$is_data_uninstall_status_checked = ( ! empty( $data_uninstall_status_field ) && 'on' === $data_uninstall_status_field ) ? 'checked' : '';

		?>
		<input name="talkino_data_uninstall_status" type="hidden" value='off'/>
		<input name="talkino_data_uninstall_status" type="checkbox" <?php echo esc_attr( $is_data_uninstall_status_checked ); ?> value='on' /> <?php esc_html_e( 'Enable Talkino plugin to completely remove all of its data when the plugin is uninstalled.', 'talkino' ); ?>
		<?php

	}

	/**
	 * Sanitize function to validate the data uninstall status field.
	 *
	 * @since     1.0.0
	 * @param     string $data_uninstall_status    The data uninstall status.
	 *
	 * @return    string    The validated value of data uninstall status.
	 */
	public function sanitize_data_uninstall_status( $data_uninstall_status ) {

		// Sanitize the checkbox.
		if ( ! empty( $data_uninstall_status ) ) {
			if ( 'on' === $data_uninstall_status || 'off' === $data_uninstall_status ) {
				$data_uninstall_status = $data_uninstall_status;

			} else {

				$data_uninstall_status = 'off';

				// Notify the user on invalid input.
				add_settings_error( 'talkino_data_uninstall_status', 'invalid_data_uninstall_status_value', esc_html__( 'Oops, you have inserted invalid input of data removing field!', 'talkino' ), 'error' );

			}
		}

		return $data_uninstall_status;

	}

	/**
	 * Reset data of plugin settings if the user activates the reset settings function on the setting.
	 *
	 * @since    1.1.1
	 */
	public static function reset_settings() {

		if ( get_option( 'talkino_reset_settings_status' ) === 'on' ) {

			/************* Settings */
			// Reset chatbox activation.
			update_option( 'talkino_chatbox_activation', 'active' );

			// Reset global online status.
			update_option( 'talkino_global_online_status', 'online' );

			// Reset global schedule data.
			$global_schedule_online_status_data = array(
				'monday_online_status'    => 'on',
				'tuesday_online_status'   => 'on',
				'wednesday_online_status' => 'on',
				'thursday_online_status'  => 'on',
				'friday_online_status'    => 'on',
				'saturday_online_status'  => 'on',
				'sunday_online_status'    => 'on',
				'monday_start_time'       => '00:00',
				'monday_end_time'         => '23:30',
				'tuesday_start_time'      => '00:00',
				'tuesday_end_time'        => '23:30',
				'wednesday_start_time'    => '00:00',
				'wednesday_end_time'      => '23:30',
				'thursday_start_time'     => '00:00',
				'thursday_end_time'       => '23:30',
				'friday_start_time'       => '00:00',
				'friday_end_time'         => '23:30',
				'saturday_start_time'     => '00:00',
				'saturday_end_time'       => '23:30',
				'sunday_start_time'       => '00:00',
				'sunday_end_time'         => '23:30',
			);

			update_option( 'talkino_global_schedule_online_status', $global_schedule_online_status_data );

			// Reset chatbox online subtitle.
			update_option( 'talkino_chatbox_online_subtitle', 'Let\'s get started to chat with us!' );

			// Reset chatbox away subtitle.
			update_option( 'talkino_chatbox_away_subtitle', 'We are currently away!' );

			// Reset chatbox offline subtitle.
			update_option( 'talkino_chatbox_offline_subtitle', 'Thank you for getting in touch. We are currently out of the office.' );

			// Reset offline message.
			update_option( 'talkino_offline_message', 'Sorry, there is no agent available.' );

			// Reset chatbox button text.
			update_option( 'talkino_chatbox_button_text', 'Chat Now' );

			// Delete to reset exclude pages.
			delete_option( 'talkino_chatbox_exclude_pages' );

			/** Styles */
			// Reset chatbox style data.
			update_option( 'talkino_chatbox_style', 'round' );

			// Reset chatbox position data.
			update_option( 'talkino_chatbox_position', 'right' );

			// Reset chatbox icon data.
			update_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );

			// Reset chatbox animation data.
			update_option( 'talkino_chatbox_animation', 'fadein' );

			// Reset start chat method.
			update_option( 'talkino_start_chat_method', '_blank' );

			// Reset chatbox z-index method.
			update_option( 'talkino_chatbox_z_index', '9999999' );

			// Reset chatbox theme color for online status.
			update_option( 'talkino_chatbox_online_theme_color', '#1e73be' );

			// Reset chatbox icon color for online status.
			update_option( 'talkino_chatbox_online_icon_color', '#fff' );

			// Reset chatbox theme color for away status.
			update_option( 'talkino_chatbox_away_theme_color', '#ff6000' );

			// Reset chatbox icon color for away status.
			update_option( 'talkino_chatbox_away_icon_color', '#fff' );

			// Reset chatbox theme color for offline status.
			update_option( 'talkino_chatbox_offline_theme_color', '#727779' );

			// Reset chatbox icon color for offline status.
			update_option( 'talkino_chatbox_offline_icon_color', '#fff' );

			// Reset chatbox background color.
			update_option( 'talkino_chatbox_background_color', '#f0f0f1' );

			// Reset chatbox title color.
			update_option( 'talkino_chatbox_title_color', '#fff' );

			// Reset chatbox subtitle color.
			update_option( 'talkino_chatbox_subtitle_color', '#000' );

			// Reset chatbox button color.
			update_option( 'talkino_chatbox_button_color', '#727779' );

			// Reset chatbox button text color.
			update_option( 'talkino_chatbox_button_text_color', '#fff' );

			// Reset agent field background color.
			update_option( 'talkino_agent_field_background_color', '#fff' );

			// Reset agent field hover background color.
			update_option( 'talkino_agent_field_hover_background_color', '#dfdfdf' );

			// Reset agent name text color.
			update_option( 'talkino_agent_name_text_color', '#222' );

			// Reset agent job title text color.
			update_option( 'talkino_agent_job_title_text_color', '#888' );

			// Reset agent channel text color.
			update_option( 'talkino_agent_channel_text_color', '#888' );

			/** Ordering */
			// Reset agent ordering.
			update_option( 'talkino_channel_ordering', 'talkino_whatsapp,talkino_facebook,talkino_telegram,talkino_phone,talkino_email' );

			/** Display */
			// Reset show on post data.
			update_option( 'talkino_show_on_post', 'on' );

			// Reset show on search data.
			update_option( 'talkino_show_on_search', 'on' );

			// Reset show on 404 data.
			update_option( 'talkino_show_on_404', 'on' );

			// Reset show on woocommerce shop, product, product category and tag pages data.
			update_option( 'talkino_show_on_woocommerce_pages', 'on' );

			// Reset show on desktop data.
			update_option( 'talkino_show_on_desktop', 'on' );

			// Reset show on mobile data.
			update_option( 'talkino_show_on_mobile', 'on' );

			// Reset user visibility data.
			update_option( 'talkino_user_visibility', 'all' );

			/** Contact Form */
			// Reset contact form status.
			update_option( 'talkino_contact_form_status', 'off' );

			// Reset email recipient.
			update_option( 'talkino_email_recipient', get_option( 'admin_email' ) );

			// Reset email subject.
			update_option( 'talkino_email_subject', 'Message from Contact Form' );

			// Reset sender message.
			update_option( 'talkino_sender_message', '%%message%%' );

			// Reset sender name.
			update_option( 'talkino_sender_name', 'From: %%sender_name%%' );

			// Reset sender email.
			update_option( 'talkino_sender_email', 'Sender\'s Email: %%sender_email%%' );

			// Reset successful email sent message.
			update_option( 'talkino_success_email_message', 'Email has been successfully sent out.' );

			// Reset failed email sent message.
			update_option( 'talkino_fail_email_message', 'Email has been failed to sent out.' );

			// Reset recaptcha status.
			update_option( 'talkino_recaptcha_status', 'off' );

			// Reset recaptcha site key.
			update_option( 'talkino_recaptcha_site_key', '' );

			// Reset recaptcha secret key.
			update_option( 'talkino_recaptcha_secret_key', '' );

			/** Advanced */
			// Reset credit.
			update_option( 'talkino_credit', 'on' );

			/** Advanced */
			// Reset data uninstall status.
			update_option( 'talkino_reset_settings_status', 'off' );

			// Reset data uninstall status.
			update_option( 'talkino_data_uninstall_status', 'off' );

			// Call to display the message of reset settings successfully.
			$message = esc_html__( 'All settings data of Talkino has been reset successfully!', 'talkino' );
			$class   = 'success';

			new Talkino_Notifier( $message, $class );

		}

	}

}
