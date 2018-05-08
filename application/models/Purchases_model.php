<?php

class Purchases_Model extends CI_Model 
{
	public function get_supplier() 
	{	
		$sql = "SELECT * FROM users AS U, suppliers AS S, supplier_type AS st WHERE S.user_id = U.ID AND st.ID = S.supplier_type";
		return $this->db->query($sql);
	}
	
	public function add_order_parent($data) 
	{
		$this->db->insert("purchase_order", $data);
		return $this->db->insert_id();
	}
	
	public function add_order_child($data) {
		$this->db->insert("purchase_order_items", $data);
	}
	
	public function insert_stock($data) {
		$this->db->insert("stock", $data);
	}
	
	public function insert_items($data) {
		$this->db->insert("purchase_items", $data);
	}
		
	public function get_all() {
		$sql = "SELECT * FROM purchase_order AS PO, purchase_order_items AS poi WHERE PO.id = poi.parent_id ORDER BY PO.id DESC";
		return $this->db->query($sql);
	}
	
	public function get_stock($id) {
		$sql = "SELECT * FROM stock WHERE `item_id`='$id'";
		return $this->db->query($sql);
	}
	
	public function update_stock($id, $data) 
	{
		$this->db->where("item_id", $id)->update("stock", $data);
	}
	
	public function add_purchases($data) 
	{
		$this->db->insert("purchases", $data);
		return $this->db->insert_id();
	}
	
	public function get_purchases_not_process()
	{
		return $this->db->where("process", 0)->get("purchases");
	}
	
	public function get_purchase_items($id)
	{
		return $this->db->where("parent_id", $id)->get("purchase_items");
	}
	
	public function update_purchase($sql) {
		$this->db->query($sql);
	}
	
	public function get_units() {
		$sql = "SELECT * FROM units";
		return $this->db->query($sql);
	}
	
	public function get_warehouses() {
		$sql = "SELECT * FROM warehouses";
		return $this->db->query($sql);
	}
	
	
	/*public function get_stock($product_id) {
		return $this->db->where("item_id", $product_id)->get("stock");
	}*/
	
	
	
}
