<script type="text/javascript">
	$(document).ready(function() {
		$('#need_to_be_issued').load('<?php echo site_url('wh_panel/need_to_be_issued');?>');
		$('#search_result').hide();
        $('#search_part').click(function(){
			c_id=$('#case_id').val();
			$('#search_result').fadeIn();
			$('#search_result').load('<?php echo site_url('wh_panel/search_part');?>/'+c_id);
			
		});
    });
</script>
<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Part Out from WH</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table" id="search_form">
            	<tr><td>Case ID</td><td><input type="text" name="case_id" id="case_id" /></td><td><button id="search_part">Search</button></td></tr>
            </table>
            <div id="search_result">
            	
            </div>
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Need to be Issued</div>
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