<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_settings extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("units_model");
		$this->load->model("category_model");
		$this->load->model("brands_model");

	}

	public function units() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("product_settings" => array("unit" => 1)));
		$units = $this->units_model->get_units();
		$this->template->loadContent("product_settings/units.php", array(
			"units" => $units
			)
		);
	}

	public function add_units() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->units_model->add_unit(array(
			"unit_name" => $name,
			"unit_code" => $code,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1621"));
		redirect(site_url("product_settings/units"));
	}
	public function checkuniquename($name) 
	{
		$units = $this->units_model->get_unitname($name);

		if($units->num_rows() == 0) {
			echo json_encode(['status'=> false]);
		}else{
			echo json_encode(['status'=> true]);
		}

	}

	public function edit_unit($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$unit = $this->units_model->get_unit($id);
		if($unit->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$unit = $unit->row();
		$this->template->loadContent("product_settings/edit_unit.php", array(
			"unit" => $unit
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
		$unit = $this->units_model->get_unit($id);
		if($unit->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$unit = $unit->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->units_model->update_unit($id, array(
			"unit_name" => $name,
			"unit_code" => $code,
			"created_at" => date("n-Y")
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1622"));
		redirect(site_url("product_settings/units"));
	}

	public function delete_unit($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$unit = $this->units_model->get_unit($id);
		if($unit->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$unit = $unit->row();

		$this->units_model->delete_unit($id);



		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1623"));
		redirect(site_url("product_settings/units"));
	}

	public function categories() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("product_settings" => array("category" => 1)));
		$categories = $this->category_model->get_categories();
		$this->template->loadContent("product_settings/categories.php", array(
			"categories" => $categories
			)
		);
	}

	public function add_category() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->category_model->add_category(array(
			"category_name" => $name,
			"category_code" => $code,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1630"));
		redirect(site_url("product_settings/categories"));
	}
	public function checkuniquecategory($name) 
	{
		$category = $this->category_model->get_categoryname($name);

		if($category->num_rows() == 0) {
			echo json_encode(['status'=> false]);
		}else{
			echo json_encode(['status'=> true]);
		}

	}

	public function edit_category($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$category = $this->category_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$category = $category->row();
		$this->template->loadContent("product_settings/edit_category.php", array(
			"category" => $category
			)
		);
	}

	public function edit_pro_category($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$category = $this->category_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$category = $category->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->category_model->update_category($id, array(
			"category_name" => $name,
			"category_code" => $code,
			"created_at" => date("n-Y")
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1631"));
		redirect(site_url("product_settings/categories"));
	}

	public function delete_category($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$category = $this->category_model->get_category($id);
		if($category->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$category = $category->row();

		$this->category_model->delete_category($id);



		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1632"));
		redirect(site_url("product_settings/categories"));
	}

	public function brands() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("product_settings" => array("brand" => 1)));
		$brands = $this->brands_model->get_brands();
		$this->template->loadContent("product_settings/brands.php", array(
			"brands" => $brands
			)
		);
	}

	public function add_brand() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");
		$url = $this->input->post("url");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->brands_model->add_brand(array(
			"brand_name" => $name,
			"brand_code" => $code,
			"brand_url" => $url,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1640"));
		redirect(site_url("product_settings/brands"));
	}
	public function checkuniquebrand($name) 
	{
		$brand = $this->brands_model->get_brandname($name);

		if($brand->num_rows() == 0) {
			echo json_encode(['status'=> false]);
		}else{
			echo json_encode(['status'=> true]);
		}

	}

	public function edit_brand($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$brand = $this->brands_model->get_brand($id);
		if($brand->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$brand = $brand->row();
		$this->template->loadContent("product_settings/edit_brand.php", array(
			"brand" => $brand
			)
		);
	}

	public function edit_pro_brand($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$brand = $this->brands_model->get_brand($id);
		if($brand->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$brand = $brand->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$code = $this->input->post("code");
		$url = $this->input->post("url");

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->brands_model->update_brand($id, array(
			"brand_name" => $name,
			"brand_code" => $code,
			"brand_url" => $url,
			"created_at" => date("n-Y")
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1641"));
		redirect(site_url("product_settings/brands"));
	}

	public function delete_brand($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$brand = $this->brands_model->get_brand($id);
		if($brand->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$brand = $brand->row();

		$this->brands_model->delete_brand($id);



		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1642"));
		redirect(site_url("product_settings/brands"));
	}

	public function product_name() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("product_settings" => array("name" => 1)));
		$names = $this->brands_model->get_names();
		$this->template->loadContent("product_settings/product_name.php", array(
			"names" => $names
			)
		);
	}

	public function add_name() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name_en = $this->common->nohtml($this->input->post("name_en"));
		$name_ar = $this->common->nohtml($this->input->post("name_ar"));

		if(empty($name_en)) $this->template->error(lang("error_112"));

		// Add
		$this->brands_model->add_name(array(
			"name_english" => $name_en,
			"name_arabic" => $name_ar,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1649"));
		redirect(site_url("product_settings/product_name"));
	}
	

	public function edit_name($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$name = $this->brands_model->get_name($id);
		if($name->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$name = $name->row();
		$this->template->loadContent("product_settings/edit_name.php", array(
			"name" => $name
			)
		);
	}

	public function edit_pro_name($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$name = $this->brands_model->get_name($id);
		if($name->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$name = $name->row();

		$name_en = $this->common->nohtml($this->input->post("name_en"));
		$name_ar = $this->common->nohtml($this->input->post("name_ar"));

		if(empty($name_en)) $this->template->error(lang("error_112"));

		// Add
		$this->brands_model->update_name($id, array(
			"name_english" => $name_en,
			"name_arabic" => $name_ar,
			"created_at" => date("n-Y")
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1650"));
		redirect(site_url("product_settings/product_name"));
	}

	public function delete_name($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$name = $this->brands_model->get_name($id);
		if($name->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$name = $name->row();

		$this->brands_model->delete_name($id);



		$this->session->set_flashdata("globalmsg", 
			lang("ctn_1651"));
		redirect(site_url("product_settings/product_name"));
	}

}