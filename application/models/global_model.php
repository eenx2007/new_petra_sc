<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Global_model extends CI_Model {
	
	function menu_item($image,$wordy,$goto)
	{
		$returnnya='<div class="menu_item" goto="'.$goto.'">';
		$returnnya.='<div class="image_placer">';
		$returnnya.='<img src="';
		$returnnya.='assets/images/'.$image.'" />';
        $returnnya.='</div>
                <div class="text_placer">
                    '.$wordy.'
                </div>
            </div>';
		return $returnnya;
	}
	
	function long_menu_item($color_scheme,$idnya,$imagenya,$wordy,$longtext,$urutdetik)
	{
		$returnnya='<div class="long_menu" style="background:'.$color_scheme.'" id="'.$idnya.'">';
		$returnnya.='<div class="long_menu_image detik_'.$urutdetik.'"><img src="'.base_url().'assets/images/'.$imagenya.'" /></div>';
		$returnnya.='<div class="long_menu_text detik_'.$urutdetik.'">'.$wordy.'</div>';
		$returnnya.='<div class="long_menu_full_text detik_'.$urutdetik.'">'.$longtext.'</div>
		</div>';
		return $returnnya;
	}
	
	function dashboard_item($title,$idnya)
	{
		$returnnya='<div class="dashboard_item">
			<div class="dashboard_item_title">'.$title.'</div>
			<div class="dashboard_item_content" id="'.$idnya.'">
				
			</div>
    	</div>';
		return $returnnya;
	}
	
	function get_all_user()
	{
		$this->db->order_by('sure_name');
		$query=$this->db->get('user');
		return $query->result();	
	}
	
	function get_all_cso()
	{
		$this->db->where('user_type',1);
		$query=$this->db->get('user');
		return $query->result();	
	}
	
	function get_user_type($user_type)
	{
		if($user_type==0)
			$user_type_text="Administrator";
		elseif($user_type==1)
			$user_type_text="Customer Service Officer";
		elseif($user_type==2)
			$user_type_text="System Admin";
		elseif($user_type==3)
			$user_type_text="Engineer";
		elseif($user_type==4)
			$user_type_text="Warehouse Admin";
		elseif($user_type==5)
			$user_type_text="Quality Control";
		elseif($user_type==6)
			$user_type_text="Technical Advisor";
		elseif($user_type==7)
			$user_type_text="Cashier";
		return $user_type_text;
	}
	
	function get_engineer($user_id)
	{
		if($user_id==0)
			return 'Not Assigned';
		else
		{
			$this->db->select('sure_name');
			$this->db->where('user_id',$user_id);
			$query=$this->db->get('user');
			$row=$query->row();
			return $row->sure_name;
		}
	}
	
	function get_all_engineer()
	{
		$this->db->where('user_type',3);
		$query=$this->db->get('user');
		return $query->result();	
	}
	
	function get_case_type($case_type)
	{
		if($case_type==0)
			$returnnya="W";
		else
			$returnnya="OOW";
		return $returnnya;	
	}
	
	function get_case_status($case_status)
	{
		if($case_status==0)
			$statusnya="Unassigned";
		elseif($case_status==1)
			$statusnya="Under Repair";
		elseif($case_status==2)
			$statusnya="Waiting Customer Approval";
		elseif($case_status==3)
			$statusnya="Part to Engineer";
		elseif($case_status==4)
			$statusnya="Part DOA";
		elseif($case_status==5)
			$statusnya="Wrong Part Received";
		elseif($case_status==6)
			$statusnya="Waiting for Invoice";
		elseif($case_status==7)
			$statusnya="Waiting for Escalation";
		elseif($case_status==8)
			$statusnya="Waiting customer approval";
		elseif($case_status==9)
			$statusnya="Under Testing";
		elseif($case_status==10)
			$statusnya="Checking and Test Complete";
		elseif($case_status==11)
			$statusnya="Ready to Ship";
		elseif($case_status==12)
			$statusnya="Closed";
		elseif($case_status==13)
			$statusnya="Partially part processed";
		elseif($case_status==14)
			$statusnya="Awaiting Part";
		elseif($case_status==15)
			$statusnya="Partially part Received";
		elseif($case_status==16)
			$statusnya="Re-Repair";
		elseif($case_status==17)
			$statusnya="RMA Request";
		elseif($case_status==18)
			$statusnya="Need more information";
		elseif($case_status==19)
			$statusnya="Customer Approved";
		elseif($case_status==20)
			$statusnya="Customer Cancelled";
		elseif($case_status==21)
			$statusnya="Rejected";
		elseif($case_status==22)
			$statusnya="Ready to RC Transfer";
		elseif($case_status==23)
			$statusnya="RC Progress";
		return $statusnya;	
	}
	
	function get_request_status($request_status)
	{
		if($request_status==0)
			$statusnya='Waiting Input By Admin';
		elseif($request_status==1)
			$statusnya='Requested by Admin';
		elseif($request_status==2)
			$statusnya='Issued by Warehose';
		elseif($request_status==3)
			$statusnya='Consumed';
		elseif($request_status==4)
			$statusnya='DOA';
		elseif($request_status==5)
			$statusnya='Wrong Part Received';
		elseif($request_status==6)
			$statusnya='Used By Engineer';
		elseif($request_status==7)
			$statusnya='Consumed No Defective';
		elseif($request_status==8)
			$statusnya='Unused';
		elseif($request_status==9)
			$statusnya='Cancelled';
		elseif($request_status==10)
			$statusnya='Part to CSO';
		return $statusnya;	
	}
	
	function Terbilang($satuan){  
		$huruf = array ("", "satu", "dua", "tiga", "empat", "lima", "enam",   
		"tujuh", "delapan", "sembilan", "sepuluh","sebelas");  
		if ($satuan < 12)  
		 return " ".$huruf[$satuan];  
		elseif ($satuan < 20)  
		 return $this->Terbilang($satuan - 10)." belas";  
		elseif ($satuan < 100)  
		 return $this->Terbilang($satuan / 10)." puluh".  
		 $this->Terbilang($satuan % 10);  
		elseif ($satuan < 200)  
		 return "seratus".Terbilang($satuan - 100);  
		elseif ($satuan < 1000)  
		 return $this->Terbilang($satuan / 100)." ratus".  
		 $this->Terbilang($satuan % 100);  
		elseif ($satuan < 2000)  
		 return "seribu".$this->Terbilang($satuan - 1000);   
		elseif ($satuan < 1000000)  
		 return $this->Terbilang($satuan / 1000)." ribu".  
		 $this->Terbilang($satuan % 1000);   
		elseif ($satuan < 1000000000)  
		 return $this->Terbilang($satuan / 1000000)." juta".  
		 $this->Terbilang($satuan % 1000000);   
		elseif ($satuan >= 1000000000)  
		 echo "Angka terlalu Besar";  
		} 
	
	function get_reason($resolved_reason)
	{
		if($resolved_reason==0)
			$statusnya="Normal";
		elseif($resolved_reason==1)
			$statusnya="DOA";
		elseif($resolved_reason==2)
			$statusnya="Fullfilment";
		elseif($resolved_reason==3)
			$statusnya="Partshortage";
		elseif($resolved_reason==4)
			$statusnya="Hard Case";
		elseif($resolved_reason==5)
			$statusnya="Operational Problem";
		return $statusnya;
			
	}
	
	function get_pn($sn)
	{
		$pn1=substr($sn,0,2);
		$pn2=substr($sn,2,5);
		$pn3=substr($sn,7,3);
		return $pn1.'.'.$pn2.'.'.$pn3;	
	}
	
	function get_message_status($message_status)
	{
		if($message_status==0)
			echo "Unread";
		elseif($message_status==1)
			echo "Read / Need to be Followed Up";
		elseif($message_status==2)
			echo "Followed Up";
		elseif($message_status==3)
			echo "Closed";
		elseif($message_status==4)
			echo "Deleted";
	}
	
	function br2nl($string)
	{
		return preg_replace('#<br\s*?/?>#i', "\n", $string); 	
	}
	
	function dirmtime($directory) {
		$last_modified_time = 0;
		$handler = opendir($directory);
		while ($file = readdir($handler)) {
			if(is_file($directory.DIRECTORY_SEPARATOR.$file)){
				$files[] = $directory.DIRECTORY_SEPARATOR.$file;
				$filemtime = filemtime($directory.DIRECTORY_SEPARATOR.$file);
				if($filemtime>$last_modified_time) {
					$last_modified_time = $filemtime;
				}
		}
		}
	
		closedir($handler);
		return $last_modified_time;
	}
	
	function getworkingdays($startDate,$endDate){
	
	
	
		//The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
		//We add one to inlude both dates in the interval.
		$days = ($endDate - $startDate) / 86400;
		
		$no_full_weeks = floor($days / 7);
		$no_remaining_days = fmod($days, 7);
	
		//It will return 1 if it's Monday,.. ,7 for Sunday
		$the_first_day_of_week = date("N", $startDate);
		$the_last_day_of_week = date("N", $endDate);
	
		//---->The two can be equal in leap years when february has 29 days, the equal sign is added here
		//In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
		if ($the_first_day_of_week <= $the_last_day_of_week) {
			if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
			if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
		}
		else {
			// (edit by Tokes to fix an edge case where the start day was a Sunday
			// and the end day was NOT a Saturday)
	
			// the day of the week for start is later than the day of the week for end
			if ($the_first_day_of_week == 7) {
				// if the start date is a Sunday, then we definitely subtract 1 day
				$no_remaining_days--;
	
				if ($the_last_day_of_week == 6) {
					// if the end date is a Saturday, then we subtract another day
					$no_remaining_days--;
				}
			}
			else {
				// the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
				// so we skip an entire weekend and subtract 2 days
				$no_remaining_days -= 2;
			}
		}
	
		//The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
	//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
	   $workingDays = $no_full_weeks * 5;
		if ($no_remaining_days > 0 )
		{
		  $workingDays += $no_remaining_days;
		}
	
		//We subtract the holidays
		
	
		return $workingDays;
		}
	
	

}