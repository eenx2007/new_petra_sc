<script type="text/javascript">
	$(document).ready(function(e) {
		$('#search_result').hide();
        $('#show_item').click(function(){
			$('#search_panel').hide();
			location_id=$('#location_id').val();
			$('#search_result').show();
			$('#search_result').load('<?php echo site_url('adminpanels/location_control/location_detail_item');?>?location_id='+location_id);
		});
    });
</script>

<div class="innerbody2" id="search_panel">
	<div class="dashboard_item">
    	<div class="dashboard_item_title">Manajemen Lokasi Unit</div>
        <div class="dashboard_item_content">
        	<table class="main_table">
            	<tr>
                	<td>Pilih Lokasi</td>
                    <td>
                    	<?php 
						$location_id=array();
						foreach($query as $rows)
						{
							$location_id[$rows->location_id]=$rows->location_id.' - '.$rows->location_name;
								
						}
						echo form_dropdown('location_id',$location_id,'','id="location_id"');
						?>
                    </td>
                    <td><button id="show_item">Show</button></td>
                </tr>
            </table>
        </div>
        
    </div>
</div>

<div class="innerbody2" id="search_result">

</div>