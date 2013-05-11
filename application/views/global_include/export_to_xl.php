<table class="main_table" id="search_result_table">
            	<thead>
            	<tr>
                    <th>Case ID</th>
                    <th>Create Date</th>
                    <th>Creator</th>
                    <th>Engineer</th>
                    <th>Aging</th>
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Customer Name / Phone</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <tr>
                    <td><span style="cursor:pointer;" class="case_detail" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></span></td>
                    <td><span style="font-size:9px;"><?php echo mdate('%d/%m/%Y %H:%i:%s',$rows->create_date,'UP5');?></span></td>
                    <td><?php echo $rows->sure_name;?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo number_format((time()-$rows->create_date)/86400,2);?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo $rows->customer_name;?> / <?php echo $rows->phone_number;?></td>
                    <td><?php echo $this->global_model->get_case_status($rows->case_status);?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>