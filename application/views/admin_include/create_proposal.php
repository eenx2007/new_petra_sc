<script type="text/javascript">
	$(document).ready(function(e) {
        $('#proposal_id_hidden').val('<?php echo $proposal_id;?>');
		$('#detail_proposal_update').load('<?php echo site_url('adminpanels/proposal_control/det_proposal_update');?>/<?php echo $proposal_id;?>');
		$('#add_part_sale').click(function(){
			p_idnya=$('#proposal_id_hidden').val();
			partno=$('#part_sale_add').val();
			$.post('<?php echo site_url('adminpanels/proposal_control/add_detail_proposal');?>',
				{
					proposal_id:p_idnya,
					det_value:partno
				},
				function(data)
				{
					$('#detail_proposal_update').load('<?php echo site_url('adminpanels/proposal_control/det_proposal_update');?>/<?php echo $proposal_id;?>');
				}
			);
		});
    });
</script>
<table class="main_table">
	<tr><td>Nomor Proposal P-<?php echo $proposal_id;?></td></tr>
</table>
<table class="main_table">
	<tr><td>Add Item</td><td><input type="text" id="part_sale_add" /></td><td><button id="add_part_sale">OK</button></td></tr>
</table>

<div id="detail_proposal_update">
	
</div>