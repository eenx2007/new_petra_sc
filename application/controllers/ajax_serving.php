<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_serving extends CI_Controller {
	
	function the_long_polling()
	{
		//get hit from main_dashboard function get_long_polling();
		$time=time();
		$kembali=array();
		$file_message_to_check="./db_cache/message_for_".$this->input->get('user_id').'.txt';
		$file_new_case_to_check="./db_cache/new_case_check.txt";
		$file_case_out_to_check="./db_cache/case_out_check.txt";
		$file_fd_to_check="./db_cache/fd_activity.txt";
		$existing_message=$this->input->get('total_message');
		$existing_case_in=$this->input->get('case_in');
		$existing_case_out=$this->input->get('case_out');
		$existing_fd_activity=$this->input->get('fd_activity');
		$last_modif_message=$this->input->get('last_modif_msg');
		$last_modif_new_case=$this->input->get('last_modif_nc');
		$last_modif_case_out=$this->input->get('last_modif_co');
		$last_modif_fd_act=$this->input->get('last_modif_fd');
		if(isset($_GET['last_modif_ut']))
		{
			$existing_under_testing=$this->input->get('under_testing');
			$file_ut_to_check='./db_cache/under_testing.txt';
			$last_modif_under_testing=$this->input->get('last_modif_ut');	
		}
		if(isset($_GET['last_modif_rc']))
		{
			$existing_repair_complete=$this->input->get('repair_complete');
			$file_rc_to_check='./db_cache/repair_complete.txt';
			$last_modif_repair_complete=$this->input->get('last_modif_rc');
		}
		while((time()-$time)<60)
		{
			
			//get the value given from main_dashboard
			$adakembali=0;
			$file_time_message=filemtime($file_message_to_check);
			clearstatcache();
			//check if there's new message
			if($last_modif_message<$file_time_message)
			{
				$kembali['new_message']=read_file("./db_cache/message_for_".$this->input->get('user_id').'.txt');
				$kembali['last_modif_message']=$file_time_message;
				$kembali['total_unread']=$this->messaging_model->get_unread($this->input->get('user_id'));
				$adakembali++;
				
			}
			$file_time_new_case=filemtime($file_new_case_to_check);
			clearstatcache();
			//check if there's new case
			if($file_time_new_case>$last_modif_new_case)
			{
				$case_in_cek=$this->case_model->get_today('yes');
				$kembali['last_modif_new_case']=$file_time_new_case;
				$kembali['selisih_cin']=$case_in_cek-$existing_case_in;
				$kembali['new_total_cin']=$case_in_cek;
				$adakembali++;
			}
			//check if there's case out
			$file_time_case_out=filemtime($file_case_out_to_check);
			clearstatcache();
			if($file_time_case_out>$last_modif_case_out)
			{
				$case_out_cek=$this->case_model->get_out_today('yes');
				$kembali['last_modif_case_out']=$file_time_case_out;
				$kembali['selisih_cout']=$case_out_cek-$existing_case_out;
				$kembali['new_total_cout']=$case_out_cek;
				$adakembali++;
			}
			//check if there's new fd activity
			$file_time_fd_act=filemtime($file_fd_to_check);
			clearstatcache();
			if($file_time_fd_act>$last_modif_fd_act)
			{
				$fd_activity_cek=$this->cso_activity_model->get_cek_today();
				$kembali['new_fd_act']=read_file('./db_cache/fd_activity.txt');
				$kembali['last_modif_fd_act']=$file_time_fd_act;
				$kembali['selisih_fd']=$fd_activity_cek-$existing_fd_activity;
				$kembali['new_total_fd']=$fd_activity_cek;
				$adakembali++;	
			}
			if(isset($_GET['last_modif_ut']))
			{
				$file_time_ut=filemtime($file_ut_to_check);
				clearstatcache();
				if($file_time_ut>$last_modif_under_testing)
				{
					$under_testing_cek=$this->case_model->get_under_testing("yes");
					$kembali['new_ut_text']=read_file('./db_cache/under_testing.txt');
					$kembali['last_modif_under_testing']=$file_time_ut;
					$kembali['new_total_ut']=$under_testing_cek;
					$adakembali++;
				}
			}
			if(isset($_GET['last_modif_rc']))
			{
				$file_time_rc=filemtime($file_rc_to_check);
				clearstatcache();
				if($file_time_rc>$last_modif_repair_complete)
				{
					$repair_complete_cek=$this->case_model->get_out_today("yes");
					$kembali['new_rc_text']=read_file('./db_cache/repair_complete.txt');
					$kembali['last_modif_repair_complete']=$file_time_rc;
					$kembali['new_repair_complete']=$repair_complete_cek;
					$adakembali++;	
				}
			}
			if($adakembali>0)
			{
				$kembali['ada_kembali']=$adakembali;
				echo json_encode($kembali);
				break;	
			}
			clearstatcache();
			usleep(55000);
		}
	}
	
	
}