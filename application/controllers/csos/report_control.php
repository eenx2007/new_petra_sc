<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_control extends CI_Controller {

	function print_srf($case_id)
	{
		//$this->load->library('pdf');
		$data['row']=$this->case_model->get_by_case_id($case_id);
		//$filepdf=$this->load->view('cso_include/srf',$data,TRUE);
		//$this->pdf->pdf_create($filepdf,'Service Request Form');
		$output = $this->load->view("cso_include/srf", $data,TRUE);
		header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
   		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
   		header('Content-disposition: attachment; filename="'.$case_id.'.doc"');

   		
   		echo $output;
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
	
	function print_invoice($proposal_id)
	{
		//$this->load->library('pdf');
		$check_proposal=$proposal_id;
		$data['proposal_id']=$check_proposal;
		$data['row']=$this->proposal_model->get_by_proposal_id($proposal_id);
		$data['query']=$this->proposal_model->get_by_proposal($check_proposal);
		$data['query2']=$this->proposal_model->get_by_proposal2($check_proposal);
		$data['discount']=0;
		$data['ppn']=0;
		$data['down_payment']=0;
		$output=$this->load->view('cso_include/invoice',$data,TRUE);
		//$filepdf=$this->load->view('cso_include/invoice',$data,TRUE);
		//$this->pdf->pdf_create($filepdf,'Service Request Form');	
		header("Content-Type: application/vnd.ms-word");
	    header("Expires: 0");
   		header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
   		header('Content-disposition: attachment; filename="I-'.$proposal_id.'.doc"');
		
		echo $output;
	}
}