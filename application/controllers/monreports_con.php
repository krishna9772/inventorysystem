<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Monreports_con extends CI_Controller
{

public function __construct()
{

	parent::__construct();
	$this->load->model('monreports');
  $this->load->model('notification');
}

public function Index()
{

	   if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }

    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['exnoti'] = $this->notification->getExNoti();
    $data['ofsnoti'] = $this->notification->getOfsNoti();
    $data['ornoti']  = $this->notification->getOrdernoti();
    $data['category_list'] = $this->_fill_category_list();

    $data['title'] = 'Monthly reports';

    $path = 'reports/monreports';
    $data['contents'] = array($path);

    $this->load->view('reports/monreports',$data);
    $this->load->view('footer',$data);
}

public function getSoldProduct($category_id=0,$date=0)
{

     $this->load->model('monreports');

    $this->load->model('category');

     $report = $this->monreports->getSoldProduct($category_id,$date);

     $category_name = $this->category->load($category_id);
  
     $output = '
     <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                      <th>Sr.No</th>
                      <th>Products</th>
                      <th>Opening Balance</th>
                      <th>Offside Sales</th>
                      <th>Total</th>
                      <th>This Month Sales</th>
                      <th>Closing</th>
                      <th>Remark For Expiry</th>
                    </tr>';
                         

                    $i=1;

                    foreach ($report as $row){

                        $opening_quantity = $row['opening_quantity'];
                        $added_quantity   = $row['added_quantity'];
                        $closing_quantity = $row['closing_quantity'];
                        $total = $opening_quantity + $added_quantity;
                        $usedquantity = ($opening_quantity+$added_quantity)-$closing_quantity;

                       $output .=' <tr>
                            <td>'.$i++.'</td>
                            <td>'.$row['product_name'].'</td>
                            <td>'. $row['opening_quantity'].'</td>
                            <td>'.$row['added_quantity'].'</td>
                            <td>'.$total.'</td>
                            <td>'.$usedquantity.'</td>                          
                            <td>'. $row['closing_quantity'].'</td>
                            <td>'.$row['product_description'].'</td>
                        </tr>';

                    }

                $output .='</table>

                 <div id="report">

                <a class="btn btn-info"'.anchor('monreports_con/email_report/'.$category_id.'/'.$date, 'Send With Email',array('class'=>'hidden-print','title'=>'Email Report')).'</a>

                 </div>


             </div>
     <script src="'.base_url().'assets/js/jquery-2.1.0.min.js"></script>
     <script src="'.base_url().'assets/js/bootstrap.min.js"></script>
     <script src="'.base_url().'assets/js/jquery.cookie.js"></script>

            <script type="text/javascript">

            $(document).ready(function(){ 

         $("#report").on("click","a",function(e){
            if($(this).closest("a").attr("title") == "Email Report"){
               e.preventDefault();
               $.get($(this).attr("href"),"",function(data){
                   $("#tmpDiv").html(data);
               });  
            }
        });

    });
               
            </script>';

        echo $output;

}

