<script type="text/javascript">
	$(document).ready(function(e) {
        $('.update_case').click(function(){
			c_id=$(this).attr('case_idnya');
			l_id=$('#location_id_'+c_id).val();
	
			$.post('<?php echo site_url('adminpanels/location_control/rc_process');?>',
				{
					case_id:c_id,
					location_id:l_id	
				},
				function(data)
				{
					$('.scrolling_item').load('<?php echo site_url('adminpanels/location_control/rc_preparation');?>');
				}
			);
		});
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title" style="float:left;width:100%;">
        	<div style="width:30%;float:left;">RC Preparation</div>
            <div style="width:30%;float:right;text-align:right;"><button id="save_all">Save All</button></div>
        </div>
        <div class="dashboard_item_content" style="clear:both;">
            <table class="main_table">
                <tr><th>No</th><th>Case ID</th><th>Type</th><th>Problem</th><th>Serial Number</th><th>Unit Type</th><th>Send To</th><th>OK</th></tr>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $rows->case_id;?></td>
                        <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                        <td>
                        	<?php echo $rows->case_problem;?>
                        </td>
                        <td><?php echo $rows->serial_number;?></td>
                        
                        <td><?php echo $rows->unit_type;?></td>
                        
                        
                        <td>
							<?php
								$loc_id=$this->location_model->get_rc();
								$location_id=array('0'=>"Pick One");
								foreach($loc_id as $rowsloc)
								{
									$location_id[$rowsloc->location_id]=$rowsloc->location_name;	
								}
								echo form_dropdown('location_id',$location_id,'','id="location_id_'.$rows->case_id.'"');
							?>
                        </td>
                        <td><button class="update_case" case_idnya="<?php echo $rows->case_id;?>">Ship</button></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        setTimeout(function(){
						generate_scroller();
			},500);
    });
</script>