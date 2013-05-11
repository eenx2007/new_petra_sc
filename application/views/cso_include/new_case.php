<script type="text/javascript">
	$(document).ready(function() {
		var all_cust=[<?php echo $customer_namenya;?>];
			$('#customer_name').autocomplete({
				source:all_cust
			});
        $('#save_case').click(function(){
			var start_timenya='<?php echo time();?>';
			
			s_number=$('#serial_number').val();
			c_name=$('#customer_name').val();
			c_address=$('#customer_address').val();
			p_number=$('#phone_number').val();
			p_number2=$('#phone_number2').val();
			u_type=$('#unit_type').val();
			c_type=$('#case_type').val();
			cplt=$('#completeness').val();
			c_problem=$('#case_problem').val();
			rmrks=$('#remarks').val()
			$.post('<?php echo site_url('cso/save_case');?>',
				{
					serial_number:s_number,
					customer_name:c_name,
					customer_address:c_address,
					customer_phone:p_number,
					customer_phone2:p_number2,
					unit_type:u_type,
					case_type:c_type,
					completeness:cplt,
					case_problem:c_problem,
					remarks:rmrks,
					start_date:start_timenya,
					user_id:sess_user_id
				},
				function(data)
				{
					clearTimeout(perulangan);
					var windowSizeArray = [ "width=200,height=200",
											"width=300,height=400,scrollbars=yes" ];
					var url = '<?php echo site_url('cso/print_srf');?>/'+data.case_id;
					var windowName = "popUp";//$(this).attr("name");
					var windowSize = windowSizeArray[$(this).attr("rel")];
					
					window.open(url, windowName, windowSize);
					back_to_dashboard();				
				},
				'json'

			);
		});
		
		$('#cancel_case').click(function(){
			clearTimeout(perulangan);
			$('.scrolling_content').load('<?php echo site_url('cso/cancel_case');?>');
			back_to_dashboard();	
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
<div class="innerbody">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Customer Data</div>
        <div class="dashboard_item_content" style="text-align:center;">
        	<table class="main_table">
            	<tr><td>Name</td><td><input type="text" name="customer_name" id="customer_name" style="width:90%;" /></td></tr>
                <tr><td valign="top">Address</td><td><textarea name="customer_address" id="customer_address" style="width:90%;"></textarea></td></tr>
                <tr><td>Phone 1</td><td><input type="text" name="phone_number" id="phone_number" style="width:90%;" /></td></tr>
                <tr><td>Phone 2</td><td><input type="text" name="phone_number2" id="phone_number2" style="width:90%;" /></td></tr>
            </table>
            <span id="time_elapsed"></span>
        </div>
    </div>
</div>
<div class="innerbody">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Unit Information</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>Serial Number</td><td><input type="text" name="serial_number" id="serial_number" style="width:90%;" /></td></tr>
                <tr><td>Unit Type</td><td><input type="text" name="unit_type" id="unit_type" style="width:90%;" /></td></tr>
                <tr><td>Case Type</td><td><?php $case_type=array('0'=>'Garansi','1'=>'Tidak Garansi'); echo form_dropdown('case_type',$case_type,'','id="case_type"');?></td></tr>
                <tr><td>Completeness</td><td><textarea name="completeness" id="completeness" style="width:90%;height:100px;"></textarea></td></tr>
                <tr><td>Problem</td><td><textarea name="case_problem" id="case_problem" style="width:90%;"></textarea></td></tr>
                <tr><td>Additional Info</td><td><input type="text" name="remarks" id="remarks" style="width:90%;" /></td></tr>
                <tr><td colspan="2"><button id="save_case">Save and Print</button> <button id="cancel_case">Cancel</button></td></tr>
            </table>
            
            

        </div>
    </div>
</div>