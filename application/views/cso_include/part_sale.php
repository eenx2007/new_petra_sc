<script type="text/javascript">
	$(document).ready(function(e) {
        var all_cust=[<?php echo $customer_namenya;?>];
			$('#customer_name').autocomplete({
				source:all_cust
			});
		$('#temp_invoice').hide();
		
		$('#create_request').click(function(){
			c_name=$('#customer_name').val();
			c_address=$('#customer_address').val();
			p_number=$('#phone_number').val();
			p_number2=$('#phone_number2').val();
			$.post('<?php echo site_url('csos/part_control/create_request');?>',
				{
					customer_name:c_name,
					customer_address:c_address,
					customer_phone:p_number,
					customer_phone2:p_number2,
					user_id:sess_user_id
				},
				function(data)
				{
					$('#temp_invoice').show();
					$('#temp_invoice_detail').load('<?php echo site_url('csos/invoice_control/temp_invoice_detail');?>/'+data);
				}
			);
		});
    });
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" id="search_panel" style="width:90%;">
    	<div class="dashboard_item_title">Customer Info</div>
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

<div class="innerbody" style="width:60%;" id="temp_invoice">
	<div class="dashboard_item" style="width:95%;">
    	<div class="dashboard_item_title">Temporary Invoice</div>
        <div class="dashboard_item_content" id="temp_invoice_detail">
        	
        
        </div>
    </div>
</div>