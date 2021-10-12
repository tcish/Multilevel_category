<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class category extends CI_Controller {
	public function index(){
		$data["tree_fetch"] = $this->category_model->get_tree_view();
		$this->load->view('index', $data);
	}

	public function insert(){
		$this->category_model->add_cat();
	}

	public function edit($id, $pId){
		$data["id"] = $id;
		$data["pId"] = $pId;
		
		$this->category_model->upCat($id);
	}

	public function del($id){
		$data["id"] = $id;

		$this->category_model->delData($id);
	}
}
