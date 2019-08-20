<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Order_con extends CI_controller 
{

	 /**
     * Order::__construct()
     *
     */
    public function __construct()
    {
      parent::__construct();

      $this->load->model("product");
      $this->load->model("order");
      $this->load->model("notification");

      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

 /**
 *fetch_order
 *
 */

  public function fetch_Order()
  {

    if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }

    $this->load->model('order');

    $data['title'] = 'Order List';

    $data['order'] = $this->order->getOrdersData();

    $data['expiryproduct']=$this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['totalnoti'] = $this->notification->getTotalNoti();



    $path = 'order/list';

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


  /**
  *add_order
  *
  */

  public function add_Order()
  {
    
    if(!$this->bitauth->logged_in())
    {
    	$this->session->set_userdata('redir', current_url());
    	redirect('account/login');
    }

    $this->form_validation->set_rules('product[]', 'Product name' , 'trim|required');

    if ($this->form_validation->run() == TRUE) {

      $order_id = $this->order->create();

        if($order_id) {
            $this->session->set_flashdata('success', 'Successfully created');
            redirect('order_con/add_Order/', 'refresh');
          }
          else {
            $this->session->set_flashdata('errors', 'Error occurred!!');
            redirect('order_con/add_Order/', 'refresh');
          }

      }else{


      }


    $data['product_list'] = $this->product->getActiveProductData();
    $data['customer_list'] = $this->order->fill_customer_list();

    $data['expiryproduct']=$this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['totalnoti'] = $this->notification->getTotalNoti();



    $data['title'] = 'Order';
    $path = 'order/add';
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

  public function update_Order($id)
  {

     if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

    $this->form_validation->set_rules('product[]','Product Name','trim|required');

      if ($this->form_validation->run() == TRUE) {            
          
          $update = $this->order->update($id);
          
          if($update == true) {
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect('order_con/fetch_Order/', 'refresh');
          }
          else {
            $this->session->set_flashdata('errors', 'Error occurred!!');
            redirect('order_con/update_Order/'.$id, 'refresh');
          }
        }


    $data['title'] = 'Order';
    $path = 'order/edit';

        $result = array();
        $orders_data = $this->order->getOrdersData($id);

        $result['order'] = $orders_data;
        $orders_item = $this->order->getOrdersItemData($orders_data['id']);

        foreach($orders_item as $k => $v)
        {

          $result['order_item'][] = $v;
        }

        $data['order_data'] = $result;

        $data['products'] = $this->product->getActiveProductData();
        $data['customer_list'] = $this->order->fill_customer_list();

        $data['expiryproduct']=$this->notification->getExpiryProduct();
        $data['oftproduct'] = $this->notification->getOftProduct();
        $data['duedate'] = $this->notification->getDueDate();
        $data['totalnoti'] = $this->notification->getTotalNoti();




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
  
  public function delete_Order($id=0)
  {
      
        if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }

      $this->order->load($id);
     
      if($this->input->post()){

       $this->form_validation->set_rules(array(
        array( 'field' => 'id', 'label' => 'ID', 'rules' => 'required|trim|has_no_schar', ),
        array( 'field' => 'del', 'label' => '', 'rules' => 'required|trim|has_no_schar', ),
      ));

    if($this->form_validation->run() == TRUE && $this->input->post('id') == $id)
   {

        $this->db->where('id', $id);
        $delete = $this->db->delete('orders');

        $this->db->where('order_id', $id);
        $delete_item = $this->db->delete('orders_item');
        
          echo 'ok';

          return;


  }else{

        echo 'nok';

        return;


  }

}
      


    $data['order'] = $this->order;

    $this->load->view('order/delete',$data);


  }

  public function print_Order($id)
  {

     if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }

        // forward to index page
    if($id){

      $order_data = $this->order->getOrdersData($id);
      $orders_items = $this->order->getOrdersItemData($id);
      $num_orders_items = $this->order->countOrderItem($id);
      $order_date = $order_data['date_time'];
      $paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

      $html = '<!-- Main content -->
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

          padding-right:26px;       
        }
        .data-div{
                  
            height:600px;
        }

        b{

           padding-right:50px;
        }
        p{
           margin: 0 38px 13px;
        }
        .line{

          border :1px solid black;
        }

      </style>

      </head>
      <body onload="window.print()">

      <div class="container">
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                Invoice
                <small class="pull-right">Customer Copy</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">
              
              <b>Ma Tue Tue(1)<br>
              <b>No.146, Myo Ma Quarters, Mogoke City<br>
              <b>Tel:08620473<br />
            </div>
            <!-- /.col -->
          </div><br><br>
          <!-- /.row -->

           <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">

             <table>
              <tr>
              <th>Customer Name</th>
              <td>'.$order_data['customer_name'].'</td>
              </tr>
              <tr>
              <th>Address</th>
              <td>'.$order_data['customer_address'].'</td>
              </tr>
              
            </table>

            </div>

            
              <table class="pull-right">
                <tr>
                  <th>No. Invoice</th>
                 <td>'.$order_data['bill_no'].'</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>'.date('d-m-Y',$order_data['date_time']).'</td>
                </tr>
                <tr>
                 <th>Net Due Date</th>
                 <td>'.date('d-m-Y',$order_data['net_due_date']).'</td>
                </tr>
              </table>

            <!-- /.col -->
          </div><br> 
          <!-- /.row -->
 
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 data-div">
              <table class="table table-bordered">
                <thead>
                <tr style="background-color:grey;">
                  <th>Product name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>FOC</th>
                  <th>Disc%</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody class="data-body">'; 

                foreach ($orders_items as $k => $v) {

                  $product_data = $this->order->fetchAllProduct($v['product_id']); 
                  
                  $html .= '<tr>
                    <td>'.$product_data['product_name'].'</td>
                    <td>'.$v['qty'].'</td>
                    <td>'.$v['rate'].'</td>
                    <td>'.$v['foc'].'</td>
                    <td>'.$v['discount'].'%</td>
                    <td>'.$v['amount'].'</td>

                  </tr>';
                }
                
                $html .= '</tbody>
              </table>
            </div>
          <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
           <div class="col-xs-4">
              <b>Total Items:</b>'.$num_orders_items.'
           </div>
           <div class="pull-right">
            <p class="sub-amount"><b>Sale Amount (Including Commercial Tax):</b>'.$order_data['net_amount'].'</p>
           </div>
          </div><br>
          <div class="row">
           <div class="col-xs-6">

             <b>Product Received</b><br><br><br>
             <hr class="line">
             <b>Signature of Customer Rep/Date</b>

           </div>
            <div class="col-xs-6">

                  <b>Paid</b><br><br><br>
                  <hr class="line">
                  <b>Signature of Customer Rep</b>


               
           </div>
          </div>
        </section>
        <!-- /.content -->
      </div>

        <div class="container">
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                Invoice
                <small class="pull-right">Owner Copy</small>
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">
              
              <b>Ma Tue Tue (1)<br>
              <b>NO.146 Myo Ma Quarter,Mogoke City<br>
              <b>Tel:086-20473<br />
            </div>
            <!-- /.col -->
          </div><br><br>
          <!-- /.row -->

           <div class="row invoice-info">
            
            <div class="col-sm-4 invoice-col">

             <table>
              <tr>
              <th>Customer Name</th>
              <td>'.$order_data['customer_name'].'</td>
              </tr>
              <tr>
              <th>Address</th>
              <td>'.$order_data['customer_address'].'</td>
              </tr>
              
            </table>

            </div>

            
              <table class="pull-right">
                <tr>
                  <th>No. Invoice</th>
                 <td>'.$order_data['bill_no'].'</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>'.date('d-m-Y',$order_data['date_time']).'</td>
                </tr>
                <tr>
                 <th>Net Due Date</th>
                 <td>'.date('d-m-Y',$order_data['net_due_date']).'</td>
                </tr>
              </table>

            <!-- /.col -->
          </div><br> 
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 data-div">
              <table class="table table-bordered"  >
                <thead>
                <tr style="background-color:grey;">
                  <th>Product name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>FOC</th>
                  <th>Disc%</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody class="data-body">'; 

                foreach ($orders_items as $k => $v) {

                  $product_data = $this->order->fetchAllProduct($v['product_id']); 
                  
                  $html .= '<tr>
                    <td>'.$product_data['product_name'].'</td>
                    <td>'.$v['qty'].'</td>
                    <td>'.$v['rate'].'</td>
                    <td>'.$v['foc'].'</td>
                    <td>'.$v['discount'].'%</td>
                    <td>'.$v['amount'].'</td>

                  </tr>';
                }
                
                $html .= '</tbody>
              </table>
            </div>
          <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
           <div class="col-xs-4">
              <b>Total Items:</b>'.$num_orders_items.'
           </div>
           <div class="pull-right">
            <p class="sub-amount"><b>Sale Amount (Including Commercial Tax):</b>'.$order_data['net_amount'].'</p>
           </div>
          </div><br>
          <div class="row">
           <div class="col-xs-6">

             <b>Product Received</b><br><br><br>
             <hr class="line">
             <b>Signature of Customer Rep/Date</b>

           </div>
            <div class="col-xs-6">

                  <b>Paid</b><br><br><br>
                  <hr class="line">
                  <b>Signature of Customer Rep</b>


               
           </div>
          </div>
        </section>
        <!-- /.content -->
      </div>
    </body>
  </html>';

  echo $html;

     }
  }

  public function invoice($id)
  { 

     if(!$this->bitauth->logged_in())
    {
      $this->session->set_userdata('redir', current_url());
      redirect('account/login');
    }
    
    if($id){

      $order_data = $this->order->getOrdersData($id);
      $orders_items = $this->order->getOrdersItemData($id);
      $num_orders_items = $this->order->countOrderItem($id);
      $order_date = $order_data['date_time'];
      $paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

      $html = '<!DOCTYPE html>
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

          padding-right:26px;       
        }

        b{

           padding-right:50px;
        }
        p{
           margin: 0 38px 13px;
        }
        .line{

          border :1px solid black;
        }
      </style>
      </head>
      <body>
      <div class="container">
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                Invoice
              </h2>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <b>Ma Tue Tue(1)<br>
              <b>No.146, Myo Ma Quarters, Mogoke City<br>
              <b>Tel:08620473<br />
            </div>
            <!-- /.col -->
          </div><br><br>
          <!-- /.row -->

           <div class="row">
            <div class="col-xs-4">
             <table>
              <tr>
              <th>Customer Name</th>
              <td>'.$order_data['customer_name'].'</td>
              </tr>
              <tr>
              <th>Address</th>
              <td>'.$order_data['customer_address'].'</td>
              </tr>
            </table>
            </div>
            
            <div class="pull-right">
              <table>
                <tr>
                  <th>No. Invoice</th>
                 <td>'.$order_data['bill_no'].'</td>
                </tr>
                <tr>
                  <th>Date</th>
                  <td>'.date('d-m-Y',$order_data['date_time']).'</td>
                </tr>
                <tr>
                 <th>Net Due Date</th>
                 <td>'.date('d-m-Y',$order_data['net_due_date']).'</td>
                </tr>
              </table>
              </div>
            <!-- /.col -->
          </div><br> 
          <!-- /.row -->
 
          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-bordered">
                <thead>
                <tr style="background-color:grey;">
                  <th>Product name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>FOC</th>
                  <th>Disc%</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>'; 
                foreach ($orders_items as $k => $v) {
                  $product_data = $this->order->fetchAllProduct($v['product_id']); 
                  $html .= '<tr>
                    <td>'.$product_data['product_name'].'</td>
                    <td>'.$v['qty'].'</td>
                    <td>'.$v['rate'].'</td>
                    <td>'.$v['foc'].'</td>
                    <td>'.$v['discount'].'%</td>
                    <td>'.$v['amount'].'</td>

                  </tr>';
                }
                $html .= '</tbody>
              </table>
            </div>
          <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row">
           <div class="col-xs-4">
              <b>Total Items:</b>'.$num_orders_items.'
           </div>
           <div class="pull-right">
           <p class="sub-amount"><b>Sale Amount (Including Commercial Tax):</b>'.$order_data['net_amount'].'</p>
           </div>
          </div><br>
          <div class="row">
           <div class="col-xs-5">
             <b>Product Received</b><br><br><br>
             <hr class="line">
             <b>Signature of Customer Rep/Date</b>
           </div>
            <div class="col-xs-5">
                  <b>Paid</b><br><br><br>
                  <hr class="line">
                  <b>Signature of Customer Rep</b>
           </div>
          </div>
        </section>
        <!-- /.content -->
      </div>';

  }
   return $html;
}

   public function email_Order($id)
{
      if(!$this->bitauth->logged_in())
    {
    
     $this->session->set_userdata('redir',current_url());
        redirect('account/login');

    }
    
    $this->order->load($id);


    $email = $this->input->post('email');

    if($email)
    {
    
    $this->load->model('order');

    $data['title'] = 'Order List';

    $data['order'] = $this->order->getOrdersData();

    $this->load->library('pdf');
    
    $this->pdf->loadHtml($this->invoice($id), 'UTF-8');
    
    $this->pdf->render();
    
    $output = $this->pdf->output();
    $file_name = md5(rand()) . '.pdf';
    file_put_contents($file_name,$output);
    
    $order_data = $this->order->getOrdersData($id);
    
    $data['expiryproduct']=$this->notification->getExpiryProduct();
    $data['oftproduct'] = $this->notification->getOftProduct();
    $data['duedate'] = $this->notification->getDueDate();
    $data['totalnoti'] = $this->notification->getTotalNoti();
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
        $this->email->subject("Invoice");
        $this->email->message("Hello ".$order_data['customer_name']." this is your invoice receipt send from Ma Tue Tue");
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
      

       $data['order'] = $this->order;
      
       $this->load->view('order/mail',$data);



}

  public function getTableProductRow()
  {
    $products = $this->product->getActiveProductData();
    echo json_encode($products);
  }

  public function getProductValueById()
  {

    $product_id = $this->input->post('product_id');

    if($product_id) {
      $product_data = $this->order->fetchAllProduct($product_id);
      echo json_encode($product_data);

    }

  }

  public function getCustomerData()
  {

    $customer_name = $this->input->post('customer_name');

    $customer_data = $this->order->fill_customer_list($customer_name);

    $output ="";

    foreach($customer_data as $row){

      $output = $row['customer_address'];
    }

    echo $output;

  }

 }