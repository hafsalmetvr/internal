<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		//$this->load->model("sales_model");
		
		$this->template->loadData("activeLink", 
			array("inventory" => array("general" => 1)));
		$this->template->loadData("activeLink", 
			array("product_management" => array("general" => 1)));

	}

	public function showstock() 
	{
		$this->template->loadData("activeLink", 
			array("inventory" => array("stock" => 1)));

		$this->template->loadContent("inventory/showstock.php", array(
			
			)
		);

	}

	public function out_of_stock() 
	{
		$this->template->loadData("activeLink", 
			array("inventory" => array("outofstock" => 1)));

		$this->template->loadContent("inventory/out_of_stock.php", array(
			
			)
		);

	}

	public function fast_moving() 
	{
		$this->template->loadData("activeLink", 
			array("inventory" => array("fast" => 1)));

		$this->template->loadContent("inventory/fast_moving.php", array(
			
			)
		);

	}

	public function slow_moving() 
	{
		$this->template->loadData("activeLink", 
			array("inventory" => array("slow" => 1)));

		$this->template->loadContent("inventory/slow_moving.php", array(
			
			)
		);

	}

	public function current_stock() 
	{
		$this->template->loadData("activeLink", 
			array("inventory" => array("current" => 1)));

		$this->template->loadContent("inventory/current_stock.php", array(
			
			)
		);

	}

	public function sales_mngmnt() 
	{
		$this->template->loadData("activeLink", 
			array("product_management" => array("sales" => 1)));

		$this->template->loadContent("inventory/sales_mngmnt.php", array(
			
			)
		);

	}

}