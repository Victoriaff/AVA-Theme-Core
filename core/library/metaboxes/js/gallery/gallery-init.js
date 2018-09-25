jQuery(document).ready(function($) {		
	$('.add_gallery_items_button').live('click', function( event ) {			
		event.preventDefault();			
		var file_frame = '', 
			field_name = '';
		
		if (file_frame) {
			file_frame.open();				
			return;			
		}		
		
		file_frame = wp.media.editor.send.attachment  = wp.media({
			editing:   true,
			multiple:   true
		}); 			
		
		field_name = $(this).parent().find('input[name="field_name_sorting[]"]').val();
		file_frame.on( 'select', function() {				
			var selection = file_frame.state().get('selection');					
				selection.map( function( attachment ) {						
				attachment = attachment.toJSON();						
				var image_url = attachment.url,							
					image_id  = attachment.id;						
					var data = {	
						action:  'spotter_add_new_element_action',										
						type:    'add_new_images',										
						image_url: image_url,										
						image_id : image_id,		
						field_name : field_name,
						image_cnt: $("ul.sortable-admin-gallery li.img_status").length,
						spotter_ajax_nonce : spotter_vars_ajax.ajax_nonce,																			
						};													
						
						$.post(spotter_vars_ajax.ajaxurl, data, function(response) {							
							if ($("ul#"+field_name+".sortable-admin-gallery li.img_status").length > 0) {
								$("ul#"+field_name+".sortable-admin-gallery li.img_status").last().after(response);							
							} else {
								$("ul#"+field_name+".sortable-admin-gallery").append(response);							
							}				  				  					
							
						});			  					
				});			
	});			
	file_frame.open();			
	return false;		
});		

	$( ".sortable-admin-gallery" ).disableSelection();	
	$( ".sortable-admin-gallery" ).sortable({placeholder:'ui-SortPlaceHolder'});			
});