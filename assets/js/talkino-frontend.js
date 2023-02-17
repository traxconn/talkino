
jQuery( document ).ready( function( $ ) {

	/******************** Append the agent profile for modern layout ********************/
	function appendHtml(el, str) {

		var div = document.createElement( 'div' ); //container to append to
		div.innerHTML = str;
		while ( div.children.length > 0 ) {
			el.appendChild(div.children[0] );
		}

	}

	$( '.talkino-chat-modern-information' ).click( function( event ) { 
        $( ".talkino-agent-wrapper" ).hide();  
        $( ".talkino-agent-profile-wrapper" ).show();
		document.getElementById( "talkino-back-button" ).setAttribute('style', 'display:block !important');

		// Clear the previous agent profile wrapper before draw it again.
		$( ".talkino-agent-profile-wrapper" ).empty();
		
		var agent_id = $( this ).find( ".talkino-hidden-agent-id" ).text();

		// Action url for ajax.
		var wpajax_chat_modern_url = talkino_frontend_ajax_object.ajax_url + '?action=talkino_draw_agent_profile';

		$.ajax({
	
			type: 'post', 
			url: wpajax_chat_modern_url, 
			data: {
				'agent_id': agent_id
			},
			cache: false,

			success: function( response ) { 

				// Draw agent profile.
				appendHtml( document.getElementById( "talkino-agent-profile-wrapper" ), response );
				
			}
			
		});

    }); 

	$( '#talkino-back-button' ).click( function( event ) { 

		$( ".talkino-agent-profile-wrapper" ).hide();
        $( ".talkino-agent-wrapper" ).show();  
		$( ".talkino-back-button" ).hide();
       
    }); 

	/******************** Insert reporting data of direct method ********************/
	$( document ).on( "mousedown", ".talkino-chat-direct-information", function ( event ) {   
	
	// Action url for ajax.
	var wpajax_chatbox_direct_log_url = talkino_frontend_ajax_object.ajax_url + '?action=talkino_insert_chatbox_log_data';

        switch( event.which ){

			// Left mouse button pressed.
			case 1:
			var agent_id = $( this ).find( ".talkino-hidden-agent-id" ).text();
			var agent = $( this ).find( ".talkino-hidden-full-name" ).text();
			var chat_channel = $( this ).find( ".talkino-hidden-chat-channel-type" ).text();
			var chat_method = 'Chatbox';

			$.ajax({

				type: 'post', 
				url: wpajax_chatbox_direct_log_url, 
				data: {
					'agent_id' : agent_id,
					'agent': agent,
					'chat_channel': chat_channel,
					'chat_method': chat_method 
				},
	
				success: function( data ) { 
					
				}
	
			});
			break;

			// Middle mouse button pressed.
           	case 2:
			var agent_id = $( this ).find( ".talkino-hidden-agent-id" ).text();
			var agent = $( this ).find( ".talkino-hidden-full-name" ).text();
			var chat_channel = $( this ).find( ".talkino-hidden-chat-channel-type" ).text();
			var chat_method = 'Chatbox';
			
			$.ajax({
	
				type: 'post', 
				url: wpajax_chatbox_direct_log_url, 
				data: {
					'agent_id' : agent_id,
					'agent': agent,
					'chat_channel': chat_channel,
					'chat_method': chat_method 
				},
	
				success: function( data ) { 
					
				}
			});
           	break;
           
           	default:

		}

    });

	/******************** Insert reporting data of modern method ********************/
	$( document ).on( "mousedown", ".talkino-agent-profile-link", function ( event ) {   

		// Action url for ajax.
		var wpajax_chatbox_modern_log_url = talkino_frontend_ajax_object.ajax_url + '?action=talkino_insert_chatbox_log_data';

		switch( event.which ){
			
			// Left mouse button pressed.
			case 1:
				var agent_id = $( this ).find( ".talkino-hidden-agent-id" ).text();
				var agent = $( this ).find( ".talkino-hidden-full-name" ).text();
				var chat_channel = $( this ).find( ".talkino-hidden-chat-channel-type" ).text();
				var chat_method = 'Chatbox';

				$.ajax({
	
					type: 'post', 
					url: wpajax_chatbox_modern_log_url, 
					data: {
						'agent_id' : agent_id,
						'agent': agent,
						'chat_channel': chat_channel,
						'chat_method': chat_method 
					},
		
					success: function( data ) { 
						
					}
		
				});
				break;
	
				// Middle mouse button pressed.
				case 2:
				var agent_id = $( this ).find( ".talkino-hidden-agent-id" ).text();
				var agent = $( this ).find( ".talkino-hidden-full-name" ).text();
				var chat_channel = $( this ).find( ".talkino-hidden-chat-channel-type" ).text();
				var chat_method = 'Chatbox';

				$.ajax({
		
					type: 'post', 
					url: wpajax_chatbox_modern_log_url, 
					data: {
						'agent_id' : agent_id,
						'agent': agent,
						'chat_channel': chat_channel,
						'chat_method': chat_method 
					},
		
					success: function( data ) { 
						
					}
				});
				break;
			   
				default:

		}
		
	});
	  
});