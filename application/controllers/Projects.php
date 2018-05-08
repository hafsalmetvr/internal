<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("projects_model");
		$this->load->model("team_model");
		$this->load->model("finance_model");
		$this->load->model("task_model");
		$this->load->model("time_model");
		$this->load->model("clients_model");
		$this->load->model("vendors_model");
		$this->load->model("expense_model");
		

		if(!$this->user->loggedin) $this->template->error(lang("error_1"));

		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function index($catid=0) 
	{
		$_SESSION['p_page'] = "index";
		$this->template->loadExternal(
			'<script src="'.base_url().
			'scripts/libraries/jscolor.min.js"></script>'
		);
		$this->template->loadData("activeLink", 
			array("projects" => array("general" => 1)));

		$catid = intval($catid);
		$users = $this->user_model->getUserDetails();
		$categories = $this->projects_model->get_project_categories();

		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);

		//get vendors
		$role1='Vendor';
		$role1 = $this->user_model->get_role($role1);
	
		$role1 = $role1->row();
		$roleId1 = $role1->ID;
		$vendors = $this->vendors_model->get_client($roleId1);
		if($vendors->num_rows() == 0) {
			$this->template->error(lang("error_191"));
		}

		$templates = $this->task_model->get_templates_for_all();


		$this->template->loadContent("projects/index.php", array(
			"categories" => $categories,
			"users" => $users,
			"clients" => $clients,
			"vendors" => $vendors,
			"catid" => $catid,
			"page" => "index",
			"templates" => $templates
			)
		);
	}

	public function gantt_chart($id) 
	{
		$this->template->loadData("activeLink", 
			array("projects" => array("general" => 1)));
		$this->load->model("task_model");
		$team_member = null;
		// Get user permission
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
			$team_member = $this->team_model
				->get_member_of_project($this->user->info->ID, $id);
			if($team_member->num_rows() == 0) {
					$this->template->error(lang("error_71"));
			}
			$team_member = $team_member->row();
		}

		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		// Get all Tasks
		$tasks = $this->task_model->get_all_tasks_no_pagination($id,0,0);
		if($tasks->num_rows() == 0) {
			$this->template->error(lang("error_267"));
		}

		// Find Date Range
		$start_date_range = 0;
		$end_date_range = 0;
		foreach($tasks->result() as $r) {
			if($start_date_range == 0) {
				$start_date_range = $r->start_date;
			}
			if($r->start_date <= $start_date_range) {
				$start_date_range = $r->start_date;
			}

			if($end_date_range == 0) {
				$end_date_range = $r->due_date;
			}

			if($r->due_date > $end_date_range) {
				$end_date_range = $r->due_date;
			}
		}

		$range1 = date($this->settings->info->date_picker_format, 
			$start_date_range);
		$range2 = date($this->settings->info->date_picker_format,
			$end_date_range);

		// Get all dates
		$dates = $this->common->getDatesFromRange($range1, $range2, 
			$this->settings->info->date_picker_format, "Y-m-d");

		// Now find all months and days in month
		$dates_months = array();
		$current_month = 0;
		$days_count = 0;
		$current_year = 0;
		$current_month_d = "";
		foreach($dates as $date) {
			$current_year = date("Y", $date['timestamp']);

			if($current_month == 0) {
				$current_month = date("m", $date['timestamp']);
				$current_month_d = date("F", $date['timestamp']);
			}

			if($current_month != date("m", $date['timestamp'])) {
				$dates_months[] = array(
					"month" => $current_month, 
					"days" => $days_count,
					"year" => $current_year,
					"display" => $current_month_d
				);
				$current_month = date("m", $date['timestamp']);
				$current_month_d = date("F", $date['timestamp']);
				$days_count = 0;
			}
			$days_count++;
		}

		$dates_months[] = array(
			"month" => $current_month, 
			"days" => $days_count,
			"year" => $current_year,
			"display" => $current_month_d
		);


		$this->template->loadContent("projects/gantt.php", array(
			"start_date_range" => $start_date_range,
			"end_date_range" => $end_date_range,
			"project" => $project,
			"dates" => $dates,
			"tasks" => $tasks,
			"months" => $dates_months
			)
		);
	}

	public function projects_page($page = "index", $catid) 
	{
		$catid = intval($catid);

		$this->load->library("datatables");

		$this->datatables->set_default_order("projects.ID", "desc");

		// Set page ordering options that can be used
		$this->datatables->ordering(
			array(
				 1 => array(
				 	"projects.name" => 0
				 ),
				 2 => array(
				 	"projects.catid" => 0
				 ),
				 4 => array(
				 	"projects.complete" => 0
				 ),
				 
			)
		);

		if($page == "index") {
			$this->datatables->set_total_rows(
				$this->projects_model
				->get_total_projects_user_all_count($catid, $this->user->info->ID)
			);
			$projects = $this->projects_model->get_projects_user_all($catid, 
			$this->user->info->ID, $this->datatables);
		} elseif($page == "all") {
			if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
				$this->template->error(lang("error_71"));
			}
			$this->datatables->set_total_rows(
				$this->projects_model
					->get_total_projects_count($catid)
			);
			$projects = $this->projects_model
				->get_projects($catid, $this->datatables);
		} elseif($page == "client") {
			$userid = intval($this->input->get("userid"));
			$this->datatables->set_total_rows(
				$this->projects_model
				->get_total_projects_user_all_count($catid, $userid)
			);
			$projects = $this->projects_model->get_projects_user_all($catid, 
			$userid, $this->datatables);
		}

		foreach($projects->result() as $r) {

			$project_name = '<a href="'.site_url("projects/view/" . $r->ID).'">'.$r->name.'</a>';
			if($r->ID == $this->user->info->active_projectid) {
				$project_name .= ' <label class="label label-success">'.lang("ctn_787").'</label>';
			}
			if($r->status == 1) {
				$project_name .= ' <label class="label label-default">'.lang("ctn_778").'</label>';
			}

			$member_string = '';
			$members = $this->team_model->get_members_for_project($r->ID);
    		$our_user = new STDclass; // For the current user 
    		foreach($members->result() as $member) {
    			if($member->userid == $this->user->info->ID) $our_user = $member;
    			$member_string .= '<div class="projects-team-members-simple">
    			'.$this->common->get_user_display(array("username" => $member->username, "avatar" => $member->avatar, "online_timestamp" => $member->online_timestamp)).'</div>';
    		}

    		$options = '<a href="'.site_url("projects/make_active/" . $r->ID).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_788").'" onclick="return confirm(\''.lang("ctn_1512").'\')"><span class="glyphicon glyphicon-pushpin"></span></a> <a href="'.site_url("projects/view/" . $r->ID).'" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="bottom" title="'.lang("ctn_555").'">'.lang("ctn_555").'</a> ';
        	if( $this->common->has_permissions(array("admin", "project_admin"), $this->user) || ($this->common->has_team_permissions(array("admin"), $our_user)) ) {
        		$options .= '<a href="'.site_url("projects/edit_project/" . $r->ID).'" class="btn btn-warning btn-xs" title="'.lang("ctn_55").'" data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("projects/delete_project/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" onclick="return confirm(\''.lang("ctn_789").'\')" title="'.lang("ctn_57").'"  data-toggle="tooltip" data-placement="bottom"><span class="glyphicon glyphicon-trash"></span></a>';
        	}

        	$vendorname = $this->vendors_model->get_user($r->vendorid);
        	if($vendorname->num_rows() == 0){
        		$vendorname = '';
        	}else{
        		$vendorname = $vendorname->row();
        		$vendorname = $vendorname->username;
        	}

			$this->datatables->data[] = array(
				$r->client_name,
				$project_name,
				'<span class="label label-default" style="background: #'.$r->cat_color.';">'.$r->catname.'</span>',
				$vendorname,
				$r->purchase_order_no,
				'<div class="progress" style="height: 15px;">
				  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$r->complete .'" aria-valuemin="0" aria-valuemax="100" style="width: '.$r->complete.'%" title="'.$r->complete.'%" data-toggle="tooltip" data-placement="bottom">
				    <span class="sr-only">'.$r->complete.'% '.lang("ctn_790").'</span>
				  </div>
				</div>',
				$options
			);
		}

		echo json_encode($this->datatables->process());
	}

	public function all($catid=0) 
	{
		$_SESSION['p_page'] = "all";
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadExternal(
			'<script src="'.base_url().
			'scripts/libraries/jscolor.min.js"></script>'
		);
		$this->template->loadData("activeLink", 
			array("projects" => array("all" => 1)));

		$catid = intval($catid);

		$categories = $this->projects_model->get_project_categories();

		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);
		
		//get vendors
		$role1='Vendor';
		$role1 = $this->user_model->get_role($role1);
		$role1 = $role1->row();
		$roleId1 = $role1->ID;
		$vendors = $this->vendors_model->get_client($roleId1);

		$templates = $this->task_model->get_templates_for_all();


		$this->template->loadContent("projects/index.php", array(
			"categories" => $categories,
			"clients" => $clients,
			"vendors" => $vendors,
			"catid" => $catid,
			"page" => "all",
			"templates" => $templates
			)
		);
	}

	public function view($id, $page=0) 
	{
		$this->template->loadData("activeLink", 
			array("projects" => array("general" => 1)));

		$this->load->model("task_model");
		$this->load->model("file_model");
		$id = intval($id);
		$page = intval($page);

		$team_member = null;
		// Get user permission
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
			$team_member = $this->team_model
				->get_member_of_project($this->user->info->ID, $id);
			if($team_member->num_rows() == 0) {
					$this->template->error(lang("error_71"));
			}
			$team_member = $team_member->row();
		}

		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		$members = $this->team_model->get_members_for_project($id);

		$activity = $this->team_model->get_project_log($id, 0, 5);

		$messages = $this->projects_model->get_messages($id, $page);

		$tasks_total = $this->task_model->get_all_tasks_total($id, 0);

		$files = $this->file_model->get_recent_files_by_project($id);

		$time = $this->time_model->count_hours_project($id);
		$hours = 0;
		if($time->num_rows() > 0) {
			foreach($time->result() as $r) {

				$hour = round($r->time/3600,2);
				$hours += $hour;
			}
		}

		// * Pagination *//
		$this->load->library('pagination');
		$config['base_url'] = site_url("projects/view/" . $id);
		$config['total_rows'] = $this->projects_model
			->get_total_messages($id);
		$config['per_page'] = 5;
		$config['uri_segment'] = 4;
		include (APPPATH . "/config/page_config.php");
		$this->pagination->initialize($config);

		$this->template->loadContent("projects/view.php", array(
			"project" => $project,
			"team_member" => $team_member,
			"members" => $members,
			"activity" => $activity,
			"messages" => $messages,
			"tasks_total" => $tasks_total,
			"files" => $files,
			"hours" => $hours
			)
		);

	}

	public function delete_message($id, $hash) 
	{
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$message = $this->projects_model->get_message($id);
		if($message->num_rows() == 0) {
			$this->template->error(lang("error_188"));
		}
		$message = $message->row();
		if($message->userid != $this->user->info->ID) {
			$this->common->check_permissions(
				lang("error_2"), 
				array("admin", "project_admin"), // User Roles
				array("admin"),  // Team Roles
				$message->projectid
			);
		}

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1408"),
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $id,
			"url" => "projects/view/" . $id
			)
		);

		$this->projects_model->delete_message($id);
		$this->session->set_flashdata("globalmsg", lang("success_131"));
		redirect(site_url("projects/view/" . $message->projectid));
	}

	public function add_message($id) 
	{
		$id = intval($id);

		$team_member = null;
		// Get user permission
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
			$team_member = $this->team_model
				->get_member_of_project($this->user->info->ID, $id);
			if($team_member->num_rows() == 0) {
					$this->template->error(lang("error_71"));
			}
			$team_member = $team_member->row();
		}

		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		$message = $this->lib_filter->go($this->input->post("message"));
		if(empty($message)) {
			$this->template->error(lang("error_187"));
		}

		// Add
		$this->projects_model->add_message(array(
			"userid" => $this->user->info->ID,
			"message" => $message,
			"projectid" => $id,
			"timestamp" => time()
			)
		);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1409"),
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $id,
			"url" => "projects/view/" . $id
			)
		);

		// Notify all team members of project message
		$members = $this->team_model->get_members_for_project($id);
		foreach($members->result() as $r) {
			if($r->userid != $this->user->info->ID) {
				$this->user_model->increment_field($r->userid, "noti_count", 1);
				$this->user_model->add_notification(array(
							"userid" => $r->userid,
							"url" => "projects/view/" . $id,
							"timestamp" => time(),
							"message" => lang("ctn_1513") . $project->name,
							"status" => 0,
							"fromid" => $this->user->info->ID,
							"email" => $r->email,
							"username" => $r->username,
							"email_notification" => $r->email_notification
							)
						);
			}
		}

		$this->session->set_flashdata("globalmsg", lang("success_92"));
		redirect(site_url("projects/view/" . $id));
	}

	public function cats() 
	{
		$this->template->loadExternal(
			'<script src="'.base_url().
			'scripts/libraries/jscolor.min.js"></script>'
		);
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$this->template->loadData("activeLink", 
			array("projects" => array("cats" => 1)));
		$cats = $this->projects_model->get_project_categories();
		$this->template->loadContent("projects/cats.php", array(
			"cats" => $cats
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
		$color = $this->common->nohtml($this->input->post("color"));
		if(strlen($color) > 6) {
			$this->template->error(lang("error_148"));
		}
		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->projects_model->add_category(array(
			"name" => $name,
			"color" => $color
			)
		);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1042") ." <b>".$name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "projects/cats"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_51"));
		redirect(site_url("projects/cats"));
	}

	public function edit_cat($id) 
	{
		$this->template->loadExternal(
			'<script src="'.base_url().
			'scripts/libraries/jscolor.min.js"></script>'
		);
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$cat = $this->projects_model->get_category($id);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$cat = $cat->row();
		$this->template->loadContent("projects/edit_cat.php", array(
			"cat" => $cat
			)
		);
	}

	public function edit_cat_pro($id) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$cat = $this->projects_model->get_category($id);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$cat = $cat->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$color = $this->common->nohtml($this->input->post("color"));
		if(strlen($color) > 6) {
			$this->template->error(lang("error_148"));
		}
		if(empty($name)) $this->template->error(lang("error_112"));

		// Add
		$this->projects_model->update_category($id, array(
			"name" => $name,
			"color" => $color
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
			"url" => "projects/cats"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("projects/cats"));
	}

	public function delete_cat($id, $hash) 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		if($hash != $this->security->get_csrf_hash()) {
			$this->template->error(lang("error_6"));
		}
		$id = intval($id);
		$cat = $this->projects_model->get_category($id);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$cat = $cat->row();

		$this->projects_model->delete_category($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $this->user->info->ID,
			"message" => lang("ctn_1044") . " <b>".$cat->name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => 0,
			"url" => "projects/cats"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_52"));
		redirect(site_url("projects/cats"));
	}

	public function add_project() 
	{
		if(!$this->common->has_permissions(array("admin", "project_admin", 
			"project_worker"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$name = $this->common->nohtml($this->input->post("name"));
		$description = $this->lib_filter->go($this->input->post("description"));
		$catid = intval($this->input->post("catid"));
		$userid = intval($this->input->post("userid"));
		$vendorid = intval($this->input->post("vendorid"));
		$calendar_id = $this->common->nohtml($this->input->post("calendar_id"));
		$calendar_color = $this->common->nohtml($this->input->post("calendar_color"));
		$templates_toadd = $this->input->post("templates");

		$complete = intval($this->input->post("complete"));
		$complete_sync = intval($this->input->post("complete_sync"));
		$project_at = $this->input->post("project_at");
		$project_value = $this->input->post("project_value");
		$purchase_orderno = intval($this->input->post("purchase_order_no"));
		$start_date = $this->input->post("start_date");
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = $this->input->post("end_date");
		$end_date = date("Y-m-d", strtotime($end_date));
		$project_in_charge = $this->input->post("project_in_charge");
		$buyer = $this->input->post("buyer");
		$po_date = $this->input->post("po_date");
		$po_date = date("Y-m-d", strtotime($po_date));

		if(empty($name)) $this->template->error(lang("error_150"));

		$cat = $this->projects_model->get_category($catid);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => $this->settings->info->file_types,
		       "max_size" => $this->settings->info->file_size,
		       "max_width" => 150,
		       "max_height" => 150
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= "default.png";
		}

		$templates= array();
		if($templates_toadd) {
			foreach($templates_toadd as $templateid) {
				$templateid = intval($templateid);
				if($templateid > 0) {
					// Check task template
					$template = $this->task_model->get_task($templateid);
					if($template->num_rows() == 0) {
						$this->template->error(lang("error_283"));
					}
					$template = $template->row();
					if(!$template->template) {
						$this->template->error(lang("error_284") . $template->name);
					}
					if($template->template_projectid > 0) {
						$this->template->error(lang("error_285") . $template->name);
					}

					$templates[] = $templateid;
				}
			}
		}

		// Add Project
		$projectid = $this->projects_model->add_project(array(
			"name" => $name,
			"description" => $description,
			"catid" => $catid,
			"userid" => $userid,
			"vendorid" => $vendorid,
			"project_at" => $project_at,
			"project_value" => $project_value,
			"purchase_order_no" => $purchase_orderno,
			"start_date" => $start_date,
			"end_date" => $end_date,
			"project_in_charge" => $project_in_charge,
			"buyer" => $buyer,
			"po_date" => $po_date,
			"timestamp" => time(),
			"image" => $image,
			"calendar_id" => $calendar_id,
			"calendar_color" => $calendar_color,
			"complete" => $complete,
			"complete_sync" => $complete_sync
			)
		);

		// Add Team Members
		$this->team_model->add_member(array(
			"projectid" => $projectid,
			"userid" => $userid,
			"vendorid" => $vendorid,
			"roleid" => 1
			)
		);

		// Create tasks from templates
		foreach($templates as $tid) {
			$this->create_task($tid, $projectid);
		}

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $userid,
			"message" => lang("ctn_1045"). " <b>".$name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $projectid,
			"url" => "projects"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_67"));
		redirect(site_url("projects"));
	}

	private function create_task($taskid, $projectid) 
	{
		$taskid = intval($taskid);
		$projectid = intval($projectid);
		$task = $this->task_model->get_task($taskid);
		if($task->num_rows() == 0) {
			$this->template->error(lang("error_166"));
		}
		$task = $task->row();

		if($task->template == 0) {
			$this->template->error(lang("error_284"));
		}

		// Options
		$import_objectives = 1;
		$import_task_members = 1;
		$import_team = 0;
		$import_files = 1;
		$import_messages = 1;

		// Create task time.
		$name = $task->name;
		$desc = $task->description;
		$start_date = $task->start_date;
		$due_date = $task->due_date;
		$status = $task->status;
		$assign = $task->assign;

		$template_start_days = $task->template_start_days;
		$template_due_days = $task->template_due_days;

		$project = $this->projects_model->get_project($projectid);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		$day_time = 3600*24;
		$sd_timestamp = time() + ($task->template_start_days * $day_time);
		$dd_timestamp = time() + ($task->template_due_days * $day_time);


		$taskid = $this->task_model->add_task(array(
			"name" => $name,
			"description" => $desc,
			"projectid" => $projectid,
			"start_date" => $sd_timestamp,
			"due_date" => $dd_timestamp,
			"status" => $status,
			"userid" => $project->userid,
			"vendorid" => $project->vendorid,
			"complete_sync" => $task->complete_sync,
			"complete" => $task->complete
			)
		);

		// Add Task dependencies
		if($import_objectives) {
			$objectives = $this->task_model->get_task_objectives($task->ID);
			foreach($objectives->result() as $r) {
				$objectiveid = $this->task_model->add_objective(array(
					"title" => $r->title,
					"description" => $r->description,
					"userid" => $project->userid,
					"vendorid" => $project->vendorid,
					"timestamp" => time(),
					"taskid" => $taskid
					)
				);

				// Get assigned objective members
				$members = $this->task_model->get_task_objective_members($r->ID);
				foreach($members->result() as $rr) {
					$member = $this->team_model->get_member_of_project($rr->userid, $projectid);
					if($member->num_rows() == 0) {
						continue;
					}
					$member = $member->row();

					$this->task_model->add_objective_member($objectiveid, $rr->userid);
				}
			}

		}

		if($import_task_members) {
			// This can only happen if the members of the current task 
			// are also members of the project that we are creating the template for
			$task_members = $this->task_model->get_task_members($task->ID);
			foreach($task_members->result() as $r) {
				// Check member is on the new project
				// Check user is member of team
				$member = $this->team_model->get_member_of_project($r->userid, $projectid);
				if($member->num_rows() == 0) {
					continue;
				}
				$member = $member->row();
				// Add

				// Add member
				$this->task_model->add_task_member(array(
					"taskid" => $taskid,
					"userid" => $r->userid,
					"vendorid" => $r->vendorid
					)
				);

				// Send notification of being added to the task
				$this->user_model->increment_field($r->userid, "noti_count", 1);
				$this->user_model->add_notification(array(
					"userid" => $r->userid,
					"vendorid" => $r->vendorid,
					"url" => "tasks/view/" . $taskid,
					"timestamp" => time(),
					"message" => lang("ctn_1056"). $task->name,
					"status" => 0,
					"fromid" => $this->user->info->ID,
					"email" => $member->email,
					"username" => $member->username,
					"email_notification" => $member->email_notification
					)
				);

			}
		}

		if($import_messages) {
			$task_messages = $this->task_model->get_task_messages_all($task->ID);
			foreach($task_messages->result() as $r) {
				$this->task_model->add_message(array(
					"userid" => $r->userid,
					"vendorid" => $r->vendorid,
					"message" => $r->message,
					"timestamp" => time(),
					"taskid" => $taskid
					)
				);
			}
		}

		if($import_files) {
			$files = $this->task_model->get_attached_files($task->ID);
			foreach($files->result() as $r) {
				// Check file is available to project
				if($r->projectid > 0) {
					if($r->projectid != $projectid) {
						continue;
					}
				}

				// Attach
				$this->task_model->add_file(array(
					"fileid" => $r->fileid,
					"taskid" => $taskid
					)
				);
			}
		}

		if($import_team) {
			// Get project team and add them
			$members = $this->team_model->get_members_for_project_roles($projectid, array("admin", "team"));
			foreach($members->result() as $r) {
				// Add member
				$this->task_model->add_task_member(array(
					"taskid" => $taskid,
					"userid" => $r->userid,
					"vendorid" => $r->vendorid
					)
				);

				// Send notification of being added to the task
				$this->user_model->increment_field($r->userid, "noti_count", 1);
				$this->user_model->add_notification(array(
					"userid" => $r->userid,
					"vendorid" => $r->vendorid,
					"url" => "tasks/view/" . $taskid,
					"timestamp" => time(),
					"message" => lang("ctn_1056"). $task->name,
					"status" => 0,
					"fromid" => $this->user->info->ID,
					"email" => $r->email,
					"username" => $r->username,
					"email_notification" => $r->email_notification
					)
				);
			}
		}
			

		if($project->complete_sync) {
			// Get all tasks
			$tasks = $this->task_model->get_all_project_tasks($project->ID);
			$total = $tasks->num_rows() * 100;
			$complete = 0;
			foreach($tasks->result() as $r) {
				$complete += $r->complete;
			}

			$complete = @intval(($complete/$total) * 100);
			$this->projects_model->update_project($project->ID, array(
				"complete" => $complete
				)
			);
		}

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $project->userid,
			"message" => lang("ctn_1050") . $name . lang("ctn_1051") . $project->name,
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $projectid,
			"url" => "tasks/view_task/" . $taskid,
			"taskid" => $taskid
			)
		);

	}

	public function delete_project($id, $hash) 
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
		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		// Delete
		$this->projects_model->delete_project($id);

		// Delete finances
		$this->finance_model->delete_finance_project($id);

		// Log
		$this->user_model->add_user_log(array(
			"userid" => $project->userid,
			"message" => lang("ctn_1046") . " <b>".$project->name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $project->ID,
			"url" => "projects"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_68"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("projects/" . $page));
	}

	public function edit_project($id) 
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
		$this->template->loadExternal(
			'<script src="'.base_url().
			'scripts/libraries/jscolor.min.js"></script>'
		);
		$id = intval($id);
		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$role='Client';
		$role = $this->user_model->get_role($role);
		$role = $role->row();
		$roleId = $role->ID;
		$clients = $this->clients_model->get_client($roleId);

		//get vendors
		$role1='Vendor';
		$role1 = $this->user_model->get_role($role1);
	
		$role1 = $role1->row();
		$roleId1 = $role1->ID;
		$vendors = $this->vendors_model->get_client($roleId1);

		$cats = $this->projects_model->get_project_categories();
		$this->template->loadContent("projects/edit.php", array(
			"categories" => $cats,
			"clients" => $clients,
			"vendors" => $vendors,
			"project" => $project->row()
			)
		);
	}

	public function edit_project_pro($id) 
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
		$id = intval($id);
		$project = $this->projects_model->get_project($id);
		if($project->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$project = $project->row();

		$name = $this->common->nohtml($this->input->post("name"));
		$description = $this->lib_filter->go($this->input->post("description"));
		$userid = intval($this->input->post("userid"));
		$vendorid = intval($this->input->post("vendorid"));
		$catid = intval($this->input->post("catid"));
		$status = intval($this->input->post("status"));
		$calendar_id = $this->common->nohtml($this->input->post("calendar_id"));
		$calendar_color = $this->common->nohtml($this->input->post("calendar_color"));

		$complete = intval($this->input->post("complete"));
		$complete_sync = intval($this->input->post("complete_sync"));

		$project_at = $this->input->post("project_at");
		$project_value = $this->input->post("project_value");
		$purchase_orderno = intval($this->input->post("purchase_order_no"));
		$start_date = $this->input->post("start_date");
		$start_date = date("Y-m-d", strtotime($start_date));
		$end_date = $this->input->post("end_date");
		$end_date = date("Y-m-d", strtotime($end_date));
		$project_in_charge = $this->input->post("project_in_charge");
		$buyer = $this->input->post("buyer");
		$po_date = $this->input->post("po_date");
		$po_date = date("Y-m-d", strtotime($po_date));

		if($status != 0 && $status != 1) {
			$this->template->error(lang("error_152"));
		}

		if(empty($name)) $this->template->error(lang("error_150"));

		$cat = $this->projects_model->get_category($catid);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}

		$this->load->library("upload");

		if ($_FILES['userfile']['size'] > 0) {
			$this->upload->initialize(array( 
		       "upload_path" => $this->settings->info->upload_path,
		       "overwrite" => FALSE,
		       "max_filename" => 300,
		       "encrypt_name" => TRUE,
		       "remove_spaces" => TRUE,
		       "allowed_types" => $this->settings->info->file_types,
		       "max_size" => $this->settings->info->file_size,
		       "max_width" => 150,
		       "max_height" => 150
		    ));

		    if (!$this->upload->do_upload()) {
		    	$this->template->error(lang("error_21")
		    	.$this->upload->display_errors());
		    }

		    $data = $this->upload->data();

		    $image = $data['file_name'];
		} else {
			$image= $project->image;
		}

		if($complete_sync) {
			// Get all tasks
			$this->load->model("task_model");
			$tasks = $this->task_model->get_all_project_tasks($project->ID);
			$total = $tasks->num_rows() * 100;
			$complete = 0;
			foreach($tasks->result() as $r) {
				$complete += $r->complete;
			}

			$complete = @intval(($complete/$total) * 100);
		}

		// Update Project
		$this->projects_model->update_project($project->ID, array(
			"name" => $name,
			"description" => $description,
			"catid" => $catid,
			"userid" => $userid,
			"vendorid" => $vendorid,
			"project_at" => $project_at,
			"project_value" => $project_value,
			"purchase_order_no" => $purchase_orderno,
			"start_date" => $start_date,
			"end_date" => $end_date,
			"project_in_charge" => $project_in_charge,
			"buyer" => $buyer,
			"po_date" => $po_date,
			"timestamp" => time(),
			"image" => $image,
			"status" => $status,
			"calendar_id" => $calendar_id,
			"calendar_color" => $calendar_color,
			"complete" => $complete,
			"complete_sync" => $complete_sync
			)
		);


		// Log
		$this->user_model->add_user_log(array(
			"userid" => $userid,
			"message" => lang("ctn_1047") . " <b>".$name.
			"</b>.",
			"timestamp" => time(),
			"IP" => $_SERVER['REMOTE_ADDR'],
			"projectid" => $project->ID,
			"url" => "projects"
			)
		);

		$this->session->set_flashdata("globalmsg", 
			lang("success_69"));
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("projects/" . $page));
	}

	public function make_active($id) 
	{
		$id = intval($id);
		if($id > 0) {
			$project = $this->projects_model->get_project($id);
			if($project->num_rows() == 0) {
				$this->template->error(lang("error_72"));
			}
			$project = $project->row();

			// Active if user is admin only or a member of the project
			if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
				// Check if user is a member
				$member = $this->team_model
					->get_member_of_project($this->user->info->ID, $project->ID);
				if($member->num_rows() == 0) {
					$this->template->error(lang("error_153"));
				}
			}

			$this->user_model->update_user($this->user->info->ID, array(
				"active_projectid" => $project->ID
				)
			);
			$msg = lang("success_70");
		} else {
			$msg = lang("success_71");
			$this->user_model->update_user($this->user->info->ID, array(
				"active_projectid" => 0
				)
			);
		}

		$this->session->set_flashdata("globalmsg", $msg);
		if(isset($_SESSION['p_page'])) {
			$page = $this->common->nohtml($_SESSION['p_page']);
		} else {
			$page = "index";
		}
		redirect(site_url("projects/" . $page));
	}

	public function expense_category()
	{

		$this->template->loadData("activeLink",
				array("projects" => array("expense_category" => 1)));
                $this->template->loadContent("projects/expense/categories.php", array("page" => "index" ) );
	}
	public function expense_category_page($page = "index"){
		$this->load->library("datatables");
		$expense_categories = $this->expense_model->get_categories_datatable($this->datatables);

		$this->datatables->set_total_rows(
				$this->expense_model->get_expense_categories_total()
			);
		foreach($expense_categories->result() as $r) {
			$options ='<a href="'.site_url("projects/edit_expense_category/" . $r->ID).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="'.lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("projects/delete_expense_category/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" onclick="return confirm(\''.lang("ctn_508").'\')" title="'.lang("ctn_57").'"><span class="glyphicon glyphicon-trash"></span></a>';
			
			$this->datatables->data[] = array(
				$r->expense_category,
				$options
			);
		}
		echo json_encode($this->datatables->process());
	}
	public function edit_expense_category($id){
		$id = intval($id);
		$expense_category = $this->expense_model->get_category($id);
		if($expense_category->num_rows() == 0) {
			$this->template->error(lang("error_72"));
		}
		$this->template->loadContent("projects/expense/edit_expense_cat.php", array(
			"cat" => $expense_category->row()
			)
		);
	}
	public function add_expense_category(){
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
				$this->user)) {
			
					$this->template->error(lang("error_71"));
			
		}
		$expense_category = $this->common->nohtml($this->input->post("expense_category"));
		if(empty($expense_category)) {
			$this->template->error(lang("error_187"));
		}
		// Add
		$this->expense_model->add_category(array(
			"expense_category" => $expense_category
			)
		);
		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("projects/expense_category"));
	}
	public function edit_expense_cat($id){

		$expense_category = $this->common->nohtml($this->input->post("expense_category"));
		$this->expense_model->update_category($id, array(
			"expense_category" => $expense_category
			)
		);
		$this->session->set_flashdata("globalmsg", 
			lang("success_53"));
		redirect(site_url("projects/expense_category"));
	}
	public function delete_expense_category($id){
		if(!$this->common->has_permissions(array("admin", "project_admin"), 
			$this->user)) {
			$this->template->error(lang("error_71"));
		}
		$id = intval($id);
		$cat = $this->expense_model->get_category($id);
		if($cat->num_rows() == 0) {
			$this->template->error(lang("error_149"));
		}
		$cat = $cat->row();

		$this->expense_model->delete_category($id);
		$this->session->set_flashdata("globalmsg", 
			lang("success_52"));
		redirect(site_url("projects/expense_category"));
	}
	public function expense_head(){
		$expense_categories = $this->expense_model->get_categories();
	    $this->template->loadData("activeLink",
		                 array("projects" => array("expense_head" => 1)));
	    $this->template->loadContent("projects/expense/head.php", array('expense_categories' => $expense_categories, "page" => "index") );
	}

	public function expense_head_page($page = "index"){
		$this->load->library("datatables");
		// $expense_categories = $this->expense_model->get_head_datatable($this->datatables);

		$this->datatables->set_total_rows(
				10
			);
		// foreach($expense_categories->result() as $r) {
		// 	$options ='<a href="'.site_url("projects/edit_expense_category/" . $r->ID).'" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="right" title="'.lang("ctn_55").'"><span class="glyphicon glyphicon-cog"></span></a> <a href="'.site_url("projects/delete_expense_category/" . $r->ID . "/" . $this->security->get_csrf_hash()).'" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="right" onclick="return confirm(\''.lang("ctn_508").'\')" title="'.lang("ctn_57").'"><span class="glyphicon glyphicon-trash"></span></a>';
			
			$this->datatables->data[] = array(
				'jjj',
				'ddd',
				'ddd',
			);
		// }
		echo json_encode($this->datatables->process());
	}

	public function expenses()
	{
            $this->template->loadData("activeLink",
		                 array("projects" => array("expenses" => 1)));

	    $this->template->loadContent("projects/expense/expenses.php", array() );
	}


}

?>
