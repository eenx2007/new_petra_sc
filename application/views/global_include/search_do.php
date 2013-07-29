<script type="text/javascript">
	$(document).ready(function(e) {
		$('#case_detail').hide();
		$('#case_detail').width(lebar-50);
		$('#case_detail').height(tinggi-91);
		$('#case_detail').css('top',85);
		$('#case_detail').css('left',25);
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        var oTable =$('#search_result_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
		
		$('.case_detail').click(function(){
			c_id=$(this).attr('idnya');
			
			$('.over_screen').load('<?php echo site_url('program/case_detail');?>/'+c_id);
			setTimeout(function(){
				
				$('.over_screen').show();
			},500);
			
		});
		$('#export_to_xls').click(function(){
			c_id=encodeURIComponent('<?php echo $case_id;?>');
			sn=encodeURIComponent('<?php echo $serial_number;?>');
			c_name=encodeURIComponent('<?php echo $customer_name;?>');
			p_number=encodeURIComponent('<?php echo $phone_number;?>');
			s_date=encodeURIComponent('<?php echo $start_date;?>');
			e_date=encodeURIComponent('<?php echo $end_date;?>');
			window.open('<?php echo site_url('program/export_to_xl');?>?&case_id='+c_id+'&serial_number='+sn+'&customer_name='+c_name+'&phone_number='+p_number+'&start_date='+s_date+'&end_date='+e_date);
		});
    });
</script>
	<div style="position:absolute;right:250px;top:10px;"><button id="export_to_xls">Export to XLS</button></div>
	<div class="dashboard_item">
        <div class="dashboard_item_content">
        	<table class="main_table" id="search_result_table">
            	<thead>
            	<tr>
                    <th>Case ID</th>
                    <th>Date Created</th>
                    <th>CSO</th>
                    <th>Engineer</th>
                    <th>Aging</th>
                    <th>TAT</th>
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Name / Phone</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <tr>
                    <td><span style="cursor:pointer;" class="case_detail" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></span></td>
                    <td><span style="font-size:9px;"><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->create_date);?></span></td>
                    <td><?php echo $rows->sure_name;?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo number_format((time()-$rows->create_date)/86400,2);?></td>
                    <td><?php echo number_format($this->global_model->getworkingdays($rows->create_date,time()),2);?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo $rows->customer_name;?> / <?php echo $rows->customer_phone;?></td>
                    <td><?php echo $this->global_model->get_case_status($rows->case_status);?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>


<div id="case_detail" style="position:fixed;background:#240079;overflow:auto;border:3px solid #1A51A7;">
	
</div>
<script type="text/javascript">
	setTimeout(function(){
						generate_scroller();
			},500);
</script>