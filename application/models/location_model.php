<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Location_model extends CI_Model {
	var $location_id='';
	var $location_name='';
	var $location_address='';
	
	var $case_id='';
	var $ready_to_transfer_id='';
	var $transfer_status='';
	var $transfer_print_date='';
	
	var $transfer_note_id='';
	var $transfer_note_date='';
	var $shipping_note='';
	
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
	
	function add_transfer_note()
	{
		$this->db->set('transfer_note_date',time());
		$this->db->set('location_id',$this->location_id);
		$this->db->set('shipping_note',$this->shipping_note);
		$this->db->insert('transfer_note');
		return $this->db->insert_id();	
	}
	
	function update_transfer_status($location_id,$transfer_note_id)
	{
		$this->db->where('location_id',$location_id);
		$this->db->where('transfer_status',0);
		$this->db->set('transfer_status',1);
		$this->db->set('transfer_print_date',time());
		$this->db->set('transfer_note_id',$transfer_note_id);
		$this->db->update('ready_to_transfer');	
	}
	
	function get_note_by_id($transfer_note_id)
	{
		$this->db->where('transfer_note.transfer_note_id',$transfer_note_id);
		$this->db->join('location','location.location_id=transfer_note.location_id');
		$query=$this->db->get('transfer_note');
		return $query->row();
	}
	
	function get_transfer_status_by_id($transfer_note_id)
	{
		$this->db->where('ready_to_transfer.transfer_note_id',$transfer_note_id);
		$this->db->join('the_case','the_case.case_id=ready_to_transfer.case_id');
		$query=$this->db->get('ready_to_transfer');
		return $query->result();	
	}
}
