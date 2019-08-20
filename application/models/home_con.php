<?php

class Home_con extends CI_Model	
{

	public function __construct()
	{

		parent::__construct();

	}

	public function count_total_user()
	{

		$this->db->select('*');
		$this->db->from('users');

		$query = $this->db->get();

		return $query->num_rows();

	}

	public function count_total_product()
	{

		$this->db->select('*');
		$this->db->from('product');

		$query = $this->db->get();

		return $query->num_rows();

	}

	public function count_total_category()
	{

		$this->db->select('*');
		$this->db->from('category');

		$query = $this->db->get();

		return $query->num_rows();

	}

		public function count_total_brand()
	{

		$this->db->select('*');
		$this->db->from('brand');

		$query = $this->db->get();

		return $query->num_rows();

	}

	    public function count_total_order_value()
	    {

	    	$query = $this->db->query("SELECT sum(net_amount) as total_order_value from orders");

	    	$total_values = $query->result_array();

	    	foreach($total_values as $result){

	    		return number_format($result['total_order_value'],2);
	    	}

	    }

	       public function count_total_paid_value()
	    {

	    	$query = $this->db->query("SELECT sum(net_amount) as total_order_value from orders where paid_status = '1' ");

	    	$total_values = $query->result_array();

	    	foreach($total_values as $result){

	    		return number_format($result['total_order_value'],2);
	    	}

	    }

	      public function count_total_unpaid_value()
	    {

	    	$query = $this->db->query("SELECT sum(net_amount) as total_order_value from orders where paid_status = '0 ' ");

	    	$total_values = $query->result_array();

	    	foreach($total_values as $result){

	    		return number_format($result['total_order_value'],2);
	    	}

	    }




}