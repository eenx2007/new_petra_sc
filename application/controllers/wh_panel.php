<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wh_panel extends CI_Controller {
	
	function part_in()
	{
		$part_numbernya='';
		$query=$this->the_part_model->get_all();
		foreach($query as $rows)
		{
			$part_numbernya.='"'.$rows->part_number.'",';	
		}
		$part_numbernya.='"-"';
		$data['part_numbernya']=$part_numbernya;
		$this->load->view('wh_include/part_in',$data);	
	}
	
	function check_part()
	{
		$row=$this->the_part_model->get_by_pn($this->input->post('part_number'));
		if($row=="new_part")
			echo "";
		else
			echo $row->part_name;
	}
	
	function part_in_save()
	{
		$this->the_part_model->stock_in($this->input->post('part_number'),$this->input->post('stock_location'),$this->input->post('stock_total'));	
	}
	function awaiting_part()
	{
		$data['queryreq']=$this->part_request_model->get_awaiting();
		$this->load->view('wh_include/awaiting_part_db',$data);	
	}
	
	
	
	function no_defective_part()
	{
		$data['querynodef']=$this->part_request_model->get_by_status(7);
		$this->load->view('wh_include/no_defective_part_db',$data);
	}
	
	function incoming_part()
	{
		$this->load->view('wh_include/incoming_part');	
	}
	
	function search_part($case_id)
	{
		$part_numbernya='';
		$query=$this->the_part_model->get_stock();
		foreach($query as $rows)
		{
			$part_numbernya.='"'.$rows->part_number.'",';	
		}
		$part_numbernya.='"-"';
		$data['part_numbernya']=$part_numbernya;
		$data['query']=$this->part_request_model->get_by_case_id_for_wh($case_id);
		$this->load->view('wh_include/search_part_result',$data);
	}
	
	function release_part()
	{
		$this->part_request_model->part_released=$this->input->post('part_released');
		$this->part_request_model->good_part_sn=$this->input->post('good_part_sn');
		$this->part_request_model->release_part($this->input->post('part_request_id'));
		
		$all_released=$this->part_request_model->cek_released($this->input->post('case_id'));
		if($all_released==0)
			$case_status=3;
		else
			$case_status=15;
		$this->case_model->update_case($this->input->post('case_id'),$case_status);
		
		$this->the_part_model->stock_out($this->input->post('part_released'),'8001',1);
		
		$this->case_model->case_log_activity='Give part '.$this->input->post('part_released').' with SN '.$this->input->post('good_part_sn');
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
	}
	
	function need_to_be_issued()
	{
		$data['query']=$this->part_request_model->get_issued();
		$this->load->view('wh_include/need_to_be_issued',$data);
	}
	
	function part_out()
	{
		$this->load->view('wh_include/part_out');
	}
	
	function update_part_status()
	{
		$this->part_request_model->update_part_use($this->input->post('part_request_id'),$this->input->post('request_status'));	
	}
	
	function part_sale()
	{
		$this->load->view('wh_include/part_sale');
	}
	
	function give_part_cso()
	{
		$this->part_request_model->user_id=$this->input->post('user_id');
		$this->part_request_model->part_number=$this->input->post('part_released');
		$this->part_request_model->good_part_sn=$this->input->post('good_part_sn');
		$row=$this->part_request_model->part_to_cso();
		$kembali=array('part_request_id'=>'G'.$row);
		echo json_encode($kembali);
	}
	
	
	
	function shipping()
	{
		$data['query']=$this->location_model->get_need_transfer();
		$this->load->view('wh_include/shipping',$data);
	}
	
	function update_transfer_note()
	{
		$this->location_model->location_id=$this->input->post('location_id');
		$this->location_model->shipping_note=$this->input->post('shipping_note');
		$notes_id=$this->location_model->add_transfer_note();
		$this->location_model->update_transfer_status($this->input->post('location_id'),$notes_id);
		
		echo $notes_id;
		
	}
	
	function print_transfer_note($notes_id)
	{
		$data['row']=$this->location_model->get_note_by_id($notes_id);
		$data['query']=$this->location_model->get_transfer_status_by_id($notes_id);
		$output=$this->load->view('wh_include/transfer_note',$data,TRUE);
		header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
   		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
   		header('Content-disposition: attachment; filename="T'.$notes_id.'.doc"');
		
		echo $output;
	}
}
