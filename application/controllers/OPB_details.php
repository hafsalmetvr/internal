<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OPB_details extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("opb_detail" => array("general" => 1)));

	}

	public function customer() 
	{
		$this->template->loadData("activeLink", 
			array("opb_detail" => array("customer" => 1)));

		$this->template->loadContent("opb_details/customer.php", array(
			
			)
		);

	}

	public function supplier() 
	{
		$this->template->loadData("activeLink", 
			array("opb_detail" => array("supplier" => 1)));

		$this->template->loadContent("opb_details/supplier.php", array(
			
			)
		);

	}
}