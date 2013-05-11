<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Engineer extends CI_Controller {
	
	function update_case($case_id='0')
	{
		$data['case_id']=$case_id;
		
		$this->load->view('engineer_include/update_case',$data);
	}
	
	function my_pending_db()
	{
		$data['query']=$this->case_model->get_pending($this->session->userdata('user_id'));
		$this->load->view('engineer_include/my_pending_db',$data);	
	}
	
	function search_case()
	{
		$row=$this->case_model->get_by_case_id($this->input->post('case_id'));
		if($row=='error')
			$kembali=array('error'=>1);
		else
		{
			$kembali=array(
							'error'=>0,
							'case_id'=>$row->case_id,
							'create_date'=>mdate('%d/%m/%Y %h:%i:%s',$row->create_date),
							'customer_name'=>$row->customer_name,
							'phone_number'=>$row->customer_phone,
							'serial_number'=>$row->serial_number,
							'unit_type'=>$row->unit_type,
							'case_type'=>$this->global_model->get_case_type($row->case_type),
							'case_status'=>$this->global_model->get_case_status($row->case_status),
							'creator'=>$row->sure_name,
							'case_type_id'=>$row->case_type,
							'assign_to'=>$row->assign_to,
							'symptom'=>$row->description,
							'case_problem'=>$row->case_problem
							);
		}
		echo json_encode($kembali);
	}
	
	function request_part()
	{
		$this->part_request_model->part_number=$this->input->post('part_number');
		$this->part_request_model->case_id=$this->input->post('case_id');
		$this->part_request_model->bad_part_sn=$this->input->post('bad_part_sn');
		$this->part_request_model->oem_part_sn=$this->input->post('oem_part_sn');
		$this->part_request_model->user_id=$this->input->post('user_id');
		$this->part_request_model->new_part_request();
		
		$this->case_model->case_log_activity='Meminta part '.$this->input->post('part_number').' dengan alasan '.$this->input->post('bad_part_sn');
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
		
		$this->case_model->update_case($this->input->post('case_id'),2);
	}
	
	function get_case_log($case_id)
	{
		$data['query']=$this->case_model->get_log($case_id);
		$this->load->view('engineer_include/case_log',$data);	
	}
	
	function part_in_case($case_id)
	{
		$data['query']=$this->part_request_model->get_by_case_id($case_id);
		$this->load->view('engineer_include/part_in_case',$data);	
	}
	
	function update_part_request()
	{
		$this->part_request_model->update_part_use($this->input->post('part_request_id'),$this->input->post('update_to'));	
	}
	
	function force_update()
	{
		if($this->input->post('update_status')==22)
		{
			$this->case_model->update_case($this->input->post('case_id'),$this->input->post('update_status'),'7001');
			$this->case_model->case_log_activity='Change status - Ready to RC Transfer';
		}
		else
		{
			$this->case_model->update_case($this->input->post('case_id'),$this->input->post('update_status'));
			$this->case_model->case_log_activity='Change status - Ready to Under Testing';
		}
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
		write_file('./db_cache/under_testing.txt',$this->input->post('case_id').' Under Testing!');
	}
	
	function pending_management($user_id)
	{
		$data['query']=$this->case_model->get_pending($user_id);
		$this->load->view('engineer_include/pending_management',$data);
	}
	
	function pending_right($user_id)
	{
		$data['query']=$this->case_model->get_pending($user_id);
		$this->load->view('engineer_include/pending_right',$data);
	}
	
	function update_log()
	{
		$this->case_model->case_log_activity=nl2br($this->input->post('new_log_entry'));
		$this->case_model->log_type=$this->input->post('log_type');
		$this->case_model->update_log_from_form($this->input->post('case_id'),$this->input->post('user_id'));
	}
}
	