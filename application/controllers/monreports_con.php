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
    $data['totalnoti'] = $this->notification->getTotalNoti();
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
                            <td>'. $row['opening_quantity'].'</td>
<td>'.$value.'</td>                          
              <td>'.$row['added_quantity'].'</td>
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


if($category_id !=0 && $date !=0){
      $output = '
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
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
  <section>
  <div class="row invoice-info">
       <div class="col-sm-4 invoice-col">
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
                            <td>'. $row['opening_quantity'].'</td>
<td>'.$value.'</td>                          
              <td>'.$row['added_quantity'].'</td>
              <td>'. $row['closing_quantity'].'</td>
                            <td>'.$row['product_description'].'</td>
                        </tr>';

                    }

               '</table>

               </div>

                </div>
      </section>
   </div>
  </body>';

              

          }

          return $output;

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
            'smtp_user' => 'aryalkrishna642@gmail.com', // change it to yours
            'smtp_pass' => 'sunainar12345', // change it to yours
            'mailtype' => 'html',
            'starttls'  => true,
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
        );
        
        $this->load->library('email', $config);
        $this->email->from('aryalkrishna642@gmail.com', "matutu1.hypms.com");
        $this->email->to($email);
        $this->email->subject("Monthly Reports");
        $this->email->message("Monthly Reports for".$date."associated with principle company".$this->category->category_name);
        $this->email->attach($file_name);

        if ($this->email->send()) {
            $this->session->set_flashdata('success', 'Successfully Sent');
            redirect('order_con/fetch_Order/', 'refresh');

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
     $category_list[''] = '';
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