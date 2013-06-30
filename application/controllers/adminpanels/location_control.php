<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_control extends CI_Controller {

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
	
	function return_from_rc()
	{
		$this->load->view('admin_include/return_from_rc');	
	}
	
	function rc_management()
	{
		$data['query']=$this->location_model->get_rc();
		$this->load->view('admin_include/rc_management',$data);	
	}
	
	function add_new()
	{
		$this->location_model->location_id=$this->input->post('location_id');
		$this->location_model->location_name=$this->input->post('location_name');
		$this->location_model->location_address=$this->input->post('location_address');
		$this->location_model->add_new_location();		
	}
}