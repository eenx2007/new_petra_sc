<script type="text/javascript">
	$(document).ready(function(e) {
    	$('#list_recorded_part').load('<?php echo site_url('whpanels/part_control/recorded_part');?>'); 
		$('#save_new_part').click(function(){
			p_number=$('#part_number').val();
			p_name=$('#part_name').val();
			p_type=$('#part_type').val();
			$.post('<?php echo site_url('whpanels/part_control/save_new_part');?>',
				{
					part_number:p_number,
					part_name:p_name,
					part_type:p_type
				},
				function(data)
				{
					$('#list_recorded_part').load('<?php echo site_url('whpanels/part_control/recorded_part');?>'); 
					$('#part_number').val('');
					$('#part_name').val('');
					$('#part_type').val('');
				}
			);
		});
    });
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">New Part Data</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table">
            	<tr><td>Part Number</td><td><input type="text" id="part_number" /></td></tr>
            	<tr><td>Part Name</td><td><input type="text" id="part_name" /></td></tr>
                <tr><td>Part Type</td><td><input type="text" id="part_type" /></td></tr>
                <tr><td colspan="2"><button id="save_new_part">Save</button></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Recorded Part</div>
        <div class="dasbhoard_item_content" id="list_recorded_part">
        	
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        setTimeout(function(){
						generate_scroller();
			},500);
    });
</script>