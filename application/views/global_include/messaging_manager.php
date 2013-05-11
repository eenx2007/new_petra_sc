<script type="text/javascript">
	$(document).ready(function(){
		$('#m_new').click(function(){
			$('#message_detail').load('<?php echo site_url('program/new_message');?>');
		});
		$('#m_sent').click(function(){
			$('#message_detail').load('<?php echo site_url('program/message_sent');?>/'+sess_user_id);
		});
		$('#close_window').click(function(){
			$('.over_screen').html('');
			$('.over_screen').hide();
		});
		$('#m_inbox').click(function(){
			$('#message_detail').html('');
			$('#message_detail').load('<?php echo site_url('program/message_inbox');?>/'+sess_user_id);
		});
		$('#message_detail').load('<?php echo site_url('program/message_inbox');?>/'+sess_user_id);
	});
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">Messaging</div>
<div class="over_screen_content">
	<table class="main_table">
		<tr><td><button id="m_inbox">Inbox</button> <button id="m_sent">Sent</button> <button id="m_new">New Message</button></td></tr>
    </table>
    <div id="message_detail">
    	
    </div>
</div>