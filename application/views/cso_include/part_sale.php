<script type="text/javascript">
	$(document).ready(function(e) {
        var all_cust=[<?php echo $customer_namenya;?>];
			$('#customer_name').autocomplete({
				source:all_cust
			});
			
		$('#create_request').click(function(){
			pt_number=$('#part_request').val();
			qty=$('#qty_sale').val();
			p_method=$('#payment_method').val()
			total_dp=$('#total_dp').val();
			
			c_name=$('#customer_name').val();
			c_address=$('#customer_address').val();
			p_number=$('#phone_number').val();
			p_number2=$('#phone_number2').val();
			$.post('<?php echo site_url('csos/part_control/create_request');?>',
				{
					part_number:pt_number,
					request_qty:qty,
					payment_method:p_method,
					total_down_payment:total_dp,
					customer_name:c_name,
					customer_address:c_address,
					customer_phone:p_number,
					customer_phone2:p_number2,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Part Request Saved! Ask warehouse to Continue');
					back_to_dashboard();
				}
			);
		});
    });
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Part Sale</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Part Request</td><td><input type="text" id="part_request" /></td></tr>
                <tr><td>Qty</td><td><input type="text" id="qty_sale" /></td></tr>
                <tr><td>Payment Method</td>
                    	<td><?php
								$payment_method=array('0'=>'Cash','1'=>'Down Payment');
								echo form_dropdown('payment_method',$payment_method,'','id="payment_method"');
							?>
                        </td>
                </tr>
                <tr><td>Total DP</td><td><input type="text" id="total_dp" value="0" /></td></tr>
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:50%;">
	<div class="dashboard_item" style="width:95%;">
    	<div class="dashboard_item_title">Customer Data</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Name</td><td><input type="text" name="customer_name" id="customer_name" style="width:90%;" /></td></tr>
                <tr><td valign="top">Address</td><td><textarea name="customer_address" id="customer_address" style="width:90%;"></textarea></td></tr>
                <tr><td>Phone 1</td><td><input type="text" name="phone_number" id="phone_number" style="width:90%;" /></td></tr>
                <tr><td>Phone 2</td><td><input type="text" name="phone_number2" id="phone_number2" style="width:90%;" /></td></tr>
                <tr><td colspan="2"><button id="create_request">Generate Request</button></td></tr>
            </table>
        
        </div>
    </div>
</div>