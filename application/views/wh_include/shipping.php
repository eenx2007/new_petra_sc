<script type="text/javascript">
	$(document).ready(function(e) {
        $('.list_group').css('background-color','#019DC3');
		$('.print_transfer_note').click(function(){
			loc_id=$(this).attr('group_nya');
			s_note=$('#shipping_note_'+loc_id).val();
			$.post('<?php echo site_url('wh_panel/print_transfer_note');?>',
				{
					location_id:loc_id,
					shipping_note:s_note
				},
				function(data)
				{
					$('.scrolling_item').load('<?php echo site_url('wh_panel/shipping');?>');
				}
			);
		});
    });
</script>
<div class="innerbody2">
	
        	
			<?php
				$i=0;$group_loc=array();
			 	foreach($query as $rows): 
				$i++;	
				$group_loc[$i]=$rows->location_id;
			?>
            	<?php if($i==1): ?>
                <div class="dashboard_item">
                    <div class="dashboard_item_title" style="float:left;width:100%;">
                        <div style="width:30%;float:left;"><?php echo $rows->location_id;?> - <?php echo $rows->location_name;?></div>
                        
                    </div>
                    <div class="dashboard_item_content" style="clear:both;">
                	<table class="main_table">
            		<tr><th>Case ID</th><th>Unit Type</th><th>Serial Number</th><th>Problem</th><th>Transfer to</th></tr>
	            	<tr class="list_group"><td colspan="5"><button class="print_transfer_note" group_nya="<?php echo $rows->location_id;?>">Print Transfer Note</button> <input type="text" id="shipping_note_<?php echo $rows->location_id;?>"></td></tr>
                <?php else: ?>
                	<?php if($group_loc[$i]<>$group_loc[$i-1]): ?>
                    	</table>
						</div></div>
                        <br /><br />
                        <div class="dashboard_item">
                        <div class="dashboard_item_title" style="float:left;width:100%;">
                            <div style="width:30%;float:left;"><?php echo $rows->location_id;?> - <?php echo $rows->location_name;?></div>
                            
                        </div>
                        <div class="dashboard_item_content" style="clear:both;">
                    	<table class="main_table">
 			           	<tr><th>Case ID</th><th>Unit Type</th><th>Serial Number</th><th>Problem</th><th>Transfer to</th></tr>
                    	<tr class="list_group"><td colspan="5"><button class="print_transfer_note" group_nya="<?php echo $rows->location_id;?>">Print Transfer Note</button> <input type="text" id="shipping_note_<?php echo $rows->location_id;?>"></td></tr>
                    <?php endif;?>
				<?php endif;?>
                <tr>
                	<td><?php echo $rows->case_id;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->case_problem;?></td>
                    <td><?php echo $rows->location_id;?></td>
                </tr>
            	
            <?php endforeach;?>
			</table>  
        </div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        setTimeout(function(){
						generate_scroller();
			},500);
    });
</script>