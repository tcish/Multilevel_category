<?php
  require_once(APPPATH . 'models/AB_Model.php');

  class category_model extends AB_Model{
    public function get_parent_cat(){
      $p_cat_query = $this->db->get('category');
      return $p_cat_query->result_array();
    }

    public function add_cat() {
      $this->form_validation->set_rules("cat", "Category", "required|trim");
 
     if($this->form_validation->run() == FALSE) {
				$data["p_cat"] = $this->category_model->get_parent_cat();
        $this->load->view("insertCat", $data);
     }else{
       $userData = array(
        "name" => $this->input->post("cat"),
        "parent_id" => $this->input->post("parentCat"),
       );
       $this->db->insert("category", $userData);
       redirect('category/');
     }
    }

    public function get_tree_view(){
      $get_tree = $this->db->get('category');
      return $get_tree->result_array();
    }

    public function edit_fetch($id){
      $all = $this->db->select("*")->from("category")->where("id", $id)->get();
      return $all->result_array();
    }

    public function upCat($id){
      $this->form_validation->set_rules("cat", "Category", "required|trim");
 
      if($this->form_validation->run() == FALSE) {
        $data["all"] = $this->category_model->get_parent_cat();
        $data["editGet"] = $this->category_model->edit_fetch($id);
        $this->load->view("edit_category", $data);
      }else{
        $userData = array(
          "name" => $this->input->post("cat"),
          "parent_id" => $this->input->post("parentCat"),
        );
        $this->db->where("id", $id)->update("category", $userData);
        redirect('category/');
      }
    }

    public function delData($id){
      $this->db->or_where("id", $id)->or_where("parent_id", $id)->delete("category");
      redirect("category/");
    }
  }
?>