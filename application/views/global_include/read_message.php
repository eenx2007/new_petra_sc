<style>
	.innernya td{padding:0;padding-right:20px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#message_reply').click(function(){
			m_id='<?php echo $row->message_id;?>';
			$('#message_detail').load('<?php echo site_url('program/reply_message');?>/'+m_id);
		});
		$('#message_ok_respon').click(function(){
			m_id='<?php echo $row->message_id;?>';
			$.post('<?php echo site_url('program/close_message');?>',
				{
					message_id:m_id,
					new_status:'3'	
				},
				function(data)
				{
					message_alert('Message Closed');
					$('#message_detail').load('<?php echo site_url('program/message_inbox');?>/'+sess_user_id);
				}
			);
		});
		$.get('<?php echo site_url('program/message_to_you_from');?>',
			{
				message_sender:'<?php echo $row->message_sender;?>',
				message_to:sess_user_id
			},
			function(data)
			{
				$('#total_conv').text(data);
			}
		)
		$.get('<?php echo site_url('program/refresh_message_status');?>',
				{
					user_id:sess_user_id
				},
				function(data)
				{
					$('#web_chat_db .long_menu_full_text').html(data+' unread message(s)');
				}
		);
	});
</script>
<table class="main_table forthisonly">
	<tr>
    	<td style="border-bottom:3px solid #240079;border-top:3px solid #240079;">
        
        	<table class="innernya" cellpadding="0" cellspacing="0">
            	<tr><td rowspan="3" style="vertical-align:top;padding-top:5px;"><img src="<?php echo base_url();?>assets/user_image/<?php echo $row->user_image;?>" /></td></tr>
            	<tr><td><?php echo $row->sure_name;?> - <?php echo mdate('%d/%m/%Y %H:%i:%s',$row->message_date);?></td></tr>
                <tr><td><span id="total_conv"></span> conversation(s) between you and <?php echo $row->sure_name;?></td></tr>
            </table>
       
        </td>
        <?php if($row->message_status<2): ?>
         <tr><td style="border-bottom:3px solid #240079;"><button id="message_reply">Reply</button> <button id="message_ok_respon">Done</button>
          </td></tr>
          <?php endif;?>
    </tr>
    <tr><td><?php echo $row->case_id;?> <strong><?php echo $row->message_subject;?></strong></td></tr>
    <tr><td><?php echo $row->message_content;?></td></tr>
   
</table>