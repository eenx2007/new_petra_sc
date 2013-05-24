<script type="text/javascript">
	$(document).ready(function() {
		
		$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/<?php echo $row->case_id;?>');
		$('#part_in_case_tab').load('<?php echo site_url('engineers/part_control/part_in_case');?>/<?php echo $row->case_id;?>');
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
		
		$('#close_window').click(function(){
			$('.over_screen').hide();
		});
		$('#re_print').click(function(){
			c_id=$('#case_id_text').val();
			var windowSizeArray = [ "width=200,height=200",
											"width=300,height=400,scrollbars=yes" ];
					var url = '<?php echo site_url('csos/report_control/print_srf');?>/'+c_id;
					var windowName = "popUp";//$(this).attr("name");
					var windowSize = windowSizeArray[$(this).attr("rel")];
					
					window.open(url, windowName, windowSize);
		});
    });
</script>
<div style="position:absolute;right:5px;top:5px;"><button id="close_window">X</button></div>
<div class="over_screen_title">Case Detail</div>
<div class="over_screen_content">
    <div id="tabsnya" class="tabbed_area" style="width:95%;border:none;">
    	<ul class="tabs">
        	<li><a href="javascript:void(0);" gototab="#case_detail_tab" class="tab active">Case Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#part_in_case_tab" class="tab">Part in Case</a></li>
            <li><a href="javascript:void(0);" gototab="#log_info_tab" class="tab">Log Info</a></li>
            
        </ul>
        <div id="case_detail_tab" class="content_tab">
       		<table class="main_table">
            	<tr><td width="300">Case ID</td><td><input type="text" name="case_id_text" id="case_id_text" value="<?php echo $row->case_id;?>" /></td></tr>
                <tr><td>Date In</td><td><input type="text" name="create_date_text" id="create_date_text" value="<?php echo mdate('%d/%m/%Y %H:%i:%s',$row->create_date);?>" /></td></tr>
                <tr><td>Name</td><td><input type="text" name="customer_name_text" id="customer_name_text" value="<?php echo $row->customer_name;?>" /></td></tr>
                <tr><td>Phone</td><td><input type="text" name="phone_number_text" id="phone_number_text" value="<?php echo $row->customer_phone;?>" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number_text" id="serial_number_text" value="<?php echo $row->serial_number;?>" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type_text" id="unit_type_text" value="<?php echo $row->unit_type;?>" /></td></tr>
                <tr><td>Case Type</td><td><input type="text" name="case_type_text" id="case_type_text" value="<?php echo $this->global_model->get_case_type($row->case_type);?>" /></td></tr>
                <tr><td>Status</td><td><input type="text" name="case_status_text" id="case_status_text" style="font-weight:bold;" value="<?php echo $this->global_model->get_case_status($row->case_status);?>" /></td></tr>
                <tr><td>CSO</td><td><input type="text" name="creator_text" id="creator_text" value="<?php echo $row->sure_name;?>" /></td></tr>
                <tr><td>Engineer</td><td><input type="text" name="engineer_text" id="engineer_text" value="<?php echo $this->global_model->get_engineer($row->assign_to);?>" /></td></tr>
                <tr><td colspan="2"><button id="re_print">Re-Print SRF</button></td></tr>
            </table>
        </div>
        <div id="part_in_case_tab" class="content_tab">
        	
        </div>
        <div id="log_info_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Log Info</td></tr>
                <tr><td><textarea name="new_log_entry" id="new_log_entry"></textarea></td></tr>
                <tr><td><?php $log_type=array(0=>'Normal Log',1=>'Promise to Customer',2=>'Request from Customer',3=>'Call Log',4=>'Engineering Update'); echo form_dropdown('log_type',$log_type,'','id="log_type"');?></td></tr>
                <tr><td><button id="submit_log">Add Log</button></td></tr>
                <tr><td><hr /></td></tr>
                <tr>
                	<td>
                    	<div id="log_details">
                        
                        </div>
                
                	</td>
            </table>
        </div>
       
    </div>
</div>