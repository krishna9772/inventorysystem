<?php

  class Customer extends MY_Model{


  	const DB_TABLE = 'customer';
	const DB_TABLE_PK = 'customer_id';


	/**
     * Category Name
     * @var string
     */
    public $customer_name;

    /**
     * Category Address
     * @var string
     */
    public $customer_address;

    /**
     * Customer Number
     * @var string
     */
    public $customer_number;

    /**
     * Customer status
     * @var string
     */
    public $customer_status;

     /**
     * Customer Description
     * @var string
     */
    public $customer_description;

    /**
     * Created Date
     * @var string
     */
    public $created_date;



  }


?>