<?php

class Vendors_Model extends CI_Model 
{

	public function get_type($id) 
	{
		return $this->db->where("ID", $id)->get("vendor_types");
	}

	public function get_user($id) 
	{
		return $this->db->where("ID", $id)->get("users");
	}

	public function get_client($roleid) 
	{
		return $this->db->where("user_role", $roleid)->get("users");
	}

	public function get_vendor_types() 
	{
		return $this->db->where('status',1)->get("vendor_types");
	}

	public function get_vendor_type($typeid) 
	{
		return $this->db->where('ID',$typeid)->get("vendor_types");
	}

	public function get_vendor_details($userid) 
	{
		return $this->db->where('user_id',$userid)->get("vendors");
	}

	public function get_total_vendors_all_count($roleId) 
	{ 
		if($roleId > 0) {
			$s = $this->db->select("COUNT(*) as num")->where("users.user_role", $roleId)->get("users");;
		}
		$r = $s->row();
		if(isset($r)) return $r->num;
		return 0;
	}

	public function get_all_vendors($roleId, $datatable) 
	{
		if($roleId > 0) {
			$this->db->where("users.user_role", $roleId);
		}

		$datatable->db_order();

		$datatable->db_search(array(
			"users.username"
			)
		);

		return $this->db
			->select("users.username, users.ID, users.email, 
				users.online_timestamp,
				vendors.phone_number as phone_number,vendor_types.name as vendor_type")
			->join("vendors", 
					"vendors.user_id = users.ID", "left outer")
			->join("vendor_types",  "vendor_types.ID = vendors.vendor_type")
			->limit($datatable->length, $datatable->start)
			->get("users");
	}

	public function add_vendor($data) 
	{
		$this->db->insert("users", $data);
		return $this->db->insert_id();
	}

	public function update_vendor($id, $data) 
	{
		$this->db->where("ID", $id)->update("users", $data);
	}

	public function add_vendor_details($data) 
	{
		$this->db->insert("vendors", $data);
	}

	public function update_vendor_details($id, $data) 
	{
		$this->db->where("user_id", $id)->update("vendors", $data);
	}

	public function delete_user_vendor($id) 
	{
		$this->db->where("ID", $id)->delete("users");
	}

	public function delete_vendor_details($id) 
	{
		$this->db->where("user_id", $id)->delete("vendors");
	}

	public function add_vendor_type($data) 
	{
		$this->db->insert("vendor_types", $data);
	}

	public function update_type($id, $data) 
	{
		$this->db->where("ID", $id)->update("vendor_types", $data);
	}

	public function delete_type($id) 
	{
		$this->db->where("ID", $id)->delete("vendor_types");
	}

}