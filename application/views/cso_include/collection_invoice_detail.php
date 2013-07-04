<script type="text/javascript">
	$(document).ready(function(e) {
       
		
		$('#save_temp_invoice').click(function(){
			p_id=$('#proposal_id').val();
			t_price=$('#total_price').val();
			b_price=$('#balance_price').val();
			$.post('<?php echo site_url('csos/invoice_control/update_clear_proposal');?>',
				{
					proposal_id:p_id,
					total_price:t_price,
					balance_price:b_price,
					user_id:sess_user_id	
				},
				function(data)
				{
					var windowSizeArray = [ "width=200,height=200",
													"width=300,height=400,scrollbars=yes" ];
					var url = '<?php echo site_url('csos/report_control/print_clear_invoice');?>/'+p_id;
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
    
  <tr><td><div align="center">No.</div></td><td><div align="center">Part Name</div></td><td><div align="center">Price</div></td><td><div align="center">QTY</div></td><td><div align="center">Total Price</div></td></tr>
    
    <?php $i=0; $total_price=0;  foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->part_number;?></td>
            <td><div align="right"><?php echo number_format($rows->det_price,0,',','.');?></div></td>
            <td><div align="right"><?php echo $rows->oem_part_sn;?></div></td>
            <td><div align="right"><?php echo number_format($rows->det_price*$rows->oem_part_sn,0,',','.');?></div></td>
        </tr>
    
    <?php $total_price=$total_price+($rows->det_price*$rows->oem_part_sn); endforeach;?>
    <tr><td colspan="5" style="border-bottom:1px solid #FFF;"></td></tr>
   
    <tr><td colspan="4"><div align="right">Total DP</div></td><td><div align="right"><?php echo number_format($row->proposal_dp,0,',','.');?></div></td></tr>
    <tr><td colspan="4"><div align="right">Total Price</div></td><td><div align="right"><?php echo number_format($total_price,0,',','.');?></div></td></tr>
    <tr><td colspan="4"><div align="right">Balance</div></td><td><div align="right" style="color:#F00;"><?php echo number_format($total_price-$row->proposal_dp,0,',','.');?><input type="hidden" id="total_price" value="<?php echo $total_price;?>" /><input type="hidden" id="balance_price" value="<?php echo $total_price-$row->proposal_dp;?>" /></div></td></tr>
    <tr><td colspan="5" style="border-bottom:1px solid #FFF;"></td></tr>
    <tr><td colspan="5"><button id="save_temp_invoice">Save and Print</button></td></tr>
</table>