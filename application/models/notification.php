<?php

  class Notification extends MY_Model{

  	public function __construct()
  	{
  		parent::__construct();
  	}

  	/*
  	**Get Products going to expire in one month
  	*/

  	public function getExpiryProduct()
  	{

  		    $date = date('m/d/Y');    
          $inc_date = date('Y-m-d', strtotime("+20 day", strtotime($date))); 


          $sql = "SELECT  * FROM product WHERE product_ex_date <= '$inc_date' and product_status = '1' and is_deleted = '0' ORDER BY product_ex_date ASC ";
          $query = $this->db->query($sql);

          return $query->result_array();
          
  	}

    public function getOftProduct()
    {

      $quantity = "0";
      $sql = "SELECT * FROM product where product_remain_quantity <= '$quantity' and product_status = '1' and is_deleted = '0' ORDER BY product_remain_quantity DESC";
      $query = $this->db->query($sql);

      return $query->result_array();

    }

       public function getDueDate()
    {

           $date = date('d-m-Y');    
          $inc_date = strtotime("+20 day", strtotime($date)); 

          $sql = "SELECT  * FROM orders WHERE net_due_date <= '$inc_date' and paid_status = '0' ORDER BY net_due_date ASC ";
          $query = $this->db->query($sql);

          return $query->result_array();

    }


    public function getExNoti()
    {

          $date = date('m/d/Y');    
          $inc_date = date('Y-m-d', strtotime("+20 day", strtotime($date))); 

          $sql = "SELECT  * FROM product WHERE product_ex_date <= '$inc_date' and product_status = '1' and is_deleted = '0' ORDER BY product_ex_date ASC ";
          $query = $this->db->query($sql);
          $ex_quantity = $query->num_rows();

           return $ex_quantity;

    }

     public function getOfsNoti()
    {

           $quantity = "0";
           $sql1 = "SELECT * FROM product where product_remain_quantity <= '$quantity' and product_status = '1' and is_deleted = '0' ORDER BY product_remain_quantity DESC";
           $query1 = $this->db->query($sql1); 

           $oft_quantity = $query1->num_rows();

           return $oft_quantity;
    }

     public function getOrderNoti()
    {

          $date = date('d-m-Y');    
          $inc_date = strtotime("+20 day", strtotime($date)); 

            $sql = "SELECT  * FROM orders WHERE net_due_date <= '$inc_date' and paid_status = '0' ORDER BY net_due_date ASC ";
            $query = $this->db->query($sql);

            $due_quantity = $query->num_rows();

           return $due_quantity;

    }

  }