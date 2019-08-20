 <?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Notification_con extends CI_controller 
{

	 /**
     * Notification::__construct()
     *
     */
    public function __construct()
    {
      parent::__construct();

      $this->load->model('notification');

    }

    public function getExpiryProduct()
    {

       if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }

      $data['expiryproduct'] = $this->notification->getExpiryProduct();
      $data['oftproduct'] = $this->notification->getOftProduct();
      $data['duedate'] = $this->notification->getDueDate();
      $data['totalnoti'] = $this->notification->getTotalNoti();


     $data['title'] = 'Notifications';

     $path = 'content/navbars/admin';


       if(isset($_GET['ajax'])&&$_GET['ajax']==true)
    {

       $this->load->view($path,$data);

    }else{

       $data['contents'] = array($path);
       $this->load->view('header',$data);
       $this->load->view('index',$data);
       $this->load->view('footer',$data);

     }


  }

}
