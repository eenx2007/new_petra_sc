<script type="text/javascript">
	$(document).ready(function(){
		// When a link is clicked
		start_timenya='<?php echo time();?>';
		$('#tabsnya').hide();
		$('#old_style_data').hide(); 
		$('.active').each(function(){
			content_show=$(this).attr("gototab");
			$(content_show).show();
		});
		
		$('#search_case').click(function(){
			c_id=$('#case_id').val();
			$.post('<?php echo site_url('engineer/search_case');?>',
				{
					case_id:c_id
				},
				function(data)
				{
					if(data.error==1)
					{
						message_alert('Case not found, please continue with old style data');
						$('#old_style_data').show();
					}
					else if(data.error==0)
					{
						
						$('#list_part_requested').hide();
						$('#tabsnya').fadeIn();
						$('#case_id_text').val(data.case_id);
						$('#create_date_text').val(data.create_date);
						$('#customer_name_text').val(data.customer_name);
						$('#phone_number_text').val(data.phone_number);
						$('#serial_number_text').val(data.serial_number);
						$('#unit_type_text').val(data.unit_type);
						$('#case_type_text').val(data.case_type);
						$('#case_status_text').val(data.case_status);
						$('#creator_text').val(data.creator);
						$('#log_details').load('<?php echo site_url('engineer/get_case_log');?>/'+c_id);
						$('#part_in_case_tab').load('<?php echo site_url('admin_panel/part_in_case2');?>/'+c_id);
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
		});
		
		$('#force_close_btn').click(function(){
			c_id=$('#case_id').val();
			new_status=$('#new_status').val();
			ship_note=$('#ship_note').val();
			$.post('<?php echo site_url('cso/force_close');?>',
				{
					case_id:c_id,
					case_status:new_status,
					shipping_note:ship_note,
					user_id:sess_user_id,
					start_time:start_timenya,
					sure_name:sess_sure_name
				},
				function(data)
				{
					message_alert('Case Closed! Thank You');
					clearTimeout(perulangan);
					back_to_dashboard();
				}
			);
		});
		
		$('#submit_old_style').click(function(){
			notes=$('#old_style_notes').val();
			$.post('<?php echo site_url('cso/save_old_style');?>',
				{
					old_style_notes:notes,
					user_id:sess_user_id,
					start_time:start_timenya
				},
				function(data)
				{
					message_alert('Notes saved! Thank You');
					back_to_dashboard();
				}
			);
		});
		
		$('#cancel_search').click(function(){
			clearTimeout(perulangan);
			$('.scrolling_content').load('<?php echo site_url('cso/cancel_case');?>');
			back_to_dashboard();
		});
		
		$('#generate_invoice').click(function(){
			c_id=$('#case_id_text').val();
			$('#invoice_tab').load('<?php echo site_url('cso/generate_invoice');?>/'+c_id);
		});
	});
	if(perulangan!="nothing")
		clearTimeout(perulangan);
	ambilselisih();
	var mulainya=new Date().getTime();
	function ambilselisih()
	{
			sekarang=new Date().getTime();
			
			var diff=new Date((sekarang - (7*3600000)) - mulainya);
			jam=diff.getHours();
			if(jam<10)
				jam="0"+jam;
			menit=diff.getMinutes();
			if(menit<10)
				menit="0"+menit;
			detik=diff.getSeconds();
			if(detik<10)
				detik="0"+detik;
			$('#time_elapsed').html(jam+' '+menit+' '+detik);
			
			perulangan=setTimeout(ambilselisih,1000);
	}
</script>
<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Search Case</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td><input type="text" id="case_id" name="case_id" style="width:90%;" /></td><td><button id="search_case">Search</button> <button id="cancel_search">Cancel</button></td></tr>
                
            </table>
        </div>
    </div>
    <div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Information</div>
        <div class="dashboard_item_content" style="text-align:center;">
        	
            
            <span id="time_elapsed"></span>

        </div>
    </div>
    
</div>

<div class="innerbody" style="width:60%;">
	<div id="old_style_data" class="dashboard_item">
    	<div class="dashboard_item_title">Collection Case from Old Database</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Notes</td><td><textarea name="old_style_notes" id="old_style_notes"></textarea></td></tr>
                <tr><td colspan="2"><button id="submit_old_style">Simpan</button></td></tr>
            </table>
        </div>
    	
    </div>	
    
    <div id="tabsnya" class="tabbed_area" style="width:90%;">
    	<ul class="tabs">
        	<li><a href="javascript:void(0);" gototab="#case_detail_tab" class="tab active">Case Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#part_in_case_tab" class="tab">Part in Case</a></li>
            <li><a href="javascript:void(0);" gototab="#invoice_tab" class="tab">Invoice</a></li>
            <li><a href="javascript:void(0);" gototab="#log_info_tab" class="tab">Log Info</a></li>
            <li><a href="javascript:void(0);" gototab="#force_close" class="tab">Change Status</a></li>
        </ul>
        <div id="case_detail_tab" class="content_tab">
       		<table class="main_table">
            	<tr><td>Case ID</td><td><input type="text" name="case_id_text" id="case_id_text" /></td></tr>
                <tr><td>Date In</td><td><input type="text" name="create_date_text" id="create_date_text" /></td></tr>
                <tr><td>Customer Name</td><td><input type="text" name="customer_name_text" id="customer_name_text" /></td></tr>
                <tr><td>Phone Number</td><td><input type="text" name="phone_number_text" id="phone_number_text" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number_text" id="serial_number_text" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type_text" id="unit_type_text" /></td></tr>
                <tr><td>Case Type</td><td><input type="text" name="case_type_text" id="case_type_text" /></td></tr>
                <tr><td>Status</td><td><input type="text" name="case_status_text" id="case_status_text" /></td></tr>
                <tr><td>CSO</td><td><input type="text" name="creator_text" id="creator_text" /></td></tr>
            </table>
        </div>
        <div id="part_in_case_tab" class="content_tab">
        	
        </div>
        <div id="invoice_tab" class="content_tab">
        	<button id="generate_invoice">Generati Invoice</button>
        </div>
        <div id="log_info_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Log Info</td></tr>
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
        <div id="force_close" class="content_tab">
        	<table class="main_table">
            	<tr><td>Log Info</td><td><textarea name="ship_note" id="ship_note"></textarea></td></tr>
                <tr><td>New Status</td><td><?php $new_status=array('12'=>'Close'); echo form_dropdown('new_status',$new_status,'','id="new_status"');?></td></tr>
                <tr><td colspan="2"><button id="force_close_btn">Save</button></td></tr>
            </table>
        </div>
    </div>
</div>