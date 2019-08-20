<legend><?php echo "-" .@$title;?></legend>

      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>

<?php

if($order)
{

   $i=0;

echo  "<div class='table-responsive'><table id='order_data' class='table table-bordered table-striped' ><thead><tr>
           <th>Bill No</th>
           <th>Name</th>
           <th>Address</th>
           <th>Date</th>
           <th>Due Date</th>
           <th>Amount</th>
           <th>Status</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody>";

    

       foreach($order as $row)
       {

        $actions = '';
        if($this->bitauth->is_admin())
        {

           $actions .= anchor('order_con/update_Order/'.$row['id'], '<span class="glyphicon glyphicon-edit"></span>',array('title'=>'Edit order'));
          $actions .= anchor('order_con/delete_Order/'.$row['id'], '<span class="glyphicon glyphicon-remove" class="delete"></span>',array('title'=>'Delete order'));
          $actions .= anchor('order_con/print_Order/'.$row['id'], '<span class="glyphicon glyphicon-print" class="print"><span>',array('title'=>'Print order'));
          $actions .= anchor('order_con/email_Order/'.$row['id'], '<span class="glyphicon glyphicon-paperclip" class="print"><span>',array('title'=>'Email order'));
      
        }

        if($row['paid_status'] == 1) {
        $paid_status = '<span class="label label-success">Paid</span>'; 
      }
      else {
        $paid_status = '<span class="label label-warning">Not Paid</span>';
      }


     echo '<tr id="order'.$row['id'].'" title="'.$row['customer_name'].'">'.
          '<td>'.html_escape($row['bill_no']).'</td>'.
          '<td>'.html_escape($row['customer_name']).'</td>'.
          '<td>'.html_escape($row['customer_address']).'</td>'.
          '<td>'.html_escape(date('d-m-Y', $row['date_time'])).'</td>'.
          '<td>'.html_escape(date('d-m-Y', $row['net_due_date'])).'</td>'.
          '<td>'.html_escape($row['net_amount']).'</td>'.
          '<td>'.$paid_status.'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>';

   
}
  $i++;

     echo '</tbody></table></div>';

?>

<?php
}
echo '<a class="btn btn-info"'.anchor('order_con/add_Order', 'Add Order',array('class'=>'hidden-print')).'</a>';
?>
<script type="text/javascript">

  $(document).ready(function(){ 

        $("#order_data").dataTable();

        $("#order_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete order'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });

         $("#order_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Email order'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });

    });
  
</script>

