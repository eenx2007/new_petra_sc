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
		
		$('#report_result').hide();
		
		$('#generate_report').click(function(){
			s_date=encodeURIComponent($('#start_date').val());
			e_date=encodeURIComponent($('#end_date').val());
			report_type=$('#report_type').val();
			$('#report_result_place').load('<?php echo site_url('adminpanels/report_control/generate_custom_report');?>/?start_date='+s_date+'&end_date='+e_date+'&report_type='+report_type);
		});
	});
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Custom Report Query</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Date Range</td><td><input type="text" id="start_date" style="width:30%;" value="from" /> <input type="text" id="end_date" style="width:30%;" value="to" /></td></tr>
                <tr>
                	<td>Report Type</td>
                    <td>
                    	<?php
							$report_type=array('0'=>'Case In vs Case Out','1'=>'Finance Report');
							echo form_dropdown('report_type',$report_type,'','id="report_type"');
						?>
                    </td>
                </tr>
                <tr><td colspan="2"><button id="generate_report">Generate Report</button></td></tr> 
                
            </table>
        </div>
    </div>
    
    <br />
    <div class="dashboard_item" id="report_result">
    	<div class="dashboard_item_title"></div>
        <div class="dashboard_item_content" id="report_result_place">
        
        </div>
    </div>
</div>