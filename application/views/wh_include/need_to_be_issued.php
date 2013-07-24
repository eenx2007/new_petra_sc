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
		
		$('.cancel_request').click(function(){
			p_id=$(this).attr('idnya');
			$.post('<?php echo site_url('whpanels/part_control/cancel_request');?>',
				{
					part_request_id:p_id
				},
				function(data)
				{
					$('#need_to_be_issued').load('<?php echo site_url('wh_panel/need_to_be_issued');?>');
				}
			);
		});
		
    });
</script>

<table class="main_table" id="need_to_table">
	<thead>
	<tr><th>No.</th><th>Orde No</th><th>Requested</th><th>Reason</th><th>Engineer</th><th>Case ID</th><th>Update</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo 'G'.$rows->part_request_id;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo $rows->bad_part_sn;?></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $rows->case_id;?></td>
            <td><button class="cancel_request" idnya="<?php echo $rows->part_request_id;?>">Cancel</button></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>