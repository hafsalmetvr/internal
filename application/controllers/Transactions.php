<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transactions extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("transactions" => array("general" => 1)));

	}

	public function receipt_voucher() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("receipt" => 1)));

		$this->template->loadContent("transactions/receipt_voucher.php", array(
			
			)
		);

	}

	public function payment_voucher() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("payment" => 1)));

		$this->template->loadContent("transactions/payment_voucher.php", array(
			
			)
		);

	}

	public function pdc_rec() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("pdc" => 1)));

		$this->template->loadContent("transactions/pdc_rec.php", array(
			
			)
		);

	}

	public function pdc_payable() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("pdcpayable" => 1)));

		$this->template->loadContent("transactions/pdc_payable.php", array(
			
			)
		);

	}

	public function pdc_clearence() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("pdc_clearence" => 1)));

		$this->template->loadContent("transactions/pdc_clearence.php", array(
			
			)
		);

	}

	public function payroll_slip() 
	{
		$this->template->loadData("activeLink", 
			array("transactions" => array("payroll_slip" => 1)));

		$this->template->loadContent("transactions/payroll_slip.php", array(
			
			)
		);

	}

}