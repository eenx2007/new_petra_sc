<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_control extends CI_Controller {

	function generate_invoice($case_id)
	{
		$check_proposal=$this->proposal_model->get_by_id($case_id);
		$data['proposal_id']=$check_proposal;
		$this->load->view('cso_include/get_invoice',$data);
	}
	
	function det_proposal_update($proposal_id)
	{
		$data['query']=$this->proposal_model->get_by_proposal($proposal_id);
		$data['query2']=$this->proposal_model->get_by_proposal2($proposal_id);
		$this->load->view('cso_include/det_invoice_update',$data);	
	}
	
}