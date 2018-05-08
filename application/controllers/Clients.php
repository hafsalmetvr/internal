<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("clients_model");
		$this->load->model("register_model");

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));
		
		$this->template->loadData("activeLink", 
			array("clients" => array("general" => 1)));

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
			array("clients" => array("general" => 1)));

		$types = $this->clients_model->get_client_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_300"));
		}

		$this->template->loadContent("clients/index.php", array(
			"client_types" => $types,
			"page" => "index"
			)
		);
	}

	public function client_page($page = "index") 
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
				 	"clients.phone_number" => 0
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
			$role='Client';
			$role = $this->user_model->get_role($role);
			if($role->num_rows() == 0) {
				$this->template->error(lang("error_191"));
			}
			$role = $role->row();
			$roleId = $role->ID;
			$this->datatables->set_total_rows(
				$this->clients_model
					->get_total_clients_all_count($roleId,$this->user->info->ID)
			);

			$members = $this->clients_model->get_all_clients($roleId,$this->datatables);
		} elseif($page == "all") {
			
		}


		foreach($members->result() as $r) {

			$options = '<a href="'.site_url("clients/view/" . $r->ID).'" class="btn btn-primary btn-xs">View</a> ';

			if( $this->common->has_permissions(array("admin", "project_admin"), $this->user) || $this->common->has_team_permissions(array("admin"), $r)) {
				$options .='<a href="'.site_url("clients/edit_client/" . $r->ID).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="'.lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("clients/delete_client/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" onclick="return confirm(\''.lang("ctn_508").'\')" title="'.lang("ctn_57").'"><span class="glyphicon glyphicon-trash"></span></a>';
			}
			
			$this->datatables->data[] = array(
				$r->username,
				$r->client_type,
				$r->phone_number,
				$r->email,
				$options
			);
		}
		echo json_encode($this->datatables->process());

	}

	public function add_client($insert_id=null){

		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$role='Client';
		$username = $this->common->nohtml(
			$this->input->post("clientname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_position = $this->input->post("position");
		$customer_type = $this->input->post("typeid");
		$client_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$vendor_number = $this->input->post("vendor_number");
		
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

		//Add Client		
		$userid = $this->clients_model->add_client(array(
			"username" => $username,
			"email" => $email,
			"user_role" => $role->ID,
			"IP" => $_SERVER['REMOTE_ADDR'],
			"joined" => time(),
			"joined_date" => date("n-Y"),
			"online_timestamp" => time()
			)

		);

		//Add Client Details
		$this->clients_model->add_client_details(array(
			"user_id" => $userid,
			"phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_position" => $contact_person_position,
			"customer_type" => $customer_type,
			"client_vat_id" => $client_vat_id,
			"address"      => $address,
			"vendor_number" => $vendor_number
			)
		);
		$this->session->set_flashdata("globalmsg", lang("success_171"));
		redirect(site_url("clients"));

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

		$clientDetails = $this->clients_model->get_client_details($userid);
		if($clientDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$clientDetails = $clientDetails->row();
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
			array("clients" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$this->template->loadContent("clients/view.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"client_detail" => $clientDetails
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
		$clientDetails = $this->clients_model->get_client_details($userid);
		if($clientDetails->num_rows() == 0) {
			$this->template->error(lang("error_52"));
		}
		$clientDetails = $clientDetails->row();
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
			array("team" => array("general" => 1)));

		$user_data = $this->user_model->get_user_data($this->user->info->ID);

		$role = $this->user_model->get_user_role($user->user_role);

		$this->template->loadAjax("clients/ajax_details.php", array(
			"user" => $user,
			"user_data" => $user_data,
			"client_detail" => $clientDetails,
			"update" => $update,
			"role" => $role
			)
		);
	}

	public function edit_client($id) 
	{
		
		$id = intval($id);
		$user = $this->clients_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}

		$types = $this->clients_model->get_client_types();
		if($types->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		$client = $this->clients_model->get_client_details($id);
		$this->template->loadContent("clients/edit_client.php", array(
			"clients" => $client->row(),
			"users" => $user->row(),
			"types" => $types
			)
		);
	}

	public function edit_client_pro($id) 
	{
		$id = intval($id);
		$user = $this->clients_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		$username = $this->common->nohtml(
			$this->input->post("clientname", true));
		$email = $this->input->post("email", true);
		$phone_number = $this->input->post("phone");
		$contact_person_name = $this->input->post("cperson");
		$contact_person_number = $this->input->post("cpersonphone");
		$contact_person_position = $this->input->post("position");
		$customer_type = $this->input->post("typeid");
		$client_vat_id = $this->input->post("vat");
		$address = $this->input->post("address");
		$vendor_number = $this->input->post("vendor_number");

		if(empty($username)) $this->template->error(lang("error_150"));

		$type = $this->clients_model->get_client_type($customer_type);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		//Update Client		
		$userid = $this->clients_model->update_client($user->ID,array(
			"username" => $username,
			"email" => $email,
			"IP" => $_SERVER['REMOTE_ADDR'],

			)

		);

		//Update Client Details
		$this->clients_model->update_client_details($user->ID,array(
			"phone_number" => $phone_number,
			"contact_person_name" => $contact_person_name,
			"contact_person_number" => $contact_person_number,
			"contact_person_position" => $contact_person_position,
			"customer_type" => $customer_type,
			"client_vat_id" => $client_vat_id,
			"address"      => $address,
			"vendor_number" => $vendor_number
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_172"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("clients/" . $page));
	}


	public function client_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("clients" => array("types" => 1)));
		$types = $this->clients_model->get_client_types();
		$this->template->loadContent("clients/client_type.php", array(
			"types" => $types
			)
		);
	}

	public function add_client_type() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->clients_model->add_client_type(array(
			"name" => $name,
			"status" => 1,
			"created_at" => date("n-Y")
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_51"));
		redirect(site_url("clients/client_type"));
	}

	public function edit_type($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$type = $this->clients_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();
		$this->template->loadContent("clients/edit_type.php", array(
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
		$type = $this->clients_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$name = $this->common->nohtml($this->input->post("name"));

		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->clients_model->update_type($id, array(
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
			"url" => "clients/client_type"
			)
		);


		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("clients/client_type"));
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
		$type = $this->clients_model->get_type($id);
		if($type->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$type = $type->row();

		$this->clients_model->delete_type($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1044") . " <b>".$cat->name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "clients/client_type"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_52"));
		redirect(site_url("clients/client_type"));
	}

	public function delete_client($id, $hash) 
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
		$user = $this->clients_model->get_user($id);
		if($user->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$user = $user->row();

		// Delete
		$this->clients_model->delete_user_client($id);

		// Delete client details
		$this->clients_model->delete_client_details($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1046") . " <b>".$user->username.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $user->ID,
			"url" => "clients"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_173"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("clients/" ));
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
		redirect(site_url("clients/view/" . $userid));

	}

}
