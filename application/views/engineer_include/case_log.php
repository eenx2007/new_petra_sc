<script type="text/javascript">
	
			$('.log_place').width($('.tabbed_area').width()-40);
			$('.info_log').width($('.log_place').width()-98);
			if($('.log_place').width()==0)
				$('.log_place').width($('.over_screen').width());
			
			

		
</script>
<ul class="log_info_place">
	<?php foreach($query as $rows): ?>
    	<li>
            <div class="log_place">
                <div class="foto_log"><img src="<?php echo base_url();?>assets/user_image/<?php echo $rows->user_image;?>" width="48" /></div>
                <div class="info_log"><strong><?php echo $rows->sure_name;?></strong> | <span class="small"><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->case_log_date);?></span><br>
                    <?php echo $rows->case_log_activity;?>
                </div>
                <div style="clear:both"></div>
            </div>
        </li>
    <?php endforeach;?>
</ul>

