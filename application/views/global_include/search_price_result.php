<script type="text/javascript">
	$(document).ready(function(){
		detail_price=$('<div class="detail_price" style="display:none;"></div>').css('background-color','#25007D').css('padding','10px').css('border','3px solid #502FBD').css('position','absolute');
		$('.list_nya').css('background-color','#F4F4F4');
		$('#price_list_result_table td').css('color','#25007D');
		$('#price_list_result_table td').css('border-bottom','1px dotted #502FBD');
		$('#price_list_result_table th').css('border-bottom','1px solid #502FBD');
		$('.list_group').css('background-color','#019DC3');
		$('.list_group td').css('color','#FFF');
		$('.list_nya').css('cursor','pointer');
		$('.list_nya').hover(
			
			function(){
				$(this).css('background-color','#DEDEDE');
				
			},
			function(){
				$(this).css('background','#F4F4F4');

		});
		
		$('.list_nya').click(function(){
			
			r_id=$(this).attr('idnya');
			$(this).append(detail_price);
			posisi=$(this).position();
			lebarnya=$(this).width();
			$('.detail_price').hide();
			$('.detail_price',this).load('<?php echo site_url('program/get_detail_price');?>/'+r_id,function(){
				lebardet=$(this).width();
				tinggidet=$(this).height();
				console.log(tinggidet+'-'+lebardet);
				$('.detail_price').css('left',(lebarnya/2)-(lebardet/2));
				$('.detail_price').css('margin-top',tinggidet-(tinggidet*2)-30);
				$('.detail_price').fadeIn('fast').animate({"marginTop": "+=15px"});
			});
			
					
				
		});
	});
</script>
<table class="main_table" id="price_list_result_table">
	<thead>
	<tr style="background:#404040;"><th>Part No</th><th>Alt Part</th><th>Part Name</th><th>Model</th><th>Description</th><th>Price</th></tr>
   	</thead>
    <tbody>
    <?php $group_array=array(); $i=0; foreach($query as $rows): $i++; $group_array[$i]=$rows->type; ?>
    	<? if($i==1): ?>
        	<tr class="list_group"><td colspan="6"><?php echo $rows->type;?></td></tr>
        <?php else: ?>
        	<?php if($group_array[$i]<>$group_array[$i-1]): ?>
            	<tr class="list_group"><td colspan="6"><?php echo $rows->type;?></td></tr>
            <?php endif;?>
        <?php endif;?>
        <tr class="list_nya" idnya="<?php echo $rows->row_id;?>">
        	<td><?php echo $rows->partno;?></td>
 
            <td><?php echo $rows->pnchange;?></td>
            <td><?php echo $rows->partname;?></td>
            <td><?php echo $rows->model;?></td>
            <td><?php echo $rows->descript;?></td>
            <td><div align="right"><?php echo  number_format($rows->price_end,0,',','.');?></div></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
