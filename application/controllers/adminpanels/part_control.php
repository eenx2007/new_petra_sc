<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part_control extends CI_Controller {

	function part_in_case($case_id)
	{
		$data['query']=$this->part_request_model->get_by_case_id($case_id);
		$this->load->view('admin_include/part_in_case',$data);
	}
	
	function part_in_case2($case_id)
	{
		$data['query']=$this->part_request_model->get_by_case_id($case_id);
		$this->load->view('admin_include/part_in_case2',$data);
	}
	
	function update_ref()
	{
		$this->part_request_model->css_ref=$this->input->post('css_ref');
		$this->part_request_model->update_part_request($this->input->post('part_request_id'));
		
		$this->case_model->case_log_activity='All Part Request OK';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
		
		$this->case_model->update_case($this->input->post('case_id'),14);	
	}
	
	function update_part_status()
	{
		$this->part_request_model->update_part_use($this->input->post('part_request_id'),$this->input->post('request_status'));	
		$this->proposal_model->add_detail($this->input->post('part_request_id'),$this->input->post('proposal_id'));
		
		$this->case_model->case_log_activity='Change the part status';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function delete_request()
	{
		$this->part_request_model->delete_request($this->input->post('part_request_id'));	
		
		$this->case_model->case_log_activity='Delete part request from engineer';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
}