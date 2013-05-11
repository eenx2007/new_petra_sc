// JavaScript Document
	jQuery.fn.center = function () {
		this.css("position","fixed");
		this.css("top", (($(window).height() - this.outerHeight()) / 2) + 
													$(window).scrollTop() + "px");
		this.css("left", (($(window).width() - this.outerWidth()) / 2) + 
													$(window).scrollLeft() + "px");
		return this;
	}
	
	jQuery.fn.centerparent = function () {
		this.css("position","fixed");
		bapak=$(this).parent();
		this.css("top", (($(bapak).height() - this.outerHeight()) / 2) + 
													$(bapak).scrollTop() + "px");
		this.css("left", (($(bapak).width() - this.outerWidth()) / 2) + 
													$(bapak).scrollLeft() + "px");
		return this;
	}
	
	$.ctrl = function(key, callback, args) {
		$(document).keydown(function(e) {
			if(!args) args=[]; // IE barks when args is null
			if(e.keyCode == key.charCodeAt(0) && e.ctrlKey) {
				callback.apply(this, args);
				return false;
			}
		});
	};

	function generate_scroller()
	{
		selisih=$('.scrolling_item').height()-$('.bodyall').height();
		if(selisih>0)
		{
			$('.scroll_pane').show();
			$('.the_scroller').css('top',posisiawalsc);
			panjangsc=($('.bodyall').height()*$('.scroll_pane').height())/$('.scrolling_item').height();
			if(panjangsc<15) panjangsc=15;
			$('.the_scroller').height(Math.round(panjangsc));
			console.log(panjangsc);
		}
		else{
			$('.scroll_pane').hide();	
		}
		
	}
	
	function menu_item_click(goto,title)
	{
		$('.loader_menu').show();
		$('.kebuka').hide();
		
		panjangdb=$('#dashboard_thing').width();
		$('#dashboard_thing').css('right',-(panjangdb));
		$('#blockout').fadeOut('fast');
		$('.scrolling_item').show();
		panjang=$('#start_menu').width();
		$('#start_menu').css('left',-(panjang-30));
		$('#program_title').css('left',-25);
		$('#program_title').show().animate({"left": "+=25px"});
		$('#program_title').html(title);
		$('.scrolling_item').html('');
		$('.scrolling_item').load(goto);
		$('.bodyall').fadeTo('fast',1);	
	}
	
	function back_to_dashboard()
	{
		if(perulangan!="nothing")
			clearTimeout(perulangan);
		$('.scrolling_item').html('');
		$('#program_title').html('');
		$('.kebuka').hide();
		
		$('.loader_menu').hide();
		$('#sub_start').removeClass('kekanan');
		$('#blockout').fadeOut('fast');
		$('#start_menu').css('left',0);
		$('#start_menu').animate({"left": "+=25px"});
		$('#dashboard_thing').css('right',0);
		$('#dashboard_thing').animate({"right": "+=25px"});
		$('.scrolling_item').html('');	
	}
	
	function message_alert(textalert)
	{
		noty({"text":textalert,"theme":"noty_theme_twitter","layout":"top","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":5000,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
	}
	
	function message_alert_stop(textalert)
	{
		noty({"text":textalert,"theme":"noty_theme_twitter","layout":"top","type":"alert","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":500,"timeout":false,"closeButton":false,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
	}
	
	function notification_alert(textnotif)
	{
		noty({"text":textnotif,"theme":"noty_theme_twitter","layout":"bottomLeft","type":"information","animateOpen":{"height":"toggle"},"animateClose":{"height":"toggle"},"speed":300,"timeout":5000,"closeButton":true,"closeOnSelfClick":true,"closeOnSelfOver":false,"modal":false});
	}
	
	function notification_alert_stop(textnotif,goto,titlegoto,buttontext)
	{
		noty(
		{
			
			buttons: [
			  {type: 'button green', text: buttontext, click: function($noty) {
					$noty.close();
					menu_item_click(goto,titlegoto);
					}
			  }
			  ],
			  "timeout":false,
			

			"text":textnotif,
			"theme":"noty_theme_twitter",
			"layout":"bottomLeft",
			"type":"information",
			"animateOpen":{"height":"toggle"},
			"animateClose":{"height":"toggle"},
			"speed":300,
			
			"closeButton":true,
			"closeOnSelfClick":true,
			"closeOnSelfOver":false,
			"modal":false
			
		});
	}
	
	function overscreen_alert(textnotif,goto,buttontext)
	{
		noty(
		{
			
			buttons: [
			  {type: 'button green', text: buttontext, click: function($noty) {
					$noty.close();
					$('.over_screen').show();
					$('.over_screen').load(goto);
					}
			  }
			  ],
			  "timeout":false,
			

			"text":textnotif,
			"theme":"noty_theme_twitter",
			"layout":"bottomLeft",
			"type":"information",
			"animateOpen":{"height":"toggle"},
			"animateClose":{"height":"toggle"},
			"speed":300,
			
			"closeButton":true,
			"closeOnSelfClick":true,
			"closeOnSelfOver":false,
			"modal":false
			
		});
	}
	
	