<script type="text/javascript">
	$(document).ready(function(e) {
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
			p_id=$('#proposal_id').val();
			$.post('<?php echo site_url('whpanels/part_control/release_part_inv');?>',
				{
					part_request_id:pr_id,
					part_released:p_released,
					good_part_sn:g_sn,
					proposal_id:p_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert_stop('New Part Request ID is G'+pr_id);
					$('#search_result').load('<?php echo site_url('whpanels/part_control/search_inv');?>/'+p_id);
					$('#need_to_be_issued').load('<?php echo site_url('whpanels/part_control/issued_to_fd');?>');
				}
			);
		});
    });
</script>
<table class="main_table">
	<tr><td>Part Request</td><td>Part Num Released</td><td>Part SN</td></tr>
    <?php foreach($query as $rows): ?>
    	<td><?php echo $rows->part_number;?></td>
            <td><input type="text" name="part_released" id="part_released_<?php echo $rows->part_request_id;?>" class="part_released" /></td>
            <td><input type="text" name="good_part_sn" id="good_part_sn_<?php echo $rows->part_request_id;?>" /></td>
            <td><button class="give_part" idnya="<?php echo $rows->part_request_id;?>">Save</button></td>
    <?php endforeach;?>
</table>