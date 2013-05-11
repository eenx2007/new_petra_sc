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
		$('.message_detailnya').click(function(){
			msg_id=$(this).attr('idnya');
			
			last_status=$(this).attr('statusnya');
			$('#message_detail').load('<?php echo site_url('program/read_message');?>/'+msg_id+'/'+last_status);
			
		});
		$('.delete_message').click(function(){
			m_id=$(this).attr('idnya');
			$.get('<?php echo site_url('program/delete_message');?>',
				{
					message_id:m_id
				},
				function(data)
				{
					$('#m_id_'+m_id).hide();
				}
			);
		});
	});
</script>
<style>
	.unread td{font-weight:bold;}
</style>
<table class="main_table" id="message_inbox_table">
	<thead>
	<tr><th>No.</th><th>Date</th><th>Sender</th><th>Case About</th><th>Subject</th><th>Status</th></tr>
    </thead>
    <tbody>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr style="cursor:pointer;" statusnya="<?php echo $rows->message_status;?>" idnya="<?php echo $rows->message_id;?>" id="m_id_<?php echo $rows->message_id;?>" class="message_detailnya <?php if($rows->message_status==0) echo "unread";?>">
        	<td><?php echo $i;?></td>
            <td><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->message_date);?></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $rows->case_id;?></td>
            <td><?php echo $rows->message_subject;?></td>
            <?php if($rows->message_status>1): ?>
            <td><a href="javascript:void(0);" class="delete_message" idnya="<?php echo $rows->message_id;?>" style="color:#000;">Delete</a></td>
            <?php else:?>
            <td><?php echo $this->global_model->get_message_status($rows->message_status);?></td>
            <?php endif;?>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>