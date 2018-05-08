<?php

class Suppliers_Model extends CI_Model 
{

	public function get_type($id) 
	{
		return $this->db->where("ID", $id)->get("supplier_type");
	}

	public function get_user($id) 
	{
		return $this->db->where("ID", $id)->get("users");
	}

	public function get_supplier_types() 
	{
		return $this->db->where('status',1)->get("supplier_type");
	}

	public function get_supplier_details($userid) 
	{
		return $this->db->where('user_id',$userid)->get("suppliers");
	}

	public function add_supplier_type($data) 
	{
		$this->db->insert("supplier_type", $data);
	}

	public function update_type($id, $data) 
	{
		$this->db->where("ID", $id)->update("supplier_type", $data);
	}

	public function delete_type($id) 
	{
		$this->db->where("ID", $id)->delete("supplier_type");
	}

	public function get_total_suppliers_all_count($roleId) 
	{ 
		if($roleId > 0) {
			$s = $this->db->select("COUNT(*) as num")->where("users.user_role", $roleId)->get("users");;
		}
		$r = $s->row();
		if(isset($r)) return $r->num;
		return 0;
	}

	public function get_all_suppliers($roleId, $datatable) 
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
				suppliers.company_phone_number as phone_number,supplier_type.name as supplier_type")
			->join("suppliers", 
					"suppliers.user_id = users.ID", "left outer")
			->join("supplier_type",  "supplier_type.ID = suppliers.supplier_type")
			->limit($datatable->length, $datatable->start)
			->get("users");
	}

	public function add_supplier($data) 
	{
		$this->db->insert("users", $data);
		return $this->db->insert_id();
	}

	public function update_supplier($id, $data) 
	{
		$this->db->where("ID", $id)->update("users", $data);
	}

	public function add_supplier_details($data) 
	{
		$this->db->insert("suppliers", $data);
	}

	public function update_supplier_details($id, $data) 
	{
		$this->db->where("user_id", $id)->update("suppliers", $data);
	}

	public function delete_user_supplier($id) 
	{
		$this->db->where("ID", $id)->delete("users");
	}

	public function delete_supplier_details($id) 
	{
		$this->db->where("user_id", $id)->delete("clients");
	}

}