<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("purchases_model");
		$this->load->model("projects_model");
		$this->load->model("suppliers_model");
	}
	
	public function index() 
	{
		$this->template->loadData("activeLink", 
			array("product_settings_links" => array("add" => 1)));

		$types = $this->suppliers_model->get_supplier_types();

		$this->template->loadContent("products/purchase_management.php", array(
			"supplier_types" => $types,
			"supplier" => $this->purchases_model->get_supplier(),
			)
		);
	}
	
	public function purchase_management() {
				
		if ($this->input->post("add_product")) {
		
			$products = $_POST['products'];
						
			foreach($products AS $product_id) {
				$sale_price = $_POST['sale_price_' . $product_id];
				$sale_id = $_POST['sale_id_' . $product_id];
				//$product_id;
				
				$stocks = $this->purchases_model->get_stock($product_id);
				
				foreach ($stocks->result() AS $stock) {
					$stock_id = $stock->id;
					$per_price = $sale_price / $stock->quantity_per;
					
					$update = array(
						'sell_price' => $sale_price,
						'sell_per_price' => $per_price,
					);
					
					$this->purchases_model->update_stock($product_id, $update);
					
				}
				
				$sql = "UPDATE `purchases` SET `process`='1' WHERE `id`='$sale_id'";
				$this->purchases_model->update_purchase($sql);
				
			} 
			
		}
		
		$this->template->loadData("activeLink", 
			array("product_settings" => array("add" => 1)));
		$this->template->loadData("activeLink", 
			array("product_settings" => array("add" => 1)));

		$types = $this->suppliers_model->get_supplier_types();

		$this->template->loadContent("products/purchase_management.php", array(
			"supplier_types" => $types,
			"supplier" => $this->purchases_model->get_supplier(),
			"purchases" => $this->purchases_model->get_purchases_not_process()
			)
		);
	}
	
	public function get_purchase_items() {
		
		
		$id = $this->input->get('id');
		$p_items = $this->purchases_model->get_purchase_items($id);
		
		foreach($p_items->result() AS $items) {
			if ($items->item_id != 0) {
				$product_id = $items->item_id;
				$s_details = $this->purchases_model->get_stock($product_id);
				
				foreach($s_details->result() AS $s) {
					$sl = 1;
					?>
						<tr>
							<td><?=$sl;?></td>
							<td>Item id</td>
							<td><?=$s->unit;?></td>
							<td id="Q<?=$sl?>"><?=$s->quantity;?></td>
							<td><?=$s->purchase_price;?></td>
							<td><?=$s->quantity_per;?></td>
							<td><?=$s->purchase_per_price;?></td>
							<td><input type="hidden" name="sale_id_<?=$product_id?>" value="<?=$id;?>" /><input type="hidden" name="products[]" value="<?=$product_id?>" /><input style="width: 70px;" type="text" name="sale_price_<?=$product_id?>" id="se<?=$sl?>" required=""/></td>
						</tr>
					<?php
				}
			}
		}
		
	}
	
}
