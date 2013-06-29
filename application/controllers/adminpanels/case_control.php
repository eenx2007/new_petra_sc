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
		$data['queryeng']=$queryeng;
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
							'customer_id'=>$row->customer_id,
							'customer_name'=>$row->customer_name,
							'phone_number'=>$row->customer_phone,
							'phone_number2'=>$row->customer_phone2,
							'customer_address'=>$row->customer_address,
							'serial_number'=>$row->serial_number,
							'unit_type'=>$row->unit_type,
							'case_type'=>$this->global_model->get_case_type($row->case_type),
							'case_status'=>$this->global_model->get_case_status($row->case_status),
							'creator'=>$row->sure_name,
							'case_type_id'=>$row->case_type,
							'assign_to'=>$row->assign_to,
							'symptom'=>$row->description,
							'case_problem'=>$row->case_problem,
							'remarks'=>$row->remarks,
							'completeness'=>$row->completeness
							);
		}
		echo json_encode($kembali);
	}
	
	function get_pending_on_hand()
	{
		$queryeng=$this->global_model->get_all_engineer();
		$data['queryeng']=$queryeng;
		$this->load->view('admin_include/engineer_pending_on_hand',$data);
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
		
		$this->case_model->case_log_activity='Assign to '.$this->global_model->get_engineer($this->input->post('assign_to'));
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
		$this->case_model->case_log_activity='Change status to Ready to Ship<br />'.nl2br($this->input->post('resolving_notes'));
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
		$this->case_model->serial_number=$this->input->post('serial_number');
		$this->case_model->unit_type=$this->input->post('unit_type');
		$this->case_model->case_type=$this->input->post('case_type');
		$this->case_model->case_problem=$this->input->post('case_problem');
		$this->case_model->update_case_detail($this->input->post('case_id'));	
		
		$this->case_model->case_log_activity='Update the case detail data';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function update_customer_data()
	{
		$this->customer_model->customer_name=$this->input->post('customer_name');
		$this->customer_model->customer_address=$this->input->post('customer_address');
		$this->customer_model->customer_phone=$this->input->post('customer_phone');
		$this->customer_model->customer_phone2=$this->input->post('customer_phone2');
		$this->customer_model->update_by_id($this->input->post('customer_id'));

		$this->case_model->case_log_activity='Update the customer data';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
		
	}
	
	function transfer_case()
	{
		$this->case_model->transfer_case($this->input->post('case_id'),$this->input->post('assign_to'));
		$this->case_model->case_log_activity='Change assignment to '.$this->global_model->get_engineer($this->input->post('assign_to'));
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function repair_complete_admin()
	{
		$data['query']=$this->case_model->get_by_status(10);
		$this->load->view('admin_include/repair_complete_admin',$data);
	}
}