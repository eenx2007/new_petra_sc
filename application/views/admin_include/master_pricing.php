<script type="text/javascript">
	$(document).ready(function(e) {
        tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#master_pricing_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true,
				"aaSorting": [[ 4, "desc" ]]
			}
		);
		
		$('.manage_price').click(function(){
			idnya=$(this).attr('idnya');
			$(this).hide();
			$('#sell_price_'+idnya).show().focus();
		});
		
		$('.sell_price_class').blur(function(){
			idnya=$(this).attr('idnya');
			new_price=$(this).val();
			$.post('<?php echo site_url('adminpanels/report_control/set_new_price');?>',
				{
					the_stock_id:idnya,
					stock_sell_price:new_price
				},
				function(data)
				{
					$('.scrolling_item').load('<?php echo site_url('adminpanels/report_control/master_pricing');?>');	
				}
			);
		});
    });
</script>

<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Master Pricing</div>
        <div class="dashboard_item_content">
        	<table class="main_table" id="master_pricing_table">
            	<thead>
                	<tr><th>Part Number</th><th>Part Name</th><th>Part Type</th><th>Base Price</th><th>Sell Price</th><th>Margin</th><th>Manage</th></tr>
                </thead>
                <tbody>
                	<?php foreach($query as $rows): ?>
                    	<tr>
                        	<td><?php echo $rows->part_number;?></td>
                            <td><?php echo $rows->part_name;?></td>
                            <td><?php echo $rows->part_type;?></td>
                            <td><div align="right"><?php echo number_format($rows->stock_base_price,0,',','.');?></div></td>
                            <td><div align="right"><?php echo number_format($rows->stock_sell_price,0,',','.');?></div></td>
                            <td><div align="center"><?php 
								if($rows->stock_sell_price<>0)
								{	$marginnya=100-(($rows->stock_base_price/$rows->stock_sell_price)*100); 
									echo number_format($marginnya,2,',','.');
								}
								else
									echo 0;
								?>%</div>
                            </td>
                            <td><button class="manage_price" id="manage_<?php echo $rows->the_stock_id;?>" idnya="<?php echo $rows->the_stock_id;?>">Manage</button>
                            	<input type="text" class="sell_price_class" value="<?php echo $rows->stock_sell_price;?>" idnya="<?php echo $rows->the_stock_id;?>" id="sell_price_<?php echo $rows->the_stock_id;?>" style="display:none;" />
                            </td>
                            
                        </tr>
                    <?php endforeach;?>
                </tbody>
               
            </table>
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