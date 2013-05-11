<table class="main_table">
    <tr><th>No</th><th>Case ID</th><th>Engineer</th><th>Unit Type</th><th>Case Type</th><th>TAT</th></tr>
    <?php $i=0; foreach($query as $rows): $i++; ?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->case_id;?></td>
            <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
            <td><?php echo $rows->unit_type;?></td>
            <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
            <td><?php echo timespan($rows->create_date,time());?></td>
        </tr>
    <?php endforeach;?>
</table>