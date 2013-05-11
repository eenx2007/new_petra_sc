<script type="text/javascript">
	$(document).ready(function(){
		
		$('#close_window').click(function(){
			$('.over_screen').html('');
			$('.over_screen').hide();
		});
		
	});
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">FD Activity</div>
<div class="over_screen_content">
    <table class="main_table" id="cso_act_table_db">
        <thead>
        	<tr>
            	<th></th>
		<?php foreach($query as $rows): ?>
            	<th><?php echo $this->cso_activity_model->get_activity_type($rows->activity_type);?></th>
        <?php endforeach;?>
        	</tr>
           
        </thead>
        <tbody>
        	<tr><td>Total</td>
			<?php foreach($query as $rows): ?>
            	<td><?php echo $rows->total;?></td>
            <?php endforeach;?> </tr>
        </tbody>
    </table>
   
</div>