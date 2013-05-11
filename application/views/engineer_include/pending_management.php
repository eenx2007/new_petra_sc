<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#pending_eng_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true,
				"aaSorting": [[ 2, "desc" ]]
			}
		);
		$('.to_update_case').click(function(){
			c_id=$(this).attr('case_idnya');
			menu_item_click('<?php echo site_url('engineer/update_case');?>/'+c_id+'/'+sess_user_id,'Update Case');
		});
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
        <div class="dashboard_item_content">
        	<table class="main_table" id="pending_eng_table">
            	<thead>
            	<tr>
                    <th>Case ID</th>
                    
                    <th>CSO</th>
                    <th>Aging</th>
                    
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Problem</th>
                    <th>Name / Phone</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <?php if($rows->case_status<>11): ?>
                <tr>
                    <td><a href="javascript:void(0);" case_idnya="<?php echo $rows->case_id;?>" class="to_update_case" style="color:#240079;"><?php echo $rows->case_id;?></a></td>
                    
                    <td><?php echo $rows->sure_name;?></td>
                    
                    <td><?php echo number_format((time()-$rows->create_date)/86400,0);?>
                    	<?php 
							$sekarang=time();
							$dibuat=$rows->create_date;
							$totalaging=($sekarang-$dibuat)/86400;
							 if($totalaging>=5)
							 	echo ' <span style="color:red;">- Warning!</span>';
						?>
                    </td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><span style="color:red;font-weight:bold;"><?php echo $rows->case_problem;?></span></td>
                    <td><?php echo $rows->customer_name;?> / <?php echo $rows->customer_phone;?></td>
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