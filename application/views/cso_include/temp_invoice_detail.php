<script type="text/javascript">
	$(document).ready(function(e) {
        $('#add_to_detail').click(function(){
			p_id=$('#proposal_id').val();
			p_number=$('#part_request').val();
			r_qty=$('#qty_sale').val();
			p_price=$('#part_price').val();
			$.post('<?php echo site_url('csos/part_control/new_part_request');?>',
				{
					proposal_id:p_id,
					part_number:p_number,
					oem_part_sn:r_qty,
					part_price:p_price,
					user_id:sess_user_id	
				},
				function(data)
				{
					$('#temp_invoice_detail').load('<?php echo site_url('csos/invoice_control/temp_invoice_detail');?>/'+p_id);
				}
			);
		});
		
		$('#save_temp_invoice').click(function(){
			p_id=$('#proposal_id').val();
			t_dp=$('#total_dp').val();
			$.post('<?php echo site_url('csos/invoice_control/update_dp_proposal');?>',
				{
					proposal_id:p_id,
					total_dp:t_dp,
					user_id:sess_user_id	
				},
				function(data)
				{
					var windowSizeArray = [ "width=200,height=200",
													"width=300,height=400,scrollbars=yes" ];
					var url = '<?php echo site_url('csos/report_control/print_dp_invoice');?>/'+p_id;
					var windowName = "popUp";//$(this).attr("name");
					var windowSize = windowSizeArray[$(this).attr("rel")];
			
					window.open(url, windowName, windowSize);
					
					back_to_dashboard();
				}
			);
		});
    });
</script>
<table class="main_table">
    <tr>
        <td><input type="hidden" id="proposal_id" value="<?php echo $proposal_id;?>" /></td>
        <td><input type="text" id="part_request" /></td>
        <td><input type="text" id="part_price" /></td>
        <td><input type="text" id="qty_sale" /></td>
        <td><button id="add_to_detail">Add</button></td>
    </tr>
    <tr><td>No.</td><td>Part Name</td><td>Price</td><td>QTY</td><td>Total Price</td></tr>
    
    <?php $i=0; $total_price=0;  foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><?php echo number_format($rows->det_price,0,',','.');?></td>
            <td><?php echo $rows->oem_part_sn;?></td>
            <td><?php echo number_format($rows->det_price*$rows->oem_part_sn,0,',','.');?></td>
        </tr>
    
    <?php $total_price=$total_price+($rows->det_price*$rows->oem_part_sn); endforeach;?>
    <tr><td colspan="5" style="border-bottom:1px solid #FFF;"></td></tr>
    <tr><td colspan="4"><div align="right">Payment Method</div></td><td><?php
                    $payment_method=array('0'=>'Cash','1'=>'Down Payment');
                    echo form_dropdown('payment_method',$payment_method,'','id="payment_method"');
                ?></td></tr>
    <tr><td colspan="4"><div align="right">Total DP</div></td><td><input type="text" id="total_dp" value="0" /></td></tr>
    <tr><td colspan="4">Total Price</td><td><input type="text" id="total_price" value="<?php echo $total_price;?>" /></td></tr>
    <tr><td colspan="5" style="border-bottom:1px solid #FFF;"></td></tr>
    <tr><td colspan="5"><button id="save_temp_invoice">Save and Print</button></td></tr>
</table>