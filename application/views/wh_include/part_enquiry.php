<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#consumed_part_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true	
			}
		);
		
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_content">
            <table class="main_table" id="consumed_part_table">
            	<thead>
                <tr><th>No</th><th>Part Number</th><th>Part Name</th><th>Part Type</th><th>Stock Total</th><th>Base Price</th><th>Sell Price</th></tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($queryreq as $rowsreq): $i++; ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rowsreq->part_number;?></td>
                    <td><?php echo $rowsreq->part_name;?></td>
                    <td><?php echo $rowsreq->part_type;?></td>
                    <td><div align="center"><?php echo $rowsreq->stock_total;?></div></td>
                    <td><div align="right"><?php echo number_format($rowsreq->stock_base_price,0,',','.');?></div></td>
                    <td><div align="right"><?php echo number_format($rowsreq->stock_sell_price,0,',','.');?></div></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
		</div>
    </div>
</div>