<?php
/**
 * The admin area to handle upgrade functions.
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
 * The admin area to handle upgrade functions.
 *
 * @package    Talkino
 * @subpackage Talkino/includes/admin
 * @author     Traxconn <mail@traxconn.com>
 */
class Talkino_Upgrader {

	/**
	 * The function to upgrade plugin data.
	 *
	 * @since    1.0.3
	 */
	public function upgrade_plugin_data() {

		/********** Update data based on plugin version **********/
		// Add talkino version data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_version' ) === false ) {

			$this->remove_plugin_database_table();
			$this->create_plugin_database_table();
			$this->remove_plugin_options();
			$this->add_plugin_options();
			$this->upgrade_plugin_options();
			
			update_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );
			update_option( 'talkino_global_online_status', strtolower( get_option( 'talkino_global_online_status' ) ) );

			add_option( 'talkino_version', '2.0' );

		} elseif ( get_option( 'talkino_version' ) === '1.1' ) {

			$this->remove_plugin_database_table();
			$this->create_plugin_database_table();
			$this->remove_plugin_options();
			$this->add_plugin_options();
			$this->upgrade_plugin_options();
		
			update_option( 'talkino_chatbox_icon', 'dashicons-format-chat' );
			update_option( 'talkino_global_online_status', strtolower( get_option( 'talkino_global_online_status' ) ) );

			update_option( 'talkino_version', '2.0' );

		} elseif ( get_option( 'talkino_version' ) === '1.2' ) {

			$this->remove_plugin_database_table();
			$this->create_plugin_database_table();
			$this->remove_plugin_options();
			$this->add_plugin_options();
			$this->upgrade_plugin_options();

			update_option( 'talkino_version', '2.0' );

		}

	}

	/**
	 * The function to remove plugin database table.
	 *
	 * @since    2.0.5
	 */
	public function remove_plugin_database_table() {
		
		// Remove old database table.
		global $wpdb;
		$table_name = $wpdb->prefix . 'talkino_chatbox_log'; 
		
		$sql = "DROP TABLE IF EXISTS $table_name";
		$result = $wpdb->query($sql);

	}

	/**
	 * The function to create plugin database table.
	 *
	 * @since    2.0.5
	 */
	public function create_plugin_database_table() {
	
		// Add new database table.
		global $wpdb;
		$table_name = $wpdb->prefix . 'talkino_log';
		$charset_collate = $wpdb->get_charset_collate();

		// Create the table if it does not exit.
		if( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {

			$sql = "CREATE TABLE {$table_name} (
				id bigint(20) NOT NULL auto_increment,
				agent_id bigint(20) NOT NULL,
				agent varchar(255) NOT NULL,
				chat_channel varchar(100) NOT NULL,
				chat_method varchar(100) NOT NULL,
				is_member varchar(100) NOT NULL,
				ip varchar(255) NOT NULL,
				country varchar(255) NOT NULL,
				chat_date date NOT NULL,
				PRIMARY KEY  id (id)
			) {$charset_collate};";

			$wpdb->query( $sql );
		
		}
	
	}

	/**
	 * The function to upgrade plugin options.
	 *
	 * @since    2.0.5
	 */
	public function add_plugin_options() {

		/********** Add new option data **********/
		// Add chatbox activation if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_activation' ) === false ) {
			add_option( 'talkino_chatbox_activation', 'active' );
		}

		// Add chatbox button text if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_text' ) === false ) {
			add_option( 'talkino_chatbox_button_text', 'Chat Now' );
		}

		// Add chatbox layout data if it does not exist when upgrade from old version. 
		if ( get_option( 'talkino_chatbox_layout' ) === false ) {
			add_option( 'talkino_chatbox_layout', 'direct' );
		}

		// Add chatbox animation if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_animation' ) === false ) {
			add_option( 'talkino_chatbox_animation', 'fadein' );
		}

		// Add chatbox z-index if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_z_index' ) === false ) {
			add_option( 'talkino_chatbox_z_index', '9999999' );
		}

		// Add chatbox icon color for online status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_online_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_online_icon_color', '#fff' );
		}

		// Add chatbox icon color for away status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_away_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_away_icon_color', '#fff' );
		}

		// Add chatbox icon color for offline status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_offline_icon_color' ) === false ) {
			add_option( 'talkino_chatbox_offline_icon_color', '#fff' );
		}

		// Add chatbox button color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_color' ) === false ) {
			add_option( 'talkino_chatbox_button_color', '#727779' );
		}

		// Add chatbox button text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_chatbox_button_text_color' ) === false ) {
			add_option( 'talkino_chatbox_button_text_color', '#fff' );
		}

		// Add bubble background color if it does not exist.
		if ( get_option( 'talkino_bubble_background_color' ) === false ) {
			add_option( 'talkino_bubble_background_color', '#f4f4f4' );
		}

		// Add contact form notice text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_contact_form_notice_text_color' ) === false ) {
			add_option( 'talkino_contact_form_notice_text_color', '#008000' );
		}

		// Add google recaptcha notice text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_google_recaptcha_notice_text_color' ) === false ) {
			add_option( 'talkino_google_recaptcha_notice_text_color', '#000' );
		}

		// Add google recaptcha link text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_google_recaptcha_link_text_color' ) === false ) {
			add_option( 'talkino_google_recaptcha_link_text_color', '#0000ff' );
		}

		// Add credit text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_credit_text_color' ) === false ) {
			add_option( 'talkino_credit_text_color', '#888' );
		}

		// Add agent field background color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_field_background_color' ) === false ) {
			add_option( 'talkino_agent_field_background_color', '#f0f0f1' );
		}

		// Add agent field hover background color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_field_hover_background_color' ) === false ) {
			add_option( 'talkino_agent_field_hover_background_color', '#dfdfdf' );
		}

		// Add agent name text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_name_text_color' ) === false ) {
			add_option( 'talkino_agent_name_text_color', '#222' );
		}

		// Add agent job title text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_job_title_text_color' ) === false ) {
			add_option( 'talkino_agent_job_title_text_color', '#888' );
		}

		// Add agent channel text color if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_agent_channel_text_color' ) === false ) {
			add_option( 'talkino_agent_channel_text_color', '#888' );
		}

		// Add show on 404 data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_show_on_404' ) === false ) {
			add_option( 'talkino_show_on_404', 'on' );
		}

		// Add typebot status data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_typebot_status' ) === false ) {
			add_option( 'talkino_typebot_status', 'off' );
		}

		// Add typebot link data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_typebot_link' ) === false ) {
			add_option( 'talkino_typebot_link', '' );
		}

		// Add Google Analytics status if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_ga_status' ) === false ) {
			add_option( 'talkino_ga_status', 'off' );
		}

		// Add Google Analytics measurement id if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_ga_measurement' ) === false ) {
			add_option( 'talkino_ga_measurement', '' );
		}

		// Add Google Analytics api secret if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_ga_api' ) === false ) {
			add_option( 'talkino_ga_api', '' );
		}

		// Add user visibility data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_user_visibility' ) === false ) {
			add_option( 'talkino_user_visibility', 'all' );
		}

		// Add show offline agents data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_show_offline_agents' ) === false ) {
			add_option( 'talkino_show_offline_agents', 'hide' );
		}

		// Add sender phone number if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_sender_phone' ) === false ) {
			add_option( 'talkino_sender_phone', 'Sender\'s Phone: %%sender_phone%%' );
		}

		// Add activate country block if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_activate_country_block' ) === false ) {
			add_option( 'talkino_activate_country_block', 'off' );
		}

		// Add country restriction data if they do not exist when upgrade from old version.
		if ( get_option( 'talkino_country_restriction' ) === false ) {

			$country_restriction_data = array();
			add_option( 'talkino_country_restriction', $country_restriction_data );

		}

		// Add credit data if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_credit' ) === false ) {
			add_option( 'talkino_credit', 'on' );
		}

		// Add report storage duration if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_report_storage_duration' ) === false ) {
			add_option( 'talkino_report_storage_duration', '24-months' );
		}

		// Add receive weekly report if it does not exist when upgrade from old version.
		if ( get_option( 'talkino_receive_weekly_report' ) === false ) {
			add_option( 'talkino_receive_weekly_report', 'active' );
		}

	}

	/**
	 * The function to remove deprecated plugin options.
	 *
	 * @since    2.0.5
	 */
	public function remove_plugin_options() {

		// Remove deprecated data of chatbox height.
		if ( get_option( 'talkino_chatbox_height' ) !== false ) {
			delete_option( 'talkino_chatbox_height' );
		}

		// Remove deprecated data of load font awesome deferred.
		if ( get_option( 'talkino_load_font_awesome_deferred' ) !== false ) {
			delete_option( 'talkino_load_font_awesome_deferred' );
		}

		// Remove deprecated data of agent not available message.
		if ( get_option( 'talkino_agent_not_available_message' ) !== false ) {
			delete_option( 'talkino_agent_not_available_message' );
		}
		
	}

	/**
	 * The function to upgrade plugin options.
	 *
	 * @since    2.0.5
	 */
	public function upgrade_plugin_options() {

		// Remove deprecated data of contact ordering.
		if ( get_option( 'talkino_contact_ordering' ) !== false ) {
			delete_option( 'talkino_contact_ordering' );

			// Add a new option of channel ordering.
			if ( get_option( 'talkino_channel_ordering' ) === false ) {
				add_option( 'talkino_channel_ordering', 'talkino-whatsapp,talkino-messenger,talkino-telegram,talkino-phone,talkino-email' );
			}
		}

		// Replace old talkino channel ordering data with dash and update it.
		if ( get_option( 'talkino_channel_ordering' ) !== false ) {

			$channel_ordering = get_option( 'talkino_channel_ordering' );

			if( strpos( $channel_ordering, '_' ) !== false ){

				$channel_ordering = str_replace( "_", "-", $channel_ordering );
				$channel_ordering = str_replace( "facebook", "messenger", $channel_ordering );
				update_option( 'talkino_channel_ordering', $channel_ordering );

			} 

		}

	}

}
