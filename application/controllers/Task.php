<?php 

class Task extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model('task_model');
		$this->load->helper('url');
		$this->load->database();
	}


	function index(){

		$data["task"]=$this->task_model->read();
		$this->load->view("task",$data);

	}

	function create(){
		echo json_encode(array("id"=>$this->task_model->create()));
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->task_model->update($id,$value,$modul);
		echo "{}";
	}

	function delete(){
		$id= $this->input->post("id");
		$this->task_model->delete($id);
		echo "{}";
	}

}