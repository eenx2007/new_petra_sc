<script type="application/javascript">
	$(document).ready(function() {
        $('.to_update_case').click(function(){
			c_id=$(this).attr('case_idnya');
			$('.scrolling_item').load('<?php echo site_url('engineer/update_case');?>/'+c_id);
		});
		
    });
</script>
<table class="main_table">
    <tr><th>No</th><th>Case ID</th><th>CSO</th><th>Unit Type</th><th>Case Type</th><th>Status</th></tr>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><a href="javascript:void(0);" case_idnya="<?php echo $rows->case_id;?>" class="to_update_case"><?php echo $rows->case_id;?></a></td>
            <td><?php echo $rows->sure_name;?></td>
            <td><?php echo $rows->unit_type;?></td>
            <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
            <td><?php echo $this->global_model->get_case_status($rows->case_status);?></td>
        </tr>
    <?php endforeach;?>
</table>