<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendors extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("vendors_model");
		$this->load->model("register_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("vendors" => array("general" => 1)));

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
			array("vendors" => array("general" => 1)));

		$types = $this->vendors_model->get_vendor_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_302"));
		}

		$this->template->loadContent("vendors/index.php", array(
			"vendor_types" => $types,
			"page" => "index"
			)
		);
	}

	public function vendor_page($page = "index") 
	{
		$this->load->library("datatables");

		$this->datatables->set_default_order("users.joined", "desc");
		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 0 => array(
				 	"users.username" => 0
				 ),
				 1 => array(
				 	"vendors.phone_number" => 0
				 ),
				 2 => array(
				 	"users.email" => 0
				 ),
				 3 => array(
				 	"users.online_timestamp" => 0
				 )
			)
		);


		if($page == "index") {
			$role='Vendor';
			$role = $this->user_model->get_role($role);
			if($role->num_rows() == 0) {
				$this->template->error(lang("error_191"));
			}
			$role = $role->row();
			$roleId = $role->ID;
			$this->datatables->set_total_rows(
				$this->vendors_model
					->get_total_vendors_all_count($roleId,$this->user->info->ID)
			);

			$members = $this->vendors_model->get_all_vendors($roleId,$this->datatables);
		} elseif($page == "all") {
			
		}


		foreach($members->result() as $r) {

			$options = '<a href="'.site_url("vendors/view/" . $r->ID).'" class="btn btn-primary btn-xs">View</a> ';

			if( $this->common->has_permissions(array("admin", "project_admin"), $this->user) || $this->common->has_team_permissions(array("admin"), $r)) {
				$options .='<a href="'.site_url("vendors/edit_vendor/" . $r->ID).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="'.lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("vendors/delete_vendor/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" onclick="return confirm(\''.lang("ctn_508").'\')" title="'.lang("ctn_57").'"><span class="glyphicon glyphicon-trash"></span></a>';
			}
			
			$this->datatables->data[] = array(
				$r->username,
				$r->vendor_type,
				$r->phone_number,
				$r->email,
				$options
			);
		}
		echo json_encode($this->datatables->process());

	}

	public function add_vendor($insert_id=null){

		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$role='Vendor';
		$username = $this->common->nohtml(
			$this->input->post("vendorname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_position = $this->input->post("position");
		$vendor_type = $this->input->post("typeid");
		$vendor_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$company_name = $this->input->post("cmpnynme");
		$vendor_number = $this->input->post("vendorno");
		
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

		if (!valid_email($email)) {
			$this->template->error(lang("error_19"));
		}

		if (!$this->register_model->checkEmailIsFree($email)) {
			$this->template->error(lang("error_20"));
		}


		//Add Vendor		
		$userid = $this->vendors_model->add_vendor(array(
			"username" => $username,
			"email" => $email,
			"user_role" => $role->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y"),
			"online_timestamp" => time()
			)

		);

		//Add Vendor Details
		$this->vendors_model->add_vendor_details(array(
			"user_id" => $userid,
			"vendor_number" => $vendor_number,
			"company_name" => $company_name,
			"phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_position" => $contact_person_position,
			"vendor_type" => $vendor_type,
			"vendor_vat_id" => $vendor_vat_id,
			"address"      => $address
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_177"));
		redirect(site_url("vendors"));

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

		$vendorDetails = $this->vendors_model->get_vendor_details($userid);
		if($vendorDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$vendorDetails = $vendorDetails->row();
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
			array("vendors" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$this->template->loadContent("vendors/view.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"vendor_detail" => $vendorDetails
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
		$vendorDetails = $this->vendors_model->get_vendor_details($userid);
		if($vendorDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$vendorDetails = $vendorDetails->row();
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
			array("vendors" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$role = $this->user_model->get_user_role($user->user_role);

		$this->template->loadAjax("vendors/ajax_details.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"vendor_detail" => $vendorDetails,
			"update" => $update,
			"role" => $role
			)
		);
	}

	public function edit_vendor($id) 
	{
		
		$id = intval($id);
		$user = $this->vendors_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}

		$types = $this->vendors_model->get_vendor_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		$vendor = $this->vendors_model->get_vendor_details($id);
		$this->template->loadContent("vendors/edit_vendor.php", array(
			"vendors" => $vendor->row(),
			"users" => $user->row(),
			"types" => $types
			)
		);
	}

	public function edit_vendor_pro($id) 
	{
		$id = intval($id);
		$user = $this->vendors_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		$username = $this->common->nohtml(
			$this->input->post("vendorname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_position = $this->input->post("position");
		$vendor_type = $this->input->post("typeid");
		$vendor_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$company_name = $this->input->post("cmpnynme");
		$vendor_number = $this->input->post("vendorno");

		if(empty($username)) $this->template->error(lang("error_150"));

		$type = $this->vendors_model->get_vendor_type($vendor_type);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		//Update Vendor		
		$userid = $this->vendors_model->update_vendor($user->ID,array(
			"username" => $username,
			"email" => $email,
			"IP" => $_SERVER['REMOTE_ADDR'],

			)

		);

		//Update Vendor Details
		$this->vendors_model->update_vendor_details($user->ID,array(
			"vendor_number" => $vendor_number,
			"company_name" => $company_name,
			"phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_position" => $contact_person_position,
			"vendor_type" => $vendor_type,
			"vendor_vat_id" => $vendor_vat_id,
			"address"      => $address
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_178"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("vendors/" . $page));
	}

	public function delete_vendor($id, $hash) 
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
		$user = $this->vendors_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		// Delete
		$this->vendors_model->delete_user_vendor($id);

		// Delete vendor details
		$this->vendors_model->delete_vendor_details($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1046") . " <b>".$user->username.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $user->ID,
			"url" => "vendors"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_179"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("vendors/"));
	}

	public function vendor_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("vendors" => array("types" => 1)));
		$types = $this->vendors_model->get_vendor_types();
		$this->template->loadContent("vendors/vendor_type.php", array(
			"types" => $types
			)
		);
	}

	public function add_vendor_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->vendors_model->add_vendor_type(array(
			"name" => $name,
			"status" => 1,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_51"));
		redirect(site_url("vendors/vendor_type"));
	}

	public function edit_type($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$type = $this->vendors_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();
		$this->template->loadContent("vendors/edit_type.php", array(
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
		$type = $this->vendors_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->vendors_model->update_type($id, array(
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
			"url" => "vendors/vendor_type"
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("vendors/vendor_type"));
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
		$type = $this->vendors_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$this->vendors_model->delete_type($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1044") . " <b>".$cat->name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "vendors/vendor_type"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_52"));
		redirect(site_url("vendors/vendor_type"));
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
		redirect(site_url("vendors/view/" . $userid));

	}

}