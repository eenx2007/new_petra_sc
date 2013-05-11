<script type="text/javascript">
	$(document).ready(function(){
		$('#close_window').click(function(){
			$('.over_screen').html('');
			$('.over_screen').hide();
		});

	});
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">Messaging</div>
<div class="over_screen_content">
<table class="main_table">
	<?php foreach($query as $rows): ?>
    	<tr><td><?php echo $rows->sure_name;?></td><td><div align="right"><?php echo $rows->total;?></div></td><td><div style="width:<?php echo $rows->total*10;?>px;height:10px;background:#FFF;"></div></td></tr>
    <?php endforeach;?>
</table>
</div>