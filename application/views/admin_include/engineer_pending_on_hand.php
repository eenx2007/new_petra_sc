<table class="main_table">
            	<tr><th>Engineer Name</th><th>On Hand</th><th>RC Progress</th><th>Total Pending</th></tr>
                <?php foreach($queryeng as $rowseng): ?>
                	<tr><td><?php echo $rowseng->sure_name;?></td>
                    <?php $get_pending=$this->case_model->get_pending_on_hand($rowseng->user_id);?>
                    <td><?php echo $get_pending['on_hand'];?></td>
                    <td><?php echo $get_pending['rc_progress'];?></td>
                    <td><?php echo $get_pending['all_pending'];?></td>
                    
                <?php endforeach;?>
            </table>