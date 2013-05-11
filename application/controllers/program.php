<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller {

	public function index()
	{
		$this->load->view('dashboard');
	}
	
	function main_dashboard()
	{
		$this->load->view('global_include/main_dashboard');	
	}
	
	function login_form()
	{
		$this->load->view('global_include/login_form');	
	}
	
	function login_process()
	{
		$this->db->where('user_id',$this->input->post('user_id'));
		$this->db->where('password',md5($this->input->post('password')));
		$querycek=$this->db->get('user');
		$totalcek=$querycek->num_rows;
		if($totalcek==0)
			$kembali=array('error'=>'yes');
		else
		{
			$rowcek=$querycek->row();
			write_file('./db_cache/message_for_'.$rowcek->user_id.'.txt', '');
			$this->session->set_userdata('user_type',$rowcek->user_type);
			$this->session->set_userdata('user_id',$rowcek->user_id);
			$this->session->set_userdata('sure_name',$rowcek->sure_name);
			if($rowcek->user_type==0)
				$user_type_text="Administrator";
			elseif($rowcek->user_type==1)
				$user_type_text="Customer Service Officer";
			elseif($rowcek->user_type==2)
				$user_type_text="System Admin";
			elseif($rowcek->user_type==3)
				$user_type_text="Engineer";
			elseif($rowcek->user_type==4)
				$user_type_text="Warehouse Admin";
			elseif($rowcek->user_type==5)
				$user_type_text="Quality Control";
			elseif($rowcek->user_type==6)
				$user_type_text="Technical Advisor";
			elseif($rowcek->user_type==7)
				$user_type_text="Cashier";
			
			$kembali=array('error'=>'no','user_id'=>$rowcek->user_id,'username'=>$rowcek->username,'user_type'=>$rowcek->user_type,'sure_name'=>$rowcek->sure_name,'user_type_text'=>$user_type_text,'user_image'=>$rowcek->user_image);
		}
		echo json_encode($kembali);
	}
	
	function case_in_today()
	{
		$data['query']=$this->case_model->get_today();
		$this->load->view('global_include/case_in_today',$data);	
	}
	
	function case_out_today()
	{
		$data['query']=$this->case_model->get_out_today();
		$this->load->view('global_include/case_out_today',$data);	
	}
	
	function cso_activity_today()
	{
		$data['query']=$this->cso_activity_model->get_today();
		$this->load->view('global_include/cso_act_today',$data);
	}
	
	function start_menu()
	{
		$this->load->view('global_include/start_menu');	
	}
	
	function user_select()
	{
		$this->db->where('user_id',$this->input->post('user_id'));
		$query=$this->db->get('user');
		$row=$query->row();
		$kembali=array('user_id'=>$row->user_id,'sure_name'=>$row->sure_name,'user_type'=>$this->global_model->get_user_type($row->user_type),'user_image'=>base_url().'assets/user_image/'.$row->user_image);
		echo json_encode($kembali);	
	}
	
	function price_list_manager()
	{
		$this->load->view('global_include/price_list_manager');	
	}
	
	function search_price_result($search_key,$search_type)
	{
		if($search_type==0)
		{
			$data['query']=$this->asp2_model->search_by_model($search_key);
		}
		elseif($search_type==1)
		{
			$data['query']=$this->asp2_model->search_by_pn($search_key);	
		}
		$this->load->view('global_include/search_price_result',$data);
	}
	
	function cso_statistic_today()
	{
		$data['query']=$this->cso_activity_model->get_statistic_today();
		$this->load->view('global_include/cso_statistic_today',$data);
	}
	
	function check_case()
	{
		$this->load->view('global_include/check_case');	
	}
	
	function search_do()
	{
		$this->case_model->case_id=urldecode($this->input->get('case_id'));
		$this->case_model->serial_number=urldecode($this->input->get('serial_number'));
		$this->case_model->customer_name=urldecode($this->input->get('customer_name'));
		$this->case_model->phone_number=urldecode($this->input->get('phone_number'));
		$data['case_id']=$this->input->get('cae_id');
		$data['serial_number']=$this->input->get('serial_number');
		$data['customer_name']=$this->input->get('customer_name');
		$data['phone_number']=$this->input->get('phone_number');
		$data['start_date']=$this->input->get('start_date');
		$data['end_date']=$this->input->get('end_date');
		$data['query']=$this->case_model->search_case($this->input->get('start_date'),$this->input->get('end_date'));
		$resultnya=$this->load->view('global_include/search_do',$data);
		echo $resultnya;
		
	}
	
	function export_to_xl()
	{
		$this->case_model->case_id=urldecode($this->input->get('case_id'));
		$this->case_model->serial_number=urldecode($this->input->get('serial_number'));
		$this->case_model->customer_name=urldecode($this->input->get('customer_name'));
		$this->case_model->phone_number=urldecode($this->input->get('phone_number'));
		$data['query']=$this->case_model->search_case($this->input->get('start_date'),$this->input->get('end_date'));
		$table=$this->load->view('global_include/export_to_xl',$data,TRUE);
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=querycase".time().".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $table;


	
	}
	
	function eng_statistic_today()
	{
		$data['query']=$this->case_model->get_eng_today();
		$this->load->view('global_include/eng_statistic_today',$data);
	}
	
	function case_detail($case_id)
	{
		$data['row']=$this->case_model->get_by_case_id($case_id);
		$this->load->view('global_include/case_detail',$data);
	}
	
	function get_detail_price($row_id)
	{
		$data['row']=$this->asp2_model->get_detail_price($row_id);
		$this->load->view('global_include/detail_price',$data);	
	}
	
	function messaging_manager()
	{
		$this->load->view('global_include/messaging_manager');	
	}
	
	function new_message()
	{
		$this->load->view('global_include/new_message');	
	}
	
	function send_the_message()
	{
		
		
		if($this->input->post('message_reply')=="yes")
		{
			$this->messaging_model->update_status($this->input->post('message_id'),2);
		}
		if($this->input->post('message_to')==101)
		{
			$query=$this->global_model->get_all_engineer();
			foreach($query as $rows)
			{
				write_file('./db_cache/message_for_'.$rows->user_id.'.txt', 'New message from '.$this->session->userdata('sure_name'));
				$this->messaging_model->message_sender=$this->input->post('user_id');
				$this->messaging_model->message_to=$rows->user_id;
				$this->messaging_model->case_id=$this->input->post('message_case_id');
				$this->messaging_model->message_subject=$this->input->post('message_subject');
				$this->messaging_model->message_content=$this->input->post('message_content');
				$this->messaging_model->new_message();		
			}
		}
		elseif($this->input->post('message_to')==102)
		{
			$query=$this->global_model->get_all_cso();
			foreach($query as $rows)
			{
				write_file('./db_cache/message_for_'.$rows->user_id.'.txt', 'New Message from '.$this->session->userdata('sure_name'));
				$this->messaging_model->message_sender=$this->input->post('user_id');
				$this->messaging_model->message_to=$rows->user_id;
				$this->messaging_model->case_id=$this->input->post('message_case_id');
				$this->messaging_model->message_subject=$this->input->post('message_subject');
				$this->messaging_model->message_content=$this->input->post('message_content');
				$this->messaging_model->new_message();		
			}
		}
		elseif($this->input->post('message_to')==103)
		{
			$query=$this->global_model->get_all_user();
			foreach($query as $rows)
			{
				if($rows->user_id<>$this->input->post('user_id'))
				{
					write_file('./db_cache/message_for_'.$rows->user_id.'.txt', 'New message from '.$this->session->userdata('sure_name'));
					$this->messaging_model->message_sender=$this->input->post('user_id');
					$this->messaging_model->message_to=$rows->user_id;
					$this->messaging_model->case_id=$this->input->post('message_case_id');
					$this->messaging_model->message_subject=$this->input->post('message_subject');
					$this->messaging_model->message_content=$this->input->post('message_content');
					$this->messaging_model->new_message();		
				}
			}
		}
		else
		{
			write_file('./db_cache/message_for_'.$this->input->post('message_to').'.txt', 'New message from '.$this->session->userdata('sure_name'));
			$this->messaging_model->message_sender=$this->input->post('user_id');
			$this->messaging_model->message_to=$this->input->post('message_to');
			$this->messaging_model->case_id=$this->input->post('message_case_id');
			$this->messaging_model->message_subject=$this->input->post('message_subject');
			$this->messaging_model->message_content=$this->input->post('message_content');
			$this->messaging_model->new_message();
		}
	}
	
	function message_inbox($user_id)
	{
		$data['query']=$this->messaging_model->get_inbox($user_id);
		$this->load->view('global_include/message_inbox',$data);	
	}
	
	function message_sent($user_id)
	{
		$data['query']=$this->messaging_model->get_sent($user_id);
		$this->load->view('global_include/message_sent',$data);	
	}
	
	function read_message($message_id,$last_status)
	{
		if($last_status==0)
			$this->messaging_model->update_status($message_id,1);
		$data['row']=$this->messaging_model->get_by_id($message_id);
		$this->load->view('global_include/read_message',$data);
	}
	
	function delete_message()
	{
		$this->messaging_model->update_status($this->input->get('message_id'),4);
	}
	
	function get_case_by_limit()
	{
		echo $this->case_model->get_by_limit(0,$this->input->get('limit'));
	}
	
	function reply_message($message_id)
	{
		$data['row']=$this->messaging_model->get_by_id($message_id);
		$this->load->view('global_include/reply_message',$data);
	}
	
	function close_message()
	{
		$this->messaging_model->update_status($this->input->post('message_id'),$this->input->post('new_status'));
	}
	
	function message_to_you_from()
	{
		echo $this->messaging_model->message_to_you_from($this->input->get('message_sender'),$this->input->get('message_to'));	
	}
	
	function refresh_message_status()
	{
		echo $this->messaging_model->get_unread($this->input->get('user_id'));	
	}
}

