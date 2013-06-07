<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#recorded_part_table').dataTable(
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

<table class="main_table" id="recorded_part_table">
    <thead>
        <tr><th>Part Number</th><th>Part Name</th><th>Part Type</th><th>Edit</th></tr>
    </thead>
    <tbody>
        <?php foreach($query as $rows): ?>
        <tr>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo $rows->part_name;?></td>
            <td><?php echo $rows->part_type;?></td>
            <td><button class="edit_part" pnnya="<?php echo $rows->part_number;?>">Edit</button></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>