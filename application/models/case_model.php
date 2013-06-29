<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Case_model extends CI_Model {
	var $case_id='';
	var $customer_id='';
	var $serial_number='';
	var $unit_type='';
	var $creator='';
	var $assign_to='';
	var $case_type='';
	var $create_date='';
	var $case_status='';
	var $resolved_reason='';
	var $resolved_date='';
	var $shipping_date='';
	var $shipper='';
	var $symptom='';
	var $completeness='';
	var $case_problem='';
	var $remarks='';
	var $location_id='';
	
	var $case_log_id='';
	var $case_log_date='';
	var $case_log_user='';
	var $case_log_activity='';
	var $log_type='';
	var $log_follow_up='';
	
	function get_case_id()
	{
		$datenya=date('dmy');
		$this->db->like('case_id',$datenya);
		$querycek=$this->db->get('the_case');
		$totalcek=$querycek->num_rows;
		$new_number=$totalcek+1;
		$new_case=$datenya.'-'.$new_number;
		return $new_case;	
	}
	function new_case()
	{
		$this->db->set('case_id',trim($this->case_id));
		$this->db->set('customer_id',$this->customer_id);
		$this->db->set('serial_number',trim($this->serial_number));
		$this->db->set('unit_type',$this->unit_type);
		$this->db->set('creator',$this->creator);
		$this->db->set('case_type',$this->case_type);
		$this->db->set('completeness',$this->completeness);
		$this->db->set('case_problem',$this->case_problem);
		$this->db->set('remarks',$this->remarks);
		$this->db->set('case_status',0);
		$this->db->set('create_date',time());
		$this->db->set('location_id',$this->location_id);
		$this->db->set('last_location_change',time());
		$this->db->insert('the_case');
	}
	
	function get_unassigned($present="none")
	{
		$this->db->where('the_case.case_status',0);
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();	
	}
	
	function get_today($present="none")
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->where('the_case.create_date >=',$startday);
		$this->db->where('the_case.create_date <=',$endday);
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();
	}
	
	function get_by_location($location_id)
	{
		$this->db->where('location_id',$location_id);
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->join('error_code','error_code.error_code=the_case.symptom');
		$query=$this->db->get('the_case');	
		return $query->result();
	}
	
	function get_out_today($presents="none")
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->where('the_case.resolved_date >=',$startday);
		$this->db->where('the_case.resolved_date <=',$endday);
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		if($presents<>"none")
			return $query->num_rows;
		else
			return $query->result();
	}
	
	function get_eng_today($present="none")
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->select('user.sure_name');
		$this->db->select('COUNT(*) as total');
		$this->db->where('the_case.resolved_date >=',$startday);
		$this->db->where('the_case.resolved_date <=',$endday);
		$this->db->group_by('the_case.assign_to');
		$this->db->join('user','user.user_id=the_case.assign_to');
		$query=$this->db->get('the_case');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();	
	}
	
	function assign_case()
	{
		$this->db->set('assign_to',$this->assign_to);
		$this->db->set('case_status',1);
		$this->db->set('symptom',$this->symptom);
		$this->db->set('location_id',$this->location_id);
		$this->db->set('last_location_change',time());
		$this->db->where('case_id',$this->case_id);
		$this->db->update('the_case');	
	}
	
	function update_case($case_id,$case_status,$location_id="none")
	{
		$this->db->set('case_status',$case_status);
		if($location_id<>'none')
		{
			$this->db->set('location_id',$location_id);
			$this->db->set('last_location_change',time());
		}
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');
	}
	
	function transfer_rc($case_id,$case_status,$location_id)
	{
		$this->db->set('location_id',$location_id);
		$this->db->set('case_status','23');
		$this->db->set('last_location_change',time());
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');
	}
	
	function change_location($case_id,$case_status,$location_id)
	{
		$this->db->set('location_id',$location_id);
		$this->db->set('case_status',$case_status);
		$this->db->set('last_location_change',time());
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');
	}
	
	function resolving_case($case_id,$case_status,$resolved_reason)
	{
		$this->db->set('case_status',$case_status);
		$this->db->set('resolved_reason',$resolved_reason);
		$this->db->set('resolved_date',time());
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');
	}
	
	function update_log($case_id,$user_id)
	{
		$this->db->set('case_log_date',time());
		$this->db->set('case_id',$case_id);
		$this->db->set('case_log_user',$user_id);
		$this->db->set('case_log_activity',$this->case_log_activity);
		$this->db->insert('case_log');	
	}
	
	function update_log_from_form($case_id,$user_id)
	{
		$this->db->set('case_log_date',time());
		$this->db->set('case_id',$case_id);
		$this->db->set('case_log_user',$user_id);
		$this->db->set('case_log_activity',$this->case_log_activity);
		$this->db->set('log_type',$this->log_type);
		$this->db->insert('case_log');	
	}
	
	function get_pending($assign_to)
	{
		$this->db->where('the_case.assign_to',$assign_to);
		$this->db->where('the_case.case_status !=',12);
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->join('error_code','error_code.error_code=the_case.symptom');
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$this->db->order_by('the_case.create_date');
		$query=$this->db->get('the_case');
		return $query->result();	
	}
	
	function get_pending_on_hand($assign_to)
	{
		$kembali=array();
		$this->db->where('assign_to',$assign_to);
		$this->db->where('case_status',23);
		$query=$this->db->get('the_case');
		$totalnya=$query->num_rows;
		$kembali['rc_progress']=$totalnya;
		
		$this->db->where('assign_to',$assign_to);
		$this->db->where('case_status !=',12);
		$query=$this->db->get('the_case');
		$totalnya=$query->num_rows;
		$kembali['all_pending']=$totalnya;
		$kembali['on_hand']=$kembali['all_pending']-$kembali['rc_progress'];
		return $kembali;
	}
	
	function get_pending_all()
	{
		$this->db->where('the_case.case_status !=',12);
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->join('error_code','error_code.error_code=the_case.symptom');
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$this->db->join('location','location.location_id=the_case.location_id');
		$this->db->order_by('the_case.create_date');
		$query=$this->db->get('the_case');
		return $query->result();	
	}
	
	function get_ready_rc()
	{
		$this->db->where('the_case.case_status',22);
		$query=$this->db->get('the_case');
		return $query->result();	
	}
	
	function get_by_status($case_status,$present="none")
	{
		$this->db->where('the_case.case_status',$case_status);
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$query=$this->db->get('the_case');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();
	}
	
	function get_under_testing($present="none")
	{
		$this->db->where('the_case.case_status',9);
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();
	}
	
	function get_by_case_id($case_id)
	{
		$this->db->where('the_case.case_id',$case_id);
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->join('error_code','error_code.error_code=the_case.symptom');
		$this->db->join('customer','customer.customer_id=the_case.customer_id');
		$query=$this->db->get('the_case');
		$total=$query->num_rows;
		if($total==0)
			return "error";
		else
			return $query->row();
	}
	
	function get_log($case_id)
	{
		$this->db->where('case_log.case_id',$case_id);
		$this->db->join('user','user.user_id=case_log.case_log_user');
		$this->db->order_by('case_log.case_log_id');
		$query=$this->db->get('case_log');
		return $query->result();
	}
	
	function close_case($case_id,$case_status,$user_id)
	{
		$this->db->set('case_status',$case_status);
		$this->db->set('shipping_date',time());
		$this->db->set('shipper',$user_id);
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');
	}
	
	function search_case($start_date,$end_date)
	{
		if($start_date<>'from')
		{
			$startnya=human_to_unix($start_date.' 00:00:00');
			$endnya=human_to_unix($end_date.' 23:59:59');
			$this->db->where('the_case.create_date >=',$startnya);
			$this->db->where('the_case.create_date <=',$endnya);	
		}
		$this->db->like('the_case.case_id',$this->case_id);
		$this->db->like('the_case.serial_number',$this->serial_number);
		$this->db->like('customer.customer_name',$this->customer_name);
		$this->db->like('customer.customer_phone',$this->phone_number);
		$this->db->join('customer','the_case.customer_id=customer.customer_id');
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		
		return $query->result();
	}
	
	function get_out_case($start_date,$end_date)
	{
		if($start_date<>'from')
		{
			$startnya=human_to_unix($start_date.' 00:00:00');
			$endnya=human_to_unix($end_date.' 23:59:59');
			$this->db->where('the_case.resolved_date >=',$startnya);
			$this->db->where('the_case.resolved_date <=',$endnya);	
		}		
		$this->db->join('user','user.user_id=the_case.creator');
		$query=$this->db->get('the_case');
		return $query->result();	
	}
	
	function get_log_type($log_type)
	{
		if($log_type==0)
			$lognya="Normal Log";
		elseif($log_type==1)
			$lognya="Promise to Customer";
		elseif($log_type==2)
			$lognya="Request From Customer";
		elseif($log_type==3)
			$lognya="Call Log";
		elseif($log_type==4)
			$lognya="Engineering Update";
		elseif($log_type==5)
			$lognya="Resolving Log";
		return $lognya;	
	}
	
	function get_log_follow_up()
	{
		$this->db->where('case_log.log_type !=',0);
		$this->db->where('case_log.log_follow_up',0);
		$this->db->join('user','user.user_id=case_log.case_log_user');
		$query=$this->db->get('case_log');
		return $query->result();	
	}
	
	function get_part_used($case_id)
	{
		$sql="SELECT * FROM (`part_request`) WHERE (`case_id` = '$case_id' AND `request_status` = 3) OR (`case_id` = '$case_id' AND `request_status` = 7)";
		$query=$this->db->query($sql);
		$total=$query->num_rows;
		if($total==0)
			return "None";
		else
		{
			$kembali='';
			$i=0;
			foreach($query->result() as $rows)
			{
				$i++;
				if($i>1)
				{
					if($i<>$total)
						$kembali.=', ';
				}
				$kembali.=$rows->part_number;
				
			}
			return $kembali;
		}
	}
	
	function update_follow_up($case_log_id)
	{
		$this->db->set('log_follow_up',1);
		$this->db->where('case_log_id',$case_log_id);
		$this->db->update('case_log');	
	}
	
	function update_case_detail($case_id)
	{
		$this->db->set('serial_number',$this->serial_number);
		$this->db->set('unit_type',$this->unit_type);
		$this->db->set('case_type',$this->case_type);
		$this->db->set('case_problem',$this->case_problem);
		$this->db->where('case_id',$case_id);
		$this->db->update('the_case');	
	}
	
	function transfer_case($case_id,$assign_to)
	{
		$this->db->query("UPDATE `the_case` SET `assign_to` = '".$assign_to."' WHERE `case_id` =  '".$case_id."'");
	}
	
	function get_by_limit($start,$limit)
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->select('the_case.case_id');
		$this->db->select('user.sure_name');
		$this->db->join('user','user.user_id=the_case.creator');
		$this->db->where('the_case.create_date >=',$startday);
		$this->db->where('the_case.create_date <=',$endday);
		$this->db->order_by('the_case.create_date','DESC');
		$this->db->limit($limit,$start);
		$query=$this->db->get('the_case');
		$kembali='';
		foreach($query->result() as $rows)
		{
			$kembali.="Case ".$rows->case_id." by ".$rows->sure_name."<br />";
		}
		return($kembali);
			
	}
	
	function get_symptom()
	{
		$query=$this->db->get('error_code');
		return $query->result();	
	}
	
	function get_cust_name()
	{
		$this->db->select('customer_name');
		$this->db->group_by('customer_name');
		$this->db->order_by('customer_name');
		$query=$this->db->get('the_case');
		return $query->result();
	}
}