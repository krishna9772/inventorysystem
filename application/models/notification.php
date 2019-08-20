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
          $inc_date = date('m/d/Y', strtotime("+20 day", strtotime($date))); 


          $sql = "SELECT  * FROM product WHERE DATE(product_ex_date) <= '$inc_date' and product_status = '1' ORDER BY product_ex_date ASC ";
          $query = $this->db->query($sql);

          return $query->result_array();
          
  	}

    public function getOftProduct()
    {

      $quantity = "10";
      $sql = "SELECT * FROM product where product_remain_quantity <= '$quantity' and product_status = '1' ORDER BY product_remain_quantity DESC";
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


    public function getTotalNoti()
    {

          $date = date('m/d/Y');    
          $inc_date = date('m/d/Y', strtotime("+20 day", strtotime($date))); 

          $sql = "SELECT  * FROM product WHERE DATE(product_ex_date) <= '$inc_date' and product_status = '1' ORDER BY product_ex_date ASC ";
          $query = $this->db->query($sql);
          $ex_quantity = $query->num_rows();

           $quantity = "10";
           $sql1 = "SELECT * FROM product where product_remain_quantity <= '$quantity' and product_status = '1' ORDER BY product_remain_quantity DESC";
           $query1 = $this->db->query($sql1); 

           $oft_quantity = $query1->num_rows();

          $date1 = date('d-m-Y');    
          $inc_date1 = strtotime("+20 day", strtotime($date1)); 

            $sql2 = "SELECT  * FROM orders WHERE net_due_date <= '$inc_date1' and paid_status = '0' ORDER BY net_due_date ASC ";
            $query2 = $this->db->query($sql2);

            $due_quantity = $query2->num_rows();


           $total = $ex_quantity+$oft_quantity+$due_quantity;

           return $total;

    }

  }