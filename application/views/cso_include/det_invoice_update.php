<script type="text/javascript">
	$(document).ready(function(e) {
        $('#print_invoice').click(function(){
			p_idnya=$('#proposal_id_hidden').val();
			var windowSizeArray = [ "width=200,height=200",
													"width=300,height=400,scrollbars=yes" ];
			var url = '<?php echo site_url('csos/report_control/print_invoice');?>/'+p_idnya;
			var windowName = "popUp";//$(this).attr("name");
			var windowSize = windowSizeArray[$(this).attr("rel")];
			
			window.open(url, windowName, windowSize);
		});
    });
</script>

<table class="main_table">
	<tr><td>No.</td><td>Item Code</td><td>Item</td><td>Price</td></tr>
    <?php $i=0;$total_price=0;
		foreach($query as $rows): $i++;?>
    <tr><td><?php echo $i;?></td><td><?php echo $rows->part_released;?></td><td><?php echo $rows->part_name;?></td><td><div align="right"><?php echo number_format($rows->det_price,0,',','.');?></div></td></tr>   
    <?php $total_price=$total_price+$rows->det_price;?>    
    <?php endforeach;?>
    <?php 
		foreach($query2 as $rows2): $i++;?>
    <tr><td><?php echo $i;?></td><td><?php echo $rows2->det_value;?></td><td><?php echo $rows2->part_name;?></td><td><div align="right"><?php echo number_format($rows2->det_price,0,',','.');?></div></td></tr>   
    <?php $total_price=$total_price+$rows2->det_price;?>    
    <?php endforeach;?>
    <tr><td colspan="3">Total</td><td><div align="right"><?php echo number_format($total_price,0,',','.');?></div></td></tr>
    <tr><td colspan="4"><button id="print_invoice">Cetak</button></td></tr>
</table>