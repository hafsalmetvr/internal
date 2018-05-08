<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fleets extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("fleets" => array("general" => 1)));

	}

	public function driver() 
	{
		$this->template->loadData("activeLink", 
			array("fleets" => array("driver" => 1)));

		$this->template->loadContent("fleets/driver.php", array(
			
			)
		);

	}

	public function vehicle() 
	{
		$this->template->loadData("activeLink", 
			array("fleets" => array("vehicle" => 1)));

		$this->template->loadContent("fleets/vehicle.php", array(
			
			)
		);

	}

}