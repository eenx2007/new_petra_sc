<script type="text/javascript">
	$(document).ready(function(){
		$('#search_result').hide();
		$('#search_case').click(function(){
			c_id=encodeURIComponent($('#case_id').val());
			sn=encodeURIComponent($('#serial_number').val());
			c_name=encodeURIComponent($('#customer_name').val());
			p_number=encodeURIComponent($('#phone_number').val());
			s_date=encodeURIComponent($('#start_date').val());
			e_date=encodeURIComponent($('#end_date').val());
			$('#search_form').hide();
			$('#search_result').show();
			$('#search_result').load('<?php echo site_url('program/search_do');?>?&case_id='+c_id+'&serial_number='+sn+'&customer_name='+c_name+'&phone_number='+p_number+'&start_date='+s_date+'&end_date='+e_date);
		});
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
	});
</script>
<div class="innerbody" id="search_form">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Search Case</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Case ID</td><td><input type="text" name="case_id" id="case_id" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number" id="serial_number" /></td></tr>
                <tr><td>Customer Name</td><td><input type="text" name="customer_name" id="customer_name" /></td></tr>
                <tr><td>Phone</td><td><input type="text" name="phone_number" id="phone_number" /></td></tr>
                <tr><td>Range</td><td><input type="text" name="start_date" id="start_date" style="width:30%;" value="from" /> <input type="text" name="end_date" id="end_date" style="width:30%;" value="to" /></td></tr>
                <tr><td colspan="2"><button id="search_case">Search</button></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="innerbody2" id="search_result">

</div>