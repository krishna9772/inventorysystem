<?php

class Category extends MY_Model{

	const DB_TABLE = 'category';
	const DB_TABLE_PK = 'category_id';


    /**
     * Category Name
     * @var string
     */
    public $category_name;


    /**
     * Check Availabity
     * @var string
     */
    public $category_status;

     /**
     * Category Description
     * @var string
     */
    public $category_description;
    
   
}