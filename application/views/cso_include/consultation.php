<script type="text/javascript">
	$(document).ready(function() {
		start_timenya='<?php echo time();?>';
        $('#save_consultation').click(function(){
			c_notes=$('#consultation_notes').val();
			$.post('<?php echo site_url('cso/save_consultation');?>',
				{
					consultation_notes:c_notes,
					start_time:start_timenya,
					user_id:sess_user_id
				},
				function(data)
				{
					message_alert('Consultation Date Saved! Thank You');
					clearTimeout(perulangan);
					back_to_dashboard();
						
				}
			);
		});
		
		$('#cancel_consultation').click(function(){
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
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Consultation</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td><textarea style="height:200px;" id="consultation_notes"></textarea></td></tr>
                <tr><td><button id="save_consultation">Save</button> <button id="cancel_consultation">Cancel</button></td></tr>
            </table>
        </div>
    </div>
    
    <div class="dashboard_item">
    	<div class="dashboard_item_title">Creating Information</div>
        <div class="dashboard_item_content" style="text-align:center;">
        	
            
            <span id="time_elapsed"></span>

        </div>
    </div>
</div>