<?php

class Product extends MY_Model{

	const DB_TABLE = 'product';
	const DB_TABLE_PK = 'product_id';

    /**
     * Category Id
     * @var int
     */
    public $category_id;

     /**
     * Brand Id
     * @var int
     */
    public $brand_id;

     /**
     * Product Name
     * @var string
     */
    public $product_name;

     /**
     * Product Manufacture Date
     * @var date
     */
    public $product_man_date;

     /**
     * Product Expire Date
     * @var date
     */
    public $product_ex_date;

     /**
     * Product Registered Quantity
     * @var int
     */
    public $product_quantity;

     /**
     * Product Remain Quantity
     * @var int
     */
    public $product_remain_quantity;

     /**
     * Added Quantity
     * @var int
     */
    public $product_added_quantity;

    /**
     * Added Quantity
     * @var int
     */
    public $act_added_quantity;


     /**
     * Product Unit
     * @var string
     */
    public $product_unit;

     /**
     * Product Base Price
     * @var int
     */
    public $product_base_price;

     /**
     * Product Selling Price
     * @var int
     */
    public $product_selling_price;

     /**
     * Product Profit Price
     * @var int
     */
    public $product_profit_price;

     /**
     * Product Tax
     * @var int
     */
    public $product_tax;

     /**
     * Product Enter By
     * @var string
     */
    public $product_enter_by;

     /**
     * Product Status
     * @var string
     */
    public $product_status;

     /**
     * Product Description
     * @var string
     */
    public $product_description;

     /**
     * Product Date
     * @var int
     */
    public $product_date;

     /**
     * Product deleted
     * @var int
     */
    public $is_deleted;


    // public function addProduct(){

    //     $data = array('')


    // }



    public function fetch_Product_Model($id=0)
    {
         if($id == ''){

       $this->db->select('*');
       $this->db->from('product');
       $this->db->join('category', 'product.category_id = category.category_id' );
       $this->db->join('brand', 'product.brand_id = brand.brand_id');
       $this->db->where('is_deleted','0');
      
       $query = $this->db->get();

       return $query->result_array();

      }else{

       $this->db->select('*');
       $this->db->from('product');
       $this->db->join('category', 'product.category_id = category.category_id' );
       $this->db->join('brand', 'product.brand_id = brand.brand_id');
       $this->db->where('product_id',$id);
      
       $query = $this->db->get();

       return $query->result_array();

      }

    }

    public function fill_brand_list($category_id=0)
    {
    
       $this->db->select("*");
       $this->db->from("brand");
       $this->db->where("brand_status","1");
       $this->db->where("category_id",$category_id);

       $query = $this->db->get();

       $result = $query->result_array();

       return $result;

    }

    public function getActiveProductData()
    {
    
        $this->db->select("*");
        $this->db->from("product");
        $this->db->where("is_deleted","0");
        
        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    public function updateDate($id)
    {

        $data = array('product_updated_date'=>  mdate("%Y-%m-%d %H:%i:%s"));
        $this->db->where('product_id',$id);
        $this->db->update('product',$data);
     
    }

    public function addProductQty($data,$product_id=null)
    {

        $product_quantity = $this->input->post('product_quantity');
        $product_remain_quantity = $this->input->post('product_remain_quantity');
        $product_added_quantity = $this->input->post('product_added_quantity');

            $data = array(
                          'product_id'=>$this->db->insert_id(),
                          'category_id'=>$this->input->post('category_id'),
                      'opening_quantity'=>$product_quantity,
                      'closing_quantity'=>$product_remain_quantity,
                      'added_quantity'=>$product_added_quantity,
                     );
        $this->db->insert('monreports',$data);

    }

    public function updateProductQty($id)
    {

      $this->db->select('added_quantity');
      $this->db->from('monreports');
      $this->db->where('product_id',$id);
      $this->db->order_by('updated_date','desc');
      $this->db->limit(1);

     $added_quantity = $this->db->get()->row()->added_quantity;


        
           $data = array(
                         'closing_quantity'=>$this->input->post('product_remain_quantity'),
                         'added_quantity'=>$this->input->post('act_added_quantity')+$added_quantity,
                         'updated_date'=>mdate("%Y-%m-%d %H:%i:%s"));
           $this->db->where('product_id',$id);
           $this->db->order_by('updated_date','desc');
           $this->db->limit(1);
           $this->db->update('monreports',$data);
                          
    }

    public function deleteProduct($id)
    {
            $data = array('is_deleted'=>'1');
            $this->db->where('product_id',$id);
            $this->db->update('product',$data);
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('product_id', $id);
            $update = $this->db->update('product', $data);
            return ($update == true) ? true : false;
        }
    }

}