<script type="text/javascript">
	$(document).ready(function(){
		$('.log_place').width($('.content_tab').width()-20);
        $('.info_log').width($('.log_place').width()-130);
		
		$('.done_log').click(function(){
			log_id=$(this).attr('idnya');
			var answer = confirm('Are you sure you have done with this item?');
			if (answer)
			{
			 	$.post('<?php echo site_url('admin_panel/log_follow_up');?>',
			  		{
						case_log_id:log_id
					},
					function(data)
					{
			  			$('#log_'+log_id).fadeOut();
					}
			   	);
			}
			
		});
	});
</script>
<ul class="log_info_place">
<?php foreach($query as $rows): ?>
	<li id="log_<?php echo $rows->case_log_id;?>">
    	<div class="log_place">
            <div class="foto_log"><img src="<?php echo base_url();?>assets/user_image/<?php echo $rows->user_image;?>" /></div>
            <div class="info_log"><strong><?php echo $rows->sure_name;?></strong> | <span class="small"><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->case_log_date);?></span><br>
				<?php echo $rows->case_id;?><br />
				<?php echo $rows->case_log_activity;?><br />
                
            </div>
            <div class="done_palce" style="float:left;width:42px;">
            	<button class="done_log" idnya="<?php echo $rows->case_log_id;?>">Selesai!</button>
            </div>
            <div style="clear:both"></div>
        </div>
    </li>
<?php endforeach;?>
</ul>