<script type="text/javascript">
	$(document).ready(function(e) {
        $('#export_to_excel').click(function(){
			s_date=encodeURIComponent('<?php echo $start_date;?>');
			e_date=encodeURIComponent('<?php echo $end_date;?>');
			window.open('<?php echo site_url('adminpanels/report_control/transaction_list_etx');?>?start_date='+s_date+'&end_date='+e_date);
		});
    });	
</script>
        	<table class="main_table">
            	<tr><th>No.</th><th>Date</th><th>Transaction</th><th>Debit</th><th>Credit</th><th>User</th><th>Reff</th></tr>
                <?php $i=0;$total_debit=0;$total_credit=0; foreach($query as $rows): $i++; ?>
                	<tr>
                    	<td><?php echo $i;?></td>
                        <td><?php echo mdate('%d/%m/%Y %h:%i:%s',$rows->transaction_date);?></td>
                        <td><?php echo $rows->transaction_title;?></td>
                        <?php if($rows->transaction_type==0):?>
                        	<td><?php echo number_format($rows->transaction_total,0,',','.');$total_debit=$total_debit+$rows->transaction_total;?></td>
                            <td>0</td>
                        <?php else:?>
							<td>0</td>
                            <td><?php echo number_format($rows->transaction_total,0,',','.');$total_credit=$total_credit+$rows->transaction_total;?></td>
						<?php endif;?>
                        <td><?php echo $rows->sure_name;?></td>
                        <td><?php echo $rows->transaction_reff;?></td>
                    </tr>
                <?php endforeach;?>
                <tr><td colspan="3">Total</td><td><?php echo number_format($total_debit,0,',','.');?></td><td><?php echo number_format($total_credit,0,',','.');?></td><td></td><td></td></tr>
                <tr><td colspan="7"><button id="export_to_excel">Export to Excel</button></td></tr>
            </table>
            
            <script type="text/javascript">
	$(document).ready(function(e) {
        setTimeout(function(){
						generate_scroller();
			},500);
    });
</script>
  