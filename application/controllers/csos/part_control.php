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
	
}