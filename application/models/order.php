<?php

class Order extends MY_Model{


    const DB_TABLE = 'orders';
    const DB_TABLE_PK = 'id';

	public function __construct()
    {

        parent::__construct();
    }

   /* get the orders data */
    public function getOrdersData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM orders WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array(); 
        }

        $sql = "SELECT * FROM orders ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // get the orders item data
    public function getOrdersItemData($order_id = null)
    {
        if(!$order_id) {
            return false;
        }

        $sql = "SELECT * FROM orders_item WHERE order_id = ?";
        $query = $this->db->query($sql, array($order_id));
        return $query->result_array();
    }

    public function create()
    {

           $data = array(
            'bill_no' => $this->input->post('bill_no'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'date_time' => strtotime($this->input->post('created_date')),
            'net_due_date'=> strtotime($this->input->post('net_due_date')),
            'net_amount' => $this->input->post('net_amount_value'),
            'paid_status' => $this->input->post('paid_status'),
            'user_id' => $this->input->post('user_id'),
        );

        $insert = $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();

        $this->load->model('product');
        $this->load->model('monreports');

         // now decrease the product qty

     $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
          
            $items = array(
                'order_id' => $order_id,
                'product_id' => $this->input->post('product')[$x],
                'qty' => $this->input->post('qty')[$x],
                'rate' => $this->input->post('rate_value')[$x],
                'tax'  => $this->input->post('tax')[$x],
                'discount' => $this->input->post('discount')[$x],
                'amount' => $this->input->post('amount_value')[$x],
                'foc' => $this->input->post('foc')[$x],
            );

            $this->db->insert('orders_item',$items); 

            $product_data = $this->fetchAllProduct($this->input->post('product')[$x]);
            $qty = (int) $product_data['product_remain_quantity'] - ((int) $this->input->post('qty')[$x] + (int) $this->input->post('foc')[$x]);

            $update_product = array('product_remain_quantity' => $qty); 
            $update_monreports_data = array('closing_quantity' => $qty);

   
            $this->product->update($update_product, $this->input->post('product')[$x]);

            $date = date('Y/m',strtotime($this->monreports->getTime($this->input->post('product')[$x])));


            if(date('Y/m') > $date){

             $this->monreports->addMonreportsOrder($this->input->post('product')[$x]);

            }else{
            $this->monreports->updateMonreports($update_monreports_data,$this->input->post('product')[$x]);
        }

        }   
 
           return ($order_id) ? $order_id : false;

    }

    public function update($id)
    {

           $data = array(
            'bill_no' => $this->input->post('bill_no'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'date_time' => strtotime($this->input->post('created_date')),
            'net_due_date'=> strtotime($this->input->post('net_due_date')),
            'net_amount' => $this->input->post('net_amount_value'),
            'paid_status' => $this->input->post('paid_status'),
            'user_id' => $this->input->post('user_id'),
        );

           $this->db->where('id',$id);
           $update = $this->db->update('orders', $data);

            // now the order item 
            // first we will replace the product qty to original and subtract the qty again

           $this->load->model('product');
           $this->load->model('monreports');

           $get_order_item = $this->getOrdersItemData($id);

           foreach($get_order_item as $k => $v){

            $product_id = $v['product_id'];
            $qty = $v['qty'];
            $foc = $v['foc'];
            
            //get the product
            $product_data = $this->fetchAllProduct($product_id);
            $update_qty = (int) $qty +(int) $foc +(int) $product_data['product_remain_quantity'];
            $update_product_data = array('product_remain_quantity' => $update_qty);
            $update_monproduct_data = array('closing_quantity' => $update_qty);

            //update the product 
            $this->product->update($update_product_data,$product_id);
            $this->monreports->updateMonreports($update_monproduct_data,$product_id);

        }

            // now remove the order item data 
            $this->db->where('order_id', $id);
            $this->db->delete('orders_item');

                 // now decrease the product qty
     $count_product = count($this->input->post('product'));
        for($x = 0; $x < $count_product; $x++) {
          
            $items = array(
                'order_id' => $id,
               'product_id' => $this->input->post('product')[$x],
                'qty' => $this->input->post('qty')[$x],
                'rate' => $this->input->post('rate_value')[$x],
                'tax'  => $this->input->post('tax')[$x],
                'discount' => $this->input->post('discount')[$x],
                'amount' => $this->input->post('amount_value')[$x],
                'foc' => $this->input->post('foc')[$x],
            );
            
            $this->db->insert('orders_item',$items); 

            $product_data = $this->fetchAllProduct($this->input->post('product')[$x]);
            $qty = (int) $product_data['product_remain_quantity'] - ((int) $this->input->post('qty')[$x] + (int) $this->input->post('foc')[$x]);

            $update_product = array('product_remain_quantity' => $qty);
            $update_monreports_data = array('closing_quantity' => $qty);


            $this->product->update($update_product, $this->input->post('product')[$x]);
   
           $date = date('Y/m',strtotime($this->monreports->getTime($this->input->post('product')[$x])));


            if(date('Y/m') > $date){

             $this->monreports->addMonreportsOrder($this->input->post('product')[$x]);

            }else{
            $this->monreports->updateMonreports($update_monreports_data,$this->input->post('product')[$x]);
        }

        } 

        return true;
}
    
    public function remove($id)
    {
        if($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('orders');

            $this->db->where('order_id', $id);
            $delete_item = $this->db->delete('orders_item');
            return ($delete == true && $delete_item) ? true : false;
        }
    }

    public function countTotalPaidOrders()
    {
        $sql = "SELECT * FROM orders WHERE paid_status = ?";
        $query = $this->db->query($sql, array(1));
        return $query->num_rows();
    }

    public function fetchAllProduct($id)
    {
        $sql = "SELECT * FROM product where product_id = ? ";
        $query = $this->db->query($sql,array($id));
        return $query->row_array();
    }


    public function countOrderItem($order_id)
    {
        if($order_id) {
            $sql = "SELECT * FROM orders_item WHERE order_id = ?";
            $query = $this->db->query($sql, array($order_id));
            return $query->num_rows();
        }
    }

    public function fill_customer_list($customer_name=null)
    {

        if($customer_name){

            $sql = "SELECT * FROM customer WHERE customer_status = 1 and customer_name = ?";
            $query = $this->db->query($sql, array($customer_name));
            return $query->result_array(); 
        }

         $query = $this->db->query("SELECT * FROM customer where customer_status = 1 ORDER BY customer_name ASC");

         return $query->result();
 }



}