    <?php

class Monreports extends CI_Model
{

  public function __construct()
  {

  	  parent::__construct();
  }

  public function getSoldProduct($category_id=0,$date=0)
  {
      
       // $sql = "SELECT foc,product_name,product_remain_quantity,SUM(qty) as total_qty FROM orders_item  JOIN product on orders_item.product_id = product.product_id
       //         JOIN brand on product.category_id = brand.category_id  WHERE created_date BETWEEN '$inc_date' and '$date' and   product.category_id = 2 group by qty ";

     $sql = "SELECT * FROM monreports JOIN product on monreports.product_id = product.product_id where monreports.category_id = '$category_id' and updated_date LIKE'%".$date."%' ";

       // $sql = "SELECT * FROM brand JOIN product on brand.category_id = product.product_id JOIN orders_item on product.product_id = orders_item.product_id WHERE created_date BETWEEN '$inc_date' and '$date' and product.category_id = 1";
      
       $query = $this->db->query($sql);
       	
       return $query->result_array();

  }

  public function getTime($id)   // Getting the lasted updated time from monreports
  {

    $this->db->select('updated_date as time');
    $this->db->from('monreports');
    $this->db->where('product_id',$id);
    $this->db->order_by('updated_date','desc');
    $this->db->limit(1);
    return $this->db->get()->row()->time;

  }

  public function updateMonreports($data,$id) //Updating the closing quantity in monreports
  {

   if($data && $id) {
            $this->db->where('product_id', $id);
            $this->db->order_by('updated_date','desc');
            $this->db->limit(1);
            $update = $this->db->update('monreports', $data);
            return ($update == true) ? true : false;
        }

    
  }

  public function addMonreports($id) //Adding the new data with the same product_id not ordering
  {

    $sql = "INSERT INTO monreports (product_id,category_id,opening_quantity,closing_quantity) SELECT product_id,category_id,product_remain_quantity,product_remain_quantity FROM  product where product_id = '$id'";

    $query = $this->db->query($sql);

  }

  public function addMonreportsOrder($id,$qty=0)//Adding the new data when ordering in a new month
  {

    $sql ="INSERT INTO monreports (product_id,category_id,opening_quantity,added_quantity) SELECT product_id,category_id,closing_quantity,'$qty' FROM monreports where product_id = '$id' order by updated_date desc limit 1";

    $query = $this->db->query($sql);

    if($query == TRUE)
    {

      $this->db->select('product_remain_quantity');
      $this->db->from('product');
      $this->db->where('product_id',$id);

      $closing_quantity = $this->db->get()->row()->product_remain_quantity;

      $this->db->set('closing_quantity',$closing_quantity);
      $this->db->where('product_id', $id);
      $this->db->order_by('updated_date','desc');
      $this->db->limit(1);
      $this->db->update('monreports');



  }
  
}

}