<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("suppliers_model");
		$this->load->model("register_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("suppliers" => array("general" => 1)));

		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function index() 
	{
		$this->template->loadData("activeLink", 
			array("suppliers" => array("general" => 1)));

		$types = $this->suppliers_model->get_supplier_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_301"));
		}

		$this->template->loadContent("suppliers/index.php", array(
			"supplier_types" => $types,
			"page" => "index"
			)
		);
	}

	public function supplier_page($page = "index") 
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("suppliers.id", "desc");
		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 0 => array(
				 	"users.username" => 0
				 ),
				 1 => array(
				 	"suppliers.supplier_type" => 0
				 ),
				 2 => array(
				 	"suppliers.company_phone_number" => 0
				 ),
				 3 => array(
				 	"users.email" => 0
				 )
				 
			)
		);


		if($page == "index") {
			$role='Supplier';
			$role = $this->user_model->get_role($role);
			if($role->num_rows() == 0) {
				$this->template->error(lang("error_191"));
			}
			$role = $role->row();
			$roleId = $role->ID;
			$this->datatables->set_total_rows(
				$this->suppliers_model
					->get_total_suppliers_all_count($roleId,$this->user->info->ID)
			);

			$members = $this->suppliers_model->get_all_suppliers($roleId,$this->datatables);
		} elseif($page == "all") {
			
		}


		foreach($members->result() as $r) {

			$options = '<a href="'.site_url("suppliers/view/" . $r->ID).'" class="btn btn-primary btn-xs">View</a> ';

			if( $this->common->has_permissions(array("admin", "project_admin"), $this->user) || $this->common->has_team_permissions(array("admin"), $r)) {
				$options .='<a href="'.site_url("suppliers/edit_supplier/" . $r->ID).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="'.lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("suppliers/delete_supplier/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" onclick="return confirm(\''.lang("ctn_508").'\')" title="'.lang("ctn_57").'"><span class="glyphicon glyphicon-trash"></span></a>';
			}
			
			$this->datatables->data[] = array(
				$r->username,
				$r->supplier_type,
				$r->phone_number,
				$r->email,
				$options
			);
		}
		echo json_encode($this->datatables->process());

	}

	public function add_supplier($insert_id=null){

		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$role='Supplier';
		$username = $this->common->nohtml(
			$this->input->post("companyname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_email = $this->input->post("cemail");
		$supplier_type = $this->input->post("typeid");
		$supplier_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$web_url = $this->input->post("web_url");
		
		if(empty($username)) $this->template->error(lang("error_150"));

		// Check role
		$role = $this->user_model->get_role($role);
		if($role->num_rows() == 0) {
			$this->template->error(lang("error_191"));
		}
		$role = $role->row();

		$this->load->helper('email');

		if (empty($email)) {
				$this->template->error(lang("error_18"));
		}
		if (empty($contact_person_email)) {
				$this->template->error(lang("error_18"));
		}

		if (!valid_email($email)) {
			$this->template->error(lang("error_19"));
		}
		if (!valid_email($contact_person_email)) {
			$this->template->error(lang("error_19"));
		}

		if (!$this->register_model->checkEmailIsFree($email)) {
			$this->template->error(lang("error_20"));
		}

		//Add Supplier		
		$userid = $this->suppliers_model->add_supplier(array(
			"username" => $username,
			"email" => $email,
			"user_role" => $role->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y"),
			"online_timestamp" => time()
			)

		);

		//Add Supplier Details
		$this->suppliers_model->add_supplier_details(array(
			"user_id" => $userid,
			"company_phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_email" => $contact_person_email,
			"supplier_type" => $supplier_type,
			"vat_id" => $supplier_vat_id,
			"address"      => $address,
			"web_url" => $web_url
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_174"));
		redirect(site_url("suppliers"));

	}

	public function view($userid) 
	{
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$user = $user->row();

		//get client details

		$supplierDetails = $this->suppliers_model->get_supplier_details($userid);
		if($supplierDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$supplierDetails = $supplierDetails->row();
		// Check we have correct permission
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			// Check user is in their team
			$projects = $this->projects_model
				->get_projects_user_all_no_pagination($this->user->info->ID);

			$projects_a = array();

			foreach($projects->result() as $r) {
				$projects_a[] = $r->ID;
			}
			
			$mem = $this->team_model->check_member_of_projects($projects_a, $userid);
			if($mem->num_rows() ==0) {
				$this->template->error(lang("error_286"));
			}
		}

		$this->template->loadData("activeLink", 
			array("suppliers" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$this->template->loadContent("suppliers/view.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"supplier_detail" => $supplierDetails
			)
		);
	}

	public function load_ajax_details($userid) 
	{
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$user = $user->row();
		//get client details
		$supplierDetails = $this->suppliers_model->get_supplier_details($userid);
		if($supplierDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$supplierDetails = $supplierDetails->row();
		// Check we have correct permission
		if(!$this->common->has_permissions(array("admin", "project_admin", "team_manage"), 
			$this->user)) {
			$update = false;
			// Check user is in their team
			$projects = $this->projects_model
				->get_projects_user_all_no_pagination($this->user->info->ID);

			$projects_a = array();

			foreach($projects->result() as $r) {
				$projects_a[] = $r->ID;
			}
			
			$mem = $this->team_model->check_member_of_projects($projects_a, $userid);
			if($mem->num_rows() ==0) {
				$this->template->error(lang("error_286"));
			}
		} else {
			$update = true;
		}

		$this->template->loadData("activeLink", 
			array("suppliers" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$role = $this->user_model->get_user_role($user->user_role);

		$this->template->loadAjax("suppliers/ajax_details.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"supplier_detail" => $supplierDetails,
			"update" => $update,
			"role" => $role
			)
		);
	}

	public function edit_supplier($id) 
	{
		
		$id = intval($id);
		$user = $this->suppliers_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}

		$types = $this->suppliers_model->get_supplier_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		$supplier = $this->suppliers_model->get_supplier_details($id);
		$this->template->loadContent("suppliers/edit_supplier.php", array(
			"suppliers" => $supplier->row(),
			"users" => $user->row(),
			"types" => $types
			)
		);
	}

	public function edit_supplier_pro($id) 
	{
		$id = intval($id);
		$user = $this->suppliers_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		$username = $this->common->nohtml(
			$this->input->post("companyname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_email = $this->input->post("cemail");
		$supplier_type = $this->input->post("typeid");
		$supplier_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$web_url = $this->input->post("web_url");
		
		if(empty($username)) $this->template->error(lang("error_150"));

		$this->load->helper('email');

		if (empty($email)) {
				$this->template->error(lang("error_18"));
		}
		if (empty($contact_person_email)) {
				$this->template->error(lang("error_18"));
		}

		if (!valid_email($email)) {
			$this->template->error(lang("error_19"));
		}
		if (!valid_email($contact_person_email)) {
			$this->template->error(lang("error_19"));
		}

		//Update Supplier		
		$userid = $this->suppliers_model->update_supplier($user->ID,array(
			"username" => $username,
			"email" => $email,
			"IP" => $_SERVER['REMOTE_ADDR'],

			)

		);

		//Update Supplier Details
		$this->suppliers_model->update_supplier_details($user->ID,array(
			"company_phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_email" => $contact_person_email,
			"supplier_type" => $supplier_type,
			"vat_id" => $supplier_vat_id,
			"address"      => $address,
			"web_url" => $web_url
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_175"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("suppliers/" . $page));
	}

	public function delete_supplier($id, $hash) 
	{
		// Get user permission
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
			$team_member = $this->team_model
				->get_member_of_project($this->user->info->ID, $id);
			if($team_member->num_rows() == 0) {
					$this->template->error(lang("error_71"));
			} else {
				$team = $team_member->row();
				if(!$this->common->has_team_permissions(array("admin"), $team)) {
					$this->template->error(lang("error_151"));
				}
			}
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$user = $this->suppliers_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		// Delete
		$this->suppliers_model->delete_user_supplier($id);

		// Delete supplier details
		$this->suppliers_model->delete_supplier_details($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1046") . " <b>".$user->username.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $user->ID,
			"url" => "projects"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_176"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("suppliers/" ));
	}


	public function supplier_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("suppliers" => array("types" => 1)));
		$types = $this->suppliers_model->get_supplier_types();
		$this->template->loadContent("suppliers/supplier_type.php", array(
			"types" => $types
			)
		);
	}

	public function add_supplier_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->suppliers_model->add_supplier_type(array(
			"name" => $name,
			"status" => 1,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_51"));
		redirect(site_url("suppliers/supplier_type"));
	}

	public function edit_type($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$type = $this->suppliers_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();
		$this->template->loadContent("suppliers/edit_type.php", array(
			"type" => $type
			)
		);
	}

	public function edit_type_pro($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$type = $this->suppliers_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->suppliers_model->update_type($id, array(
			"name" => $name
			)
		);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1043") . " <b>".$name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "suppliers/supplier_type"
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("suppliers/supplier_type"));
	}

	public function delete_type($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$type = $this->suppliers_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$this->suppliers_model->delete_type($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1044") . " <b>".$cat->name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "suppliers/supplier_type"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_52"));
		redirect(site_url("suppliers/supplier_type"));
	}


	public function update_user($userid) 
	{
		$userid = intval($userid);
		$user = $this->user_model->get_user_by_id($userid);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$user = $user->row();

		// Check we have correct permission
		if(!$this->common->has_permissions(array("admin", "project_admin", "team_manage"), 
			$this->user)) {
			$this->template->error(lang("error_287"));	
		}

		$address_line_1 = $this->common->nohtml($this->input->post("address_line_1"));
		$address_line_2 = $this->common->nohtml($this->input->post("address_line_2"));
		$city = $this->common->nohtml($this->input->post("city"));
		$state = $this->common->nohtml($this->input->post("state"));
		$country = $this->common->nohtml($this->input->post("country"));
		$zipcode = $this->common->nohtml($this->input->post("zipcode"));

		$this->user_model->update_user($userid, array(
			"address_1" => $address_line_1,
			"address_2" => $address_line_2,
			"city" => $city,
			"state" => $state,
			"country" => $country,
			"zipcode" => $zipcode
			)
		);

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$this->session->set_flashdata("globalmsg", lang("success_160"));
		redirect(site_url("suppliers/view/" . $userid));

	}

}