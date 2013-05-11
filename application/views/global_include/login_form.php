<script type="text/javascript">
	$(document).ready(function() {
		$('.main_dialog').hide();
		$('.menu_item').hover(
			function(){
				$('.image_placer',this).hide();
				$('.text_placer',this).css('font-size','14px').fadeIn('fast');
			},
			function(){
				$('.text_placer',this).hide();
				$('.image_placer',this).fadeIn('fast');
				
			}
		);
        $('#password').keypress(function(e){
			if(e.which==13)
			{
				u_id=$('#sure_name').attr('idnya');
				pwd=$('#password').val();
				$.post('<?php echo site_url('program/login_process');?>',
					{
						user_id:u_id,
						password:pwd	
					},
					function(data)
					{
						if(data.error=='no')
						{
							$('#super_menu').fadeIn();
							$('.bodyall').fadeIn();
							$('#dashboard_thing').load('<?php echo site_url('program/main_dashboard');?>');
							$('#dashboard_thing').show();
							$('.scrolling_item').html('');
							$('#sure_name_text').html(data.sure_name);
							$('#user_type_text').html(data.user_type_text);
							$('.toppane-right').fadeIn();
							$('#user_image_place').html('<img src="<?php echo base_url();?>assets/user_image/'+data.user_image+'">');
							$('#start_menu').load('<?php echo site_url('program/start_menu');?>');
							sess_user_id=data.user_id;
							sess_sure_name=data.sure_name;
							sess_user_type=data.user_type;
						}
						else
						{
							$('#password').val('');
							$('#password').css('border','1px solid red');	
						}
					},
					'json'
				);
			}
		});
		$('.menu_item').click(function(){
			$('.selected').addClass('notselected');
			$('.menu_item').removeClass('selected');
			$(this).addClass('selected');
			$(this).removeClass('notselected');
			$(this).fadeTo('fast',1);
			$('.notselected').fadeTo('fast',0.1);
			posisi=$(this).position();
			idnya=$(this).attr('idnya');
			$.post('<?php echo site_url('program/user_select');?>',
				{
					user_id:idnya	
				},
				function(data)
				{
					$('.main_dialog').css('left',posisi.left+125);
					$('.main_dialog').css('top',posisi.top+100);
					$('.main_dialog').show().animate({"left": "+=25px"});
					
					$('#password').focus();
					
					$('#sure_name').text(data.sure_name);
					$('#sure_name').attr('idnya',data.user_id);
					$('#user_type').text(data.user_type);
					$('#user_image').attr('src',data.user_image);
				},
				'json'
			);
				
		});
    });
</script>
<div class="innerbody2" style="margin:auto;text-align:center">
<div class="innerbody" id="user_select_place" style="margin:auto;float:none;">
	
	<?php
		$queryuser=$this->global_model->get_all_user();
		foreach($queryuser as $rowsuser): ?>
            <div class="menu_item notselected" idnya="<?php echo $rowsuser->user_id;?>">
                <div class="image_placer" style="padding-top:26px;position:static;margin:0;padding-top:26px;;"><img src="<?php echo base_url();?>assets/user_image/<?php echo $rowsuser->user_image;?>" /></div>
                <div class="text_placer" style="display:none;margin-top:10px;position:static;"><?php echo $rowsuser->sure_name;?></div>
            </div>
    <?php endforeach;?>
    
    
</div>
</div>

	<div class="main_dialog" style="position:fixed;">
        <table class="main_table" style="width:250px;">
        	
            <tr><td><span id="sure_name" idnya="" style="font-size:14px;"></span><br />
            		<span id="user_type"></span></td></tr>
            <tr><td><input type="password" id="password" name="password" style="width:100%;" /></td></tr>
            
        </table>
    </div>