public function getMultiReports($date=0)
{

    $this->load->model('monreports');

    $this->load->model('category');

    $category_id  = $this->input->post('category_id');

    if($category_id){

    $report = $this->monreports->getMultiReports($category_id,$date);
    $date = $date;

     $output = '';

     foreach ($report as $value) {

     $output = '
     <!DOCTYPE html>
        <html>
           <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Monthly Multi Reports</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" />
        </head>
        <body>
         <div class="container" id="data-table">
         <div class="row">
         <div class="col-xs-6">
           <h2 class="label label-warning">'.$date.'</h2>
          </div>
          <div class="col-xs-12">

            <table class="table table-bordered">
                <tr>
                  <th>Category</th>
                  <th>Sr.No</th>
                  <th>Products</th>
                  <th>Opening Balance</th>
                  <th>Offside Sales</th>
                  <th>Total</th> 
                  <th>This Month Sales</th>
                  <th>Closing</th>
                  <th>Remark For Expiry</th>
                </tr>';

                    $i=1;

                    foreach ($report as $row){

                        $opening_quantity = $row['opening_quantity'];
                        $added_quantity   = $row['added_quantity'];
                        $closing_quantity = $row['closing_quantity'];
                        $total = $opening_quantity + $added_quantity;
                        $usedquantity = ($opening_quantity+$added_quantity)-$closing_quantity;
                        // $category_name = $this->monreports->categoryName($row['category_id']);
                        $categories = array_unique(array_map(function($val){
                            return $val['category_id'];
                        }, $report));

                        foreach ($categories as $cat) {
                              $category_name = $this->monreports->categoryName($cat);
                        }
                       $output .='
                        <tr>
                            <td>'.$category_name.'</td>
                            <td>'.$i++.'</td>
                            <td>'.$row['product_name'].'</td>
                            <td>'.$row['opening_quantity'].'</td>
                            <td>'.$row['added_quantity'].'</td>
                            <td>'.$total.'</td>
                            <td>'.$usedquantity.'</td>                          
                            <td>'.$row['closing_quantity'].'</td>
                            <td>'.$row['product_description'].'</td>
                        </tr>';

                    }

                $output .='</table></div></body></html>

                 <div id="report">

                <a class="btn btn-info"'.anchor('monreports_con/email_report/'.$value['category_id'].'/'.$date, 'Send With Email',array('class'=>'hidden-print','title'=>'Email Report')).'</a>

                 </div>


             </div>
           <script src="'.base_url().'assets/js/jquery-2.1.0.min.js"></script>
           <script src="'.base_url().'assets/js/bootstrap.min.js"></script>
           <script src="'.base_url().'assets/js/jquery.cookie.js"></script>

            <script type="text/javascript">

            $(document).ready(function(){ 

         $("#report").on("click","a",function(e){
            if($(this).closest("a").attr("title") == "Email Report"){
               e.preventDefault();
               $.get($(this).attr("href"),"",function(data){
                   $("#tmpDiv").html(data);
               });  
            }
        });

    });
               
            </script>';
    }

        echo $output;

    }else{

    $data['title'] = 'Monthly-Multiple reports';
    $data['expiryproduct'] = $this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['exnoti'] = $this->notification->getExNoti();
    $data['ofsnoti'] = $this->notification->getOfsNoti();
    $data['ornoti']  = $this->notification->getOrdernoti();

    $path = 'reports/multireports';
    $data['contents'] = array($path);
    $data['category_list'] = $this->_fill_category_list();

    $this->load->view('reports/multireports',$data);
    $this->load->view('footer',$data);

  }

  
}

