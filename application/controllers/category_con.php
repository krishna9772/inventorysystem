<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Category_con extends CI_Controller
{

   /**
   * Category::__construct()
   *
   */
  public function __construct()
  {
    parent::__construct();

    $this->load->model('notification');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
  }

  /**
  *fetch_category()
  *
  */

  public function fetch_Category($limit=10,$page=1)
  {

    if(!$this->bitauth->logged_in())
   {

     $this->session->set_userdata('redir', current_url());
     redirect('account/login');

   }

   $this->load->model('category');
   
    $data['category'] = $this->category->get();
    $data['title']    = 'Company List';
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['exnoti'] = $this->notification->getExNoti();
    $data['ofsnoti'] = $this->notification->getOfsNoti();
    $data['ornoti']  = $this->notification->getOrdernoti();



     $path='category/list';
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
  *Insert_category()
  *
  */
  
  public function add_Category()
  {

     if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

      if($this->input->post())
    {

      $this->form_validation->set_rules(array(
        array( 'field' => 'category_name', 'label' => 'Category Name', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'category_description', 'label' => 'Description', 'rules' => 'trim', ),
      ));

      if($this->form_validation->run() == TRUE)
      {

        unset($_POST['submit']);
        $cat = $this->input->post();
        $this->load->model('category');
        foreach($cat as $key => $value)
        $this->category->$key = $value;
        $this->category->save();
        unset($_POST);

       $this->session->set_flashdata('success', 'Successfully created');
       redirect('category_con/add_Category/', 'refresh');

      }else{
        $data['error']=validation_errors();
      }

     }

    $data['title']='Category';
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['exnoti'] = $this->notification->getExNoti();
    $data['ofsnoti'] = $this->notification->getOfsNoti();
    $data['ornoti']  = $this->notification->getOrdernoti();

    $path='category/add';
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
  *update_Category()
  *
  */

  public function update_Category($category_id=0) 
  {

    if (!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->load->model('category');
    $this->category->load($category_id);


    if($this->input->post())
    {

       $this->form_validation->set_rules(array(
        array( 'field' => 'category_name', 'label' => 'Category Name', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'category_description', 'label' => 'Description', 'rules' => 'trim', ),
      ));

       if($this->form_validation->run() == TRUE)
       {
        
        unset($_POST['submit']);
        $cat = $this->input->post(); 
        $this->load->model('category');
        foreach($cat as $key => $value)
        $this->category->$key = $value;
        $this->category->save();
        unset($_POST);

       $data['script'] = '<script>alert("'.html_escape($this->category->category_name). 'has been edited successfuly.");</script>';

            redirect('category_con/fetch_Category');

        }else{
          //user may have sent the form to a url other than the original
          $data['error'] = validation_errors();
    }

  }
 
    $data['title'] = 'Edit Category';
    $data['category']  = $this->category;
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['exnoti'] = $this->notification->getExNoti();
    $data['ofsnoti'] = $this->notification->getOfsNoti();
    $data['ornoti']  = $this->notification->getOrdernoti();

    $path = 'category/edit';
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
  *delete_Category()
  *
  */

  public function delete_Category($category_id=0)
  {
    
    if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
    }

    $this->load->model('category');
    $this->category->load($category_id);

    if($this->input->post())
    {
       $this->form_validation->set_rules(array(
        array( 'field' => 'category_id', 'label' => 'ID', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'del', 'label' => '', 'rules' => 'required|trim|has_no_schar', ),
      ));

       if($this->form_validation->run() == TRUE && $this->input->post('category_id') == $category_id)
      {

        $this->load->model('brand');
        $this->brand->get_by_fkey('category_id',$category_id);

        if(!$this->brand->category_id){
        $this->category->delete();

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

     $data['category'] = $this->category;
     
     $this->load->view('category/delete',$data);

}

}