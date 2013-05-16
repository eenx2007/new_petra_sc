<script type="text/javascript">
	$(document).ready(function(){
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
		$('#export_to_xls').click(function(){
			s_date=encodeURIComponent('<?php echo $start_date;?>');
			e_date=encodeURIComponent('<?php echo $end_date;?>');
			window.open('<?php echo site_url('adminpanels/report_control/case_out_etx');?>?start_date='+s_date+'&end_date='+e_date);
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
                    <th>Create Date</th>
                    <th>RTS Date</th>
                    <th>Engineer</th>
                    <th>TAT</th>
                    <th>Part Used</th>
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Reason</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <tr>
                    <td><span style="cursor:pointer;" class="case_detail" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></span></td>
                    <td><?php echo mdate('%d/%m/%Y',$rows->create_date);?></td>
                    <td><?php echo mdate('%d/%m/%Y',$rows->resolved_date);?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo number_format($this->global_model->getworkingdays($rows->create_date,$rows->resolved_date),2);?></td>
                    <td><?php echo $this->case_model->get_part_used($rows->case_id);?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo $this->global_model->get_reason($rows->resolved_reason);?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>