<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proposal_model extends CI_Model {
	var $proposal_id='';
	var $case_id='';
	var $proposal_create_date='';
	var $proposal_status='';
	var $proposal_dp='';
	
	var $det_proposal_id='';
	var $part_request_id='';
	var $det_value='';
	var $det_price='';
	
	function create_new($case_id)
	{
		$this->db->set('case_id',$case_id);
		$this->db->set('proposal_create_date',time());
		$this->db->set('proposal_status',0);
		$this->db->insert('proposal');
		return $this->db->insert_id();	
	}
	
	function create_new_sell()
	{
		$this->db->set('case_id',$this->case_id);
		$this->db->set('proposal_create_date',time());
		$this->db->set('proposal_status',0);
		$this->db->set('proposal_dp',$this->propsal_dp);
		$this->db->insert('proposal');
		return $this->db->insert_id();
	}
	
	function get_by_id($case_id)
	{
		$this->db->where('case_id',$case_id);
		$query=$this->db->get('proposal');
		$totalcek=$query->num_rows;
		if($totalcek==0)
			return "0";
		else
		{
			$rowcek=$query->row();	
			return $rowcek;
		}
	}
	
	function add_detail($part_request_id,$proposal_id)
	{
		$this->db->where('part_request.part_request_id',$part_request_id);
		$this->db->join('the_stock','the_stock.part_number=part_request.part_released');
		$query=$this->db->get('part_request');
		$row=$query->row();
		$this->db->set('proposal_id',$proposal_id);
		$this->db->set('part_request_id',$part_request_id);
		$this->db->set('det_price',$row->stock_sell_price);
		$this->db->insert('det_proposal');
		
			
	}
	
	function add_detail2($det_value,$proposal_id)
	{
		$this->db->where('part_number',$det_value);
		$query=$this->db->get('the_stock');
		$row=$query->row();
		$this->db->set('proposal_id',$proposal_id);
		$this->db->set('det_value',$det_value);
		$this->db->set('det_price',$row->stock_sell_price);
		$this->db->insert('det_proposal');	
	}
	
	function get_by_proposal($proposal_id)
	{
		$this->db->where('det_proposal.proposal_id',$proposal_id);
		$this->db->join('part_request','part_request.part_request_id=det_proposal.part_request_id');
		$this->db->join('the_part','the_part.part_number=part_request.part_released');
		$query=$this->db->get('det_proposal');
		return $query->result();
	}
	
	function get_by_proposal2($proposal_id)
	{
		$this->db->where('det_proposal.proposal_id',$proposal_id);
		$this->db->join('the_part','the_part.part_number=det_proposal.det_value');
		$query=$this->db->get('det_proposal');
		return $query->result();
	}
	
	function update_to_invoice($proposal_id)
	{
		$this->db->set('proposal_status',1);
		$this->db->where('proposal_id',$proposal_id);
		$this->db->update('proposal');	
	}
	
	function get_total_price($proposal_id)
	{
		$this->db->where('proposal_id',$proposal_id);
		$query=$this->db->get('det_proposal');
		$total_price=0;
		foreach($query->result() as $rows)
		{
			$total_price=$total_price+$rows->det_price;
		}
		return $total_price;
	}
}