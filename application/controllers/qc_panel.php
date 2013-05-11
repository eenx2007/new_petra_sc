<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qc_panel extends CI_Controller {
	
	function qc_repair_complete_db()
	{
		$data['query']=$this->case_model->get_by_status(9);
		$this->load->view('qc_include/qc_repair_complete_db',$data);
	}
	
	function update_case($case_id=0)
	{
		if($case_id==0)
			$data['case_id']=0;
		else
			$data['case_id']=$case_id;
		$this->load->view('qc_include/update_case',$data);	
	}
	
	function force_update()
	{
		$logact='';
		if($this->input->post('update_status')==10)
		{
			$logact='change status to Repair Complete';
			write_file('./db_cache/repair_complete.txt',$this->input->post('case_id').' finish Test!');
		}
		else
			$logact='dikembalikan ke Engineer';
		$this->case_model->change_location($this->input->post('case_id'),$this->input->post('update_status'),'1003');
		$this->case_model->update_case($this->input->post('case_id'),$this->input->post('update_status'));
		$this->case_model->case_log_activity=$logact;
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
}