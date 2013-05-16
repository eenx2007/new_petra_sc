<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Case_control extends CI_Controller {
	
	function case_today()
	{
		$listeng=array();
		$listeng[0]='Not Assigned';
		$queryeng=$this->global_model->get_all_engineer();
		foreach($queryeng as $rowseng)
		{
			$listeng[$rowseng->user_id]=$rowseng->sure_name;	
		}
		$data['listeng']=$listeng;
		$data['query']=$this->case_model->get_unassigned();
		$queryerror=$this->case_model->get_symptom();
		$symptomnya='';
		$i=0;
		foreach($queryerror as $rowserror)
		{
			$symptomnya.='"'.$rowserror->error_code.'-'.$rowserror->description.'",';
		}
		$symptomnya.='"-"';
		$data['symptomnya']=$symptomnya;
		$this->load->view('admin_include/case_today',$data);
	}
	
	function assign_case()
	{
		$this->case_model->assign_to=$this->input->post('assign_to');
		$this->case_model->case_status=1;
		$this->case_model->case_id=$this->input->post('case_id');
		$pecah=explode('-',$this->input->post('symptom'));
		$this->case_model->symptom=$pecah[0];
		$this->case_model->location_id='1002';
		$this->case_model->assign_case();
		
		$this->case_model->case_log_activity='Diberikan ke '.$this->global_model->get_engineer($this->input->post('assign_to'));
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function update_case($case_id=0)
	{
		$data['case_id']=$case_id;
		$data['queryreq']=$this->part_request_model->get_all();
		$this->load->view('admin_include/update_case',$data);	
	}
	
	function under_testing_db()
	{
		$data['query']=$this->case_model->get_under_testing();
		$this->load->view('admin_include/under_testing_db',$data);	
	}
	
	function repair_complete_db()
	{
		$data['query']=$this->case_model->get_by_status(10);
		$this->load->view('admin_include/repair_complete_db',$data);	
	}
	
	function resolving_today()
	{
		$this->load->view('admin_include/resolving_today');	
	}
	
	function force_update()
	{
		$this->case_model->change_location($this->input->post('case_id'),$this->input->post('case_status'),'7002');
		$this->case_model->resolving_case($this->input->post('case_id'),$this->input->post('case_status'),$this->input->post('resolved_reason'));
		$this->case_model->case_log_activity='Mengganti status menjadi Siap Diambil<br />'.nl2br($this->input->post('resolving_notes'));
		$this->case_model->log_type=5;
		$this->case_model->update_log_from_form($this->input->post('case_id'),$this->input->post('user_id'));
		write_file('./db_cache/case_out_check.txt','');
	}
	
	function pending_management()
	{
		$data['query']=$this->case_model->get_pending_all();
		$this->load->view('admin_include/pending_management',$data);
		
	}
	
	function quick_update()
	{
		$this->case_model->update_case($this->input->post('case_id'),$this->input->post('quick_update'));
		$this->case_model->case_log_activity='Change the case status with notes : <br />'.nl2br($this->input->post('update_notes'));
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'),$this->input->post('user_id'));
	}
	
	function log_follow_up_db()
	{
		$data['query']=$this->case_model->get_log_follow_up();
		$this->load->view('admin_include/log_follow_up',$data);	
	}
	
	function log_follow_up()
	{
		$this->case_model->update_follow_up($this->input->post('case_log_id'));	
	}
	
	function update_case_detail()
	{
		$this->case_model->customer_name=$this->input->post('customer_name');
		$this->case_model->phone_number=$this->input->post('phone_number');
		$this->case_model->serial_number=$this->input->post('serial_number');
		$this->case_model->unit_type=$this->input->post('unit_type');
		$this->case_model->case_type=$this->input->post('case_type');
		$this->case_model->update_case_detail($this->input->post('case_id'));	
	}
	
	function transfer_case()
	{
		$this->case_model->transfer_case($this->input->post('case_id'),$this->input->post('assign_to'));
		echo $this->db->last_query();
	}
	
	function repair_complete_admin()
	{
		$data['query']=$this->case_model->get_by_status(10);
		$this->load->view('admin_include/repair_complete_admin',$data);
	}
}