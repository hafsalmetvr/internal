<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Opening_balance extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("general" => 1)));

	}

	public function customer_opening_balance() 
	{
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("customer" => 1)));

		$this->template->loadContent("opening_balance/customer_opening_balance.php", array(
			
			)
		);

	}

	public function supplier_opening_balance() 
	{
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("supplier" => 1)));

		$this->template->loadContent("opening_balance/supplier_opening_balance.php", array(
			
			)
		);

	}

	public function receive_old_balance() 
	{
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("receive" => 1)));

		$this->template->loadContent("opening_balance/receive_old_balance.php", array(
			
			)
		);

	}

	public function receive_old_balance_supplier() 
	{
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("receive_supplier" => 1)));

		$this->template->loadContent("opening_balance/receive_old_balance_supplier.php", array(
			
			)
		);

	}

	public function old_balance_details() 
	{
		$this->template->loadData("activeLink", 
			array("opening_balance" => array("old_balance" => 1)));

		$this->template->loadContent("opening_balance/old_balance_details.php", array(
			
			)
		);

	}

}