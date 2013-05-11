
<table class="main_table">
	<tr><td colspan="2"><div align="right">Kondisi Normal</div></td></tr>
	<tr><td>Price</td><td><div align="right"><?php echo number_format($row->price_end,2,',','.');?></div></td></tr>
    <tr><td>PPN</td><td><div align="right"><?php $vat=($row->price_end*10)/100; echo number_format($vat,2,',','.');?></div></td></tr>
    <tr><td>Biaya Service</td><td><input type="text" id="service_charge" value="0" style="text-align:right;" /></td></tr>
    <tr><td>Total Price</td><td><div align="right" id="total_price"><?php $total_price=$row->price_end+$vat; echo number_format($total_price,2,',','.');?></div></td></tr>
</table>
<script type="text/javascript">


	$(document).ready(function(){
		var price_end=<?php echo $row->price_end;?>;
		var vat=<?php echo $vat;?>;
		$('#service_charge').focus();
		$('#service_charge').keypress(function(e){
			if(e.which==13)
			{
				valnya=$(this).val();
				if(valnya=='')
					valnya=0;
				new_price=parseInt(price_end)+parseInt(vat)+parseInt(valnya);
				$('#total_price').text(new_price);
			}
		});
	});
</script>