public function reportInvoice($category_id='',$date=0)
{
   
    if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }


     $this->load->model('monreports');

     $this->load->model('category');


     $report = $this->monreports->getSoldProduct($category_id,$date);

     $this->category->load($category_id);

     $email = $this->input->post('email');

     $output = '';


   if($category_id !=0 && $date !=0){
      $output .= '
      <!DOCTYPE html>
      <html>
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="'.base_url('assets/css/bootstrap.min.css').'">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="'.base_url('assets/font-awesome/css/font-awesome.min.css').'">
        <link rel="stylesheet" href="'.base_url('assets/admin_lte/css/AdminLTE.min.css').'">
           <style>
          th{

            padding:10px;   

          }
          .first-col{

            padding-right:80px;
          }
          .second-col{
            padding-right: 40px;
          }

          body{
            background: grey;
            color: #fff;
          }

        </style>  

      </head>
      <body>
  <div class="container">
  <div class="row">
       <div class="col-xs-4">
        <table>
           <tr>
           <th class="first-col">Customer </th>
           <td>Ma Tue Tue</td>
           </tr>
           <tr>
           <th class="first-col">Location</th>
               <td>Mogok</td>
           </tr>
        </table>
       </div>
        <table class="pull-right">
           <tr>
           <th class="second-col">Principle</th>
           <td>'.$this->category->category_name.'</td>
           </tr>
           <tr>  
              <th class="second-col">Month</th>
               <td><span id="date">'.$date.'</span></td>
           </tr>
        </table> 
       </div><br><br>
       <div class="row" id="reports">
              <div class="col-xs-12">
                <table class="table table-bordered">
                    <tr>
                      <th>Sr.No</th>
                      <th>Products</th>
                      <th>Opening Balance</th>
                      <th>This Month Sales</th>
                      <th>Offside Sales</th>
                      <th>Closing</th>
                      <th>Remark For Expiry</th>
                    </tr>';
                         

                    $i=1;

                    foreach ($report as $row){

                        $opening_quantity = $row['opening_quantity'];
                        $added_quantity   = $row['added_quantity'];
                        $closing_quantity = $row['closing_quantity'];

                        $value = ($opening_quantity+$added_quantity)-$closing_quantity;

                       $output .=' <tr>
                            <td>'.$i++.'</td>
                            <td>'.$row['product_name'].'</td>
                            <td>'.$row['opening_quantity'].'</td>
                            <td>'.$value.'</td>                          
                            <td>'.$row['added_quantity'].'</td>
                            <td>'. $row['closing_quantity'].'</td>
                            <td>'.$row['product_description'].'</td>
                            </tr>';

                        }

                       '</table>

                          </div>

                        </div>
                       </div>
                      </body>';
          }
          echo $output;
}

public function email_report($category_id=0,$date=0)
{

   if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }

     $this->load->model('monreports');

     $email = $this->input->post('email');

     if($email)
     {

    $this->load->model('category');

    $this->category->load($category_id);

    $this->load->library('pdf');
    
    $this->pdf->loadHtml($this->reportInvoice($category_id,$date));
    
    $this->pdf->render();

    $output = $this->pdf->output();
    $file_name ='Monthly_Reports.pdf';
    file_put_contents($file_name,$output);

    // Email configuration
        $config = Array(
            'protocol' => 'sendmail',
            'smtp_host' => 'localhost',
            'smtp_port' => 465,
            'smtp_user' => 'matuetue.mgk@gmail.com', // change it to yours
            'smtp_pass' => '123456mtt', // change it to yours
            'mailtype' => 'html',
            'starttls'  => true,
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
        );
        
        $this->load->library('email', $config);
        $this->email->from('matuetue.mgk@gmail.com', "matutu1.hypms.com");
        $this->email->to($email);
        $this->email->subject("Monthly Reports");
        $this->email->message("Monthly Reports for <b>".$date."</b> associated with principle company <b>".$this->category->category_name."</b>");
        $this->email->attach($file_name);

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Successfully Sent');
            redirect('monreports_con/Index/'.$date, 'refresh');

        }else{

            $this->session->set_flashdata('errors', 'Error occurred!!');
            // redirect('order_con/fetch_Order/', 'refresh');

            echo $this->email->print_debugger();
        }
     }

     $data['category_id'] = $this->uri->segment(3);
     $data['date']        = $this->uri->segment(4);

     $this->load->view('reports/mail',$data);
}


public function _fill_category_list()
{
   $this->load->model('category');
     $category = $this->category->get();
     $category_list = array();
     foreach($category as $cat)
     {

      $category_list[$cat->category_id] = html_escape($cat->category_name);

     }

     return $category_list;
}

// public function cronUpdate()
// {
//       if(!$this->bitauth->logged_in())
//       {

//          $this->session->set_userdata('redir',current_url());
//          redirect('account/login');
//       }

//       $this->monreports->cronUpdate();

//     $path = "reports/list";

//     $data['contents'] = array($path);

//     $this->load->view('header',$data);
//     $this->load->view('index',$data);
//     $this->load->view('footer',$data);

// }

}