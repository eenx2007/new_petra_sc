<script type="text/javascript">
	$(document).ready(function(){
		// When a link is clicked
		$('#tabsnya').hide(); 
		$('#list_repair_complete').load('<?php echo site_url('adminpanels/case_control/repair_complete_admin');?>');
		$('.active').each(function(){
			content_show=$(this).attr("gototab");
			$(content_show).show();
		});
		
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
						
						$('#list_part_requested').hide();
						$('#tabsnya').fadeIn();
						$('#list_repair_complete').hide();
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
						$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case2');?>/'+c_id);
					}
				},
				'json'
			);
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
		
		$('#force_update_btn').click(function(){
			c_id=$('#case_id').val();
			reason=$('#resolved_reason').val();
			new_status=$('#new_status').val();
			r_notes=$('#resolving_notes').val();
			$.post('<?php echo site_url('adminpanels/case_control/force_update');?>',
				{
					case_id:c_id,
					resolved_reason:reason,
					case_status:new_status,
					resolving_notes:r_notes,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Updated!');
					back_to_dashboard();
				}
			);
		});
		
		$('#create_proposal').click(function(){
			c_id=$('#case_id').val();
			$('#create_proposal_tab').load('<?php echo site_url('adminpanels/proposal_control/create_proposal');?>/'+c_id);
		});
	});
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Search Case</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td><input type="hidden" id="proposal_id_hidden" /><input type="text" id="case_id" name="case_id" style="width:90%;" /></td><td><button id="search_case">Search</button></td></tr>
                
            </table>
        </div>
    </div>
    
    
</div>

<div class="innerbody" style="width:60%;">
	
    <div id="list_repair_complete">
    
    </div>
    
    <div id="tabsnya" class="tabbed_area" style="width:90%;">
    	<ul class="tabs">
        	<li><a href="javascript:void(0);" gototab="#case_detail_tab" class="tab active">Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#part_in_case_tab" class="tab">Used Part</a></li>
            <li><a href="javascript:void(0);" gototab="#create_proposal_tab" class="tab">Proposal</a></li>
            <li><a href="javascript:void(0);" gototab="#log_info_tab" class="tab">Log Info</a></li>
            <li><a href="javascript:void(0);" gototab="#force_update" class="tab">Change Status</a></li>
        </ul>
        <div id="case_detail_tab" class="content_tab">
       		<table class="main_table">
            	<tr><td colspan="2"><span id="warningnya" style="color:#F00;font-weight:bold;text-decoration:blink;"></span></td></tr>
            	<tr><td>Case ID</td><td><input type="text" name="case_id_text" id="case_id_text" /></td></tr>
                <tr><td>Date In</td><td><input type="text" name="create_date_text" id="create_date_text" /></td></tr>
                <tr><td>Customer Name</td><td><input type="text" name="customer_name_text" id="customer_name_text" /></td></tr>
                <tr><td>Phone Number</td><td><input type="text" name="phone_number_text" id="phone_number_text" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number_text" id="serial_number_text" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type_text" id="unit_type_text" /></td></tr>
                <tr><td>Case Type</td><td><input type="text" name="case_type_text" id="case_type_text" /></td></tr>
                <tr><td>Case Status</td><td><input type="text" name="case_status_text" id="case_status_text" /></td></tr>
                <tr><td>Creator</td><td><input type="text" name="creator_text" id="creator_text" /></td></tr>
            </table>
        </div>
        <div id="part_in_case_tab" class="content_tab">
        	
        </div>
        <div id="create_proposal_tab" class="content_tab">
        	<button id="create_proposal">Create Proposal</button>
        </div>
        <div id="log_info_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Add New Log</td></tr>
                <tr><td><textarea name="new_log_entry" id="new_log_entry"></textarea></td></tr>
                <tr><td><button id="submit_log">Add</button></td></tr>
                <tr><td><hr /></td></tr>
                <tr>
                	<td>
                    	<div id="log_details">
                        
                        </div>
                
                	</td>
            </table>
        </div>
        <div id="force_update" class="content_tab">
        	<table class="main_table">
            	<tr><td>Reason</td><td><?php $resolved_reason=array('0'=>'Normal','1'=>'DOA','2'=>'Fulfillment','3'=>'Partshortage','4'=>'Hard Case','5'=>'Operational Problem'); echo form_dropdown('resolved_reason',$resolved_reason,'','id="resolved_reason"');?></td></tr>
                <tr><td>New Status</td><td><?php $new_status=array('11'=>'Ready to Ship','21'=>'Rejected'); echo form_dropdown('new_status',$new_status,'','id="new_status"');?></td></tr>
                <tr><td>Log Info</td><td><textarea name="resolving_notes" id="resolving_notes"></textarea></td></tr>
                <tr><td colspan="2"><button id="force_update_btn">Update Now</button></td></tr>
            </table>
        </div>
    </div>
</div>