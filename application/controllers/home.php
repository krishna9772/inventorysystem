<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


  /**
   * this is the index of home page
   * this should load the main panel for user
   */
  
class Home extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
	    
	    $this->load->model('home_con');
	    $this->load->model('notification');
	}


	public function index(){

		$data['title'] = 'Inventory_demo';

		$data['contents'] = array('content/card');

		$data['total_users'] = $this->home_con->count_total_user();
		$data['total_products'] = $this->home_con->count_total_product();
		$data['total_categorys'] = $this->home_con->count_total_category();
		$data['total_brands']   = $this->home_con->count_total_brand();
		$data['total_order_value'] = $this->home_con->count_total_order_value();
	    $data['total_paid_value'] = $this->home_con->count_total_paid_value();
	    $data['total_unpaid_value'] = $this->home_con->count_total_unpaid_value();
	    $data['expiryproduct'] = $this->notification->getExpiryProduct();
	    $data['oftproduct'] = $this->notification->getOftProduct();
	    $data['duedate'] = $this->notification->getDueDate();
	    $data['totalnoti'] = $this->notification->getTotalNoti();


		$this->load->view("header",$data);
		$this->load->view("index",$data);		
		$this->load->view("footer",$data);
	}
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */