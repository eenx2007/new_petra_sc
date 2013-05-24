<script type="text/javascript">
	$(document).ready(function(e) {
        $('.update_ref').click(function(){
			pr_id=$(this).attr('idnya');
			c_ref=$('#css_ref_'+pr_id).val();
			$.post('<?php echo site_url('csos/part_control/update_css_ref');?>',
				{
					part_request_id:pr_id,
					css_ref:c_ref
				},
				function(data)
				{
					$('#row_ref_'+pr_id).fadeOut('fast');
				}
			);
		});
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Masukkan Nomor Referensi</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><th>Part Request ID</th><th>Part Number</th><th>Serial Number</th><th>Request Date</th><th>CSS Reff</th><th>Update</th></tr>
                <?php foreach($query as $rows): ?>
                	<tr id="row_ref_<?php echo $rows->part_request_id;?>">
                    	<td><?php echo 'G'.$rows->part_request_id;?></td>
                        <td><?php echo $rows->part_number;?></td>
                        <td><?php echo $rows->good_part_sn;?></td>
                        <td><?php echo mdate('%d/%m/%Y %h:%i:%s',$rows->request_date);?></td>
                        <td><input type="text" id="css_ref_<?php echo $rows->part_request_id;?>" /></td>
                        <td><button class="update_ref" idnya="<?php echo $rows->part_request_id;?>">Update</button></td>
                    </tr>
                <?php endforeach;?>
            </table>
        </div>
    </div>
</div>