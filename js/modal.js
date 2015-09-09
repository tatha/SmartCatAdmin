// JavaScript Document
/*
*****************************************************************
** Custom Modal using jQuery UI Dialog
*****************************************************************
** Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 *  jquery.ui.button.js
 *	jquery.ui.draggable.js
 *	jquery.ui.dialog.js
 *	jquery.ui.mouse.js
 *	jquery.ui.position.js
 *	jquery.ui.resizable.js
*****************************************************************
** Page Author : Tathagata Basu
** Created On  : 20/11/2013
*****************************************************************
*/
(function ( $ ) {

	$.modal = function( options ) {
		
		var modalId;
		var title;
		var html;
		var showEffect;
		var hideEffect;
		var duration;
		var reloadOnClose;
		var autoOpen;
		var	buttons;
		var	closeOnEscape;
		var closeText;
		var	draggable;
		var	height;
		var	width;
		var	modal;
	
		
		// This is the easiest way to have default options.
		var settings = $.extend({
			// These are the defaults.
			modalId: "dialog",
			title: "Modal Box",
			html:"<p>Insert your content here</p>",
			showEffect:"clip",
			hideEffect:"clip",
			duration:250,
			reloadOnClose:false,
			autoOpen: false,
			buttons: [],
			closeOnEscape: true,
			closeText: null,
			draggable: true,
			height: "auto",
			width: "auto",
			modal: true
		}, options );
		
		var modalhtml = '<div class="'+settings.modalId+'" title="'+settings.title+'">'+settings.html+'</div>';
		$('body').append(modalhtml);
		var modalObj = $("."+settings.modalId).dialog({
			autoOpen: settings.autoOpen,
			buttons: settings.buttons,
			closeOnEscape: settings.closeOnEscape,
			closeText: settings.closeText,
			settings: settings.settings,
			draggable: settings.draggable,
			height: settings.height,
			width: settings.width,
			modal: settings.modal,
			show: {
				effect: settings.showEffect,
				duration: settings.duration
			},
			hide: {
				effect: settings.hideEffect,
				duration: settings.duration
			},
			close:function() {
				$("."+settings.modalId ).remove();
				if(settings.reloadOnClose) {
					location.reload();
				}
			}
		});
				
		$("."+settings.modalId ).dialog( "open" );
		
		$.modal.close = function() {
			
			modalObj.dialog( "close" );
			
		}
		
		/*close : function(options) {
			alert(111);
		}*/
	 
	};
	
	/*$.modal.close = function(options) {
		
		alert(123);
		
	}*/
	
	/*$("#dialog").on('dialogclose', function(){
		alert("Hello");
	})*/
 
}( jQuery ));