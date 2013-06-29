<script type="text/javascript">
	$(document).ready(function(){
		// When a link is clicked
		$('#tabsnya').hide(); 
		lebar=$('#component_detailnya').width('100%');
		$('#component_detailnya').width(lebar-20);
		$('#component_detailnya').height(300);
		$('.active').each(function(){
			content_show=$(this).attr("gototab");
			$(content_show).show();
		});
		
		$('#save_quick_update').click(function(){
			c_id=$('#case_id').val();
			q_update=$('#quick_update').val();
			u_notes=$('#update_notes').val();
			$.post('<?php echo site_url('adminpanels/case_control/quick_update');?>',
				{
					case_id:c_id,
					quick_update:q_update,
					update_notes:u_notes,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Updated!');
					$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/'+c_id);
					$('#update_notes').val('');
				}
			);
		});
		
		<?php if($case_id==0): ?>
			$('#search_case').click(function(){
				c_id=$('#case_id').val();
				do_the_search(c_id);
			});
		<?php else: ?>
			c_id='<?php echo $case_id;?>';
			do_the_search(c_id);
		<?php endif;?>	
			function do_the_search(c_id)
			{
				$('#case_id').val(c_id);
				$.post('<?php echo site_url('adminpanels/case_control/search_case');?>',
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
							$('#case_id_text').val(data.case_id);
							$('#create_date_text').val(data.create_date);
							$('#customer_id_text').val(data.customer_id);
							$('#customer_name_text').val(data.customer_name);
							$('#phone_number_text').val(data.phone_number);
							$('#phone_number2_text').val(data.phone_number2);
							$('#customer_address').val(data.customer_address);
							$('#serial_number_text').val(data.serial_number);
							$('#unit_type_text').val(data.unit_type);
							$('#case_type_text').val(data.case_type_id);
							$('#case_status_text').val(data.case_status);
							$('#engineer_trans').val(data.assign_to);
							$('#creator_text').val(data.creator);
							$('#component_detailnya').attr('src',data.comp_detail);
							$('#symptom').val(data.case_problem);
							$('#remarks_text').val(data.remarks);
							$('#log_details').load('<?php echo site_url('engineers/case_control/get_case_log');?>/'+c_id);
							$('#part_in_case_tab').load('<?php echo site_url('adminpanels/part_control/part_in_case');?>/'+c_id);
						}
					},
					'json'
				);
			}
		
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
		$('#back_to_pending').click(function(){
			$('.scrolling_item').load('<?php echo site_url('adminpanels/case_control/pending_management');?>#tombol_<?php echo $case_id;?>');
		});
		
		$('#update_case_detail').click(function(){
			c_id=$('#case_id_text').val();
			sn=$('#serial_number_text').val();
			u_type=$('#unit_type_text').val();
			c_type=$('#case_type_text').val();
			p_blem=$('#symptom').val();
			$.post('<?php echo site_url('adminpanels/case_control/update_case_detail');?>',
				{
					case_id:c_id,
					serial_number:sn,
					unit_type:u_type,
					case_type:c_type,
					case_problem:p_blem,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Detail is Updated!');
				}
			);
		});
		
		$('#update_customer_detail').click(function(){
			cust_id=$('#customer_id_text').val();
			c_name=$('#customer_name_text').val();
			c_address=$('#customer_address').val();
			c_phone=$('#phone_number_text').val();
			c_phone2=$('#phone_number2_text').val();
			c_id=$('#case_id_text').val();
			$.post('<?php echo site_url('adminpanels/case_control/update_customer_data');?>',
				{
					customer_id:cust_id,
					customer_name:c_name,
					customer_address:c_address,
					customer_phone:c_phone,
					customer_phone2:c_phone2,
					case_id:c_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Customer Data is Updated!');	
				}
			);
		});
		
		$('#trasnfer_rc').click(function(){
			l_id=$('#location_to').val();
			c_id=$('#case_id').val();
			$.post('<?php echo site_url('adminpanels/location_control/transfer_rc');?>',
				{
					case_id:c_id,
					location_id:l_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Transferred to RC!');	
					var windowSizeArray = [ "width=200,height=200",
													"width=300,height=400,scrollbars=yes" ];
					var url = '<?php echo site_url('adminpanels/report_control/print_transfer');?>/'+c_id+'/'+l_id;
					var windowName = "popUp";//$(this).attr("name");
					var windowSize = windowSizeArray[$(this).attr("rel")];
					
					window.open(url, windowName, windowSize);
				}
			);
		});
		
		$('#transfer_engineer').click(function(){
			c_id=$('#case_id').val();
			a_to=$('#engineer_trans').val();
			$.post('<?php echo site_url('adminpanels/case_control/transfer_case');?>',
				{
					case_id:c_id,
					assign_to:a_to,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Transferred!');
				}
			);
		});
		
		$('#under_testing_rc').click(function(){
			c_id=$('#case_id').val();
			$.post('<?php echo site_url('adminpanels/location_control/under_testing_rc');?>',
				{
					case_id:c_id,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Case Transferred!');	
				}
			);
		});
		
		$('.request_part_case').click(function(){
			c_id=$(this).attr('idnya');
			$('.scrolling_item').load('<?php echo site_url('adminpanels/case_control/update_case');?>/'+c_id);
		});
	});
