<script type="text/javascript">

	$('.menu_item').fadeIn();
	
	$('.menu_item').click(function(){
		goto=$(this).attr('goto');
		title=$('.text_placer',this).text();
		menu_item_click(goto+'/'+sess_user_id,title);
	});
	
	$('.kebuka').click(function(){
		panjang=$('#start_menu').width();
		$('#start_menu').css('left',-(panjang-30));
		panjangdb=$('#dashboard_thing').width();
		$('#dashboard_thing').css('right',-(panjangdb-25));
		$('#blockout').fadeOut('fast');
		$('.scrolling_item').show();
		
		$('.loader_menu').show();
		$(this).hide();
	});
	$('.loader_menu').click(function(){
		$('.scrolling_item').hide();
		$('#blockout').fadeIn('fast');
		$('.kebuka').show();
		$(this).hide();
		$('#start_menu').css('left',20);
		$('#start_menu').animate({"left": "+=5px"});
		$('#dashboard_thing').css('right',20);
		$('#dashboard_thing').animate({"right": "+=5px"});
	});
	$('.loader_menu').hover(function(){
		$(this).animate({"left": "+=5px"});
	},function(){
		$(this).animate({"left": "-=5px"});
	});
	
	$('.kebuka').hover(function(){
		$(this).animate({"left": "-=5px"});
	},function(){
		$(this).animate({"left": "+=5px"});
	});
	
	$("#back_to_dashboard").click(function(){
			back_to_dashboard();
			
			
	});
	
	$('#price_list_manager').click(function(){
		
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/price_list_manager');?>');
	});
</script>
<div id="the_menu_all" class="innerbody" style="position:fixed;">
<img src="<?php echo base_url();?>assets/images/loader_menu.png" class="loader_menu" style="display:none;" />
<img src="<?php echo base_url();?>assets/images/kebuka.png" class="kebuka" style="display:none;" />
<h3 style="position:absolute;color:#FFF;margin-top:-20px;margin-left:2px;">Dashboard Menu - Build 0.7.4</h3>
    <div id="sub_start">
       
            <img src="<?php echo base_url();?>assets/images/back_to_dashboard.png" id="back_to_dashboard" />
            <img src="<?php echo base_url();?>assets/images/price_list_manager.png" id="price_list_manager" />
            <img src="<?php echo base_url();?>assets/images/reminder.png" title="Reminder" id="reminder_manager" /> 
            
    </div>
<?php if($this->session->userdata('user_type')==1): ?>
	<?php echo $this->global_model->menu_item('new_case.png','New Case',site_url('cso/new_case'));?>
    <?php echo $this->global_model->menu_item('collection.png','Collection',site_url('cso/collection'));?>          
    <?php echo $this->global_model->menu_item('consultation.png','Consultation',site_url('cso/consultation'));?>
    <?php echo $this->global_model->menu_item('part_sale.png','Part Sale',site_url('cso/part_by_me'));?>
    <?php echo $this->global_model->menu_item('today_statistic.png','Statistic',site_url('cso/today_statistic'));?>
<?php elseif($this->session->userdata('user_type')==2): ?>
	<?php echo $this->global_model->menu_item('update_case.png','Update Case',site_url('adminpanels/case_control/update_case/0'));?>
    <?php echo $this->global_model->menu_item('new_case.png','Assigning',site_url('adminpanels/case_control/case_today'));?>
    <?php echo $this->global_model->menu_item('marker.png','Unit Location',site_url('adminpanels/location_control/location_management'));?>
	<?php echo $this->global_model->menu_item('awaiting_part.png','RC Preparation',site_url('adminpanels/location_control/rc_preparation'));?>
    <?php echo $this->global_model->menu_item('resolving_today.png','Finish Case',site_url('adminpanels/case_control/resolving_today'));?>           
    <?php echo $this->global_model->menu_item('pending.png','Pending',site_url('adminpanels/case_control/pending_management'));?>
    <?php echo $this->global_model->menu_item('export_out.png','Export Data',site_url('adminpanels/report_control/export_case_out_data'));?>
    <?php echo $this->global_model->menu_item('custom_report.png','Reporting',site_url('adminpanels/report_control/custom_report'));?>
    <?php echo $this->global_model->menu_item('buy_part.png','Buy Purt',site_url('admin_panel/buy_purt'));?>
<?php elseif($this->session->userdata('user_type')==3): ?>
    <?php echo $this->global_model->menu_item('pending.png','Pending!',site_url('engineer/pending_management'));?>
<?php elseif($this->session->userdata('user_type')==4): ?>
	<?php echo $this->global_model->menu_item('part_out.png','Part for Case',site_url('wh_panel/part_out'));?>
    <?php echo $this->global_model->menu_item('part_sale.png','Part for Sale',site_url('wh_panel/part_sale'));?>
    <?php echo $this->global_model->menu_item('awaiting_part.png','Part In',site_url('wh_panel/part_in'));?>
    <?php echo $this->global_model->menu_item('consumed_part.png','Part Enquiry',site_url('wh_panel/consumed_part'));?>
    <?php echo $this->global_model->menu_item('marker.png','Unit Location',site_url('adminpanels/location_control/location_management'));?>
    <?php echo $this->global_model->menu_item('no_defective_part.png','Shipping',site_url('wh_panel/shipping'));?>
<?php elseif($this->session->userdata('user_type')==5): ?>
	<?php echo $this->global_model->menu_item('new_case.png','Assigning',site_url('adminpanels/case_control/case_today'));?>
	<?php echo $this->global_model->menu_item('update_case.png','Update Case',site_url('qc_panel/update_case'));?>
    <?php echo $this->global_model->menu_item('under_testing.png','Under Testing',site_url('qc_panel/under_testing_case'));?>
    <?php echo $this->global_model->menu_item('pending.png','Pending!',site_url('adminpanels/case_control/pending_management'));?>
<?php elseif($this->session->userdata('user_type')==0): ?>
	
<?php elseif($this->session->userdata('user_type')==6):?>
	<?php echo $this->global_model->menu_item('customer_in.png','Customer In',site_url('ta/customer_in'));?>            
    <?php echo $this->global_model->menu_item('cso_statistic.png','CSO Statistic',site_url('ta/cso_statistic'));?>
    
<?php endif;?>
<?php echo $this->global_model->menu_item('check_case.png','Search Case',site_url('program/check_case'));?>
<a href="<?php echo base_url();?>"><div class="menu_item" style="background:url(<?php echo base_url();?>assets/images/menu_bg_red.png) repeat-y;border:1px solid #C5365D;">
	<div class="image_placer"><img src="<?php echo base_url();?>assets/images/logout.png" /></div>
    <div class="text_placer">Logout</div>
</div></a>
</div>
