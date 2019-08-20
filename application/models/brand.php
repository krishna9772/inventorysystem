<?php

class Brand extends MY_Model{

	const DB_TABLE = 'brand';
	const DB_TABLE_PK = 'brand_id';


    /**
     * Category Name
     * @var string
     */
    public $brand_name;

     /**
     * Category id
     * @var int
     */
    public $category_id;


    /**
     * Check Availabity
     * @var string
     */
    public $brand_status;

     /**
     * Category Description
     * @var string
     */
    public $brand_description;


    public function fill_category_list()
   {

    $query = $this->db->query("SELECT * FROM category where category_status = 1 ORDER BY category_name ASC");

    return $query->result();

    }

     public function fetch_Brand_Model($id=0)
     {

      if($id == ''){

       $this->db->select('*');
       $this->db->from('brand');
       $this->db->join('category', 'brand.category_id = category.category_id' );
      
       $query = $this->db->get();

       $result = $query->result_array();

      }

      return $result;

     }

     public function delete_brand($id=0){

         $this->db->where('brand_id',$id);
         $this->db->delete('brand');

     }



}