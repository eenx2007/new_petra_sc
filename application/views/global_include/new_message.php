<style>
	.message_table{margin:10px;}
	.message_table td{padding-right:10px;padding-top:10px;padding-bottom:10px;}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#send_message').click(function(){
			m_to=$('#message_to').val();
			m_c_id=$('#message_case_id').val();
			m_subject=$('#message_subject').val();
			m_content=$('#message_content').val();
			$.post('<?php echo site_url('program/send_the_message');?>',
				{
					message_to:m_to,
					message_case_id:m_c_id,
					message_subject:m_subject,
					message_content:m_content,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Message Sent!');
					$('#message_detail').load('<?php echo site_url('program/message_inbox');?>/'+sess_user_id);
				}
			);
		});
		$('#message_content').tinymce({
			script_url : '<?php echo base_url();?>assets/jquery/tiny_mce/tiny_mce.js',					  
			relative_urls : false,

			theme : "advanced",
			plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,",
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,blockquote,|,undo,redo,|,hr,|,sub,sup,|,charmap,|,fullscreen,|,fontsizeselect,formatselect",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom"
								  });
	});
</script>
<table class="message_table">
	<tr>
    	<td>To</td>
        <td><?php
				$message_to=array('0'=>'Select User');
				$message_to['101']="All Engineer";
				$message_to['102']="All CSO";
				$message_to['103']="All User";
        		$queryu=$this->global_model->get_all_user();
				foreach($queryu as $rowsu)
				{
					if($rowsu->user_id<>$this->session->userdata('user_id'))
					{
						
						$message_to[$rowsu->user_id]=$rowsu->sure_name;	
					}
				}
				echo form_dropdown('message_to',$message_to,'','id="message_to"');
			?></td>
    </tr> 
    <tr><td>Case ID</td><td><input type="text" id="message_case_id" name="message_case_id" /></td></tr>
    
   
</table>
<table class="main_table">
	<tr><td><strong>Subject</strong><br /><input type="text" id="message_subject" name="message_subject" /></td></tr>
	<tr><td><strong>Content</strong><br /><textarea name="message_content" id="message_content" style="height:250px;"></textarea></td></tr>
    <tr><td><button id="send_message">Send</button></td></tr>
</table>