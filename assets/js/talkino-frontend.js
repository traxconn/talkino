jQuery( document ).ready( function( $ ) {

	/******************** Insert data to database table ********************/
	// Action url for ajax.
	var wpajax_url1 = ajax_object.ajax_url + '?action=insert_chatbox_log_data';

	$( '.talkino-chat-information' ).click( function( event ) { 
        
		var agent = $(this).find(".talkino-chat-name").text();
		var chat_channel = $(this).find(".talkino-chat-channel-type").text();
        
		$.ajax({

			type: 'post', 
			url: wpajax_url1, 
			data: {
				'agent': agent,
				'chat_channel': chat_channel 
			},

			success: function(data) { 
				
			}

		});

    }); 
		
});