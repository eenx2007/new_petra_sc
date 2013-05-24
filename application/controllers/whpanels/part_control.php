<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Part_control extends CI_Controller {
	
	function buy_new_part()
	{
		$part_numbernya='';
		$part_typenya='';
		$query=$this->the_part_model->get_all();
		foreach($query as $rows)
		{
			$part_numbernya.='"'.$rows->part_number.'",';
			$part_typenya.='"'.$rows->part_type.'",';
		}
		$part_numbernya.='"-"';
		$part_typenya.='"-"';
		$data['part_numbernya']=$part_numbernya;
		$data['part_typenya']=$part_typenya;
		$data['qpartorder']=$this->the_part_model->get_open_order();
		$this->load->view('wh_include/buy_part',$data);	
	}
	
	function save_new_order()
	{
		$this->the_part_model->part_number=$this->input->post('part_number');
		$this->the_part_model->part_order_from=$this->input->post('part_order_from');
		$this->the_part_model->part_order_qty=$this->input->post('part_order_qty');
		$this->the_part_model->part_order_price=$this->input->post('part_order_price');
		$totalprice=$this->input->post('part_order_qty')*$this->input->post('part_order_price');
		$this->the_part_model->part_order_total=$totalprice;
		$this->the_part_model->part_order_reff=$this->input->post('part_order_reff');
		$this->the_part_model->new_part_order();
		
		if($this->input->post('part_order_type')==1)
		{
			$this->the_part_model->part_number=$this->input->post('part_number');
			$this->the_part_model->part_name=$this->input->post('part_name');
			$this->the_part_model->part_type=$this->input->post('part_type');
			$this->the_part_model->save_new_part();
		}
		
		//saving the transaction
		$this->transaction_model->transaction_title='Order Part '.$this->input->post('part_number');
		$this->transaction_model->transaction_total=$totalprice;
		$this->transaction_model->transaction_type=1;
		$this->transaction_model->transaction_reff=$this->input->post('part_order_reff');
		$this->transaction_model->transaction_user=$this->input->post('user_id');
		$this->transaction_model->new_transaction();
		
	}
	
	function received()
	{
		$this->the_part_model->receive_part($this->input->post('part_order_id'));
		$row=$this->the_part_model->get_by_po_id($this->input->post('part_order_id'));
		$this->the_part_model->stock_in($row->part_number,'8001',$row->part_order_qty,$row->part_order_price);	
	}
	
	function part_enquiry()
	{
		$data['queryreq']=$this->the_part_model->get_stock();
		$this->load->view('wh_include/part_enquiry',$data);	
	}
	
	function check_part()
	{
		$row=$this->the_part_model->get_by_pn($this->input->post('part_number'));
		if($row=="new_part")
		{
			$kembali=array('part_name'=>'','part_type'=>'');
			echo json_encode($kembali);	
		}
		else
		{
			$kembali=array('part_name'=>$row->part_name,'part_type'=>$row->part_type);
			echo json_encode($kembali);
			
		}
	}
	
}