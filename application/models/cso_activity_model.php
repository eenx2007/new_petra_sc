<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cso_activity_model extends CI_Model {
	var $cso_activity_id='';
	var $user_id='';
	var $activity_type='';
	var $start_time='';
	var $end_time='';
	var $activity_ref='';
	
	function new_activity()
	{
		$this->db->set('user_id',$this->user_id);
		$this->db->set('activity_type',$this->activity_type);
		$this->db->set('start_time',$this->start_time);
		$this->db->set('end_time',$this->end_time);
		$this->db->set('activity_ref',$this->activity_ref);
		$this->db->insert('cso_activity');	
	}
	
	function get_today()
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->select('activity_type');
		$this->db->select('COUNT(activity_type) as total');
		$this->db->where('start_time >=',$startday);
		$this->db->where('end_time <=',$endday);
		$this->db->group_by('activity_type');
		$query=$this->db->get('cso_activity');
		return $query->result();			
	}
	
	function get_cek_today()
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->where('start_time >=',$startday);
		$this->db->where('end_time <=',$endday);
		$query=$this->db->get('cso_activity');
		return $query->num_rows();
	}
	
	function get_today_by_user($user_id)
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->where('start_time >=',$startday);
		$this->db->where('end_time <=',$endday);
		$this->db->where('user_id',$user_id);
		$query=$this->db->get('cso_activity');
		return $query->result();
	}
	
	function get_by_date($start_date,$end_date)
	{
		$startday=human_to_unix($start_date.' 00:00:00');
		$endday=human_to_unix($end_date.' 23:59:59');
		$this->db->where('start_time >=',$startday);
		$this->db->where('end_time <=',$endday);
		$query=$this->db->get('cso_activity');
		return $query->result();
	}
	
	function get_activity_type($activity_type)
	{
		$kembali='Nothing';
		if($activity_type==0)
			$kembali='Service';
		elseif($activity_type==1)
			$kembali='Collection';
		elseif($activity_type==2)
			$kembali='Consultation';
		elseif($activity_type==3)
			$kembali='Part Request';
		return $kembali;	
	}
	
	function get_statistic_today($present="none")
	{
		$startday=human_to_unix(date('Y-m-d').' 00:00:00');
		$endday=human_to_unix(date('Y-m-d').' 23:59:59');
		$this->db->select('cso_activity.user_id');
		$this->db->select('user.sure_name');
		$this->db->select('COUNT(cso_activity.user_id) as total');
		$this->db->join('user','user.user_id=cso_activity.user_id');
		$this->db->where('cso_activity.start_time >=',$startday);
		$this->db->where('cso_activity.end_time <=',$endday);
		$this->db->group_by('user_id');
		$query=$this->db->get('cso_activity');
		if($present<>"none")
			return $query->num_rows;
		else
			return $query->result();
	}
}