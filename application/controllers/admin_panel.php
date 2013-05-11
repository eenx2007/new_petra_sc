<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_panel extends CI_Controller {
	
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
	
	function print_transfer($case_id,$location_id)
	{
		$this->load->library('pdf');
		
		
		
		$data['row']=$this->case_model->get_by_case_id($case_id);
		$data['row_location']=$this->location_model->get_by_id($location_id);
		$filepdf=$this->load->view('admin_include/print_transfer',$data,TRUE);	
		$this->pdf->pdf_create($filepdf,'Service Request Form');
	}
	
	function update_case($case_id=0)
	{
		
		$data['case_id']=$case_id;
		$data['queryreq']=$this->part_request_model->get_all();
		$this->load->view('admin_include/update_case',$data);	
	}
	
	function location_management()
	{
		$data['query']=$this->location_model->get_all();
		$this->load->view('admin_include/location_management',$data);	
	}
	
	function location_detail_item()
	{
		$location_id=$this->input->get('location_id');
		$data['query']=$this->case_model->get_by_location($location_id);
		$this->load->view('admin_include/location_detail_item',$data);
	}
	
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
	
	function update_part_status()
	{
		$this->part_request_model->update_part_use($this->input->post('part_request_id'),$this->input->post('request_status'));	
		$this->proposal_model->add_detail($this->input->post('part_request_id'),$this->input->post('proposal_id'));
	}
	
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
	
	function transfer_rc()
	{
		$this->case_model->transfer_rc($this->input->post('case_id'),'23',$this->input->post('location_id'));
		$this->case_model->case_log_activity='Transfer the case to RC';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function under_testing_rc()
	{
		$this->case_model->change_location($this->input->post('case_id'),'9','1005');
		$this->case_model->case_log_activity='Transfer Case to QC';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));	
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
	
	function rc_preparation()
	{
		$data['query']=$this->case_model->get_ready_rc();
		$this->load->view('admin_include/rc_preparation',$data);
	}
	
	function rc_process()
	{
		$this->case_model->transfer_rc($this->input->post('case_id'),'23',$this->input->post('location_id'));
		$this->location_model->add_to_transfer($this->input->post('case_id'),$this->input->post('location_id'));
		$this->case_model->case_log_activity='Transfer the case to RC';
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
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
	
	function export_case_out_data()
	{
		$this->load->view('admin_include/export_case_out_data');	
	}
	
	function case_out_query()
	{
		$data['start_date']=$this->input->get('start_date');
		$data['end_date']=$this->input->get('end_date');
		$data['query']=$this->case_model->get_out_case(urldecode($this->input->get('start_date')),urldecode($this->input->get('end_date')));
		$this->load->view('admin_include/export_case_out_result',$data);
	}
	
	function case_out_etx()
	{
		$data['query']=$this->case_model->get_out_case(urldecode($this->input->get('start_date')),urldecode($this->input->get('end_date')));
		$table=$this->load->view('admin_include/export_case_etx',$data,TRUE);
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=case_out_".time().".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $table;
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
	
	function delete_request()
	{
		$this->part_request_model->delete_request($this->input->post('part_request_id'));	
	}
	
	function custom_report()
	{
		$this->load->view('admin_include/custom_report');	
	}
	
	function generate_custom_report()
	{
		$start_date=urldecode($this->input->get('start_date'));
		$end_date=urldecode($this->input->get('end_date'));
		$report_type=$this->input->get('report_type');
		if($report_type==0)
		{
			
		}
		elseif($report_type==4)
		{
			$data['query']=$this->cso_activity_model->get_by_date($start_date,$end_date);	
			$this->load->view('admin_include/fd_activity',$data);
		}
	}
	
	function repair_complete_admin()
	{
		$data['query']=$this->case_model->get_by_status(10);
		$this->load->view('admin_include/repair_complete_admin',$data);
	}
	
	function return_from_rc()
	{
		$this->load->view('admin_include/return_from_rc');	
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