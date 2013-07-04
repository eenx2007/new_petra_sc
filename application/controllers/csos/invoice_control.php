<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_control extends CI_Controller {

	function generate_invoice($case_id)
	{
		$check_proposal=$this->proposal_model->get_by_id($case_id);
		$data['proposal_id']=$check_proposal->proposal_id;
		if($check_proposal->proposal_status==0)
		{
			$this->proposal_model->update_to_invoice($check_proposal->proposal_id);
			$get_total_price=$this->proposal_model->get_total_price($check_proposal->proposal_id);
			//saving the transaction
			$this->transaction_model->transaction_title='Income from Invoice I'.$check_proposal->proposal_id;
			$this->transaction_model->transaction_total=$get_total_price;
			$this->transaction_model->transaction_type=0;
			$this->transaction_model->transaction_reff='invoicing case '.$case_id;
			$this->transaction_model->transaction_user=$this->uri->segment(5);
			$this->transaction_model->new_transaction();	
		}
		$this->load->view('cso_include/get_invoice',$data);
	}
	
	function update_dp_proposal()
	{
		$this->proposal_model->update_dp_to_invoice($this->input->post('proposal_id'),$this->input->post('total_dp'));
		//saving the transaction
			$this->transaction_model->transaction_title='Income from Invoice I'.$this->input->post('proposal_id');
			$this->transaction_model->transaction_total=$this->input->post('balance_price');
			$this->transaction_model->transaction_type=0;
			$this->transaction_model->transaction_reff='invoicing part sale';
			$this->transaction_model->transaction_user=$this->input->post('user_id');
			$this->transaction_model->new_transaction();
	}
	
	function update_clear_proposal()
	{
		$this->proposal_model->update_clear_to_invoice($this->input->post('proposal_id'));
		
	}
	
	function det_proposal_update($proposal_id)
	{
		$data['query']=$this->proposal_model->get_by_proposal($proposal_id);
		$data['query2']=$this->proposal_model->get_by_proposal2($proposal_id);
		$this->load->view('cso_include/det_invoice_update',$data);	
	}
	
	function temp_invoice_detail($proposal_id)
	{
		$data['proposal_id']=$proposal_id;
		$data['query']=$this->proposal_model->get_by_proposal3($proposal_id);
		$this->load->view('cso_include/temp_invoice_detail',$data);
	}
	
	function collection_part()
	{
		$this->load->view('cso_include/collection_part');
			
	}
	
	function search_invoice_result($proposal_id)
	{
		$data['proposal_id']=$proposal_id;
		$data['row']=$this->proposal_model->get_by_proposal_id2($proposal_id);
		
		$data['query']=$this->proposal_model->get_by_proposal3($proposal_id);
		$this->load->view('cso_include/collection_invoice_detail',$data);
	}
	
}