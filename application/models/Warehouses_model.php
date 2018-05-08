<?php

class Warehouses_Model extends CI_Model 
{

	public function get_warehouses() 
	{
		return $this->db->get("warehouses");
	}

	public function get_warehouse($id) 
	{
		return $this->db->where('ID',$id)->get("warehouses");
	}

	public function add_warehouse($data) 
	{
		$this->db->insert("warehouses", $data);
	}

	public function update_warehouse($id, $data) 
	{
		$this->db->where("ID", $id)->update("warehouses", $data);
	}

	public function delete_warehouse($id) 
	{
		$this->db->where("ID", $id)->delete("warehouses");
	}

}