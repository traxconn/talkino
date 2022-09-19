jQuery( document ).ready( function( $ ) {

	/******************** Contact order list ********************/
	// Action url for ajax.
	var wpajax_url_sort_contact = ajax_object.ajax_url + '?action=talkino_update_contact_order_list';

	$( '#talkino_contact_ordering_list' ).sortable({
        update: function( event, ui ) {

			var list_data = $( "#talkino_contact_ordering_list" ).sortable( 'toArray' ).toString();

			$.ajax( {
				data: {
					order: list_data
				},
				method: 'POST',
				url: wpajax_url_sort_contact,

				'error': function( error ) {

					// Ajax didn't work
					alert( error );

				}

			}); 
			
        }

    }); 

	/******************** Agent order list ********************/
	// Action url for ajax.
	var wpajax_url_sort_agent = ajax_object.ajax_url + '?action=talkino_update_agent_order_list';

	$( '#talkino_agent_ordering_list' ).sortable({
        update: function( event, ui ) {

			var list_data = $( "#talkino_agent_ordering_list" ).sortable( 'toArray' ).toString();

			$.ajax( {
				data: {
					order: list_data
				},
				method: 'POST',
				url: wpajax_url_sort_agent,

				'error': function( error ) {

					// Ajax didn't work
					alert( error );

				}

			});

        }

    }); 

});

// Drag and drop event
function ordering_list_event() {

	jQuery( "#talkino_contact_ordering_list" ).sortable( { 

		placeholder: "talkino_sortable_placeholder", 
		revert: false,
		tolerance: "pointer" 
		
	});

	jQuery( "#talkino_agent_ordering_list" ).sortable( { 

		placeholder: "talkino_sortable_placeholder", 
		revert: false,
		tolerance: "pointer" 
		
	});

};

addLoadEvent( ordering_list_event );