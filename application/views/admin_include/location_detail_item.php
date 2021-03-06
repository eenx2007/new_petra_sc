<script type="text/javascript">
	$(document).ready(function(e) {
		tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#pending_adm_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true,
				"aaSorting": [[ 4, "desc" ]]
			}
		);
		$('.update_casenya').click(function(){
			c_id=$(this).attr('idnya');
			$('.scrolling_item').load('<?php echo site_url('adminpanels/case_control/update_case');?>/'+c_id);
		});
    });
</script>
<div class="innerbody2">
	<div class="dashboard_item">
        <div class="dashboard_item_content">
        	<table class="main_table" id="pending_adm_table">
            	<thead>
            	<tr>
                    <th>Case ID</th>
                    <th>Tanggal Buat</th>
                    <th>CSO</th>
                    <th>Engineer</th>
                    <th>Lama di Lokasi</th>
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Problem</th>
                    
                    
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
               
                <tr>
                    <td><a href="javascript:void(0);" id="tombol_<?php echo $rows->case_id;?>" class="update_casenya" style="color:#000;" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></a></td>
                    <td><span style="font-size:9px;"><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->create_date,'UP5');?></span></td>
                    <td><?php echo $rows->sure_name;?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo number_format((time()-$rows->last_location_change)/86400,0);?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo $rows->description;?></td>
                   
                    
                </tr>
              
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
	setTimeout(function(){
						generate_scroller();
			},500);
</script>