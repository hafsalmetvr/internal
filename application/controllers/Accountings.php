<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountings extends CI_Controller 
{
	public function __construct() 
	{
	
		parent::__construct();
		
		
		$this->template->loadData("activeLink", 
			array("accounting" => array("general" => 1)));
		$this->template->loadData("activeLink", 
			array("accounting" => array("expense" => array("general" => 1)) ));

	}

	public function direct_income() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("direct_income" => 1)));

		$this->template->loadContent("accountings/income/direct_income.php", array(
			
			)
		);

	}

	public function indirect_income() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("indirect_income" => 1)));

		$this->template->loadContent("accountings/income/indirect_income.php", array(
			
			)
		);

	}

	public function direct_expense() 
	{
		$this->template->loadData("activeLink", 
	
			array("accounting" => array("direct_expense" => 1)));

		$this->template->loadContent("accountings/expense/direct_expense.php", array(
			
			)
		);

	}

	public function indirect_expense() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("indirect_expense" => 1)));

		$this->template->loadContent("accountings/expense/indirect_expense.php", array(
			
			)
		);

	}

	public function expense_category() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("expense_category" => 1)));

		$this->template->loadContent("accountings/expense_category.php", array(
			
			)
		);

	}

	public function expense_head() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("expense_head" => 1)));

		$this->template->loadContent("accountings/expense_head.php", array(
			
			)
		);

	}

	public function receive_payment() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("receive_payment" => 1)));

		$this->template->loadContent("accountings/receive_payment.php", array(
			
			)
		);

	}

	public function pay_purchase_bill() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("pay_purchase_bill" => 1)));

		$this->template->loadContent("accountings/purchase_bill/pay_purchase_bill.php", array(
			
			)
		);

	}

	public function purchase_bill() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("purchase_bill" => 1)));

		$this->template->loadContent("accountings/purchase_bill/purchase_bill.php", array(
			
			)
		);

	}

	public function due_purchase_bill() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("due_purchase_bill" => 1)));

		$this->template->loadContent("accountings/purchase_bill/due_purchase_bill.php", array(
			
			)
		);

	}

	public function over_due_purchase_bill() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("over_due_purchase_bill" => 1)));

		$this->template->loadContent("accountings/purchase_bill/over_due_purchase_bill.php", array(
			
			)
		);

	}

	public function paid_purchase_bill() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("paid_purchase_bill" => 1)));

		$this->template->loadContent("accountings/purchase_bill/paid_purchase_bill.php", array(
			
			)
		);

	}

	public function partialy_paid() 
	{
		$this->template->loadData("activeLink", 
			array("accounting" => array("partialy_paid" => 1)));

		$this->template->loadContent("accountings/purchase_bill/partialy_paid.php", array(
			
			)
		);

	}

}