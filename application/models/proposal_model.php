<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proposal_model extends CI_Model {
	var $proposal_id='';
	var $case_id='';
	var $proposal_create_date='';
	var $proposal_status='';
	
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
	
	function get_by_id($case_id)
	{
		$this->db->where('case_id',$case_id);
		$query=$this->db->get('proposal');
		$totalcek=$query->num_rows;
		if($totalcek==0)
			return 0;
		else
		{
			$rowcek=$query->row();	
			return $rowcek->proposal_id;
		}
	}
	
	function add_detail($part_request_id,$proposal_id)
	{
		$this->db->where('part_request.part_request_id',$part_request_id);
		$this->db->join('asp2','asp2.partno=part_request.part_released');
		$query=$this->db->get('part_request');
		$row=$query->row();
		$this->db->set('proposal_id',$proposal_id);
		$this->db->set('part_request_id',$part_request_id);
		$this->db->set('det_price',$row->price_end);
		$this->db->insert('det_proposal');
		
			
	}
	
	function add_detail2($det_value,$proposal_id)
	{
		$this->db->where('partno',$det_value);
		$query=$this->db->get('asp2');
		$row=$query->row();
		$this->db->set('proposal_id',$proposal_id);
		$this->db->set('det_value',$det_value);
		$this->db->set('det_price',$row->price_end);
		$this->db->insert('det_proposal');	
	}
	
	function get_by_proposal($proposal_id)
	{
		$this->db->where('det_proposal.proposal_id',$proposal_id);
		$this->db->join('part_request','part_request.part_request_id=det_proposal.part_request_id');
		$this->db->join('asp2','asp2.partno=part_request.part_released');
		$query=$this->db->get('det_proposal');
		return $query->result();
	}
	
	function get_by_proposal2($proposal_id)
	{
		$this->db->where('det_proposal.proposal_id',$proposal_id);
		$this->db->join('asp2','asp2.partno=det_proposal.det_value');
		$query=$this->db->get('det_proposal');
		return $query->result();
	}
}