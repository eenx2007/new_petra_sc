<script type="text/javascript">
	$(document).ready(function(e) {
        tinggi_new=36+18+18.5;
		tinggi_scroll=$('.bodyall').height()-tinggi_new;
        $('#location_table').dataTable(
			{
				"sDom": '<"top"if>rt',
				"bPaginate": false,
				"bLengthChange": false,
				"sScrollY": tinggi_scroll+"px",
				"bScrollCollapse": true
			}
		);
		
		$('#save_new_location').click(function(){
			l_id=$('#location_id').val();
			l_name=$('#location_name').val();
			l_address=$('#location_address').val();
			$.post('<?php echo site_url('adminpanels/location_control/add_new');?>',
				{
					location_id:l_id,
					location_name:l_name,
					location_address:l_address
				},
				function(data)
				{
					$('.scrolling_item').load('<?php echo site_url('adminpanels/location_control/rc_management');?>');
				}
			);
		});
    });
</script>
<div class="innerbody2" style="width:30%;">
	<div class="dashboard_item" style="width:90%;">
    	<div class="dashboard_item_title">
        	Add New RC
        </div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr><td>RC Code</td><td><input type="text" id="location_id" /></td></tr>
                <tr><td>RC Name</td><td><input type="text" id="location_name" /></td></tr>
                <tr><td>Location Address</td><td><textarea id="location_address" style="width:90%;"></textarea></td></tr>
                <tr><td colspan="2"><div align="right"><button id="save_new_location">Save</button></div></td></tr>
            </table>
        </div>
    </div>
</div>
<div class="innerbody2" style="width:70%;">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">
        	RC Management
            
        </div>
        <div class="dashboard_item_content" style="clear:both;">
        	<table class="main_table" id="location_table">
            	<thead>
                	<tr><th>RC ID</th><th>RC Name</th><th>RC Address / Phone</th><th>Action</th></tr>
                </thead>
                <tbody>
                	<?php foreach($query as $rows): ?>
                    	<tr>
                        	<td><?php echo $rows->location_id;?></td>
                            <td><?php echo $rows->location_name;?></td>
                            <td><?php echo $rows->location_address;?></td>
                            <td><button class="edit_location">Edit</button></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>