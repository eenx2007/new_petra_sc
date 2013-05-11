<script type="text/javascript">
	$(document).ready(function(){
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
		var oTable =$('#message_inbox_table').dataTable(
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
<style>
	.unread td{font-weight:bold;}
</style>
<table class="main_table" id="message_inbox_table">
	<thead>
	<tr><th>No.</th><th>Date</th><th>To</th><th>Case About</th><th>Subject</th><th>Status</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr style="cursor:pointer;" idnya="<?php echo $rows->message_id;?>" class="message_detailnya <?php if($rows->message_status==0) echo "unread";?>">
        	<td><?php echo $i;?></td>
            <td><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->message_date);?></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $rows->case_id;?></td>
            <td><?php echo $rows->message_subject;?></td>
            <td><?php echo $this->global_model->get_message_status($rows->message_status);?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>