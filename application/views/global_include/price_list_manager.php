<script type="text/javascript">
	$(document).ready(function(){
		$('#search_price_result').hide();
		$('#search_price').click(function(){
			s_key=$('#search_key').val();
			s_type=$('#search_type').val();
			if(s_key=='')
				message_alert('Please enter e keyword');
			else
			{
				$('#search_price_result').show();
				$('#search_price_result').load('<?php echo site_url('program/search_price_result');?>/'+s_key+'/'+s_type);
			}
		});
		$('#close_window').click(function(){
			$('.over_screen').hide();
		});
	});
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">Pricelist</div>
<div class="over_screen_content">
	<table class="main_table" style="width:auto;">
    	<tr><td><input type="text" id="search_key" name="search_key" /></td><td><?php $search_type=array('0'=>'Model','1'=>'Part Number','2'=>'Description'); echo form_dropdown('search_type',$search_type,'','id="search_type"');?></td><td><button id="search_price">Search</button></td></tr>
    </table>
    <div id="search_price_result">
    
    </div>
</div>