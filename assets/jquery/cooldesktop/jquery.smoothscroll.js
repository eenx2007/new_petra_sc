// JavaScript Document

(function($){
	$.fn.smoothscroll = function(options){
		
		var settings = {
			'scrollstep' : 40
		};
		var startscroll=0;
		var stopscroll=0;

		return this.each(function(){
			if ( options ) { 
        		$.extend( settings, options );
      		}

			var $t=$(this);
			$t.mousewheel(function(event, delta) {
				posisi=$(this).scrollTop();
				$(this).scrollTop(posisi-(delta*settings.scrollstep));
			});
			
			$t.mousedown(function(e){
				startscroll=e.pageY;
				posisi=$(this).scrollTop();
				
				$(this).mousemove(function(e){
					stopscroll=e.pageY;
					selisih=stopscroll-startscroll;
						
					$(this).scrollTop(posisi-selisih);
				});
			});
			$t.mouseup(function(e){
				stopscroll=e.pageY;
				posisi=$(this).scrollTop();
				tinggi_ini=$(this).height();
				if(startscroll>stopscroll)
				{
					selisih=startscroll-stopscroll;
					if(selisih>(tinggi_ini/2))
						$(this).animate({scrollTop:posisi+selisih});
				}
				else(startscroll<stopscroll)
				{
					selisih=stopscroll-startscroll;
					if(selisih>(tinggi_ini/2))
						$(this).animate({scrollTop:posisi-selisih});
				}
				$(this).unbind('mousemove');
			});
		});
	};
})( jQuery );