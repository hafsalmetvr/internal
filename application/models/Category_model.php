<?php

class Category_Model extends CI_Model 
{

	public function get_categories() 
	{
		return $this->db->get("categories");
	}

	public function get_category($id) 
	{
		return $this->db->where('ID',$id)->get("categories");
	}
	public function get_categoryname($name) 
	{
		return $this->db->where('category_name',$name)->get("categories");
	}

	public function add_category($data) 
	{
		$this->db->insert("categories", $data);
	}

	public function update_category($id, $data) 
	{
		$this->db->where("ID", $id)->update("categories", $data);
	}

	public function delete_category($id) 
	{
		$this->db->where("ID", $id)->delete("categories");
	}
}