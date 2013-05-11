<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Messaging_model extends CI_Model {
	var $message_id='';
	var $message_sender='';
	var $message_to='';
	var $message_date='';
	var $case_id='';
	var $message_subject='';
	var $message_content='';
	var $message_flag='';
	var $message_status='';
	
	function new_message()
	{
		$this->db->set('message_sender',$this->message_sender);
		$this->db->set('message_to',$this->message_to);
		$this->db->set('message_date',time());
		$this->db->set('case_id',$this->case_id);
		$this->db->set('message_subject',$this->message_subject);
		$this->db->set('message_content',$this->message_content);
		$this->db->set('message_flag',0);
		$this->db->set('message_status',$this->message_status);
		$this->db->insert('messaging');
	}
	
	function get_unread($user_id)
	{
		$this->db->where('message_to',$user_id);
		$this->db->where('message_status',0);
		$query=$this->db->get('messaging');
		return $query->num_rows;	
	}
	
	function get_inbox($user_id)
	{
		$this->db->where('messaging.message_to',$user_id);	
		$this->db->where('messaging.message_status <',4);
		$this->db->join('user','user.user_id=messaging.message_sender');
		$this->db->order_by('messaging.message_id','DESC');
		$query=$this->db->get('messaging');
		return $query->result();
	}
	
	function get_sent($user_id)
	{
		$this->db->where('messaging.message_sender',$user_id);
		$this->db->join('user','user.user_id=messaging.message_to');
		$this->db->order_by('messaging.message_id','DESC');
		$query=$this->db->get('messaging');
		return $query->result();	
	}
	
	function get_by_id($message_id)
	{
		$this->db->where('messaging.message_id',$message_id);
		$this->db->join('user','user.user_id=messaging.message_sender');
		$query=$this->db->get('messaging');
		return $query->row();
	}
	
	function message_to_you_from($user_id,$message_to)
	{
		$this->db->where('message_sender',$user_id);
		$this->db->where('message_to',$message_to);
		$query=$this->db->get('messaging');
		return $query->num_rows;	
	}
	
	function check_new($user_id)
	{
		$this->db->where('messaging.message_to',$user_id);	
		$this->db->where('messaging.message_status <',2);
		$query=$this->db->get('messaging');
		return $query->num_rows;
	}
	
	function update_status($message_id,$new_status)
	{
		$this->db->set('message_status',$new_status);
		$this->db->where('message_id',$message_id);
		$this->db->update('messaging');	
	}
}