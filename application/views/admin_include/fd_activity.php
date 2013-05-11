<div class="innerbody">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">My Today Statistic</div>
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