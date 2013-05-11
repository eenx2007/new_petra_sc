<script type="text/javascript">
	$(document).ready(function(e) {
        var availableTags = [
			<?php echo $part_numbernya;?>
		];
		$('#part_number').autocomplete({
			source: availableTags
		});
		$('#part_number').blur(function(){
			pn=$(this).val();
			$.post('<?php echo site_url('wh_panel/check_part');?>',
				{
					part_number:pn
				},
				function(data)
				{
					$('#part_name').val(data);
				}
			);
		});
		
		$('#save_part').click(function(){
			ty_in=$('#type_in').val();
			if(ty_in==0)
			{
				pn=$('#part_number').val();
				s_t=$('#stock_total').val();
				loc=$('#part_location').val();
				$.post('<?php echo site_url('wh_panel/part_in_save');?>',
					{
						part_number:pn,
						stock_total:s_t,
						stock_location:loc
					},
					function(data)
					{
						$('#part_number').val('');
						$('#part_name').val('');
						$('#stock_total').val('');
						
					}
				);
			}
			else
			{
				
			}
		});
    });
</script>
<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Part In to Warehouse</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table">
            	<tr><td>Part Number</td><td><input type="text" name="part_number" id="part_number" /></td></tr>
                <tr><td>Part Name</td><td><input type="text" name="part_name" id="part_name" /></td></tr>
                <tr><td>Total In</td><td><input type="text" name="stock_total" id="stock_total" /></td></tr>
                <tr><td>Type</td>
                	<td>
                    	<?php $type_in=array('0'=>'Existing Part','1'=>'New Part');
							echo form_dropdown('type_in',$type_in,'','id="type_in"');
						?>
                    </td>
                </tr>
                <tr><td>Location</td>
                	<td>
                    	<?php
							$part_location=array(); 
							$queryloc=$this->location_model->get_part_location();
							foreach($queryloc as $rowsloc)
							{
								$part_location[$rowsloc->location_id]=$rowsloc->location_name;
									
							}
							echo form_dropdown('part_location',$part_location,'','id="part_location"');
						?>
                    </td>
                </tr>
                <tr><td colspan="2"><button id="save_part">Save</button></td></tr>
            </table>
        </div>
    </div>
</div>