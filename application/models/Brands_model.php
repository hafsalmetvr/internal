<?php

class Brands_Model extends CI_Model 
{

	public function get_brands() 
	{
		return $this->db->get("brands");
	}

	public function get_brand($id) 
	{
		return $this->db->where('ID',$id)->get("brands");
	}
	public function get_brandname($name) 
	{
		return $this->db->where('brand_name',$name)->get("brands");
	}

	public function add_brand($data) 
	{
		$this->db->insert("brands", $data);
	}

	public function update_brand($id, $data) 
	{
		$this->db->where("ID", $id)->update("brands", $data);
	}

	public function delete_brand($id) 
	{
		$this->db->where("ID", $id)->delete("brands");
	}

	//product name 

	public function get_names() 
	{
		return $this->db->get("product_name");
	}

	public function get_name($id) 
	{
		return $this->db->where('ID',$id)->get("product_name");
	}

	public function add_name($data) 
	{
		$this->db->insert("product_name", $data);
	}

	public function update_name($id, $data) 
	{
		$this->db->where("ID", $id)->update("product_name", $data);
	}

	public function delete_name($id) 
	{
		$this->db->where("ID", $id)->delete("product_name");
	}
}