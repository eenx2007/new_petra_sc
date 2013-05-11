<script type="text/javascript">
	$(document).ready(function(){
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
		var oTable =$('#repair_complete_table_admin').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
	});
</script>
<div class="dashboard_item">
	<div class="dashboard_item_title">Repair Complete List</div>
    <div class="dashboard_item_content">
        <table class="main_table" id="repair_complete_table_admin">
            <thead>
            <tr><th>No</th><th>Case ID</th><th>Engineer</th><th>Unit Type</th><th>Case Type</th><th>TAT</th></tr>
            </thead>
            <tbody>
            <?php $i=0; foreach($query as $rows): $i++; ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rows->case_id;?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo timespan($rows->create_date,time());?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>