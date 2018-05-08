<?php

class Expense_model extends CI_Model 
{

	public function get_categories() 
	{
		return $this->db->get("expense_categories");
	}

	public function get_categories_datatable($datatables) 
	{
		return $this->db->get("expense_categories");
		$datatable->db_order();

		$datatable->db_search(array(
			"expense_categories.expense_category"
			)
		);

		return $this->db
			->select("expense_categories.expense_category")
			->limit($datatable->length, $datatable->start)
			->get("expense_categories");
	}

	public function get_category($id) 
	{
		return $this->db->where("ID", $id)->get("expense_categories");
	}

	public function delete_category($id) 
	{
		$this->db->where("ID", $id)->delete("expense_categories");
	}

	public function update_category($id, $data) 
	{
		$this->db->where("ID", $id)->update("expense_categories", $data);
	}

	public function add_category($data) 
	{
		$this->db->insert("expense_categories", $data);
	}
	public function get_expense_categories_total() 
	{
		$query = $this->db->query('SELECT ID FROM expense_categories');
		return  $query->num_rows();
	}

}

?>