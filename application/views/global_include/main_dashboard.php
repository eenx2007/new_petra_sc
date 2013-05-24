<script type="text/javascript">
	var new_message=0;
	var new_case_in_today=0;
	var new_case_out_today=0;
	var new_fd_activity=0;
	var last_modif_new_case=0;
	var last_modif_case_out=0;
	var last_modif_message=0;
	var last_modif_fd_act=0;
	if(sess_user_type==5)
	{
		var new_under_testing=0;
		var last_modif_under_testing='<?php echo filemtime('./db_cache/under_testing.txt');?>';
	}
	else if(sess_user_type==2)
	{
		var new_repair_complete=0;
		var last_modif_repair_complete='<?php echo filemtime('./db_cache/repair_complete.txt');?>';
	}
	function get_long_polling()
	{
		if(sess_user_type==5)
		{
			var_to_send=
				{
					under_testing:new_under_testing,
					last_modif_ut:last_modif_under_testing,
					total_message:new_message,
					user_id:sess_user_id,
					case_in:new_case_in_today,
					case_out:new_case_out_today,
					fd_activity:new_fd_activity,
					last_modif_msg:last_modif_message,
					last_modif_nc:last_modif_new_case,
					last_modif_co:last_modif_case_out,
					last_modif_fd:last_modif_fd_act,
					user_id:sess_user_id
				};
		}
		else if(sess_user_type==2)
		{
			var_to_send=
				{
					repair_complete:new_repair_complete,
					last_modif_rc:last_modif_repair_complete,
					total_message:new_message,
					user_id:sess_user_id,
					case_in:new_case_in_today,
					case_out:new_case_out_today,
					fd_activity:new_fd_activity,
					last_modif_msg:last_modif_message,
					last_modif_nc:last_modif_new_case,
					last_modif_co:last_modif_case_out,
					last_modif_fd:last_modif_fd_act,
					user_id:sess_user_id
				};
			
		}
		else
		{
			var_to_send=
				{
					total_message:new_message,
					user_id:sess_user_id,
					case_in:new_case_in_today,
					case_out:new_case_out_today,
					fd_activity:new_fd_activity,
					last_modif_msg:last_modif_message,
					last_modif_nc:last_modif_new_case,
					last_modif_co:last_modif_case_out,
					last_modif_fd:last_modif_fd_act,
					user_id:sess_user_id
				};
		}
		
		$.get('<?php echo site_url('ajax_serving/the_long_polling');?>',
			var_to_send,
			function(data)
			{
				if(data!=null)
				{
					
					if(data.last_modif_message!=null)
					{
						last_modif_message=data.last_modif_message;
						$('#web_chat_db .long_menu_full_text').html(data.total_unread+' unread message(s)');
						if(data.new_message!='')
							overscreen_alert(data.new_message,'<?php echo site_url('program/messaging_manager');?>','Open Message');
					}
					if(data.last_modif_new_case!=null)
					{
						last_modif_new_case=data.last_modif_new_case;
						new_case_in_today=data.new_total_cin;
						$('#case_in_menu_db .long_menu_full_text').html(new_case_in_today+' Case(s)');
							if(data.selisih_cin>0)
							{
								$.get('<?php echo site_url('program/get_case_by_limit');?>',
									{
										limit:data.selisih_cin	
									},
									function(data)
									{
										textnya=data;
										if(sess_user_type==2)
										{
											notification_alert_stop(textnya,'<?php echo site_url('adminpanels/case_control/case_today');?>','Case Today','Assign Case');
										}
										else
										{
											notification_alert(textnya);
										}
									}
								);
							}
					}
					if(data.last_modif_case_out!=null)
					{
						last_modif_case_out=data.last_modif_case_out;
						new_case_out_today=data.new_total_cout;
						$('#case_out_menu_db .long_menu_full_text').html(new_case_out_today+' Case(s)');
						notification_alert(data.selisih_cout+" new Case Out");	
					}
					if(data.last_modif_fd_act!=null)
					{
						last_modif_fd_act=data.last_modif_fd_act;
						new_fd_activity=data.new_total_fd;
						$('#fd_activity_db .long_menu_full_text').html(new_fd_activity+' activity');
						notification_alert(data.new_fd_act);
					}
					if(sess_user_type==5)
					{
						if(data.last_modif_under_testing!=null)
						{
							last_modif_under_testing=data.last_modif_under_testing;
							new_under_testing=data.new_total_ut;
							$('#under_testing_menu_db .long_menu_full_text').html(new_under_testing+' case(s)');
							overscreen_alert(data.new_ut_text,'<?php echo site_url('qcpanels/case_control/qc_repair_complete_db');?>','Check it');
						}
					}
					if(sess_user_type==2)
					{
						if(data.last_modif_repair_complete!=null)
						{
							last_modif_repair_complete=data.last_modif_repair_complete;
							new_repair_complete=data.new_repair_complete;
							$('#repair_complete_menu_db .long_menu_full_text').html(new_repair_complete+' case(s)');
							overscreen_alert(data.new_rc_text,'<?php echo site_url('adminpanels/case_control/repair_complete_db');?>','Check it');
						}
					}
				}
				get_long_polling();
			},
			'json'
		);
	}
	
	
	$(document).ready(function() {
		var detik=0;
		setInterval(function(){
			detik=detik+1;
			$('.detik_'+detik).toggle('fade',{},500);
			if(detik==12)
			{
				detik=0;	
			}
			if(sess_user_id==0)
			{
				alert('Please refresh the page, session expired');	
			}
		},1000);
		var new_engineer_statistic_today=0;
		get_long_polling();
		
		
		if(sess_user_type==2)
		{		
			var new_under_testing=0;
			var new_repair_complete=0;
			$('#repair_complete_menu_db').click(function(){
				$('.over_screen').html('').show();
				$('.over_screen').load('<?php echo site_url('adminpanels/case_control/repair_complete_db');?>');
			});
		}
		else if(sess_user_type==5)
		{
			var new_under_testing=0;
			$('#under_testing_menu_db').click(function(){
				$('.over_screen').html('').show();
				$('.over_screen').load('<?php echo site_url('qcpanels/case_control/qc_repair_complete_db');?>');
			});
		}
		else if(sess_user_type==0)
		{
			var new_under_testing=0;
			var new_repair_complete=0;
			$('#repair_complete_menu_db').click(function(){
				$('.over_screen').html('').show();
				$('.over_screen').load('<?php echo site_url('adminpanels/case_control/repair_complete_db');?>');
			});
			$('#under_testing_menu_db').click(function(){
				$('.over_screen').html('').show();
				$('.over_screen').load('<?php echo site_url('qcpanels/case_control/qc_repair_complete_db');?>');
			});
		}
			
			
		$('#case_in_menu_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/case_in_today');?>');
		});
		$('#case_out_menu_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/case_out_today');?>');
		});
		$('#fd_activity_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/cso_activity_today');?>');
		});
		
		$('#engineer_activity_menu_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/eng_statistic_today');?>');
		});
		$('#cso_productivity_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/cso_statistic_today');?>');
		});
		$('#web_chat_db').click(function(){
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('program/messaging_manager');?>');
		});
		
    });
		
