<?php

class Orderitems extends MY_Model{


    const DB_TABLE = 'orders_item';
    const DB_TABLE_PK = 'id';

     /**
     * Product id
     * @var integer
     */
     public $product_id;


}