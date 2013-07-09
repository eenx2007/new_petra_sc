<script type="text/javascript">
	$(document).ready(function(){
		$('.ok_use').click(function(){
			pr_id=$(this).attr('idnya');
			c_id=$('#case_id_text').val();
			u_to=6;
			$.post('<?php echo site_url('engineers/part_control/update_part_request');?>',
				{
					part_request_id:pr_id,
					update_to:u_to					
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
				}
			);
		});
		
		$('.doa_use').click(function(){
			pr_id=$(this).attr('idnya');
			c_id=$('#case_id_text').val();
			u_to=4;
			$.post('<?php echo site_url('engineers/part_control/update_part_request');?>',
				{
					part_request_id:pr_id,
					update_to:u_to					
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
				}
			);
		});
		
		$('.wpib_use').click(function(){
			pr_id=$(this).attr('idnya');
			c_id=$('#case_id_text').val();
			p_n=$(this).attr('pnnya');
			u_to=5;
			$.post('<?php echo site_url('engineers/part_control/update_part_request');?>',
				{
					part_request_id:pr_id,
					update_to:u_to,
					part_number:p_n			
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
				}
			);
		});
		
		$('.unused_use').click(function(){
			pr_id=$(this).attr('idnya');
			c_id=$('#case_id_text').val();
			p_n=$(this).attr('pnnya');
			u_to=8;
			$.post('<?php echo site_url('engineers/part_control/update_part_request');?>',
				{
					part_request_id:pr_id,
					update_to:u_to,
					part_number:p_n			
				},
				function(data)
				{
					$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
				}
			);
		});
	});
</script>
<table class="main_table">
    <tr><th>No.</th><th>Part Number</th><th>SN</th><th>OEM SN</th><th>Status</th></tr>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo $rows->bad_part_sn;?></td>
            <td><?php echo $rows->oem_part_sn;?></td>
            <td>
				<?php echo $this->global_model->get_request_status($rows->request_status);?>
            	<?php if($rows->request_status==2): ?>
                	| <a href="javascript:void(0);" class="ok_use" idnya="<?php echo $rows->part_request_id;?>">OK</a> | 
                    <a href="javascript:void(0);" class="doa_use" idnya="<?php echo $rows->part_request_id;?>">DOA</a> | 
                    <a href="javascript:void(0);" class="wpib_use" idnya="<?php echo $rows->part_request_id;?>" pnnya="<?php echo $rows->part_released;?>">WPIB</a> |
                    <a href="javascript:void(0);" class="unused_use" idnya="<?php echo $rows->part_request_id;?>" pnnya="<?php echo $rows->part_released;?>">Unused</a>
                <?php endif;?>
            </td>
            
        </tr>
    <?php endforeach;?>
</table>