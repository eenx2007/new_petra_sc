<script type="text/javascript">
	$(document).ready(function(e) {
        $('.list_group').css('background-color','#019DC3');
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title" style="float:left;width:100%;">
        	<div style="width:30%;float:left;">Need to Transfer</div>
            
        </div>
        <div class="dashboard_item_content" style="clear:both;">
        	<table class="main_table">
            	<tr><th>Case ID</th><th>Unit Type</th><th>Serial Number</th><th>Problem</th><th>Transfer to</th></tr>
			<?php
				$i=0;$group_loc=array();
			 	foreach($query as $rows): 
				$i++;	
				$group_loc[$i]=$rows->location_id;
			?>
            	<?php if($i==1): ?>
	            	<tr class="list_group"><td colspan="5"><?php echo $rows->location_id;?> - <?php echo $rows->location_name;?></td></tr>
                <?php else: ?>
                	<?php if($group_loc[$i]<>$group_loc[$i-1]): ?>
                    	<tr class="list_group"><td colspan="5"><?php echo $rows->location_id;?> - <?php echo $rows->location_name;?></td></tr>
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