</script>
<?php echo $this->global_model->long_menu_item('#04AEDA','web_chat_db','webchat.png','Message','No Message',rand(1,12));?>
<?php echo $this->global_model->long_menu_item('#04AEDA','case_in_menu_db','case_in_db.png','Case In','0 Case',rand(1,12));?>
<?php echo $this->global_model->long_menu_item('#FDD148','case_out_menu_db','case_out_db.png','Case Out','0 Case(s)',rand(1,12));?>
<?php echo $this->global_model->long_menu_item('#6B6B6B','engineer_activity_menu_db','engineer_activity_db.png','Engineer Productivity','Click to view all',rand(1,12));?>
<?php echo $this->global_model->long_menu_item('#23A8E0','cso_productivity_db','cso_productivity_db.png','CSO Productivity','Click to view all',rand(1,12));?>
<?php echo $this->global_model->long_menu_item('#7013A6','fd_activity_db','fd_activity_db.png','FD Activity','0 Activity(ies)',rand(1,12));?>
<?php if($this->session->userdata('user_type')==5): ?>
	<?php echo $this->global_model->long_menu_item('#D20808','under_testing_menu_db','under_testing_db.png','Under Testing Case','0 Case(s)',rand(1,12));?>
<?php elseif($this->session->userdata('user_type')==2): ?>
	<?php echo $this->global_model->long_menu_item('#30A0F0','repair_complete_menu_db','repair_complete_db.png','Case Testing Complete','0 Case(s)',rand(1,12));?>
<?php elseif($this->session->userdata('user_type')==0): ?>
	<?php echo $this->global_model->long_menu_item('#D20808','under_testing_menu_db','under_testing_db.png','Under Testing Case','0 Case(s)',rand(1,12));?>
    <?php echo $this->global_model->long_menu_item('#30A0F0','repair_complete_menu_db','repair_complete_db.png','Case Testing Complete','0 Case(s)',rand(1,12));?>
<?php endif;?>
<script type="text/javascript">
	$(document).ready(function(e) {
        setTimeout(function(){
						generate_scroller();
			},500);
    });
</script>