<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_con extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reports');
		$this->load->model('notification');

	}

	/* 
    * It redirects to the report page
    * and based on the year, all the orders data are fetch from the database.
    */
	public function index()
	{
		   if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }
		
		$today_year = date('Y');

		if($this->input->post('select_year')) {
			$today_year = $this->input->post('select_year');
		}

		$parking_data = $this->reports->getOrderData($today_year);
		$data['report_years'] = $this->reports->getOrderYear();


		$final_parking_data = array();
		foreach ($parking_data as $k => $v) {
			
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['net_amount'];						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}
		
		$data['selected_year'] = $today_year;
		$data['company_currency'] = "Kyat";
		$data['results'] = $final_parking_data;

		$path = 'reports/list';
		if(isset($_GET['ajax']) && $_GET['ajax'] == TRUE){

			$this->load->view($path,$data);
		}else{

			$data['title'] = 'Report';
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['totalnoti'] = $this->notification->getTotalNoti();

			$data['contents'] = array($path);
			$this->load->view('header',$data);
			$this->load->view('index',$data);
			$this->load->view('footer',$data);
		}

	}
}	