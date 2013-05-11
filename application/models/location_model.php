<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Location_model extends CI_Model {
	var $location_id='';
	var $location_name='';
	var $location_address='';
	
	var $case_id='';
	var $ready_to_transfer_id='';
	var $transfer_status='';
	var $transfer_print_date='';
	
	function get_all()
	{
		$this->db->order_by('location_id');
		$query=$this->db->get('location');
		return $query->result();	
	}
	
	function get_rc()
	{
		$this->db->like('location_id','5','after');
		$query=$this->db->get('location');
		return $query->result();	
	}
	
	function get_by_id($location_id)
	{
		$this->db->where('location_id',$location_id);
		$query=$this->db->get('location');
		return $query->row();	
	}
	
	function get_part_location()
	{
		$this->db->like('location_id','8','after');
		$query=$this->db->get('location');
		return $query->result();	
	}
	
	function get_need_transfer()
	{
		$this->db->where('ready_to_transfer.transfer_status',0);
		$this->db->join('location','location.location_id=ready_to_transfer.location_id');
		$this->db->join('the_case','the_case.case_id=ready_to_transfer.case_id');
		$this->db->order_by('ready_to_transfer.location_id');
		$query=$this->db->get('ready_to_transfer');
		return $query->result();	
	}
	
	function add_to_transfer($case_id,$location_id)
	{
		$this->db->set('case_id',$case_id);
		$this->db->set('location_id',$location_id);
		$this->db->insert('ready_to_transfer');	
	}
}
