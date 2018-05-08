<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchases extends CI_Controller {
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
			array("purchases" => array("add" => 1)));

		$types = $this->suppliers_model->get_supplier_types();

		$this->template->loadContent("purchases/index.php", array(
			"supplier_types" => $types,
			"supplier" => $this->purchases_model->get_supplier(),
			"units" => $this->purchases_model->get_units(),
			"warehouses" => $this->purchases_model->get_warehouses(),
			)
		);
	}
	
	public function add() {
		
		if ($this->input->post("purchase_date")) {
			$supplier = $this->input->post("supplier");
			$mode_of_purchase = $this->input->post("mode_of_purchase");
			$purchase_date = $this->input->post("purchase_date");
			$payment_by = $this->input->post("payment_by");
			$overdue_date = $this->input->post("overdue_date");
			$biller_name = $this->input->post("biller_name");
			$ware_house = $this->input->post("ware_house");
			$invoice_no = $this->input->post("invoice_no");
			
			$total_paid = $this->input->post("total_paid");
			$discount = $this->input->post("discount");
			
			$shipping_cost = (float) $this->input->post("shipping_cost");
			$transportation = (float) $this->input->post("transportation");
			$commission = (float) $this->input->post("commision");
			$other_expense = (float) $this->input->post("other-expence");
			
			$items_count = $this->input->post("items_count");
			$total_amount = 0;
			$total_vat = 0;
			$total_qty = 0;
			
			$total_cost = $shipping_cost + $transportation + $commission + $other_expense;
			
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST["item_quantity_" . $i])) {
					continue;
				}
				
				$tp = $_POST["item_quantity_" . $i] * $_POST["item_price_" . $i];
				
				if (!empty($_POST['item_vat_' . $i])) {
					$vat = $tp * $_POST['item_vat_' . $i] / 100;
					$tp = $tp + $vat;
					$total_vat = $total_vat + $vat;
				}
				
				$total_amount = $total_amount + $tp;
				$total_qty = $total_qty + $_POST["item_quantity_" . $i];
			}
			
			$data_main = array(
				'supplier' => $supplier,
				'purchase_date' => $purchase_date,
				'purchase_overdue' => $overdue_date,
				'warehouse' => $ware_house,
				'mode_of_purchase' => $mode_of_purchase,
				'payment_by' => $payment_by,
				'biller_name' => $biller_name,
				'sales_invoice' => $invoice_no,
				'total_amount' => $total_amount,
				'total_vat' => $total_vat,
				'total_amount_without_tax' => $total_amount - $total_vat,
				'amount_paid' => (float) $total_paid,
				'discount' => $discount,
				'shipping_cost' => $shipping_cost,
				'transportation' => $transportation,
				'commission' => $commission,
				'other_expense' => $other_expense,
				'total_cost' => $total_cost,
				'time' => time(),
				'ip' => $_SERVER['REMOTE_ADDR']
			);
						
			$pi_id = $this->purchases_model->add_purchases($data_main);
			$per_quantity_cost = 0;
			
			if (!empty($total_cost)) {
				$per_quantity_cost = $total_cost / $total_qty;
			}
						
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST["item_id_" . $i])) {
					continue;
				}
				
				$tot = 0;
				$item_id = $this->input->post("item_id_" . $i);
				$item_name = $this->input->post("item_name_" . $i);
				$unit = $this->input->post("item_unit_" . $i);
				$quantity = $this->input->post("item_quantity_" . $i);
				$quantity_per_unit = $this->input->post("item_quantity_unit_" . $i);
				$price = (float) $this->input->post("item_price_" . $i);
				$vat = $this->input->post("item_vat_" . $i);
				
				$unit = 0;
				$vat_price = 0;
				$tot = $price * $quantity;
				
				if (!empty($vat)) {
					$vat_price = $price * $quantity;
					$vat_price = $vat_price * $vat/100;
					$tot = $vat_price + $tot;
				}
				
				$p = 0;
				
				if (!empty($quantity_per_unit)) {
					$p = (float) $price/$quantity_per_unit;
				}
				
				$data = array(
					'parent_id' => $pi_id,
					'item_id' => $item_id,
					'item_name' => $item_name,
					'unit' => $unit,
					'quantity' => $quantity,
					'quantity_per_unit' => $quantity_per_unit,
					'price' => $price,
					'price_per_unit' => $p,
					'vat_percentage' => $vat,
					'vat_amount' => $vat_price,
					'total' => $tot,
					'time' => time(),
					'ip' => $_SERVER['REMOTE_ADDR']
				);
				
				$this->purchases_model->insert_items($data);
				
								
				$purchase_price = $per_quantity_cost + ($price * $quantity) + $vat_price;
				
				if (!empty($item_id)) {
					$s = $this->purchases_model->get_stock($item_id);
					
					foreach($s->result() AS $k){}
					
					if (!empty($k)) {
						
						$purchase_per_price = 0;
						
						if (!empty($quantity_per_unit)) {
							$purchase_per_price = $purchase_price / $quantity_per_unit;
						}
						
						$stock_update = array(
							'quantity' => $k->quantity + $quantity,
							'quantity_per' => $k->quantity_per + $quantity_per_unit,
							'purchase_price' => $purchase_price,
							'sell_price' => 0,
							'purchase_per_price' => $purchase_per_price,
							'sell_per_price' => 0,
							'unit' => $unit,
							'warehouse' => $ware_house,
							'time' => time()
						);
						
						//print_r($stock_update);
						
						/*echo '<pre>';
						print_r($stock_update);
						echo '</pre>';*/
						
						$this->purchases_model->update_stock($item_id, $stock_update);
						
					}
					else {
						$purchase_per_price = 0;
						
						if (!empty($quantity_per_unit)) {
							$purchase_per_price = $purchase_price / $quantity_per_unit;
						}
						
						$stock_insert = array(
							'item_id' => $item_id,
							'quantity' => $quantity,
							'quantity_per' => $quantity_per_unit,
							'purchase_price' => $purchase_price,
							'sell_price' => 0,
							'purchase_per_price' => $purchase_per_price,
							'sell_per_price' => 0,
							'unit' => $unit,
							'warehouse' => $ware_house,
							'time' => time()
						);
						
						/*echo '<pre>';
						print_r($stock_insert);
						echo '</pre>';*/
						
						$this->purchases_model->insert_stock($stock_insert);
					}
				}
				
			}
			
		}
		
		$this->load->helper('url');
		redirect('products/purchase_management', 'refresh');
		
	}
	
	public function order() {
		$this->template->loadData("activeLink", array("purchases" => array("general" => 1)));
		
		$this->template->loadContent("purchases/orders.php", array(
				"page" => 'index',
				"supplier" => $this->purchases_model->get_supplier(),
				"projects" => $this->projects_model->get_all_active_projects(),
				"orders" => $this->purchases_model->get_all(),
			)
		);
	}
	
	public function edit() {
		$this->template->loadData("activeLink", array("purchases" => array("general" => 1)));
		
		$this->template->loadContent("purchases/edit_order.php", array(
				"page" => 'index',
				"supplier" => $this->purchases_model->get_supplier(),
				"projects" => $this->projects_model->get_all_active_projects(),
			)
		);
	}
	
	public function order_add() {

		if ($this->input->post("delivery_before")) {
			
			$delivery_before = $this->input->post("delivery_before");
			
			if (empty($delivery_before)) {
				$delivery_before = time();
			}
			else {
				$delivery_before = strtotime(str_replace('/','-', $delivery_before));
			}
			
			if (empty($delivery_at)) {
				$delivery_at = time();
			}
			else {
				$delivery_at = strtotime(str_replace('/','-', $delivery_at));
			}
			
			$delivery_at = $this->input->post("delivery_at");
			$supplier = $this->input->post("supplier");
			$project = $this->input->post("project");
			$items_count = $this->input->post("items_count");
			
			$data_main = array(
				'supplier' => $supplier,
				'project' => $project,
				'date' => time(),
				'delivery_date' => $delivery_before,
				'delivery_at' => $delivery_at,
				'time' => time()
			);
			
			
			
			$pi_id = $this->purchases_model->add_order_parent($data_main);
			
			for($i=1;$i<=$items_count;$i++) {
				
				$in = "item_name_{$i}";
				$id = "item_desc_{$i}";
				$ip = "item_price_{$i}";
				$iq = "item_quantity_{$i}";
				
				$item_name = $_POST[$in];
				$item_desc = $_POST[$id];
				$item_price = $_POST[$ip];
				$item_quantity = $_POST[$iq];
				
				$data_c = array(
					'parent_id' => $pi_id,
					'products' => $item_name,
					'description' => $item_desc,
					'quantity' => $item_quantity,
					'price' => $item_price,
					'time' => time(),
					'unit' => 'B'
				);
	
				$this->purchases_model->add_order_child($data_c);
				
			}
			
			
			//add_order_child
		}
		
		
		
		$this->template->loadData("activeLink", array("purchases" => array("general" => 1)));
		
		$this->template->loadContent("purchases/add_order.php", array(
				"page" => 'index',
				"supplier" => $this->purchases_model->get_supplier(),
				"projects" => $this->projects_model->get_all_active_projects(),
			)
		);
	}
	
}
