<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class The_part_model extends CI_Model {
	var $part_number='';
	var $part_name='';
	var $part_type='';
	
	var $the_stock_id='';
	var $stock_total='';
	var $stock_location='';
	
	function get_all()
	{
		$query=$this->db->get('the_part');
		return $query->result();	
	}
	
	function get_stock()
	{
		$this->db->where('stock_total !=',0);
		$this->db->join('the_part','the_stock.part_number=the_part.part_number');
		$query=$this->db->get('the_stock');	
		return $query->result();
	}
	
	function get_by_pn($part_number)
	{
		$this->db->where('the_part.part_number',$part_number);
		$query=$this->db->get('the_part');
		$total=$query->num_rows;
		if($total==0)
			return "new_part";
		else
		{
			return $query->row();	
		}
	}
	
	function stock_in($part_number,$stock_location,$stock_total)
	{
		$this->db->where('part_number',$part_number);
		$this->db->where('stock_location',$stock_location);
		$query=$this->db->get('the_stock');
		$total=$query->num_rows;
		if($total==0)
		{
			$this->db->set('part_number',$part_number);
			$this->db->set('stock_total',$stock_total);
			$this->db->set('stock_location',$stock_location);
			$this->db->insert('the_stock');
		}
		else
		{
			$row=$query->row();
			$current_stock=$row->stock_total;
			$new_stock=$current_stock+$stock_total;
			$this->db->set('stock_total',$new_stock);
			$this->db->where('part_number',$part_number);
			$this->db->where('stock_location',$stock_location);
			$this->db->update('the_stock');
		}
	}
	
	function stock_out($part_number,$stock_location,$stock_total)
	{
		$this->db->where('part_number',$part_number);
		$this->db->where('stock_location',$stock_location);
		$query=$this->db->get('the_stock');
		$total=$query->num_rows;
		
		
			$row=$query->row();
			$current_stock=$row->stock_total;
			$new_stock=$current_stock-$stock_total;
			$this->db->set('stock_total',$new_stock);
			$this->db->where('part_number',$part_number);
			$this->db->where('stock_location',$stock_location);
			$this->db->update('the_stock');
		
	}
}