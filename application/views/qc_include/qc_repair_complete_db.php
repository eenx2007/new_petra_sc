<script type="text/javascript">
	$(document).ready(function() {
        $('.update_case').click(function(){
			c_id=$(this).attr('idnya');

			menu_item_click('<?php echo site_url('qcpanels/case_control/update_case');?>/'+c_id,'Update Case');
			$('.over_screen').hide();
		});
		
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
		var oTable =$('#under_testing_table_db').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
		
		$('#close_window').click(function(){
			$('.over_screen').html('');
			$('.over_screen').hide();
		});
    });
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">List of Under Testing Case</div>
<div class="over_screen_content">
<table class="main_table" id="under_testing_table_db"> 
	<thead>
    <tr><th>No</th><th>Case ID</th><th>Serial Number</th><th>Engineer</th><th>Unit Type</th><th>Case Type</th><th>Aging</th><th>TAT</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><a href="javascript:void(0);" class="update_case" style="color:#000;" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></a></td>
            <td><?php echo $rows->serial_number;?></td>
            <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
            <td><?php echo $rows->unit_type;?></td>
            <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
            <td><?php $agingnya=(time()-$rows->create_date)/86400; echo number_format($agingnya,2);?></td>
            <td><?php echo number_format($this->global_model->getworkingdays($rows->create_date,time()),2);?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>