<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part_control extends CI_Controller {
	
	function part_by_me($user_id)
	{
		$data['query']=$this->part_request_model->get_by_me($user_id);
		$this->load->view('cso_include/part_by_me',$data);
		
	}
	
	function update_css_ref()
	{
		$this->db->set('css_ref',$this->input->post('css_ref'));
		$this->db->where('part_request_id',$this->input->post('part_request_id'));
		$this->db->update('part_request');
		write_file('./db_cache/fd_activity.txt','Part Sale Code Number G'.$this->input->post('part_request_id').' Closed by '.$this->session->userdata('sure_name'));
	}
	
	function part_sale()
	{
		
		$c_namenya='';
		$query=$this->customer_model->get_all();
		foreach($query as $rows)
		{
			$c_namenya.='"'.$rows->customer_name.'",';	
		}
		$c_namenya.='"-"';
		$data['customer_namenya']=$c_namenya;
		$this->load->view('cso_include/part_sale',$data);
	}
	
	function create_request()
	{
		$this->customer_model->customer_name=$this->input->post('customer_name');
		$this->customer_model->customer_address=$this->input->post('customer_address');
		$this->customer_model->customer_phone=$this->input->post('customer_phone');
		$this->customer_model->customer_phone2=$this->input->post('customer_phone2');
		$id_user=$this->customer_model->save_new();
		
		$this->proposal_model->case_id='no_case_'.$id_user;
		$this->proposal_model->propsal_dp=$this->input->post('total_down_payment');
		$proposal_number=$this->proposal_model->create_new_sell();
		
		echo $proposal_number;
	}
	
	function new_part_request()
	{
		$this->part_request_model->part_number=$this->input->post('part_number');
		$this->part_request_model->case_id=$this->input->post('proposal_id');
		$this->part_request_model->user_id=$this->input->post('user_id');
		$this->part_request_model->bad_part_sn='part_sell';
		$this->part_request_model->oem_part_sn=$this->input->post('oem_part_sn');
		$part_request_id=$this->part_request_model->new_part_request2();
		
		$this->proposal_model->add_detail3($part_request_id,$this->input->post('proposal_id'),$this->input->post('part_price'));
	}
}