<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proposal_control extends CI_Controller {

	function add_detail_proposal()
	{
		$this->proposal_model->add_detail2($this->input->post('det_value'),$this->input->post('proposal_id'));	
	}

	function det_proposal_update($proposal_id)
	{
		$data['query']=$this->proposal_model->get_by_proposal($proposal_id);
		$data['query2']=$this->proposal_model->get_by_proposal2($proposal_id);
		$this->load->view('admin_include/det_proposal_update',$data);	
	}
	
	function create_proposal($case_id)
	{
		$check_proposal=$this->proposal_model->get_by_id($case_id);
		if($check_proposal==0)
			$data['proposal_id']=$this->proposal_model->create_new($case_id);
		else
			$data['proposal_id']=$check_proposal;
		$this->load->view('admin_include/create_proposal',$data);
	}

}