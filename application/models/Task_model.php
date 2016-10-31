<?php 

class Task_model extends CI_Model
{

	function __construct(){
		parent::__construct();		
	}

	function create(){
		$this->db->insert("tbl_doni",array(
			"task"=>"",
			"date"=>date('Y-m-d'),
			"time"=>date('H:i:s'),
			));
		return $this->db->insert_id();
	}


	function read(){
		$this->db->order_by("id","desc");
		$query=$this->db->get("tbl_doni");
		return $query->result_array();
	}


	function update($id,$value,$modul){
		$this->db->where(array("id"=>$id));
		$this->db->update("tbl_doni",array($modul=>$value));
	}

	function delete($id){
		$this->db->where("id",$id);
		$this->db->delete("tbl_doni");
	}


}