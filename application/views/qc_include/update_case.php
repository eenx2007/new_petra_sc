<script type="text/javascript">
	$(document).ready(function() {
		$('#tabsnya').hide();
		//$('#result_panel').hide();
		<?php if($case_id==0): ?>
        $('#search_case').click(function(){
			c_id=$('#case_id').val();
			$.post('<?php echo site_url('engineers/case_control/search_case');?>',
				{
					case_id:c_id
				},
				function(data)
				{
					if(data.error==1)
						message_alert('Case not found');
					else if(data.error==0)
					{
						
						$('#search_panel').hide();
						$('#tabsnya').show();
						$('#case_id_text').val(data.case_id);
						$('#create_date_text').val(data.create_date);
						$('#customer_name_text').val(data.customer_name);
						$('#phone_number_text').val(data.phone_number);
						$('#serial_number_text').val(data.serial_number);
						$('#unit_type_text').val(data.unit_type);
						$('#case_type_text').val(data.case_type);
						$('#case_status_text').val(data.case_status);
						$('#creator_text').val(data.creator);
						$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/'+c_id);
						$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
					}
				},
				'json'
			);
		});
		<?php else: ?>
			c_id='<?php echo $case_id;?>';
			$('#case_id').val(c_id);
			$.post('<?php echo site_url('engineers/case_control/search_case');?>',
				{
					case_id:c_id
				},
				function(data)
				{
					if(data.error==1)
						message_alert('Case not found');
					else if(data.error==0)
					{
						
						$('#search_panel').hide();
						$('#tabsnya').show();
						$('#case_id_text').val(data.case_id);
						$('#create_date_text').val(data.create_date);
						$('#customer_name_text').val(data.customer_name);
						$('#phone_number_text').val(data.phone_number);
						$('#serial_number_text').val(data.serial_number);
						$('#unit_type_text').val(data.unit_type);
						$('#case_type_text').val(data.case_type);
						$('#case_status_text').val(data.case_status);
						$('#creator_text').val(data.creator);
						$('#case_problem_text').val(data.case_problem);
						$('#completeness_text').val(data.completeness);
						$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/'+c_id);
						$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/'+c_id);
					}
				},
				'json'
			);
		<?php endif;?>
		// When a link is clicked 
		$('.active').each(function(){
			content_show=$(this).attr("gototab");
			$(content_show).show();
		});
		$("a.tab").click(function () {  
	  
			// switch all tabs off  
			$(".active").removeClass("active");  
	  
			// switch this tab on  
			$(this).addClass("active");  
	  
			// slide all elements with the class 'content' up  
			$(".content_tab").hide();  
	  
			// Now figure out what the 'title' attribute value is and find the element with that id.  Then slide that down.  
			var content_show = $(this).attr("gototab");  
			$(content_show).show();  
	  		 setTimeout(function(){
						generate_scroller();
			},500);
		});
		$('#force_update').click(function(){
			c_id=$('#case_id').val();
			u_status=$('#last_status').val();
			$.post('<?php echo site_url('qcpanels/case_control/force_update');?>',
				{
					case_id:c_id,
					update_status:u_status,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('You just transfer this case');
					back_to_dashboard();
				}
			);
		});
		
		$('#submit_log').click(function(){
			n_l_entry=$('#new_log_entry').val();
			l_type=$('#log_type').val();
			c_id=$('#case_id_text').val();
			$.post('<?php echo site_url('engineers/case_control/update_log');?>',
				{
					new_log_entry:n_l_entry,
					log_type:l_type,
					case_id:c_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Log saved!');
					$('#new_log_entry').val('');
					$('#log_type').val(0)
					
					$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/'+c_id);
				}
			);
		});
    });
</script>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Search Case</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td><input type="text" id="case_id" name="case_id" style="width:90%;" /></td><td><button id="search_case">Search</button></td></tr>
            </table>
        </div>
    </div>
    
    <div id="tabsnya" class="tabbed_area" style="width:90%;">
    	<ul class="tabs">
        	<li><a href="javascript:void(0);" gototab="#case_detail_tab" class="tab active">Case Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#part_in_case_tab" class="tab">Part Pada Case</a></li>
            <li><a href="javascript:void(0);" gototab="#log_info_tab" class="tab">Log Info</a></li>
            <li><a href="javascript:void(0);" gototab="#force_update_tab" class="tab">Change Status</a></li>
        </ul>
        <div id="case_detail_tab" class="content_tab">
       		<table class="main_table">
            	<tr><td>Case ID</td><td><input type="text" name="case_id_text" id="case_id_text" /></td></tr>
                <tr><td>Date In</td><td><input type="text" name="create_date_text" id="create_date_text" /></td></tr>
                <tr><td>Customer Name</td><td><input type="text" name="customer_name_text" id="customer_name_text" /></td></tr>
                <tr><td>Phone</td><td><input type="text" name="phone_number_text" id="phone_number_text" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number_text" id="serial_number_text" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type_text" id="unit_type_text" /></td></tr>
                <tr><td>Case Type</td><td><input type="text" name="case_type_text" id="case_type_text" /></td></tr>
                <tr><td>Status</td><td><input type="text" name="case_status_text" id="case_status_text" /></td></tr>
                <tr><td>CSO</td><td><input type="text" name="creator_text" id="creator_text" /></td></tr>
                <tr><td>Problem</td><td><input type="text" name="case_problem_text" id="case_problem_text" style="color:#F00;font-weight:bold;" /></td></tr>
                <tr><td>Completeness</td><td><textarea name="completeness_text" id="completeness_text" style="width:90%;"></textarea></td></tr>
            </table>
        </div>
        <div id="part_in_case_tab" class="content_tab">
        	
        </div>
        <div id="log_info_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Log Info Baru</td></tr>
                <tr><td><textarea name="new_log_entry" id="new_log_entry"></textarea></td></tr>
                <tr><td><?php $log_type=array(0=>'Normal Log',1=>'Promise to Customer',2=>'Request from Customer',3=>'Call Log',4=>'Engineering Update'); echo form_dropdown('log_type',$log_type,'','id="log_type"');?></td></tr>
                <tr><td><button id="submit_log">Add</button></td></tr>
                <tr><td><hr /></td></tr>
                <tr>
                	<td>
                    	<div id="log_details">
                        
                        </div>
                
                	</td>
            </table>
        </div>
        <div id="force_update_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td colspan="2">Make sure the unit is tested</td></tr>
                <tr>
                	<td>
						<?php
							$last_status=array('10'=>'Finish Check','16'=>'Re-Repair');
							echo form_dropdown('last_status',$last_status,'','id="last_status"');
						?>
                    </td>
                    <td><button id="force_update">Update</button></td> 
                 </tr>
                 
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">ITW</div>
        <div class="dashboard_item_content">
        	
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