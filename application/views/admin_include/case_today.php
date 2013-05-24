<script type="text/javascript">
	$(document).ready(function() {
        var availableTags = [
			<?php echo $symptomnya;?>
		];
		$('.symptom_list').autocomplete({
			source: availableTags
		});
		$('.dashboard_item_title').width($('.dashboard_item').width()-20);
		$('.update_case').click(function(){
			c_idnya=$(this).attr('case_idnya');
			n_stat=1;
			eng=$('#engineer_'+c_idnya).val();
			symnya=$('#symptom_'+c_idnya).val();
			$.post('<?php echo site_url('adminpanels/case_control/assign_case');?>',
				{
					case_id:c_idnya,
					case_status:n_stat,
					symptom:symnya,
					assign_to:eng,
					user_id:sess_user_id
				},
				function(data)
				{
					$('.scrolling_item').load('<?php echo site_url('adminpanels/case_control/case_today');?>');
				}
			);
		});
		
		$('.trnyaubah').hover(
			function(){
				$(this).css('background','#2F009B');	
			},
			function(){
				$(this).css('background','#25007D');
			}
		);
		
		$('#save_all').click(function(){
			$('.update_case').each(function() {
                c_idnya=$(this).attr('case_idnya');
				n_stat=1;
				eng=$('#engineer_'+c_idnya).val();
				symnya=$('#symptom_'+c_idnya).val();
				$.post('<?php echo site_url('adminpanels/case_control/assign_case');?>',
					{
						case_id:c_idnya,
						case_status:n_stat,
						assign_to:eng,
						symptom:symnya,
						user_id:sess_user_id
					},
					function(data)
					{
						$('.scrolling_item').load('<?php echo site_url('adminpanels/case_control/case_today');?>');
					}
				);
            });
		});
    });
</script>

<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title" style="float:left;width:100%;">
        	<div style="width:30%;float:left;">Case Today</div>
            <div style="width:30%;float:right;text-align:right;"><button id="save_all">Save All</button></div>
        </div>
        <div class="dashboard_item_content" style="clear:both;">
            <table class="main_table">
                <tr><th>No</th><th>Case ID</th><th>Type</th><th>Serial Number</th><th>Customer Name</th><th>Unit Type</th><th>Cust Info</th><th>Assign to</th><th>OK</th></tr>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                    <tr title="<?php echo $rows->completeness;?>" class="trnyaubah">
                        <td><?php echo $i;?></td>
                        <td><?php echo $rows->case_id;?></td>
                        <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                        
                        <td><?php echo $rows->serial_number;?></td>
                        <td><?php echo $rows->customer_name;?></td>
                        <td><?php echo $rows->unit_type;?></td>
                        <td><?php echo $rows->case_problem;?></td>
                        
                        <td>
							<?php
								if($rows->assign_to==0) 
									echo form_dropdown('assign_to',$listeng,$rows->assign_to,'id="engineer_'.$rows->case_id.'"');
								else
									echo $this->global_model->get_engineer($rows->assign_to);
							?>
                        </td>
                        <td><?php if($rows->assign_to==0): ?><button class="update_case" case_idnya="<?php echo $rows->case_id;?>">OK</button><?php endif;?></td>
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