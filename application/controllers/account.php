<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

  class Account extends CI_Controller
  {
    /**
     * Account::__construct()
     *
     */
    public function __construct()
    {
      parent::__construct();

      $this->load->model('notification');

      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    /**
     * account::users()
     *
     */
    public function users($limit=10,$page=1)
    {
      if(!$this->bitauth->logged_in())
      {
        $this->session->set_userdata('redir', current_url());      
        redirect('account/login');
      }
      if(!$this->bitauth->is_admin())
      {
        $this->_no_access();
        return;
      }
      
      $data['title']='User List';
      $data['bitauth']=$this->bitauth;
      $data['users'] = $this->bitauth->get_users(TRUE);
      
      $data['total_rows'] = count($data['users']);
      $data['page'] = (int)$page;
      $data['per_page'] = (int)$limit;
      $config['base_url'] = site_url('account/users/'.$data['per_page']);
      $config['total_rows'] = $data['total_rows'];
      $config['per_page'] = $data['per_page'];
      $data['ip'] = ip2long($_SERVER['REMOTE_ADDR']);
      $data['expiryproduct'] = $this->notification->getExpiryProduct();
      $data['oftproduct'] = $this->notification->getOftProduct();
      $data['duedate'] = $this->notification->getDueDate();
      $data['totalnoti'] = $this->notification->getTotalNoti();


      
      $path='account/users';
      if(isset($_GET['ajax'])&&$_GET['ajax']==true)
      {
          $this->load->view($path, $data);
      }else{
          $data['contents']=array($path);
          $this->load->view('header', $data);
          $this->load->view('index', $data);
          $this->load->view('footer', $data);
      }

    }

    /**
     * Account::login()
     *
     */

    public function login()
    {

      if($this->bitauth->logged_in())
      {
        redirect("home");
      }

      $data = array();

      if($this->input->post())
      {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('remember_me','Remember Me','');

        if($this->form_validation->run() == TRUE)
        {
          // Login
          if($this->bitauth->login($this->input->post('username'), $this->input->post('password'), $this->input->post('remember_me')))
          { 
            // Redirect
            if($redir = $this->session->userdata('redir'))
            {
              $this->session->unset_userdata('redir');
            }

            redirect($redir ? $redir : ''); //should be redirect to user home page
          }
          else
          {
            $data['error'] = $this->bitauth->get_error();
          }
        }
        else
        {
          $data['error'] = validation_errors();
        }
      } 
      $data['title']='Login';
      $path='account/login';
      if(isset($_GET['ajax'])&&$_GET['ajax']==true)
      {
          $this->load->view($path, $data);
      }else{
          $data['includes']=array($path); 
          $this->load->view('header', $data);
          $this->load->view('index', $data); // account/login
          $this->load->view('footer', $data);
      }

    }

    /**
     * account::signup()
     *
     */

    public function signup()
    {
      if ($this->bitauth->get_users() && !$this->bitauth->logged_in())
      {
        $this->session->set_userdata('redir', current_url());
        redirect('account/login');
      }

      if ($this->bitauth->get_users() && !$this->bitauth->is_admin())
      {
        $this->_no_access();
        return;
      }
      
      $data = array();
      $data['roles_option'] = $this->config->item('roles', 'bitauth');
      if($this->input->post())
      {
        $this->form_validation->set_rules(array(
          array( 'field' => 'username', 'label' => 'User Name', 'rules' => 'required|trim|bitauth_unique_username|has_no_schar', ),
        array( 'field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|has_no_schar', ),
          array( 'field' => 'gender', 'label' => 'Gender', 'rules' => 'required', ),
          array( 'field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email', ),
          array( 'field' => 'phone', 'label' => 'Phone', 'rules' => 'required|trim', ),
          array( 'field' => 'address', 'label' => 'Address', 'rules' => 'trim', ),
          array( 'field' => 'position', 'label' => 'Position', 'rules' => 'required|trim|has_no_schar', ),
          array( 'field' => 'memo', 'label' => 'Memo', 'rules' => '', ),
          array( 'field' => 'birth_date', 'label' => 'Birth Date', 'rules' => '', ),
          array( 'field' => 'password', 'label' => 'Password', 'rules' => 'required|bitauth_valid_password', ),
          array( 'field' => 'password_conf', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]', ),
        ));
        
        if($this->form_validation->run() == TRUE)
        {
          unset($_POST['submit'], $_POST['password_conf']);
          $user = $this->input->post();
          $user['birth_date']=strtotime($user['birth_date']);
          $user['create_date']=now();
          //find the role from position and then assign the proper group to user
          foreach (array_keys($data['roles_option']) as $key => $value) {
            if($value==$_POST['position']){
              $role=pow(2,$key);
              $this->db->select('group_id')->from('groups')->where('roles',$role);
              $q=$this->db->get();
              foreach($q->result() as $row){
                $user['groups'] = array($row->group_id);
                break;
              }
            }
          }//end foreach
          
          if($this->bitauth->add_user($user))
          {
            foreach ($_POST as $key => $value)
                unset($_POST[$key]);
            
            $data['script'] = '<script>alert("'. html_escape($user['username']). ' has been registered successfuly.");</script>';
          }
          else
            $data['error'] = '<div class="alert alert-danger">Registring user: '. html_escape($user['username']). ' is failed.</div>';
        }else{
            $data['error'] = validation_errors();
        }

      }
      $data['title'] = 'Sign up'; 
      $data['expiryproduct'] = $this->notification->getExpiryProduct();
      $data['duedate'] = $this->notification->getDueDate();
      $data['oftproduct'] = $this->notification->getOftProduct();
      $data['totalnoti'] = $this->notification->getTotalNoti();


      $path='account/add_user';
      if(isset($_GET['ajax'])&&$_GET['ajax']==true)
      {
          $this->load->view($path, $data);
      }else{
          $data['contents']=array($path);
          $this->load->view('header', $data);
          $this->load->view('index', $data);
          $this->load->view('footer', $data);
      }
      
    }
     
    /**
     * account::edit_user()
     *
     */
    public function edit_user($user_id=0)
    {
      $data=array();
      $data['roles_option'] = $this->config->item('roles', 'bitauth');
      if(!$this->bitauth->logged_in())
      {
        $this->session->set_userdata('redir', current_url());
        redirect('account/login');
      }

      if (!$this->bitauth->is_admin())
      {
        if($this->session->userdata('ba_user_id') != $user_id)
        {
          $this->_no_access();
          return;
        }
      }

      if($this->input->post())
      {
        $this->form_validation->set_rules(array(
          array( 'field' => 'username', 'label' => 'User Name', 'rules' => 'required|trim|bitauth_unique_username['.html_escape($user_id).']|has_no_schar', ),
          array( 'field' => 'first_name', 'label' => 'First Name', 'rules' => 'trim|has_no_schar', ),
          array( 'field' => 'last_name', 'label' => 'Last Name', 'rules' => 'trim|has_no_schar', ),
          array( 'field' => 'gender', 'label' => 'Gender', 'rules' => 'required', ),
          array( 'field' => 'email', 'label' => 'Email', 'rules' => 'required|trim|valid_email', ),
          array( 'field' => 'phone', 'label' => 'Phone', 'rules' => 'required|trim', ),
          array( 'field' => 'address', 'label' => 'Address', 'rules' => 'trim', ),
          array( 'field' => 'position', 'label' => 'Position', 'rules' => '', ),
          array( 'field' => 'memo', 'label' => 'Memo', 'rules' => '', ),
          array( 'field' => 'active', 'label' => 'Active', 'rules' => '', ),
          array( 'field' => 'enabled', 'label' => 'Enabled', 'rules' => '', ),
          array( 'field' => 'password_never_expires', 'label' => 'Password Never Expires', 'rules' => '', ),
          array( 'field' => 'groups[]', 'label' => 'Groups', 'rules' => '', ),
          array( 'field' => 'picture', 'label' => 'Picture', 'rules' => '', ),
        ));

        if($this->input->post('password'))
        {
          if(!$this->bitauth->is_admin())
          {
              $this->form_validation->set_rules(array(
            array( 'field' => 'old_password', 'label' => 'Old Password', 'rules' => 'required', ),
            ));
          }
          $this->form_validation->set_rules(array(
            array( 'field' => 'password', 'label' => 'Password', 'rules' => 'required|bitauth_valid_password', ),
            array( 'field' => 'password_conf', 'label' => 'Confirm Password', 'rules' => 'required|matches[password]', ),
        ));
        }

        if($this->form_validation->run() == TRUE)
        {
          unset($_POST['submit'], $_POST['password_conf']);
          !isset($_POST['active']) ? $_POST['active']=0 :'';
          !isset($_POST['enabled']) ? $_POST['enabled']=0 :'';
          !isset($_POST['password_never_expires']) ? $_POST['password_never_expires']=0 :'';
    
          if(!$this->bitauth->is_admin()){
              unset($_POST['active'],$_POST['enabled'],$_POST['password_never_expires'],$_POST['groups[]']);
          }
          //upload picture
          if($_FILES['picture']['tmp_name'])
          {
            //check if any picture is selected to upload
            $path='uploads/hospital/staff/'.$user_id.'/';
            $config['upload_path']='./'.$path;
            $config['file_name']=$user_id.'_profile_picture';
            $config['overwrite']=TRUE;
            $config['allowed_types']='gif|jpg|jpeg|png';
            $config['max_size']='100';
            $config['max_width'] = '300';
            $config['max_height'] = '400';
            $this->load->library('upload', $config);
            
            if ( !$this->upload->do_upload('picture'))
            {
              $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">','</div>');
            }else{
              $data['upload_data'] = $this->upload->data();
              $_POST['picture']=$path.$data['upload_data']['file_name'];
              $_user = $this->bitauth->get_user_by_id($user_id);
              if(isset($_user->picture) && !($_user->picture==$_POST['picture']))
                unlink('./'.$_user->picture); //delete picture if it is not overwritten
            }
          }
          $user=$this->input->post();
          $user['birth_date']=strtotime($user['birth_date']);
          if(!$this->bitauth->is_admin()&&isset($user['password'])&&strlen($user['password']))
          {
              $tmp = $this->bitauth->get_user_by_id($user_id);
              if(isset($user['old_password'])&&$this->bitauth->check_pass($user['old_password'],$tmp->password))
              {
                  unset($user['old_password']);
                  $this->bitauth->update_user($user_id, $user);
              }
          }  else {
              if(isset($user['old_password'])) unset($user['old_password']);
              $this->bitauth->update_user($user_id, $user);
          }
          
        }else{
          $data['error'] = validation_errors();
        }
      }

      $groups = array();
      foreach($this->bitauth->get_groups() as $_group)
        $groups[$_group->group_id] = $_group->name;

      $data['title'] = 'Edit User';
      $data['bitauth']=$this->bitauth;
      $data['groups']=$groups;
      $data['user']=$this->bitauth->get_user_by_id($user_id);
      $data['expiryproduct'] = $this->notification->getExpiryProduct();
      $data['duedate'] = $this->notification->getDueDate();
      $data['oftproduct'] = $this->notification->getOftProduct();
      $data['totalnoti'] = $this->notification->getTotalNoti();

      $path='account/edit_user';
      if(isset($_GET['ajax'])&&$_GET['ajax']==true)
      {
          $this->load->view($path, $data);
      }else{
          $data['contents']=array($path);
          $this->load->view('header', $data);
          $this->load->view('index', $data);
          $this->load->view('footer', $data);
      }
    }

    /**
     * account::activate()
     *
     */
     public function activate($activation_code)
     {
      if($this->bitauth->activate($activation_code))
      {
        echo "User successfully activated";
        return;
      }
      echo "Activation failed!";
     }

    /**
     * account::deactivate()
     *
     */
    public function deactivate($user_id)
    {
      if (!$this->bitauth->is_admin()) {
        echo 'no';
        //$this->load->view('account/_no_access');
        return;
      }
      if($this->bitauth->deactivate($user_id))
      {
        echo 'true';
        //$this->load->view('account/activation_successful');
        return;
      }
      echo 'false';
      //$this->load->view('account/activation_failed');
    }

     /**
     * account::logout()
     *
     */
    public function logout()
    {
      $this->bitauth->logout();
      redirect('home');
    }

  }