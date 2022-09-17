jQuery( document ).ready( function( $ ) {

	// Listen for click on toggle checkbox of agent schedule online status.
	$( '#talkino_agent_schedule_selector' ).click( function( event ) {   
		
		$( '#talkino_agent_schedule_monday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_tuesday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_wednesday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_thursday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_friday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_saturday_online_status' ).prop( 'checked', true );
		$( '#talkino_agent_schedule_sunday_online_status' ).prop( 'checked', true );
			
	}); 

	$( '#talkino_global_schedule_selector' ).click( function( event ) {   
		
		$( '#talkino_global_schedule_monday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_tuesday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_wednesday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_thursday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_friday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_saturday_online_status' ).prop( 'checked', true );
		$( '#talkino_global_schedule_sunday_online_status' ).prop( 'checked', true );
			
	}); 

});

