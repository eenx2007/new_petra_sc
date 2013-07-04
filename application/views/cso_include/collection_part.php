<script type="text/javascript">
	$(document).ready(function(e) {
		$('#search_result').hide();
        $('#search_proposal').click(function(){
			p_id=$('#proposal_id').val();
			$('#search_result').show(); 
			$('#search_result_content').load('<?php echo site_url('csos/invoice_control/search_invoice_result');?>/'+p_id);
		});
    });
</script>
<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Search Invoice</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Invoice Number</td><td><input type="text" id="proposal_id" /></td><td><button id="search_proposal">Search</button></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item" id="search_result" style="width:90%;">
    	<div class="dashboard_item_title">Invoice</div>
        <div class="dashboard_item_content" id="search_result_content">
        
        </div>
    </div>
</div>