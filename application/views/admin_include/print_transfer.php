<html>
	<head>
    	<title>
   		</title>
    </head>
<body>
<style>
	body{
		font-size:12px;	
		font-family:"Courier New", Courier, monospace;
		margin:0;
		
	}
	th{border-bottom:1px solid #000;}
	.berborder td{border-top:1px solid #000;}
	.isinya td{font-size:10px;padding-left:15px;}
</style>
<table style="width:100%;">
	<tr>
    	<th colspan="2">
        	<div align="center">
                <span style="font-size:17px;">Petra Computer</span><br />
                Surat Jalan
            </div>
        </th>
    </tr>
</table>

<table style="width:100%;">
	<tr>
    	<td style="width:50%;">
        	<table>
            	<tr><td>Case ID</td><td>: <strong><?php echo $row->case_id;?></strong></td></tr>
                <tr><td>Unit</td><td>: <?php echo $row->unit_type;?></td></tr>
                <tr><td>Serial Number</td><td>: <?php echo $row->serial_number;?></td></tr>
            </table>
        </td>
        <td style="width:50%;">
        	<table>
            	<tr><td>Kepada</td><td>: <?php echo $row_location->location_name;?></td></tr>
                <tr><td>Address</td><td>: <?php echo $row_location->location_address;?></td></tr>
            </table>
        </td>
    </tr>
   
    <tr><td colspan="2" style="border-bottom:1px solid #000;"></td></tr>
    <tr>
      <td colspan="2">Problem : <br />
   		<?php echo $row->case_problem;?></td></tr>
    <tr><td colspan="2" style="border-bottom:1px solid #000;"></td></tr>
</table>
<br />
<br />
<br />
<br />
<br />

<table style="width:50%;">
	<tr>
    	<td>
        	<div align="center">
         		Received By #<?php echo date('d/m/Y h:i:s');?>
            </div>
        </td>
        <td>
        	<div align="center">
            	Customer
            </div>
        </td>
    </tr>
        
</table>

</body>

</html>