<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
	body{
		font-size:12px;	
		font-family:Courier, monospace;
		font-weight:bold;
		margin:0;
		
	}
	th{border-bottom:1px solid #000;}
	.berborder td{border-top:1px solid #000;}
	.isinya td{font-size:10px;padding-left:15px;}
</style>
<body>
<table style="width:100%;">
	<tr>
    	<th colspan="2">
        	<div align="center">
                <span style="font-size:17px;">Petra Computer</span><br />
                Jl. Masjid No. 24 (Sebelah Utara Alun-alun) Purwokerto<br />
                Telp. (0281)636787,632580 Fax (0281)633153
            </div>
        </th>
    </tr>
</table>
<table style="width:100%;">
	<tr><td>Invoice Number P-<?php echo $proposal_id;?><input type="hidden" id="proposal_id_hidden" value="<?php echo $proposal_id;?>" /></td></tr>
</table>

<table style="width:100%;">
	<tr><th>No.</td><th>Item Code</th><th>Item</th><th>Price</th></tr>
    <?php $i=0;$total_price=0;
		foreach($query as $rows): $i++;?>
    <tr><td><?php echo $i;?></td><td><?php echo $rows->part_released;?></td><td><?php echo $rows->part_name;?></td><td><div align="right"><?php echo number_format($rows->det_price,0,',','.');?></div></td></tr>   
    <?php $total_price=$total_price+$rows->det_price;?>    
    <?php endforeach;?>
    <?php 
		foreach($query2 as $rows2): $i++;?>
    <tr><td><?php echo $i;?></td><td><?php echo $rows2->det_value;?></td><td><?php echo $rows2->part_name;?></td><td><div align="right"><?php echo number_format($rows2->det_price,0,',','.');?></div></td></tr>   
    <?php $total_price=$total_price+$rows2->det_price;?>    
    <?php endforeach;?>
    <tr><td colspan="4"><hr /></td></tr>
    <tr><td colspan="3">Total</td><td><div align="right"><?php echo number_format($total_price,0,',','.');?></div></td></tr>
    
</table>
</body>
</html>