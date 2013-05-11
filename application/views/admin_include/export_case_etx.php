<table class="main_table" id="search_result_table">
            	<thead>
            	<tr>
                	<th>No</th>
                    <th>Case ID</th>
                    <th>Create Date</th>
                    <th>RTS Date</th>
                    <th>Engineer</th>
                    <th>TAT</th>
                    <th>Part Used</th>
                    <th>Serial Number</th>
                    <th>Unit Type</th>
                    <th>Case Type</th>
                    <th>Reason</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; foreach($query as $rows): $i++; ?>
                <tr>
                	<td><?php echo $i;?></td>
                    <td><span style="cursor:pointer;" class="case_detail" idnya="<?php echo $rows->case_id;?>"><?php echo $rows->case_id;?></span></td>
                    <td><?php echo mdate('%m/%d/%Y',$rows->create_date);?></td>
                    <td><?php echo mdate('%m/%d/%Y',$rows->resolved_date);?></td>
                    <td><?php echo $this->global_model->get_engineer($rows->assign_to);?></td>
                    <td><?php echo number_format($this->global_model->getworkingdays($rows->create_date,$rows->resolved_date),2);?></td>
                    <td><?php echo $this->case_model->get_part_used($rows->case_id);?></td>
                    <td><?php echo $rows->serial_number;?></td>
                    <td><?php echo $rows->unit_type;?></td>
                    <td><?php echo $this->global_model->get_case_type($rows->case_type);?></td>
                    <td><?php echo $this->global_model->get_reason($rows->resolved_reason);?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>