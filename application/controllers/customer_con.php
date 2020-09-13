<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Customer_con extends CI_Controller
{


   /**
   * Customer::__construct()
   *
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->model('notification');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  /**
  *fetch_customer()
  *
  */

  public function fetch_Customer($limit=10,$page=1)
  {

    if(!$this->bitauth->logged_in())
   {

     $this->session->set_userdata('redir', current_url());
     redirect('account/login');

   }

   $this->load->model('customer');
   

   $data['customer'] = $this->customer->get();
   $data['title']    = 'Customer List';
   $data['expiryproduct'] = $this->notification->getExpiryProduct();
                $data['oftproduct'] = $this->notification->getOftProduct();
                $data['duedate'] = $this->notification->getDueDate();
                $data['exnoti'] = $this->notification->getExNoti();
                $data['ofsnoti'] = $this->notification->getOfsNoti();
                $data['ornoti']  = $this->notification->getOrdernoti();



     $path='customer/list';
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
  *Insert_customer()
  *
  */
  
  public function add_Customer()
  {

     if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

      if($this->input->post())
    {

      $this->form_validation->set_rules(array(
        array( 'field' => 'customer_name', 'label' => 'customer Name', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'customer_address', 'label' => 'customer Address', 'rules' => 'trim', ),
        array( 'field' => 'customer_name', 'label' => 'customer Number', 'rules' => 'trim', ),
        array( 'field' => 'customer_description', 'label' => 'Description', 'rules' => 'trim', ),
      ));

      if($this->form_validation->run() == TRUE)
      {

        unset($_POST['submit']);
        $cat = $this->input->post();
        $this->load->model('customer');
        foreach($cat as $key => $value)
        $this->customer->$key = $value;
        $this->customer->save();
        unset($_POST);

       $this->session->set_flashdata('success', 'Successfully created');
       redirect('customer_con/add_customer/', 'refresh');

      }else{
        $data['error']=validation_errors();
      }

     }

    $data['title']='customer';
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
                $data['oftproduct'] = $this->notification->getOftProduct();
                $data['duedate'] = $this->notification->getDueDate();
                $data['exnoti'] = $this->notification->getExNoti();
                $data['ofsnoti'] = $this->notification->getOfsNoti();
                $data['ornoti']  = $this->notification->getOrdernoti();

    $path='customer/add';
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
  *update_customer()
  *
  */

  public function update_customer($customer_id=0) 
  {

    if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('customer');
    $this->customer->load($customer_id);

    if($this->input->post())
    {

        $this->form_validation->set_rules(array(
        array( 'field' => 'customer_name', 'label' => 'customer Name', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'customer_address', 'label' => 'customer Address', 'rules' => 'trim', ),
        array( 'field' => 'customer_name', 'label' => 'customer Number', 'rules' => 'trim', ),
        array( 'field' => 'customer_description', 'label' => 'Description', 'rules' => 'trim', ),
      ));

       if($this->form_validation->run() == TRUE)
       {
        
        unset($_POST['submit']);
        $cat = $this->input->post(); 
        $this->load->model('customer');
        foreach($cat as $key => $value)
        $this->customer->$key = $value;
        $this->customer->save();
        unset($_POST);

       $data['script'] = '<script>alert("'.html_escape($this->customer->customer_name). 'has been edited successfuly.");</script>';

            redirect('customer_con/fetch_customer');

        }else{
          //user may have sent the form to a url other than the original
          $data['error'] = validation_errors();
    }

  }
 
    $data['title'] = 'Edit customer';
    $data['customer']  = $this->customer;
   $data['expiryproduct'] = $this->notification->getExpiryProduct();
                $data['oftproduct'] = $this->notification->getOftProduct();
                $data['duedate'] = $this->notification->getDueDate();
                $data['exnoti'] = $this->notification->getExNoti();
                $data['ofsnoti'] = $this->notification->getOfsNoti();
                $data['ornoti']  = $this->notification->getOrdernoti();

    $path = 'customer/edit';
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
  *delete_customer()
  *
  */

  public function delete_Customer($customer_id=0)
  {
    
    if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
    }

    $this->load->model('customer');
    $this->customer->load($customer_id);

    if($this->input->post())
    {
       $this->form_validation->set_rules(array(
        array( 'field' => 'customer_id', 'label' => 'ID', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'del', 'label' => '', 'rules' => 'required|trim|has_no_schar', ),
      ));

       if($this->form_validation->run() == TRUE && $this->input->post('customer_id') == $customer_id)
      {

        $this->customer->delete();

          echo 'ok';
          return;

        }else{

          echo 'nok';
          return;

        }

  }

     $data['customer'] = $this->customer;
     
     $this->load->view('customer/delete',$data);

}

}