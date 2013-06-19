
<style>

<!-- 
@page
{
    margin:1cm 1cm 1cm 1cm; /* Margins: 2.5 cm on each side */
    
}
@page Section1 { }
div.Section1 { page:Section1; }
-->
	body{
		font-size:12px;	
		font-family:Courier, monospace;
		font-weight:bold;
		margin:0;
		padding:0;
	}
	th{border-bottom:1px solid #000;}
	.berborder td{border-top:1px solid #000;}
	.isinya td{font-size:10px;padding-left:15px;}
	.atasan td{border-top:1px solid #000;border-bottom:solid 1px #000;}
</style>
<div class="Section1">
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
	<tr>
    	<td style="width:50%;">
        	Kepada YTH<br />
            <?php echo $row->location_name;?><br />
            <?php echo $row->location_address;?>
        </td>
    	<td style="width:50%;">
        	Tanggal : <?php echo date('d-m-Y');?><br />
            Nomor : T-<?php echo $row->transfer_note_id;?>
        </td>
    </tr>
</table>

<table style="width:100%;">
	<tr class="atasan"><td>No</td><td>Nama Barang</td><td>SN</td><td>Kerusakan</td><td>Kelengkapan</td></tr>
    <?php $i=0;
		foreach($query as $rows): $i++;?>
    	<tr>
        	<td><?php echo $i;?></td>
            <td><?php echo $rows->unit_type;?></td>
            <td><?php echo $rows->serial_number;?></td>
            <td><?php echo $rows->case_problem;?></td>
            <td><?php echo $rows->completeness;?></td>
        </tr>    
        
    <?php endforeach;?>
    <tr><td colspan="5" style="border-bottom:solid 1px #000;"></td></tr>
</table>
<br /><br />
<table style="width:100%;">
	<tr>
   	  <td style="width:25%;">
        	<div align="center">
            	Dibuat Oleh <br /><br /><br /><br />
                (.....................)
            </div>
      </td>
        <td style="width:25%;">
        	<div align="center">
            	Bagian Gudang <br /><br /><br /><br />
                (.....................)
            </div>
        </td>
        <td style="width:25%;">
        	<div align="center">
            	Dikirim Oleh <br /><br /><br /><br />
                (.....................)
            </div>
        </td>
        <td style="width:25%;">
        	<div align="center">
            	Diterima Oleh <br /><br /><br /><br />
                (.....................)
            </div>
        </td>
    </tr>
</table>
</div>
