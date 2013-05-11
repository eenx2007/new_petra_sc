<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Asp2_model extends CI_Model {
	var $row_id='';
	var $TYPE='';
	var $PARTNO='';
	var $PARTNAME='';
	var $MODEL='';
	var $DESCRIPT='';
	var $PNCHANGE='';
	var $PRICE_ASP='';
	var $PRICE_DEA='';
	var $PRICE_END='';
	var $pic='';
	var $NOU='';
	
	function search_by_model($search_key)
	{
		$this->db->like('partname',$search_key);
		$this->db->order_by('TYPE');
		$query=$this->db->get('asp2');
		return $query->result();
	}
	
	function search_by_pn($search_key)
	{
		$this->db->like('PARTNO',$search_key);
		$this->db->order_by('TYPE');
		$query=$this->db->get('asp2');
		return $query->result();
	}
	
	function search_price($PARTNO)
	{
		$this->db->select('PRICE_END');
		$this->db->where('PARTNO',$PARTNO);
		$query=$this->db->get('asp2');
		$total=$query->num_rows;
		if($total==0)
			return 'Not in Database';
		else
		{
			$row=$query->row();
			return number_format($row->PRICE_END,0,',','.');	
		}
	}
	function get_detail_price($row_id)
	{
		$this->db->where('row_id',$row_id);
		$query=$this->db->get('asp2');
		return $query->row();
	}
}