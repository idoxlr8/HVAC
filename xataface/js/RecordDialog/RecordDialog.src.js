(function($){
	var RecordDialog = function(o){
		this.el = document.createElement('div');
		this.recordid = null;
		this.table = null;
		this.baseURL = DATAFACE_URL+'/js/RecordDialog';
		
		for ( var i in o ) this[i] = o[i];
	};
	
	RecordDialog.prototype = {
	
		display: function(){
			var dialog = this;
			$(this.el).load(this.baseURL+'/templates/dialog.html', function(){
				var frame = $(this).find('.xf-RecordDialog-iframe')
					.css({
						'width': '100%',
						'height': '100%',
						'border': 'none'
					})
					.attr('src', dialog.getURL());
					
				//alert(frame.attr('width'));
				frame.load(function(){
					//alert('here');
					var iframe = $(this).contents();
					try {
						var parsed  = null;
						
						eval('parsed = '+iframe.text()+';');
						if ( parsed['response_code'] == 200 ){
							
							// We saved it successfully
							// so we can close our window
							if ( dialog.callback ){
								dialog.callback(parsed['record_data']);
							}
							
							$(dialog.el).dialog('close');
							if ( parsed['response_message'] ){
								alert(parsed['response_message']);
							}
							return;
						
						}
					} catch (err){
					
					
					}
					//alert($(this).html());
					
					var dc =iframe.find('.documentContent');
					if ( dc.length == 0 ) dc = iframe.find('#main_section');
					if ( dc.length == 0 ) dc = iframe.find('#main_column');
					iframe.find('body').empty();
					$('script', dc).remove();	// So script tags don't get run twice.
					dc.appendTo(iframe.find('body'));
						
				});
					
				
			});
			$(this.el).appendTo('body');
			
			
			$(this.el).dialog({
				buttons: {
					OK : function(){
						if ( dialog.callback ){
							dialog.callback();
						}
						$(this).dialog('close');
					}
					
				},
				height: $(window).height()-100,
				width: $(window).width()-100,
				title: (this.recordid?'Edit '+this.table+' Record':'Create New '+this.table+' Record'),
				modal: true
			});
			
		},
		
		getURL: function(){
			var action;
			if ( !this.recordid ){
				action='new';
			} else {
				action='edit';
			}
			return DATAFACE_SITE_HREF+'?-table='+encodeURIComponent(this.table)+(this.recordid?'&-recordid='+encodeURIComponent(this.recordid):'')+'&-action='+encodeURIComponent(action)+'&-response=json';
		}
	};
	
	
	
	$.fn.RecordDialog = function(options){
		return this.each(function(){
		
			$(this).click(function(){
				var d = new RecordDialog(options);
				d.display();
			});
		});
	};
	
	
	
})(jQuery);