<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_control extends CI_Controller {

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
		elseif($report_type==1)
		{
			$data['query']=$this->transaction_model->get_by_date($start_date,$end_date);
			$this->load->view('admin_include/transaction_list',$data);
		}
	}
	
	function print_transfer($case_id,$location_id)
	{
		$this->load->library('pdf');
		
		
		
		$data['row']=$this->case_model->get_by_case_id($case_id);
		$data['row_location']=$this->location_model->get_by_id($location_id);
		$filepdf=$this->load->view('admin_include/print_transfer',$data,TRUE);	
		$this->pdf->pdf_create($filepdf,'Service Request Form');
	}
	
	function master_pricing()
	{
		$data['query']=$this->the_part_model->get_all_stock();
		$this->load->view('admin_include/master_pricing',$data);	
	}
	
	function set_new_price()
	{
		$this->the_part_model->set_new_price($this->input->post('the_stock_id'),$this->input->post('stock_sell_price'));	
	}
	
}