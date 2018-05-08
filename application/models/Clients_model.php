<?php

class Clients_Model extends CI_Model 
{

	public function get_type($id) 
	{
		return $this->db->where("ID", $id)->get("client_types");
	}

	public function get_user($id) 
	{
		return $this->db->where("ID", $id)->get("users");
	}

	public function get_client($roleid) 
	{
		return $this->db->where("user_role", $roleid)->get("users");
	}

	public function get_client_types() 
	{
		return $this->db->where('status',1)->get("client_types");
	}

	public function get_client_type($typeid) 
	{
		return $this->db->where('ID',$typeid)->get("client_types");
	}

	public function add_client_type($data) 
	{
		$this->db->insert("client_types", $data);
	}

	public function update_type($id, $data) 
	{
		$this->db->where("ID", $id)->update("client_types", $data);
	}

	public function delete_type($id) 
	{
		$this->db->where("ID", $id)->delete("client_types");
	}

	public function get_client_details($userid) 
	{
		return $this->db->where('user_id',$userid)->get("clients");
	}

	public function get_total_clients_all_count($roleId) 
	{ 
		if($roleId > 0) {
			$s = $this->db->select("COUNT(*) as num")->where("users.user_role", $roleId)->get("users");;
		}
		$r = $s->row();
		if(isset($r)) return $r->num;
		return 0;
	}

	public function get_all_clients($roleId, $datatable) 
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
				clients.phone_number as phone_number,client_types.name as client_type")
			->join("clients", 
					"clients.user_id = users.ID", "left outer")
			->join("client_types",  "client_types.ID = clients.customer_type")
			->limit($datatable->length, $datatable->start)
			->get("users");
	}

	public function add_client($data) 
	{
		$this->db->insert("users", $data);
		return $this->db->insert_id();
	}

	public function update_client($id, $data) 
	{
		$this->db->where("ID", $id)->update("users", $data);
	}

	public function add_client_details($data) 
	{
		$this->db->insert("clients", $data);
	}

	public function update_client_details($id, $data) 
	{
		$this->db->where("user_id", $id)->update("clients", $data);
	}

	public function delete_user_client($id) 
	{
		$this->db->where("ID", $id)->delete("users");
	}

	public function delete_client_details($id) 
	{
		$this->db->where("user_id", $id)->delete("clients");
	}

	
}