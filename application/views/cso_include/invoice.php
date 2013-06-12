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
		
	}
	th{border-bottom:1px solid #000;}
	.berborder td{border-top:1px solid #000;}
	.isinya td{font-size:10px;padding-left:15px;}
	.atasan td{border-top:1px solid #000;border-bottom:1px solid #000;}
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
	<tr><td>Invoice Number I-<?php echo $proposal_id;?> / <?php echo date('d-m-Y');?><input type="hidden" id="proposal_id_hidden" value="<?php echo $proposal_id;?>" /></td></tr>
</table>

<table style="width:100%;">
	<tr class="atasan"><td>No.</td><td>Item Code</td><td>Item</td><td>Price</td></tr>
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
    <tr><td colspan="4" style="border-bottom:1px solid #000;"></td></tr>
    <tr>
      <td colspan="4">
    <table style="width:100%;">
    <tr><tr><td colspan="2"><?php echo $this->global_model->Terbilang($total_price+$discount+$ppn);?> rupiah</td><td><div align="right">Jumlah :</div></td><td><div align="right"><?php echo number_format($total_price,0,',','.');?></div></td></tr>
    <tr>
      <td rowspan="6"><div align="center">Penerima<br /><br /><br /><br />(...........)</div></td>
      <td rowspan="6"><div align="center">Hormat Kami<br /><br /><br /><br />(...........)</div></td>
      
    
      <td><div align="right">Discount :</div></td><td><div align="right"><?php echo number_format($discount,0,',','.');?></div></td></tr>
    <tr>
      <td><div align="right">PPN :</div></td><td><div align="right"><?php echo number_format($ppn,0,',','.');?></div></td></tr>
    <tr>
      <td><div align="right">Total :</div></td><td><div align="right"><?php echo number_format($total_price+$discount+$ppn,0,',','.');?></div></td></tr>
    <tr>
      <td><div align="right"></div></td><td style="border-bottom:1px solid #000;"></td></tr>
    <tr>
      <td><div align="right">Uang Muka :</div></td><td><div align="right"><?php echo number_format($down_payment,0,',','.');?></div></td></tr>
    <tr>
      <td><div align="right">Bayar :</div></td><td><div align="right"><?php echo number_format($total_price+$discount+$ppn-$down_payment,0,',','.');?></div></td></tr>
    
  	</table>
	</td></tr>  
</table>

<table style="width:100%;">
	<tr>
    	<td style="font-size:9px;">Ketentuan Garansi<br />
        	<ol>
           		<li>Nota berlaku sebagai bukti garansi (wajib ada pada saat klaim garansi).</li>
                <li>Garansi tidak berlaku jika terjadi kesalahan pemakaian/pemasangan/segel rusak.</li>
                <li>Garansi tidak mencakup penggantian unit baru.</li>
                <li>PETRA COMPUTER tidak bertanggung jawab terhadap kehilangan data dalam berbagai hal.</li>
            </ol>
        </td>
    </tr>	
</table>
</div>