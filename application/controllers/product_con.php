<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Product_con extends CI_Controller
{

     /**
     * Product::__construct()
     *
     */
    public function __construct()
    {

    parent::__construct();

    $this->load->model('notification');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    }

  /**
  *fetch_product
  *
  */

  public function fetch_Product()
  {

      if(!$this->bitauth->logged_in())
      {
        $this->session->set_userdata('redir',current_url());
        redirect('account/login');

      }

      $this->load->model('product');

      $data['title'] = 'Product List';

        $data['product'] = $this->product->fetch_Product_Model();
        $data['expiryproduct'] = $this->notification->getExpiryProduct();
        $data['oftproduct'] = $this->notification->getOftProduct();
        $data['duedate'] = $this->notification->getDueDate();
        $data['exnoti'] = $this->notification->getExNoti();
        $data['ofsnoti'] = $this->notification->getOfsNoti();
        $data['ornoti']  = $this->notification->getOrdernoti();

      $path = 'product/list';

       if(isset($_GET['ajax'])&&$_GET['ajax']==true)
    {
        $this->load->view($path, $data);
    }else{
        $data['contents']=array($path);
        $this->load->view('header',$data);
        $this->load->view('index',$data);
        $this->load->view('footer',$data);
    }


  }


  /**
  *add_product
  *
  */

  public function add_Product()
  {

      $this->load->model('product');
   
     if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    if ($this->input->post())
    {

      $this->form_validation->set_rules(array(

      array( 'field' => 'category_id' , 'label' => 'Category Id' , 'rules' => 'required|trim|has_no_schar', ),

      array('field' => 'brand_id' , 'label' => 'Brand Id' , 'rules' => 'trim'),
      array('field' => 'product_name' , 'label' => 'Product Name' , 'rules' => 'trim'),
      array('field' => 'product_quantity' , 'label' => 'Product Quantity' , 'rules' => 'required'),
      array('field' => 'product_unit' , 'label' => 'Product Unit' , 'rules' => 'required'),
      array('field' => 'product_base_price' ,'label' => 'Product Base Price' , 'rules' => 'required'),
      array('field' => 'product_selling_price' , 'label' => 'Product Selling Price' , 'rules' => 'required' ),
    ));

      if($this->form_validation->run() == TRUE )
      {

        unset($_POST['submit']);

        $product = $this->input->post();
        foreach($product as $key => $value)
        $this->product->$key = $value;
        $this->product->save();
        $this->product->addProductQty($product);
        unset($_POST);

           $this->session->set_flashdata('success', 'Successfully created');
            redirect('product_con/add_Product/', 'refresh');
        
      }else{
        $data['error']=validation_errors();
      }

      }

        $data['title']  = 'Product';
        $data['category_list'] = $this->_fill_category_list();
        $data['unit_list']     = $this->_fill_product_unit();
        $data['expiryproduct'] = $this->notification->getExpiryProduct();
        $data['oftproduct'] = $this->notification->getOftProduct();
        $data['duedate'] = $this->notification->getDueDate();
        $data['exnoti'] = $this->notification->getExNoti();
        $data['ofsnoti'] = $this->notification->getOfsNoti();
        $data['ornoti']  = $this->notification->getOrdernoti();

        $path='product/add';
        if(isset($_GET['ajax'])&&$_GET['ajax']==true)
        {
            $this->load->view($path, $data);
        }
        else
        {
            $data['contents']=array($path);
            $this->load->view('header',$data);
            $this->load->view('index',$data);
            $this->load->view('footer',$data);
        }
  }

   /**
  *update_product
  *
  */

  public function update_Product($product_id=0)
  {
    if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('product');
    $this->load->model('monreports');

    $data['category_name'] = urldecode($this->uri->segment(4));
    $data['brand_name']    = urldecode($this->uri->segment(5));
    $data['product_unit']  = urldecode($this->uri->segment(6));
    $data['brand_list']    = $this->product->fill_brand_list($this->uri->segment(4));
    $data['category_list'] = $this->_fill_category_list();
    $data['unit_list']     = $this->_fill_product_unit();

    $this->product->load($product_id);

    if($this->input->post())
    {

     $this->form_validation->set_rules(array(

      array( 'field' => 'category_id' , 'label' => 'Category Id' , 'rules' => 'required|trim|has_no_schar',),

      array('field' => 'brand_id' , 'label' => 'Brand Id' , 'rules' => 'trim'),
      array('field' => 'product_name' , 'label' => 'Product Name' , 'rules' => 'trim'),
      array('field' => 'product_quantity' , 'label' => 'Product Quantity' , 'rules' => 'required'),
      array('field' => 'product_unit' , 'label' => 'Product Unit' , 'rules' => 'required'),
      array('field' => 'product_base_price' ,'label' => 'Product Base Price' , 'rules' => 'required'),
      array('field' => 'product_selling_price' , 'label' => 'Product Selling Price' , 'rules' => 'required' ),
    ));

     if($this->form_validation->run() == TRUE)
     {
        unset($_POST['submit']);
        $product = $this->input->post(); 
        $this->load->model('product');
        foreach($product as $key => $value)
        $this->product->$key = $value;
        $this->product->save();
        $this->product->updateDate($product_id);

        $date = date('Y/m',strtotime($this->monreports->getTime($product_id)));

        if(date('Y/m') > $date){

          $added_quantity = $this->input->post('act_added_quantity');

          $this->monreports->addMonreportsOrder($product_id,$added_quantity);
        }else{

           $this->product->updateProductQty($product_id);
        }


        unset($_POST);

        $data['script'] = '<script>alert("'.html_escape($this->product->product_name). 'has been edited successfuly.");</script>';

        redirect('product_con/fetch_Product');

         }else{

          $data['error'] = validation_errors();
         }


    }

        $data['title'] = "Edit Product";
        $data['product'] = $this->product;
        $data['expiryproduct'] = $this->notification->getExpiryProduct();
        $data['oftproduct'] = $this->notification->getOftProduct();
        $data['duedate'] = $this->notification->getDueDate();
        $data['exnoti'] = $this->notification->getExNoti();
        $data['ofsnoti'] = $this->notification->getOfsNoti();
        $data['ornoti']  = $this->notification->getOrdernoti();

        $path = "product/edit";

         if(isset($_GET['ajax'])&&$_GET['ajax']==true)
        { 

            $this->load->view($path, $data);

        }else{

            $data['contents']=array($path);
            $this->load->view('header',$data);
            $this->load->view('index',$data);
            $this->load->view('footer',$data);

        }

  }
  
  public function cronUpdate()
  {

    $this->load->model('product');
    $this->load->model('monreports');

    $product = $this->product->fetch_Product_Model();

    foreach ($product as $pro) {
       
        $this->product->updateDate($pro['product_id']);

        $date = date('Y/m',strtotime($this->monreports->getTime($pro['product_id'])));

        if(date('Y/m') > $date){

          $added_quantity = 0;

          $this->monreports->addMonreportsOrder($pro['product_id'],$added_quantity);
        }else{

           redirect("/");
        }

    }


  }

  public function delete_Product($product_id=0)
  {

    if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
    }

      $this->load->model('product');
      $this->product->load($product_id);

    if($this->input->post()){

       $this->form_validation->set_rules(array(
        array( 'field' => 'product_id', 'label' => 'ID', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'del', 'label' => '', 'rules' => 'required|trim|has_no_schar', ),
      ));

      if($this->form_validation->run() == TRUE && $this->input->post('product_id') == $product_id)
     {
         $this->load->model('orderitems');
          $this->orderitems->get_by_fkey('product_id',$product_id);

          if(!$this->orderitems->product_id){

          $this->product->deleteProduct($product_id);

            echo 'ok';
            return;

          }else{

            echo 'nok';
            return;

          }

      }else{

        $data['error'] = 'mismatch';
        return;

      }

  }

     $data['product'] = $this->product;
     
     $this->load->view('product/delete',$data);

 }
 
  public function _fill_category_list()
  {

     $this->load->model('category');
     $category = $this->category->get();
     $category_list[''] = '';
     foreach($category as $cat)
     {

      $category_list[$cat->category_id] = html_escape($cat->category_name);

     }

     return $category_list;

  }


  public function fill_brand_list($category_id=0)
  {

      $this->load->model("product");

      $brand_list = $this->product->fill_brand_list($this->input->post("category_id"));

      $output = '<option value="" selected disabled>Select Distributor</option>';

      foreach($brand_list as $bran)
      {

      $output .= '
      
      <option value="'.$bran["brand_id"].'">'.$bran["brand_name"].'</option>';

      }

      echo  $output;

  }
  
  public function _fill_product_unit()
  {

     return array('Box'=>'Box',
                 'Bottle'=>'Bottle',
                 'Tube'=>'Tube',
                 'Sachet'=>'Sachet',);
  
  }

  public function check_Product()
  {

    if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('product');

    $product_id= urldecode($this->uri->segment(3));
    $data['category_name'] = urldecode($this->uri->segment(4));
    $data['brand_name']    = urldecode($this->uri->segment(5));

    $data['product'] = $this->product->fetch_Product_Model($product_id);

    $this->load->view('product/check',$data);

  }

}