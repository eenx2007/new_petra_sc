<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Part_request_model extends CI_Model {
	
	var $part_request_id='';
	var $part_number='';
	var $case_id='';
	var $user_id='';
	var $request_date='';
	var $request_status='';
	var $bad_part_sn='';
	var $oem_part_sn='';
	var $css_ref='';
	var $part_released='';
	var $good_part_sn='';
	
	function new_part_request()
	{
		$this->db->set('part_number',$this->part_number);
		$this->db->set('case_id',$this->case_id);
		$this->db->set('user_id',$this->user_id);
		$this->db->set('request_date',time());
		$this->db->set('request_status',0);
		$this->db->set('bad_part_sn',$this->bad_part_sn);
		$this->db->set('oem_part_sn',$this->oem_part_sn);
		$this->db->insert('part_request');
	}
	
	function get_by_case_id($case_id)
	{
		$this->db->where('case_id',$case_id);
		$query=$this->db->get('part_request');
		return $query->result();
	}
	
	function get_by_case_id_for_wh($case_id)
	{
		$this->db->where('case_id',$case_id);
		$this->db->where('request_status',1);
		$query=$this->db->get('part_request');
		return $query->result();	
	}
	
	function get_all()
	{
		$this->db->where('part_request.request_status',0);
		$this->db->join('user','user.user_id=part_request.user_id');
		$this->db->join('the_case','the_case.case_id=part_request.case_id');
		$query=$this->db->get('part_request');
		return $query->result();	
	}
	
	function get_issued()
	{
		$this->db->where('part_request.request_status',1);
		$this->db->join('user','user.user_id=part_request.user_id');
		$query=$this->db->get('part_request');
		return $query->result();
	}
	
	function get_awaiting()
	{
		$this->db->where('part_request.request_status',1);
		$this->db->join('user','user.user_id=part_request.user_id');
		$this->db->join('the_case','the_case.case_id=part_request.case_id');
		$query=$this->db->get('part_request');
		return $query->result();
	}
	
	function get_by_status($request_status)
	{
		$this->db->where('part_request.request_status',$request_status);
		$this->db->join('user','user.user_id=part_request.user_id');
		$this->db->join('the_case','the_case.case_id=part_request.case_id');
		$query=$this->db->get('part_request');
		return $query->result();
	}
	
	function get_issued_to_fd()
	{
		$this->db->where('part_request.bad_part_sn','part_sell');
		$this->db->join('user','user.user_id=part_request.user_id');
		$query=$this->db->get('part_request');
		return $query->result();
	}
	
	function update_part_request($part_request_id)
	{
		$this->db->set('css_ref',$this->css_ref);
		$this->db->set('request_status',1);
		$this->db->where('part_request_id',$part_request_id);
		$this->db->update('part_request');	
	}
	
	function release_part($part_request_id)
	{
		$this->db->where('part_request_id',$part_request_id);
		$this->db->set('part_releaseD',$this->part_released);
		$this->db->set('good_part_sn',$this->good_part_sn);
		$this->db->set('request_status',2);
		$this->db->update('part_request');
	}
	
	function cek_released($case_id)
	{
		$this->db->where('case_id',$case_id);
		$this->db->where('request_status',1);
		$query=$this->db->get('part_request');
		return $query->num_rows;
	}
	
	function update_part_use($part_request_id,$request_status)
	{
		$this->db->set('request_status',$request_status);
		$this->db->where('part_request_id',$part_request_id);
		$this->db->update('part_request');
	}
	
	function delete_request($part_request_id)
	{
		$this->db->where('part_request_id',$part_request_id);
		$this->db->delete('part_request');	
	}
	
	function part_to_cso()
	{
		$this->db->set('part_number',$this->part_number);
		$this->db->set('part_released',$this->part_number);
		$this->db->set('good_part_sn',$this->good_part_sn);
		$this->db->set('request_date',time());
		$this->db->set('user_id',$this->user_id);
		$this->db->set('request_status',10);
		$this->db->insert('part_request');
		return $this->db->insert_id();
	}
	
	function get_by_me($user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('css_ref','');
		$query=$this->db->get('part_request');
		return $query->result();	
	}
}