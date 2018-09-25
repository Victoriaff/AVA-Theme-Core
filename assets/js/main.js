// *************************************************************************//
// ! This is main JS file that contains custom scripts used in this plugin */
// *************************************************************************//

(function($){
	"use strict";

	window.ehCoreFront = {

        ajaxUrl: '/wp-admin/admin-ajax.php',

		/**
			Constructor
		**/
		initialize: function() {
			var self = this;
			$(document).ready(function(){
				self.build();
				self.events();
			});
		},
		/**
			Build page elements, plugins init
		**/
		build: function() {
			//this.setupHeader();
			//this.setupMenu();
		},
		/**
			Set page events
		**/
		events: function() {
		},

		/** Check for mobile device **/
		isMobile: function() {
			return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent );
		},

		stringToBoolean: function(string){

			switch(string){
				case "true": case "yes": case "1": return true;
				case "false": case "no": case "0": case null: case '': return false;
				default: return Boolean(string);
			}
		},

		/** Check email address **/
		isValidEmailAddress: function( emailAddress ) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test( emailAddress );
		},

        /** Check required fields*/
        hl_required: function($form) {
            var checked = true;
            $form.find('[required]').removeClass('required').each(function() {
                var $this = $(this), val = $.trim($(this).val());
                $this.parent('.select.required').removeClass('required');

                if ($this.attr('required') == 'required' && $.trim(val) == '') {
                    $this.addClass('required');
                    $(this).parent('.select').addClass('required');
                    checked = false;
                } else if ($this.attr('type') == 'email' && !ehCoreFront.isValidEmailAddress(val)) {
                    $this.addClass('required');
                    checked = false;
                }
            });
            return checked;
        },

        /** Format value to format 0.00 */
        sprintf: function( val ) {
            val = val.toString();
            var i = val.indexOf('.');
            if (i == -1)
                val = val + '.00';
            else if (i == val.length - 2)
                val = val + '0';
            return val;
        },

        /** Show modal window */
        modal: function(response) {
            if (response.message != undefined ) {
                $("#ehModal .modal-title").html(response.title);
                $("#ehModal .modal-text").html(response.message);
                $("#ehModal").modal("show");
            }
        }
    }

	window.ehCoreFront.initialize();

})( window.jQuery );