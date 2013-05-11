<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        var oTable =$('#awaiting_part_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
		
		$('.cancel_request').click(function(){
			pr_id=$(this).attr('idnya');
			$.post('<?php echo site_url('wh_panel/update_part_status');?>',
				{
					part_request_id:pr_id,
					request_status:9
				},
				function(data)
				{
					message_alert('Part Request Cancelled');
					$('.scrolling_item').load('<?php echo site_url('wh_panel/awaiting_part');?>');
				}
			);
		});
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_content">
            <table class="main_table" id="awaiting_part_table">
            	<thead>
                <tr><th>No</th><th>Code</th><th>Part Number</th><th>Bad SN</th><th>Bad OEM</th><th>CSS Ref</th><th>Case ID</th><th>Engineer</th><th>Aging</th><th>Case Status</th></tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($queryreq as $rowsreq): $i++; ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo 'G'.$rowsreq->part_request_id;?></td>
                    <td><?php echo $rowsreq->part_number;?></td>
                    <td><?php echo $rowsreq->bad_part_sn;?></td>
                    <td><?php echo $rowsreq->oem_part_sn;?></td>
                    <td><?php echo $rowsreq->css_ref;?></td>
                    <td><?php echo $rowsreq->case_id;?></td>
                    <td><?php echo $rowsreq->sure_name;?></td>
                    <td><?php echo number_format((time()-$rowsreq->request_date)/86400,2);?></td>
                    <td>
						<?php echo $this->global_model->get_case_status($rowsreq->case_status);?>
                        <?php if($rowsreq->case_status==12): ?>
                        | <a href="javascript:void(0);" class="cancel_request" idnya="<?php echo $rowsreq->part_request_id;?>" style="color:#000;">Cancel</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
		</div>
    </div>
</div>