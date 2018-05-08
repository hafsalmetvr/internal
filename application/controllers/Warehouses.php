<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warehouses extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("warehouses_model");

	}

	public function index() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("warehouses" => array("general" => 1)));
		$warehouses = $this->warehouses_model->get_warehouses();
		$this->template->loadContent("warehouses/index.php", array(
			"warehouses" => $warehouses
			)
		);
	}

	public function add_warehouse() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$manager = $this->input->post("manager");
		$charge = $this->input->post("charge");
		$phone = $this->input->post("phone");
		$location = $this->input->post("location");
		$rack = $this->input->post("rack");
		$space = $this->input->post("space");
		$store = $this->input->post("store");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->warehouses_model->add_warehouse(array(
			"name" => $name,
			"manager" => $manager,
			"in_charge" => $charge,
			"phone" => $phone,
			"location" => $location,
			"total_rack" => $rack,
			"space_available" => $space,
			"store_keeper" => $store,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1604"));
		redirect(site_url("warehouses"));
	}

	public function edit($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$warehouses = $this->warehouses_model->get_warehouse($id);
		if($warehouses->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$warehouses = $warehouses->row();
		$this->template->loadContent("warehouses/edit.php", array(
			"warehouses" => $warehouses
			)
		);
	}

	public function edit_pro($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$warehouses = $this->warehouses_model->get_warehouse($id);
		if($warehouses->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$warehouses = $warehouses->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$manager = $this->input->post("manager");
		$charge = $this->input->post("charge");
		$phone = $this->input->post("phone");
		$location = $this->input->post("location");
		$rack = $this->input->post("rack");
		$space = $this->input->post("space");
		$store = $this->input->post("store");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->warehouses_model->update_warehouse($id, array(
			"name" => $name,
			"manager" => $manager,
			"in_charge" => $charge,
			"phone" => $phone,
			"location" => $location,
			"total_rack" => $rack,
			"space_available" => $space,
			"store_keeper" => $store,
			"created_at" => date("n-Y")
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1605"));
		redirect(site_url("warehouses"));
	}

	public function delete($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$warehouses = $this->warehouses_model->get_warehouse($id);
		if($warehouses->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$warehouses = $warehouses->row();

		$this->warehouses_model->delete_warehouse($id);



		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1606"));
		redirect(site_url("warehouses"));
	}

	

}