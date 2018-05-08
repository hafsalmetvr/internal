<?php

class Units_Model extends CI_Model 
{

	public function get_units() 
	{
		return $this->db->get("units");
	}

	public function get_unit($id) 
	{
		return $this->db->where('ID',$id)->get("units");
	}
	public function get_unitname($name) 
	{
		return $this->db->where('unit_name',$name)->get("units");
	}

	public function add_unit($data) 
	{
		$this->db->insert("units", $data);
	}

	public function update_unit($id, $data) 
	{
		$this->db->where("ID", $id)->update("units", $data);
	}

	public function delete_unit($id) 
	{
		$this->db->where("ID", $id)->delete("units");
	}
}