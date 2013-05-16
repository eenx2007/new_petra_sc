<script type="text/javascript">
	$(document).ready(function(){
		$('#start_date').blur(function(){
			harusnya='from';
			if($(this).val()=='')
				$(this).val(harusnya);
		});
		$('#start_date').focus(function(){
			harusnya='from';
			if($(this).val()==harusnya)
				$(this).val('');
		});
		
		$('#end_date').blur(function(){
			harusnya='to';
			if($(this).val()=='')
				$(this).val(harusnya);
		});
		$('#end_date').focus(function(){
			harusnya='to';
			if($(this).val()==harusnya)
				$(this).val('');
		});
		
		$('#start_date').datepicker(
			{ dateFormat: "yy-mm-dd" }
		);
		
		$('#end_date').datepicker(
			{ dateFormat: "yy-mm-dd" }
		);
		
		$('#search_case_out').click(function(){
			s_date=encodeURIComponent($('#start_date').val());
			e_date=encodeURIComponent($('#end_date').val());
			$('#search_panel').hide();
			$('#search_result').load('<?php echo site_url('adminpanels/report_control/case_out_query');?>?start_date='+s_date+'&end_date='+e_date);
		});
	});
</script>
<div class="innerbody" id="search_panel">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Search Range</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Date Range</td><td><input type="text" name="start_date" id="start_date" style="width:30%;" value="from" /> <input type="text" name="end_date" id="end_date" style="width:30%;" value="to" /></td><td><button id="search_case_out">Search Case Out</button></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="innerbody2" id="search_result">

</div>