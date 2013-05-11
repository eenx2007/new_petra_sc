<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cso extends CI_Controller {

	function new_case()
	{
		$waktu=time();
		$this->session->set_userdata('start_time',$waktu);
		$c_namenya='';
		$query=$this->customer_model->get_all();
		foreach($query as $rows)
		{
			$c_namenya.='"'.$rows->customer_name.'",';	
		}
		$c_namenya.='"-"';
		$data['customer_namenya']=$c_namenya;
		$this->load->view('cso_include/new_case',$data);
	}
	
	function cancel_case()
	{
		$this->session->unset_userdata('start_time');	
	}
	
	function cancel_consultation()
	{
		$this->session->unset_userdata('start_time');	
	}
	
	function save_case()
	{
		//get from file new_case.php function save_case()
		
		//saving customer data
		$this->customer_model->customer_name=$this->input->post('customer_name');
		$this->customer_model->customer_address=$this->input->post('customer_address');
		$this->customer_model->customer_phone=$this->input->post('customer_phone');
		$this->customer_model->customer_phone2=$this->input->post('customer_phone2');
		$id_user=$this->customer_model->save_new();
		
		//saving case
		$new_case_id=$this->case_model->get_case_id();
		$this->case_model->case_id=$new_case_id;
		$this->case_model->customer_id=$id_user;
		$this->case_model->serial_number=$this->input->post('serial_number');
		$this->case_model->unit_type=$this->input->post('unit_type');
		$this->case_model->case_type=$this->input->post('case_type');
		$this->case_model->completeness=$this->input->post('completeness');
		$this->case_model->case_problem=$this->input->post('case_problem');
		$this->case_model->remarks=$this->input->post('remarks');
		$this->case_model->creator=$this->input->post('user_id');
		$this->case_model->location_id='1001';
		$this->case_model->new_case();
		
		$this->cso_activity_model->user_id=$this->input->post('user_id');
		$this->cso_activity_model->activity_type=0;
		$this->cso_activity_model->start_time=$this->input->post('start_date');
		$this->cso_activity_model->end_time=time();
		$this->cso_activity_model->activity_ref=$this->input->post('case_id');
		$this->cso_activity_model->new_activity();
		write_file('./db_cache/new_case_check.txt','');
		
		$kembali=array('case_id'=>$new_case_id);
		$kembalinya=json_encode($kembali);
		echo $kembalinya;
		
	}
	
	function print_srf($case_id)
	{
		$this->load->library('pdf');
		$data['row']=$this->case_model->get_by_case_id($case_id);
		$filepdf=$this->load->view('cso_include/srf',$data,TRUE);
		$this->pdf->pdf_create($filepdf,'Service Request Form');
	}
	
	function collection()
	{
		$waktu=time();
		$this->session->set_userdata('start_time',$waktu);
		$this->load->view('cso_include/collection');
	}
	
	function force_close()
	{
		$this->case_model->close_case($this->input->post('case_id'),$this->input->post('case_status'),$this->input->post('user_id'));
		$this->case_model->case_log_activity=nl2br($this->input->post('shipping_note'));
		$this->case_model->update_log($this->input->post('case_id'),$this->input->post('user_id'));
		
		$this->cso_activity_model->user_id=$this->input->post('user_id');
		$this->cso_activity_model->activity_type=1;
		$this->cso_activity_model->start_time=$this->input->post('start_time');
		$this->cso_activity_model->end_time=time();
		$this->cso_activity_model->activity_ref=nl2br($this->input->post('shipping_note'));
		$this->cso_activity_model->new_activity();
		
		write_file('./db_cache/fd_activity.txt','Case '.$this->input->post('case_id').' Closed by '.$this->input->post('sure_name'));
	}
	
	function save_old_style()
	{
		$this->cso_activity_model->user_id=$this->input->post('user_id');
		$this->cso_activity_model->activity_type=1;
		$this->cso_activity_model->start_time=$this->input->post('start_time');
		$this->cso_activity_model->end_time=time();
		$this->cso_activity_model->activity_ref=nl2br($this->input->post('old_style_notes'));
		$this->cso_activity_model->new_activity();
		write_file('./db_cache/fd_activity.txt','Non RC Case Closed by '.$this->session->userdata('sure_name'));
	}
	
	function consultation()
	{
		$waktu=time();
		$this->session->set_userdata('start_time',$waktu);
		$this->load->view('cso_include/consultation');
	}
	
	function save_consultation()
	{
		$this->cso_activity_model->user_id=$this->input->post('user_id');
		$this->cso_activity_model->activity_type=2;
		$this->cso_activity_model->start_time=$this->input->post('start_time');
		$this->cso_activity_model->end_time=time();
		$this->cso_activity_model->activity_ref=nl2br($this->input->post('consultation_notes'));
		$this->cso_activity_model->new_activity();
		write_file('./db_cache/fd_activity.txt','Consultation - '.$this->input->post('consultation_notes').' oleh '.$this->session->userdata('sure_name'));
	}
	
	function today_statistic($user_id)
	{
		$data['query']=$this->cso_activity_model->get_today_by_user($user_id);
		$this->load->view('cso_include/today_statistic',$data);
	}
	
	function detail_activity($c_a_id)
	{
		$this->db->where('cso_activity_id',$c_a_id);
		$query=$this->db->get('cso_activity');
		$row=$query->row();
		if($row->activity_type==0)
		{
			$row2=$this->case_model->get_by_case_id($row->activity_ref);
			echo '<table class="main_table">';
			echo '<tr><td>Case ID</td><td>'.$row->activity_ref.'</td></tr>';
			echo '<tr><td>Serial Number</<td><td>'.$row2->serial_number.'</td></tr>';
			echo '</table>';
		}
		else
		{
			echo '<table class="main_table"><tr><td>'.$row->activity_ref.'</td></tr></table>';	
		}
	}
	
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
	
	function generate_invoice($case_id)
	{
		$check_proposal=$this->proposal_model->get_by_id($case_id);
		$data['proposal_id']=$check_proposal;
		$this->load->view('cso_include/get_invoice',$data);
	}
	
	function det_proposal_update($proposal_id)
	{
		$data['query']=$this->proposal_model->get_by_proposal($proposal_id);
		$data['query2']=$this->proposal_model->get_by_proposal2($proposal_id);
		$this->load->view('cso_include/det_invoice_update',$data);	
	}
	
	function print_invoice($proposal_id)
	{
		$this->load->library('pdf');
		$check_proposal=$proposal_id;
		$data['proposal_id']=$check_proposal;
		$data['query']=$this->proposal_model->get_by_proposal($check_proposal);
		$data['query2']=$this->proposal_model->get_by_proposal2($check_proposal);
		//$this->load->view('cso_include/invoice',$data);
		$filepdf=$this->load->view('cso_include/invoice',$data,TRUE);
		$this->pdf->pdf_create($filepdf,'Service Request Form');	
	}
}