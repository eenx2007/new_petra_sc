<script type="text/javascript">
	$(document).ready(function(e) {
        
		$('#detail_proposal_update').load('<?php echo site_url('csos/invoice_control/det_proposal_update');?>/<?php echo $proposal_id;?>');
		
    });
</script>
<table class="main_table">
	<tr><td>Invoice Number P-<?php echo $proposal_id;?><input type="hidden" id="proposal_id_hidden" value="<?php echo $proposal_id;?>" /></td></tr>
</table>
<div id="detail_proposal_update">
	
</div>