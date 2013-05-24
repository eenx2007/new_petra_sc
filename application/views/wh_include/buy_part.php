<script type="text/javascript">
	$(document).ready(function(e) {
        var availableTags = [
			<?php echo $part_numbernya;?>
		];
		var availableTags2= [
			<?php echo $part_typenya;?>
		];
		$('#part_number').autocomplete({
			source: availableTags
		});
		$('#part_type').autocomplete({
			source: availableTags2
		});
		
		$('#part_number').blur(function(){
			pn=$(this).val();
			$.post('<?php echo site_url('whpanels/part_control/check_part');?>',
				{
					part_number:pn
				},
				function(data)
				{
					$('#part_name').val(data.part_name);
					$('#part_type').val(data.part_type);
				},
				'json'
			);
		});
		
		$('#save_buy').click(function(){
			po_type=$('#type_in').val();
			p_number=$('#part_number').val();
			p_name=$('#part_name').val();
			p_type=$('#part_type').val();
			po_from=$('#buy_from').val();
			po_qty=$('#total_buy').val();
			po_price=$('#part_order_price').val();
			po_reff=$('#ref_number').val();
			$.post('<?php echo site_url('whpanels/part_control/save_new_order');?>',
				{
					part_order_type:po_type,
					part_number:p_number,
					part_name:p_name,
					part_type:p_type,
					part_order_from:po_from,
					part_order_qty:po_qty,
					part_order_price:po_price,
					part_order_reff:po_reff,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Part Ordered!');
					back_to_dashboard();
				}
			);
			
		});
		
		$('.update_this').click(function(){
			po_id=$(this).attr('po_id');
			$.post('<?php echo site_url('whpanels/part_control/received');?>',
				{
					part_order_id:po_id
				},
				function(data)
				{
					message_alert('Part Received!');
					back_to_dashboard();
				}
			);
		});
    });
</script>
<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Order Part</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table">
            	
                <tr><td>Buying Type</td>
                	<td>
                    	<?php $type_in=array('0'=>'Existing Part','1'=>'New Part');
							echo form_dropdown('type_in',$type_in,'','id="type_in"');
						?>
                    </td>
                </tr>
                <tr><td>Part Number</td><td><input type="text" id="part_number" /></td></tr>
                <tr><td>Part Name</td><td><input type="text" id="part_name" /></td></tr>
                <tr><td>Part Type</td><td><input type="text" id="part_type" /></td></tr>
                <tr><td>Buy From</td><td><input type="text" id="buy_from" /></td></tr>
                <tr><td>Price</td><td><input type="text" id="part_order_price" /></td></tr>
                <tr><td>Total</td><td><input type="text" id="total_buy" /></td></tr>
                <tr><td>Ref Number</td><td><input type="text" id="ref_number" /></td></tr>
                <tr><td colspan="2"><button id="save_buy">Save</button></td></tr>
            </table>
        
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item" style="width:95%;">
    	<div class="dashboard_item_title">Ordered Part</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table" id="ordered_part_table">
            	<thead>
                	<tr><th>Order ID</th><th>Part Number</th><th>Part Name</th><th>Total</th><th>Order Reff</th><th>Update</th></tr>
                </thead>
                <tbody>
                <?php foreach($qpartorder as $rowspo): ?>
                	<tr>
                    	<td><?php echo $rowspo->part_order_id;?></td>
                        <td><?php echo $rowspo->part_number;?></td>
                        <td><?php echo $rowspo->part_name;?></td>
                        <td><div align="right"><?php echo number_format($rowspo->part_order_total,0,',','.');?></div></td>
                        <td><?php echo $rowspo->part_order_reff;?></td>
                        <td><button class="update_this" po_id="<?php echo $rowspo->part_order_id;?>">Received</button></td>
                    </tr>
                <?php endforeach;?>	
                </tbody>
            </table>
        
        </div>
    </div>
</div>