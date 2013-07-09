<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class The_part_model extends CI_Model {
	var $part_number='';
	var $part_name='';
	var $part_type='';
	
	var $the_stock_id='';
	var $stock_total='';
	var $stock_location='';
	var $stock_base_price='';
	var $stock_sell_price='';
	
	var $part_order_id='';
	var $part_order_from='';
	var $part_order_qty='';
	var $part_order_price='';
	var $part_order_total='';
	var $part_order_date='';
	var $part_order_reff='';
	var $part_order_status='';
	
	function new_part_order()
	{
		$this->db->set('part_number',$this->part_number);
		$this->db->set('part_order_from',$this->part_order_from);
		$this->db->set('part_order_qty',$this->part_order_qty);
		$this->db->set('part_order_price',$this->part_order_price);
		$this->db->set('part_order_total',$this->part_order_total);
		$this->db->set('part_order_date',time());
		$this->db->set('part_order_reff',$this->part_order_reff);
		$this->db->set('part_order_status',0);	
		$this->db->insert('part_order');
	}
	
	function receive_part($part_order_id)
	{
		$this->db->set('part_order_status',1);
		$this->db->where('part_order_id',$part_order_id);
		$this->db->update('part_order');	
	}
	
	function get_by_po_id($part_order_id)
	{
		$this->db->where('part_order_id',$part_order_id);
		$query=$this->db->get('part_order');
		return $query->row();	
	}
	
	function get_open_order()
	{
		$this->db->where('part_order.part_order_status',0);
		$this->db->join('the_part','the_part.part_number=part_order.part_number');
		$query=$this->db->get('part_order');
		return $query->result();
	}
	
	function save_new_part()
	{
		$this->db->set('part_number',$this->part_number);
		$this->db->set('part_name',$this->part_name);
		$this->db->set('part_type',$this->part_type);
		$this->db->insert('the_part');	
	}
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
	
	function get_all_stock()
	{
		$this->db->join('the_part','the_stock.part_number=the_part.part_number');
		$query=$this->db->get('the_stock');	
		return $query->result();
	}
	
	function set_new_price($the_stock_id,$stoc_sell_price)
	{
		$this->db->set('stock_sell_price',$stoc_sell_price);
		$this->db->where('the_stock_id',$the_stock_id);
		$this->db->update('the_stock');
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
	
	function stock_in($part_number,$stock_location,$stock_total,$stock_base_price)
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
			$this->db->set('stock_base_price',$stock_base_price);
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
	
	function stock_back_in($part_number,$stock_total)
	{
		$this->db->where('part_number',$part_number);
		$query=$this->db->get('the_stock');
		$total=$query->num_rows;
		$row=$query->row();
		
			$current_stock=$row->stock_total;
			$new_stock=$current_stock+$stock_total;
			$this->db->set('stock_total',$new_stock);
			$this->db->where('part_number',$part_number);
			
			$this->db->update('the_stock');
	}
}