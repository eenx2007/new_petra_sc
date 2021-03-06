
<style>

<!-- 
@page
{
    margin:0.6cm 0.6cm 0.6cm 0.6cm; /* Margins: 2.5 cm on each side */
    
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
        	<table>
            	<tr><td colspan="2">Case ID : <strong><?php echo $row->case_id;?></strong></td></tr>
                <tr><td colspan="2"><?php echo $row->customer_name;?><br />
                <?php echo $row->customer_address;?><br />
                <?php echo $row->customer_phone;?> - <?php echo $row->customer_phone2;?></td></tr>
            </table>
        </td>
        <td style="width:50%;">
        	<table>
            	<tr><td>Serial Number</td><td>: <?php echo $row->serial_number;?></td></tr>
                <tr><td>Type</td><td>: <?php if($row->case_type==0) echo "Garansi"; else echo "Tidak Garansi";?></td></tr>
                <tr><td>Unit</td><td>: <?php echo $row->unit_type;?></td></tr>
            </table>
        </td>
    </tr>
    
</table>    
    
    
    
<table style="width:100%;">      
      
    
    <tr><td colspan="4" style="border-bottom:1px solid #000;"></td></tr>
    <tr>
      <td colspan="4">Problem : <?php echo $row->case_problem;?></td></tr>
    
    <tr>
      <td colspan="4">Kelengkapan : <?php echo $row->completeness;?></td></tr>
      <tr><td colspan="4" style="border-bottom:1px solid #000;"></td></tr>
</table>


<table style="width:100%;">
	<tr><td colspan="2"><div align="center">Diterima</div></td><td colspan="2"><div align="center">Diambil</div></td></tr>
    <tr><td colspan="2" style="border:1px solid #000;"><div align="center">TGL ______/______/_________</div></td><td colspan="2" style="border:1px solid #000;"><div align="center">TGL ______/______/_________</div></td></tr>
    <tr><td colspan="4">
<br />
<br />
<br /></td></tr>
	<tr>
    	<td>
        	<div align="center">
         		CSO
            </div>
        </td>
        <td>
        	<div align="center">
            	Customer
            </div>
        </td>
        <td>
        	<div align="center">
         		CSO
            </div>
        </td>
        <td>
        	<div align="center">
            	Customer
            </div>
        </td>
    </tr>
        
</table>
<table style="width:100%;">
	<tr>
    	<td style="font-size:10px;border-top:1px solid #000;">
        	<ol>
            	<li>Lembar ini merupakan pengambilan unit dan harap disimpan dengan baik, segala resiko yang diakibatkan oleh hilangnya lembar ini adalah diluar tanggung jawab PETRA COMPUTER</li>
                <li>PETRA COMPUTER tidak bertanggung jawab terhadap kehilangan data</li>
                <li>Garansi tidak berlaku untuk software dan kerusakan fisik.</li>
                <li>Pelanggan yang menandatangani lembar ini telah memahami dan menyetujui syarat dan ketentuan diatas</li>
                <li>Untuk biaya pengecekan/pembatalan Rp. 25.000</li>
                <li>PETRA COMPUTER tidak bertanggung jawab atas unit service yang tidak diambil dalam waktu 3 bulan sejak tangal penerimaan</li>
                <li>Pelayanan Service dimulai dari pukul 8.00 sampai dengan 16.30</li>
            </ol>
        </td>
    </tr>	
</table>
</div>
