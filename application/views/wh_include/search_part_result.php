<script type="text/javascript">
	$(document).ready(function(){
		var availableTags = [
			<?php echo $part_numbernya;?>
		];
		$('.part_released').autocomplete({
			source: availableTags
		});
		
		$('.give_part').click(function(){
			pr_id=$(this).attr('idnya');
			p_released=$('#part_released_'+pr_id).val();
			g_sn=$('#good_part_sn_'+pr_id).val();
			c_id=$('#case_id').val();
			$.post('<?php echo site_url('wh_panel/release_part');?>',
				{
					part_request_id:pr_id,
					part_released:p_released,
					good_part_sn:g_sn,
					case_id:c_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert_stop('New Part Request ID is G'+pr_id);
					$('#search_result').load('<?php echo site_url('wh_panel/search_part');?>/'+c_id);
					$('#need_to_be_issued').load('<?php echo site_url('wh_panel/need_to_be_issued');?>');
				}
			);
		});
		
		$('#save_all').click(function(){
			$('.give_part').each(function(index, element) {
                pr_id=$(this).attr('idnya');
				p_released=$('#part_released_'+pr_id).val();
				g_sn=$('#good_part_sn_'+pr_id).val();
				c_id=$('#case_id').val();
				$.post('<?php echo site_url('wh_panel/release_part');?>',
					{
						part_request_id:pr_id,
						part_released:p_released,
						good_part_sn:g_sn,
						case_id:c_id
					},
					function(data)
					{
						message_alert('New Part Request ID is G'+pr_id);
						$('#search_result').load('<?php echo site_url('wh_panel/search_part');?>/'+c_id);
						$('#need_to_be_issued').load('<?php echo site_url('wh_panel/need_to_be_issued');?>');
					}
				);
            });
		});
	});
</script>

<table class="main_table">
	<tr><th>No.</th><th>Part Requested</th><th>Part Out</th><th>Good SN</th></tr>
	<?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
        	<td><?php echo $rows->part_number;?></td>
            <td><input type="text" name="part_released" id="part_released_<?php echo $rows->part_request_id;?>" class="part_released" /></td>
            <td><input type="text" name="good_part_sn" id="good_part_sn_<?php echo $rows->part_request_id;?>" /></td>
            <td><button class="give_part" idnya="<?php echo $rows->part_request_id;?>">Save</button></td>
        </tr>
    <?php endforeach;?>
    <tr><td colspan="2"><button id="save_all">Save All</button></td></tr>
</table>