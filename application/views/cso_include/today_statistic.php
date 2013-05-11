<script type="text/javascript">
	$(document).ready(function(){
		$('#detail_activity').hide();
		$('.detail_activity').click(function(){
			c_a_id=$(this).attr('idnya');
			$('#detailnya').load('<?php echo site_url('cso/detail_activity');?>/'+c_a_id);
			
			$('#detail_activity').center().show().animate({"left": "+=25px"});
		});
		$('#close_detail_activity').click(function(){
			$('#detail_activity').hide();
		});
		setTimeout(function(){
						generate_scroller();
			},500);
	});
</script>
<div class="innerbody">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">Today Satistic</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><th>No</th><th>Serving Type</th><th>Duration</th><th>Detail</th></tr>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                	<tr>
                    	<td><?php echo $i;?></td>
                        <td><?php echo $this->cso_activity_model->get_activity_type($rows->activity_type);?></td>
                        <td><?php echo timespan($rows->start_time,$rows->end_time);?></td>
                        <td><a href="javascript:void(0);" class="detail_activity" idnya="<?php echo $rows->cso_activity_id;?>">Detail</a></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>
	
        <div id="detail_activity" style="padding:10px;position:fixed;width:300px;height:300px;">
        	<div style="position:absolute;right:10px;top:5px;"><button id="close_detail_activity">X</button></div>
            <div class="dashboard_item">
            	<div class="dashboard_item_title">Detail Activity</div>
                <div class="dashboard_item_content" id="detailnya">
                
                </div>
            </div>
        </div>
