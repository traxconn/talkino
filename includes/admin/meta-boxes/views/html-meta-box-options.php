<?php
/**
 * Displays the options metabox.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/admin/meta-boxes/views
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

	// Declare the class to use various functions.
	$talkino_tools = new Talkino_Tools();

	$agent_schedule_activate_status         = $data['agent_schedule_activate_status'];
	$agent_schedule_monday_online_status    = $data['agent_schedule_monday_online_status'];
	$agent_schedule_tuesday_online_status   = $data['agent_schedule_tuesday_online_status'];
	$agent_schedule_wednesday_online_status = $data['agent_schedule_wednesday_online_status'];
	$agent_schedule_thursday_online_status  = $data['agent_schedule_thursday_online_status'];
	$agent_schedule_friday_online_status    = $data['agent_schedule_friday_online_status'];
	$agent_schedule_saturday_online_status  = $data['agent_schedule_saturday_online_status'];
	$agent_schedule_sunday_online_status    = $data['agent_schedule_sunday_online_status'];

	// Declare the values of weekday checkbox.
	$is_agent_schedule_activate_status_checked = ( ! empty( $agent_schedule_activate_status ) && 'on' === $agent_schedule_activate_status ) ? 'checked' : '';
	$is_monday_checked                         = ( ! empty( $agent_schedule_monday_online_status ) && 'on' === $agent_schedule_monday_online_status ) ? 'checked' : '';
	$is_tuesday_checked                        = ( ! empty( $agent_schedule_tuesday_online_status ) && 'on' === $agent_schedule_tuesday_online_status ) ? 'checked' : '';
	$is_wednesday_checked                      = ( ! empty( $agent_schedule_wednesday_online_status ) && 'on' === $agent_schedule_wednesday_online_status ) ? 'checked' : '';
	$is_thursday_checked                       = ( ! empty( $agent_schedule_thursday_online_status ) && 'on' === $agent_schedule_thursday_online_status ) ? 'checked' : '';
	$is_friday_checked                         = ( ! empty( $agent_schedule_friday_online_status ) && 'on' === $agent_schedule_friday_online_status ) ? 'checked' : '';
	$is_saturday_checked                       = ( ! empty( $agent_schedule_saturday_online_status ) && 'on' === $agent_schedule_saturday_online_status ) ? 'checked' : '';
	$is_sunday_checked                         = ( ! empty( $agent_schedule_sunday_online_status ) && 'on' === $agent_schedule_sunday_online_status ) ? 'checked' : '';

?>
	<div>
		<p>
			<label><b><?php esc_html_e( 'Time Schedule:', 'talkino' ); ?></b></label>
		<br>
			<label><i><?php esc_html_e( 'Configure the online time schedule for the agent. Please be noted that global online schedule in Talkino Settings will override the online time schedule for the agent.', 'talkino' ); ?></i></label>
		</p>
		<p>			
		<!-- Agent schedule time activate status field -->
		<input name="talkino_agent_schedule_activate_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_activate_status" name="talkino_agent_schedule_activate_status" type="checkbox" <?php echo esc_attr( $is_agent_schedule_activate_status_checked ); ?> value='on' /> <?php esc_html_e( 'Activate the time schedule feature for agent', 'talkino' ); ?>
		</p>

		<p>
			<label><b><?php esc_html_e( 'Select the day and time for online schedule of agent:', 'talkino' ); ?></b></label>
		</p>		
		<!-- Monday field -->
		<input name="talkino_agent_schedule_monday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_monday_online_status" name="talkino_agent_schedule_monday_online_status" type="checkbox" <?php echo esc_attr( $is_monday_checked ); ?> value='on' /> <?php esc_html_e( 'Monday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_monday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_monday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_monday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_monday_end_time'] );
			?>
			</select>
		</p>

		<!-- Tuesday field -->
		<input name="talkino_agent_schedule_tuesday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_tuesday_online_status" name="talkino_agent_schedule_tuesday_online_status" type="checkbox" <?php echo esc_attr( $is_tuesday_checked ); ?> value='on' /> <?php esc_html_e( 'Tuesday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_tuesday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_tuesday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_tuesday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_tuesday_end_time'] );
			?>
			</select>
		</p>

		<!-- Wednesday field -->
		<input name="talkino_agent_schedule_wednesday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_wednesday_online_status" name="talkino_agent_schedule_wednesday_online_status" type="checkbox" <?php echo esc_attr( $is_wednesday_checked ); ?> value='on' /> <?php esc_html_e( 'Wednesday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_wednesday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_wednesday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_wednesday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_wednesday_end_time'] );
			?>
			</select>
		</p>

		<!-- Thursday field -->
		<input name="talkino_agent_schedule_thursday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_thursday_online_status" name="talkino_agent_schedule_thursday_online_status" type="checkbox" <?php echo esc_attr( $is_thursday_checked ); ?> value='on' /> <?php esc_html_e( 'Thursday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_thursday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_thursday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_thursday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_thursday_end_time'] );
			?>
			</select>
		</p>

		<!-- Friday field -->
		<input name="talkino_agent_schedule_friday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_friday_online_status" name="talkino_agent_schedule_friday_online_status" type="checkbox" <?php echo esc_attr( $is_friday_checked ); ?> value='on' /> <?php esc_html_e( 'Friday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_friday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_friday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_friday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_friday_end_time'] );
			?>
			</select>
		</p>

		<!-- Saturday field -->
		<input name="talkino_agent_schedule_saturday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_saturday_online_status" name="talkino_agent_schedule_saturday_online_status" type="checkbox" <?php echo esc_attr( $is_saturday_checked ); ?> value='on' /> <?php esc_html_e( 'Saturday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_saturday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_saturday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_saturday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_saturday_end_time'] );
			?>
			</select>
		</p>

		<!-- Sunday field -->
		<input name="talkino_agent_schedule_sunday_online_status" type="hidden" value='off' />
		<input id="talkino_agent_schedule_sunday_online_status" name="talkino_agent_schedule_sunday_online_status" type="checkbox" <?php echo esc_attr( $is_sunday_checked ); ?> value='on' /> <?php esc_html_e( 'Sunday', 'talkino' ); ?>
		<p>
			<select name="talkino_agent_schedule_sunday_start_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_sunday_start_time'] );
			?>
			</select>

			<select name="talkino_agent_schedule_sunday_end_time">
			<?php
				$talkino_tools->select_time( $data['agent_schedule_sunday_end_time'] );
			?>
			</select>
		</p>

		<!-- Button to select all boxes -->
		<p>
			<button type="button" class="button button-primary" name="talkino_agent_schedule_selector" id="talkino_agent_schedule_selector" /><?php esc_html_e( 'Select all days', 'talkino' ); ?></button>
		</p>
	</div>
