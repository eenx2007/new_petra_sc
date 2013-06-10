<script type="text/javascript">
	$(document).ready(function(e) {
		$('#need_to_be_issued').load('<?php echo site_url('whpanels/part_control/issued_to_fd');?>');
        $('#give_part').click(function(){
			u_id=$('#user_id').val();
			p_released=$('#part_released').val();
			g_sn=$('#good_part_sn').val();
			$.post('<?php echo site_url('wh_panel/give_part_cso');?>',
				{
					user_id:u_id,
					part_released:p_released,
					good_part_sn:g_sn	
				},
				function(data)
				{
					message_alert_stop('Request Part ID is '+data.part_request_id);
					$('#part_released').val('');
					$('#good_part_sn').val('');
					$('#need_to_be_issued').load('<?php echo site_url('wh_panel/issued_to_fd');?>');
				},
				'json'
			);
		});
    });
</script>

<div class="innerbody" style="width:40%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">New Part Sale</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr>
                	<td>CSO</td>
                    <td><?php
							$user_id=array();
							$queryu=$this->global_model->get_all_cso();
							foreach($queryu as $rowsu)
							{
								$user_id[$rowsu->user_id]=$rowsu->sure_name;	
							}
							echo form_dropdown('user_id',$user_id,'','id="user_id"');
						?>
                    </td>
                </tr>
                <tr><td>Part Number</td><td><input type="text" name="part_released" id="part_released" /></td></tr>
                <tr><td>Part SN</td><td><input type="text" name="good_part_sn" id="good_part_sn" /></td></tr>
                <tr><td colspan="2"><button id="give_part">Give Part</button></td></tr> 
            </table>
        </div>
    </div>
</div>

<div class="innerbody" style="width:60%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Part Request By CSO</div>
        <div class="dashboard_item_content" id="need_to_be_issued">
        	
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