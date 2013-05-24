<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transaction_model extends CI_Model {
	var $transaction_id='';
	var $transaction_date='';
	var $transaction_title='';
	var $transaction_total='';
	var $transaction_type='';
	var $transaction_reff='';
	var $transaction_user='';
	
	function new_transaction()
	{
		$this->db->set('transaction_date',time());
		$this->db->set('transaction_title',$this->transaction_title);
		$this->db->set('transaction_total',$this->transaction_total);
		$this->db->set('transaction_type',$this->transaction_type);
		$this->db->set('transaction_reff',$this->transaction_reff);
		$this->db->set('transaction_user',$this->transaction_user);
		$this->db->insert('transaction_list');	
	}
}