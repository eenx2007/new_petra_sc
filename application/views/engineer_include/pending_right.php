<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#pending_right_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
		$('.to_update_case').click(function(){
			c_id=$(this).attr('case_idnya');
			menu_item_click('<?php echo site_url('engineers/case_control/update_case');?>/'+c_id,'Update Case');
		});
		
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
        <div class="dashboard_item_content">
        	<table class="main_table" id="pending_right_table">
            	<thead>
            	<tr>
                    <th>Case ID</th>
                    
                    <th>Aging</th>
                    
                    <th>Case Type</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <?php if($rows->case_status<>11): ?>
                <tr>
                    <td><a href="javascript:void(0);" case_idnya="<?php echo $rows->case_id;?>" class="to_update_case" style="color:#240079;"><?php echo $rows->case_id;?></a></td>
                   
                   
                    <td><?php echo number_format((time()-$rows->create_date)/86400,2);?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    
                    <td><?php echo $this->global_model->get_case_status($rows->case_status);?></td>
                </tr>
                <?php endif;?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
	setTimeout(function(){
						generate_scroller();
			},500);
</script>