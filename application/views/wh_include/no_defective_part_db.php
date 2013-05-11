<table class="main_table">
    <tr><th>No</th><th>Part Number</th><th>Case ID</th><th>Engineer</th><th>Date</th></tr>
    <?php $i=0; foreach($querynodef as $rowsreq): $i++; ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $rowsreq->part_number;?></td>
        <td><?php echo $rowsreq->case_id;?></td>
        <td><?php echo $rowsreq->sure_name;?></td>
        <td><?php echo mdate('%d/%m/%Y %H:%i:%s',$rowsreq->request_date);?></td>
    </tr>
    <?php endforeach;?>
</table>