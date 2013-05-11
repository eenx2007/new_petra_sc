<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_model extends CI_Model {
	var $customer_id='';
	var $customer_name='';
	var $customer_address='';
	var $customer_phone='';
	var $customer_phone2='';
	
	function get_all()
	{
		$query=$this->db->get('customer');
		return $query->result();
	}
	
	function save_new()
	{
		$this->db->set('customer_name',$this->customer_name);
		$this->db->set('customer_address',$this->customer_address);
		$this->db->set('customer_phone',$this->customer_phone);
		$this->db->set('customer_phone2',$this->customer_phone2);
		$this->db->insert('customer');
		return $this->db->insert_id();	
	}
}