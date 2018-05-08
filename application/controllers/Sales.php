<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		//$this->load->model("sales_model");
		
		$this->template->loadData("activeLink", 
			array("sales" => array("general" => 1)));

		$this->template->loadData("activeLink", 
			array("sales_order" => array("general" => 1)));

		// If the user does not have premium. 
		// -1 means they have unlimited premium
		if($this->settings->info->global_premium && 
			($this->user->info->premium_time != -1 && 
				$this->user->info->premium_time < time()) ) {
			$this->session->set_flashdata("globalmsg", lang("success_29"));
			redirect(site_url("funds/plans"));
		}
	}

	public function sales_invoice() 
	{
		$this->template->loadData("activeLink", 
			array("sales" => array("invoice" => 1)));

		$this->template->loadContent("sales/sales_invoice.php", array(
			
			)
		);

	}

	public function sales_due() 
	{
		$this->template->loadData("activeLink", 
			array("sales" => array("due" => 1)));

		$this->template->loadContent("sales/sales_due.php", array(
			
			)
		);

	}

	public function sales_over_due() 
	{
		$this->template->loadData("activeLink", 
			array("sales" => array("overdue" => 1)));
		$this->template->loadContent("sales/sales_over_due.php", array(
			
			)
		);

	}

	public function sales_paid_invoice() 
	{
		$this->template->loadData("activeLink", 
			array("sales" => array("paid" => 1)));
		$this->template->loadContent("sales/sales_paid_invoice.php", array(
			
			)
		);

	}

	public function sales_partiallypaid_invoice() 
	{
		$this->template->loadData("activeLink", 
			array("sales" => array("partially" => 1)));
		$this->template->loadContent("sales/sales_partiallypaid_invoice.php", array(
			
			)
		);

	}

	public function order() 
	{
		$this->template->loadData("activeLink", 
			array("sales_order" => array("order" => 1)));
		$this->template->loadContent("sales/order.php", array(
			
			)
		);

	}

	public function return() 
	{
		$this->template->loadData("activeLink", 
			array("sales_order" => array("return" => 1)));
		$this->template->loadContent("sales/return.php", array(
			
			)
		);

	}

}