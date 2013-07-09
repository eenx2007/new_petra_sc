<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part_control extends CI_Controller {

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
	
	function part_in_case($case_id)
	{
		$data['query']=$this->part_request_model->get_by_case_id($case_id);
		$this->load->view('engineer_include/part_in_case',$data);	
	}
	
	function update_part_request()
	{
		$this->part_request_model->update_part_use($this->input->post('part_request_id'),$this->input->post('update_to'));	
		$update_type=$this->input->post('update_to');
		if($update_type==8)
		{
			$this->the_part_model->stock_back_in($this->input->post('part_number'),1);	
		}
		elseif($update_type==5)
		{
			$this->the_part_model->stock_back_in($this->input->post('part_number'),1);	
		}
		
	}
	
}