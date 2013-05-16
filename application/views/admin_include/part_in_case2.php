<script type="text/javascript">
	$(document).ready(function(){
		$('.bad_ok_update').click(function(){
			c_id=$('#case_id').val();
			idnya=$(this).attr('idnya');
			p_idnya=$('#proposal_id_hidden').val();
			updatenya=3;
			$.post('<?php echo site_url('adminpanels/part_control/update_part_status');?>',
				{
					part_request_id:idnya,
					request_status:updatenya,
					proposal_id:p_idnya
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case2');?>/'+c_id);
					$('#detail_proposal_update').load('<?php echo site_url('adminpanels/proposal_control/det_proposal_update');?>/'+p_idnya);
				}
			);
		});
		$('.no_defective').click(function(){
			c_id=$('#case_id').val();
			idnya=$(this).attr('idnya');
			updatenya=7;
			$.post('<?php echo site_url('adminpanels/part_control/update_part_status');?>',
				{
					part_request_id:idnya,
					request_status:updatenya	
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case2');?>/'+c_id);
				}
			);
		});
	});
</script>
<table class="main_table">
	<tr><th>No.</th><th>Part Number</th><th>Status</th><th>Reff</th></tr>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->part_released;?></td>
           
            <td>
            	<?php if($rows->request_status==6): ?>
            	<a href="javascript:void(0);" class="bad_ok_update" idnya="<?php echo $rows->part_request_id;?>">Add to Proposal</a></td>
                <?php else: ?>
                	<?php echo $this->global_model->get_request_status($rows->request_status);?>
                <?php endif;?>
            <td><?php echo $rows->css_ref;?></td>
            
        </tr>
    <?php endforeach;?>
    
</table>