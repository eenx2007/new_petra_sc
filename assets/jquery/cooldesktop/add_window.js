// JavaScript Document
(function( $ ){
	
	$.fn.add_window = function( options ) {
		
		var settings={
			'sdg_aktif' : '#content_slider',
			'window_id' : 'new_window_id',
			'window_title' : 'New Window Title',
			'icon' : 'New Icon',
			'status_dashboard' :  true,
			'toload' : ''
		};
		
		return this.each(function(){
			if(options){
				$.extend( settings, options);	
			}
		});
		
		function add_window(sdg_aktif,title,window_titles,icon,toload)
		{
			if(dashboard_aktif==true)
			{	
				$('#dashboard').fadeOut();
				$('#content_slider').fadeIn();
				dashboard_aktif=false;
			}
			var posisi=$('#content_slider').position();
			var item=$('<div class="a_window" id="'+title+'"></div>').hide().height(tinggi_content-19).width(lebar-16).animate({left:0});
			var window_title=$('<div class="window_title"><span class="the_window_title">'+window_titles+'</span> <img src="<?php echo base_url();?>assets/styles/images/close.png" class="close_window"> <img src="<?php echo base_url();?>assets/styles/images/maximize.png" class="maximize_window"></div>');
			var window_content=$('<div class="window_content"></div>').height($(item).height()-40);
			$(window_content).load(toload);
			$(item).append(window_title);
			$(item).append(window_content);
			var judul=$(this).attr('title')
			$('#content_slider').append(item);
			$('.a_window').css('z-index','93');
			$(item).css('z-index','99');
			$(item).show('fade','fast');
			aktif_window=$(item);
			$('#content_slider').animate({left:0});
			$('#wrapper_background').animate({left:0})
			
		}
	};
})(jQuery);