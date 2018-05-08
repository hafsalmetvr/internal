<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("quotes_model");
		$this->load->model("projects_model");
		$this->load->model("suppliers_model");
	}
	
	public function change_status() {
		$id = $this->uri->segment('3');
		$status = $this->uri->segment('4');
		
		$data = array(
			'status' => (int) $status
		);
		
		$this->quotes_model->update_quotation_status($id, $data);
		
	}
	
	
	public function edit() 
	{	
		$id = $this->uri->segment('3');
		
		if ($this->input->post('date')) {
			$clientid = (int) $this->input->post('clientid');
			$date = $this->input->post('date');
			$date_valid = $this->input->post('date_valid');
			$attention = $this->input->post('attention');
			
			$refno = $this->input->post('refno');
			$project = $this->input->post('project');
			$location = $this->input->post('location');
			$notes = $this->input->post('notes');
			$term_notes = $this->input->post('term_notes');
			$hidden_notes = $this->input->post('hidden_notes');
			$items_count = $this->input->post('items_count');
			
			$TA = 0;
			$TV = 0;
			
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST['item_quantity_' . $i])) {
					continue;
				}
				
				$qty = $this->input->post('item_quantity_' . $i);
				$price = $this->input->post('item_amount_' . $i);
				$vat = $this->input->post('item_vat_' . $i);
				
				$t_amount = $price * $qty;
				$t_vat = 0;
				
				if (!empty($vat)) {
					$t_vat = $t_amount * $vat / 100;
				}
				
				$t_amount = $t_amount + $t_vat;
				$TA = $TA + $t_amount;
				$TV = $TV + $t_vat;
			}
			
			
			$data = array(
				'client' => (float) $clientid,
				'attention' => (string) $attention,
				'ref_no' => (string) $refno,
				'project' => (string) $project,
				'location' => (string) $location,
				'date' => (string) $date,
				'date_upto' => (string) $date_valid,
				'notes' => (string) $notes,
				'term_notes' => (string) $term_notes,
				'hidden_notes' => (string) $hidden_notes,
				'total_amount' => (float) $TA,
				'total_vat' => (float) $TV,
			);
			
			
			$this->quotes_model->update_quotations($id, $data);
			$q_id = $id;
			$this->quotes_model->delete_quotation_items($id);
			
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST['item_quantity_' . $i])) {
					continue;
				}
				
				$t_amount = 0;
				$qty = $this->input->post('item_quantity_' . $i);
				$price = $this->input->post('item_amount_' . $i);
				$vat = $this->input->post('item_vat_' . $i);
				$item_name = $this->input->post('item_name_' . $i);
				$item_id = $this->input->post('item_id_' . $i);
				$item_description = $this->input->post('item_description_' . $i);
				
				$t_amount = $price * $qty;
				$t_vat = 0;
				
				if (!empty($vat)) {
					$t_vat = $t_amount * $vat / 100;
				}
				
				$total = $t_amount + $t_vat;
				
				$quotation_items = array(
					"parent_id" => $q_id,
					"item_name" => (string) $item_name,
					"item_id" => (int) $item_id,
					"description" => (string) $item_description,
					"quantity" => (float) $qty,
					"amount" => (float) $t_amount,
					"vat_percentage" => $vat,
					"vat_amount" => $t_vat,
					"total_amount" => $total
				);
				
				$this->quotes_model->insert_quotation_items($quotation_items);
								
			}
			
			$this->load->helper('url');
			redirect('quotes/view_quotations', 'refresh');
			
		}
		
		
		$this->template->loadData("activeLink", 
			array("quotes" => array("quotations" => 1)));

		$this->load->model("clients_model");
		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);
		
		$quotations = $this->quotes_model->get_quote($id);
		$quotation_items = $this->quotes_model->get_quote_items($id);

		$this->template->loadContent("quotes/edit_quotations.php", array(
			"clients" => $clients,
			"quotations" => $quotations,
			"quotation_items" => $quotation_items
			)
		);
	}
	
	public function lists() {
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		
		$quotes = $this->quotes_model->get_quotes();
		$data = array();

		foreach($quotes->result() as $r) {

		   $data[] = array(
				$r->date,
				$r->id,
				$r->client,
				$r->status,
		   );
		}
          
		$output = array(
		   "draw" => $draw,
			 "recordsTotal" => $quotes->num_rows(),
			 "recordsFiltered" => $quotes->num_rows(),
			 "data" => $data
		);

		echo json_encode($output);
		exit();
          
		
	}
	
	public function add() {
				
		if ($this->input->post('date')) {
			$clientid = (int) $this->input->post('clientid');
			$date = $this->input->post('date');
			$date_valid = $this->input->post('date_valid');
			$attention = $this->input->post('attention');
			
			$refno = $this->input->post('refno');
			$project = $this->input->post('project');
			$location = $this->input->post('location');
			$notes = $this->input->post('notes');
			$term_notes = $this->input->post('term_notes');
			$hidden_notes = $this->input->post('hidden_notes');
			$items_count = $this->input->post('items_count');
			
			$TA = 0;
			$TV = 0;
			
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST['item_quantity_' . $i])) {
					continue;
				}
				
				$qty = $this->input->post('item_quantity_' . $i);
				$price = $this->input->post('item_amount_' . $i);
				$vat = $this->input->post('item_vat_' . $i);
				
				$t_amount = $price * $qty;
				$t_vat = 0;
				
				if (!empty($vat)) {
					$t_vat = $t_amount * $vat / 100;
				}
				
				$t_amount = $t_amount + $t_vat;
				$TA = $TA + $t_amount;
				$TV = $TV + $t_vat;
			}
			
			
			$data = array(
				'client' => (float) $clientid,
				'attention' => (string) $attention,
				'ref_no' => (string) $refno,
				'project' => (string) $project,
				'location' => (string) $location,
				'date' => (string) $date,
				'date_upto' => (string) $date_valid,
				'notes' => (string) $notes,
				'term_notes' => (string) $term_notes,
				'hidden_notes' => (string) $hidden_notes,
				'total_amount' => (float) $TA,
				'total_vat' => (float) $TV,
				'status' => 0,
				'time' => time(),
				'ip' => $_SERVER['REMOTE_ADDR']			
			);
			
			$q_id = $this->quotes_model->insert_quotations($data);
			
			for($i=1;$i<=$items_count;$i++) {
				
				if (!isset($_POST['item_quantity_' . $i])) {
					continue;
				}
				
				$t_amount = 0;
				$qty = $this->input->post('item_quantity_' . $i);
				$price = $this->input->post('item_amount_' . $i);
				$vat = $this->input->post('item_vat_' . $i);
				$item_name = $this->input->post('item_name_' . $i);
				$item_id = $this->input->post('item_id_' . $i);
				$item_description = $this->input->post('item_description_' . $i);
				
				$t_amount = $price * $qty;
				$t_vat = 0;
				
				if (!empty($vat)) {
					$t_vat = $t_amount * $vat / 100;
				}
				
				$total = $t_amount + $t_vat;
				
				$quotation_items = array(
					"parent_id" => $q_id,
					"item_name" => (string) $item_name,
					"item_id" => (int) $item_id,
					"description" => (string) $item_description,
					"quantity" => (float) $qty,
					"amount" => (float) $t_amount,
					"vat_percentage" => $vat,
					"vat_amount" => $t_vat,
					"total_amount" => $total
				);
				
				$this->quotes_model->insert_quotation_items($quotation_items);
								
			}
			
		}
		
		$this->load->helper('url');
		redirect('quotes/view_quotations', 'refresh');
		
	}
	
	public function view_quotations() 
	{
		$this->template->loadData("activeLink", 
			array("quotes" => array("quotations" => 1)));
			
		$quotes = $this->quotes_model->get_quotes();
		$this->load->model("clients_model");
		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);	

		$this->template->loadContent("quotes/view_quotations.php", array(
			"quotes" => $quotes,
			"clients" => $clients
			)
		);
	}

	public function quotations() 
	{
		$this->template->loadData("activeLink", 
			array("quotes" => array("quotations" => 1)));

		$this->load->model("clients_model");
		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);

		$this->template->loadContent("quotes/quotations.php", array(
			"clients" => $clients
			)
		);
	}

}
