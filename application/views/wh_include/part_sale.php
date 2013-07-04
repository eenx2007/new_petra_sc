<script type="text/javascript">
	$(document).ready(function(e) {
		$('#need_to_be_issued').load('<?php echo site_url('whpanels/part_control/issued_to_fd');?>');
		$('#search_inv').click(function(){
			p_id=$('#proposal_id').val();
			$('#search_result').load('<?php echo site_url('whpanels/part_control/search_inv/');?>/'+p_id);
		});
    });
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Give Part Sale</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Invoice Number</td><td><input type="text" id="proposal_id" /></td><td><button id="search_inv">Search</button></td></tr>
                
 
            </table>
            <div id="search_result">
            	
            </div>
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Part Request By CSO</div>
        <div class="dashboard_item_content" id="need_to_be_issued">
        	
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