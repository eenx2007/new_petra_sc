<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Center System for Petra V.1</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/reset.css"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/ui-lightness/jquery.ui.all.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/ui-lightness/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/ui/ui-lightness/jquery.ui.core.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/datatables/media/css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/the_style.css?time=<?php echo time();?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/notycss/noty_theme_twitter.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery/notycss/jquery.noty.css"/>


<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-2.0.0.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.noty.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery-ui.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.effect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.effect-fade.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.resizable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/ui/jquery.ui.autocomplete.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery.mousewheel-2.0.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/function_group.js"></script>
</head>

<body>
<script type="text/javascript">
	//global session variable
	var sess_user_id;
	var sess_sure_name;
	var sess_user_type;

	var perulangan1="nothing";
	var perulangan="nothing";
	var panjangsc=0;
	var posisiawalsc=0;
	var lompatan=1;
	var totalnya=0;
	var totalnyabaru=0;
	var	tinggi=$(window).height();
	
	var	lebar=$(window).width();
	
	$(document).ready(function(){
		$('.over_screen').hide();
		$('#blockout').width(lebar);
		$('#blockout').height(tinggi);
		$('#dashboard_thing').hide();
		$('.bodyall').height(tinggi-85);
		$('.bodyall').width(lebar-50);
		$('.bodyall').css('top',85);
		$('.bodyall').css('left',25);
		$('#start_menu').css('top',82);
		$('#start_menu').css('left',25);
		$('.over_screen').height(tinggi-98);
		$('.over_screen').width(lebar-56);
		$('.over_screen').css('top',85);
		$('.over_screen').css('left',25);
		$('#dashboard_thing').height(tinggi-85);
		$('#dashboard_thing').css('right',25);
		$('#dashboard_thing').css('top',85);
		$('.toppane').width(lebar-50);
		$('.toppane').height(50);
		$('.toppane').css('top',25);
		$('.toppane').css('left',25);
		
		lebar_menu=$('.bodyall').width()/8;
		tinggi_menu=$('.bodyall').height()/5;
		$('.the_scroller').draggable({ axis: 'y',containment: 'parent',
			 drag: function(event, ui) { 
				posisinya=$('.scrolling_item').position();
				tinggisp=$('.scroll_pane').height();
				lompatan=Math.round(tinggisp-panjangsc);
				geser=$(this).position().top*($('.scrolling_item').height()-$('.bodyall').height())/lompatan
				$('.bodyall').scrollTop(geser);
			  }
		});
		
		var geser=0;
		$('.bodyall').on('mousewheel',function(event,delta){
			
			posisinya=$('.scrolling_item').position();
			tinggisp=$('.scroll_pane').height();
			lompatan=Math.round(tinggisp-panjangsc);
			posisinya=$('.the_scroller').position();
			if (delta<0)
			{
				if(posisinya.top<(tinggisp-$('.the_scroller').height()))
				{
					$('.the_scroller').css('top',posisinya.top+5);
					geser=(posisinya.top+20)*($('.scrolling_item').height()-$('.bodyall').height())/lompatan;
				}
				else
				{
					$('.the_scroller').css('top',tinggisp-$('.the_scroller').height());
					geser=(tinggisp-$('.the_scroller').height())*($('.scrolling_item').height()-$('.bodyall').height())/lompatan;
				}
			}
			else if(delta>0)
			{
				if(posisinya.top>0)
				{
					$('.the_scroller').css('top',posisinya.top-5);
					geser=(posisinya.top-20)*($('.scrolling_item').height()-$('.bodyall').height())/lompatan;
				}
				else
				{
					$('.the_scroller').css('top',0);
					geser=0;
				}
			}
			nilai=tinggisp-$('.the_scroller').height()
				
				$('.bodyall').scrollTop(geser);
			
		});
		
			$(window).resize(function(){
				tinggi=$(window).height();
				lebar=$(window).width();
				$('.bodyall').height(tinggi-100);
				$('.bodyall').width(lebar-50);
				$('.bodyall').css('top',75);
				$('.bodyall').css('left',25);
				
				$('.toppane').width(lebar-50);
				$('.toppane').height(50);
				$('.toppane').css('top',25);
				$('.toppane').css('left',25);
			});
		
		$('.scroll_pane').height($('.bodyall').height());
		$('.scroll_pane').hover(function(){
			$(this).fadeTo('fast',0.8);	
			},
			function(){
			$(this).fadeTo('fast',0);	
			}
		);
		$('.scrolling_item').load('<?php echo site_url('program/login_form');?>');
		
		$('#super_menu').hover(
			function(){
				$(this).animate({"left": "+=185px"});
			},
			function(){
				$(this).animate({"left": "-=185px"});
			}
		);
		$.ctrl('Z',function(){
			back_to_dashboard();
		});
		
		setInterval(function(){
			currentDate = new Date();
			jam=currentDate.getHours();
			menit=currentDate.getMinutes();
			detik=currentDate.getSeconds();
			if(menit<10)
				menit="0"+menit;
			if(detik<10)
				detik="0"+detik;
			$('#jam_utama').html(jam+':'+menit+':'+detik);
			
		},1000);
		
		$(document).ajaxStart(function() {
            $('#ajax_loader').fadeIn('slow');
        });
		$(document).ajaxStop(function() {
            $('#ajax_loader').fadeOut('slow');
        });
	});
	window.onbeforeunload = function() {
        return "Are you sure want to logout ?";
    }
</script>
</body>
	<div class="toppane">
    	<div class="toppane-left">
	    	<h3 id="program_title" style="position:absolute;"></h3>
        </div>
        <div class="toppane-right" style="display:none;">
        		
                <div style="float:right;width:50px;" id="user_image_place">
                	
                </div>
                <div style="float:right;width:200px;margin-right:15px;">
        	   		<span id="sure_name_text" style="font-size:15px;font-weight:bold;"></span> <br /> <span id="user_type_text"></span> | <span id="jam_utama"></span>
                </div>
        </div>
    </div>
	<div class="bodyall">
    	<div class="scrolling_item">
           
        </div>
    </div>
    <div id="dashboard_thing" class="innerbody" style="width:420px;">
    
    </div>
    <div class="scroll_pane">
      	<div class="the_scroller">
            
        </div>
    </div>
    
    <div class="over_screen"></div>
    <div id="ajax_loader" style="color:#FFF;position:fixed;bottom:20px;right:20px;opacity:0.6;">
    	Build 0.7.4 last update 
		<?php 
			$directory = dirname(__FILE__);
			$dir_last_modified_time = $this->global_model->dirmtime($directory);
			echo date('d M Y h:i:s', $dir_last_modified_time); 
		?>
    </div>
    <div class="innerbody" id="start_menu" style="position:fixed;z-index:10001;">
		
	</div>
    <div id="blockout"></div>
</html>