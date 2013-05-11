<script type="application/javascript">
	$(document).ready(function() {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
		var oTable =$('#case_in_today_table_db').dataTable(
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
<div class="over_screen_title">Case Today</div>
<div class="over_screen_content">
<table class="main_table" id="case_in_today_table_db">
	<thead>
    <tr><th>No</th><th>Case ID</th><th>Serial Number</th><th>CSO</th><th>Engineer</th><th>Customer</th><th>Unit Type</th><th>Case Type</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->case_id;?></td>
            <td><?php echo $rows->serial_number;?></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
            <td><?php echo $rows->customer_name;?></td>
            <td><span style="font-size:9px;"><?php echo $rows->unit_type;?></span></td>
            <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
</div>