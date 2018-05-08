<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stm_account extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("stm_account" => array("general" => 1)));

	}

	public function customer_statement() 
	{
		$this->template->loadData("activeLink", 
			array("stm_account" => array("customer" => 1)));

		$this->template->loadContent("stm_account/customer_statement.php", array(
			
			)
		);

	}

	public function supplier_statement() 
	{
		$this->template->loadData("activeLink", 
			array("stm_account" => array("supplier" => 1)));

		$this->template->loadContent("stm_account/supplier_statement.php", array(
			
			)
		);

	}
}