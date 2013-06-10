<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#need_to_table').dataTable(
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

<table class="main_table" id="need_to_table">
	<thead>
	<tr><th>No.</th><th>Issued Code</th><th>Part Number</th><th>Serial Number</th><th>CSO</th><th>CSS Reff</th><th>Update</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo 'G'.$rows->part_request_id;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo $rows->bad_part_sn;?></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $rows->css_ref;?></td>
            <td><button class="done_in_css">Waiting</button></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>