</script>
<div class="innerbody" style="width:30%;" id="group_search_panel">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Search Case</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td><input type="text" id="case_id" name="case_id" style="width:90%;" /></td><td><button id="search_case">Search</button></td></tr>
                <?php if($case_id<>0): ?>
                	<tr><td colspan="2"><button id="back_to_pending">Back to Pending</button></td></tr>
                <?php endif;?>
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:70%;" id="group_result_panel">
	<div class="dashboard_item" id="list_part_requested">
    	<div class="dashboard_item_title">Part Requested by Engineer</div>
        <div class="dasbhoard_item_content">
        	<table class="main_table">
            	<tr><th>No</th><th>Part Request</th><th>Reason</th><th>QTY</th><th>Case ID</th><th>Engineer</th><th>Case Status</th></tr>
                <?php $i=0; foreach($queryreq as $rowsreq): $i++; ?>
                <tr>
                	<td><?php echo $i;?></td>
                    <td><?php echo $rowsreq->part_number;?></td>
                    <td><?php echo $rowsreq->bad_part_sn;?></td>
                   	<td><?php echo $rowsreq->oem_part_sn;?></td>
                   	
                    <td><a href="javascript:void(0);" class="request_part_case" idnya="<?php echo $rowsreq->case_id;?>"><?php echo $rowsreq->case_id;?></a></td>
                    <td><?php echo $rowsreq->sure_name;?></td>
                    <td><?php echo $this->global_model->get_case_type($rowsreq->case_type);?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
    
    <div id="tabsnya" class="tabbed_area" style="width:90%;">
    	<ul class="tabs">
        	<li><a href="javascript:void(0);" gototab="#case_detail_tab" class="tab active">Case Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#customer_detail_tab" class="tab">Customer Detail</a></li>
            <li><a href="javascript:void(0);" gototab="#return_from_rc" class="tab">&lt RC</a></li>
            <li><a href="javascript:void(0);" gototab="#transfer_case_tab" class="tab">Transfer Case</a></li>
            <li><a href="javascript:void(0);" gototab="#part_in_case_tab" class="tab">Part Request</a></li>
            <li><a href="javascript:void(0);" gototab="#log_info_tab" class="tab">Log Info</a></li>
            <li><a href="javascript:void(0);" gototab="#quick_update_tab" class="tab">Change Status</a></li>
        </ul>
        <div id="case_detail_tab" class="content_tab">
       		<table class="main_table">
            	
            	<tr><td style="width:30%;">Case ID</td><td><input type="text" name="case_id_text" id="case_id_text" disabled="disabled" /></td></tr>
                <tr><td>Date In</td><td><input type="text" name="create_date_text" id="create_date_text" disabled="disabled" /></td></tr>
                <tr><td>Serial Number</td><td><input type="text" name="serial_number_text" id="serial_number_text" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type_text" id="unit_type_text" /></td></tr>
                <tr><td>Case Type</td><td><?php $case_type_text=array('0'=>'Warranty','1'=>'Out of Warranty'); echo form_dropdown('case_type_text',$case_type_text,'','id="case_type_text"');?></td></tr>
                <tr><td>Problem</td><td><input type="text" name="symptom" id="symptom" /></td></tr>
                <tr><td>Remarks</td><td><input type="text" name="remarks_text" id="remarks_text" /></td></tr>
                <tr><td>Case Status</td><td><input type="text" name="case_status_text" id="case_status_text" disabled="disabled" style="color:#F00;" /></td></tr>
                <tr><td>Creator</td><td><input type="text" name="creator_text" id="creator_text" disabled="disabled" /></td></tr>
                <tr><td colspan="2"><button id="update_case_detail">Update Case Detail</button></td></tr>
            </table>
        </div>
        <div id="customer_detail_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Customer ID</td><td><input type="text" name="customer_id_text" id="customer_id_text" disabled="disabled" /></td></tr>
                <tr><td>Customer Name</td><td><input type="text" name="customer_name_text" id="customer_name_text" /></td></tr>
                <tr><td>Phone Number</td><td><input type="text" name="phone_number_text" id="phone_number_text" /></td></tr>
                <tr><td>Phone Number 2</td><td><input type="text" name="phone_number2_text" id="phone_number2_text" /></td></tr>
                <tr><td>Address</td><td><textarea id="customer_address" style="width:90%;"></textarea></td></tr>
                <tr><td colspan="2"><button id="update_customer_detail">Update Customer Data</button></td></tr>
            </table>
        </div>
        <div id="return_from_rc" class="content_tab">
        	<table class="main_table">
            	<tr>
                	<td><button id="under_testing_rc">ke Quality Control</button></td>
                </tr>
            </table>
        </div>
        <div id="part_in_case_tab" class="content_tab">
        	
        </div>
        <div id="transfer_case_tab" class="content_tab">
        	<table class="main_table">
            	<tr>
                	<td>Transfer To</td>
                    <td>
						<?php 
							$engineer_trans=array();
							$qengineer=$this->global_model->get_all_engineer();
							foreach($qengineer as $rowsengineer)
							{
								$engineer_trans[$rowsengineer->user_id]=$rowsengineer->sure_name;	
							}
							echo form_dropdown('engineer_trans',$engineer_trans,'','id="engineer_trans"');
						?>
                    </td>
                </tr>
                <tr><td colspan="2"><button id="transfer_engineer">Transfer</button></td></tr>
							
            </table>
        </div>
        <div id="log_info_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>New Log</td></tr>
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
        <div id="quick_update_tab" class="content_tab">
        	<table class="main_table">
            	<tr><td>Update To</td><td><?php $quick_update=array(6=>'Awaiting for Invoice/Proof of Purchase',7=>'Waiting for Escalation',8=>'Awaiting Customer Approval','17'=>'RMA Request','18'=>'Waiting for information','19'=>'Customer Approved','20'=>'Customer Cancel'); echo form_dropdown('quick_update',$quick_update,'','id="quick_update"');?></td></tr>
                <tr><td>Notes</td><td><textarea name="update_notes" id="update_notes"></textarea></td></tr>
                <tr><td colspan="2"><button id="save_quick_update">Update</button></td></tr>
            </table>
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