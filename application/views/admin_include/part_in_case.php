<script type="text/javascript">
	$(document).ready(function(){
		$('#save_all_update_ref').click(function(){
			c_id=$('#case_id').val();
			$('.css_ref_update_form').each(function(){
				rp_id=$(this).attr('idnya');
				ref_number=$(this).val();
				$.post('<?php echo site_url('adminpanels/part_control/update_ref');?>',
					{
						part_request_id:rp_id,
						css_ref:ref_number,
						case_id:c_id,
						user_id:sess_user_id
					},
					function(data)
					{
						$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case');?>/'+c_id);
					}
				);
            });
		});
		$('.update_request_this').click(function(){
			rp_id=$(this).attr('idnya');
			ref_number=$('#ref_num_' + rp_id).val();
			$.post('<?php echo site_url('adminpanels/part_control/update_ref');?>',
				{
					part_request_id:rp_id,
					css_ref:ref_number,
					case_id:c_id,
					user_id:sess_user_id
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case');?>/'+c_id);
				}
			);
		});
		$('.remove_request').click(function(){
			pr_id=$(this).attr('idnya');
			c_id=$('#case_id').val();
			var answer = confirm('Delete it?');
			if (answer)
			{
			 	$.post('<?php echo site_url('adminpanels/part_control/delete_request');?>',
			  		{
						part_request_id:pr_id
					},
					function(data)
					{
			  			$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case');?>/'+c_id);
					}
			   	);
			}
		});
		
		$('#create_proposal').click(function(){
			c_id=$('#case_id').val();
			$('.over_screen').html('<img src="<?php echo base_url();?>assets/images/please_wait.png" />').show();
			$('.over_screen').load('<?php echo site_url('adminpanels/proposal_control/create_proposal');?>/'+c_id);
		});
	});
</script>
<table class="main_table">
	<tr><th>No Order</th><th>Part Dipesan</th><th>Reason</th><th>QTY</th><th>Status</th><th>Log Info</th><th>Hapus/Ubah</th></tr>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td>P-<?php echo $rows->part_request_id;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo $rows->bad_part_sn;?></td>
            <td><?php echo $rows->oem_part_sn;?></td>
            <td><?php echo $this->global_model->get_request_status($rows->request_status);?></td>
            <td>
            	<?php if($rows->request_status==0): ?>
                	<input type="text" name="css_ref_update" idnya="<?php echo $rows->part_request_id;?>" id="ref_num_<?php echo $rows->part_request_id;?>" class="css_ref_update_form" />
                <?php else: ?>
                	<?php echo $rows->css_ref;?>
                <?php endif;?>
            </td>
            <td>
            	<?php if($rows->request_status==0): ?>
                	<button class="update_request_this" idnya="<?php echo $rows->part_request_id;?>">OK</button>
	            	<button class="remove_request" idnya="<?php echo $rows->part_request_id;?>">X</button>
                <?php endif;?>
            </td>
        </tr>
    <?php endforeach;?>
    <tr><td colspan="6"><button id="save_all_update_ref">Update All</button> </td></tr>
</table>