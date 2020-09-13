<legend><?php echo "-" .@$title;?></legend>

      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>


       <div class='table-responsive'><table id='order_data' class='table table-bordered table-striped' ><thead><tr>
           <th>Bill No</th>
           <th>Name</th>
           <th>Address</th>
           <th>Date</th>
           <th>Due Date</th>
           <th>Amount</th>
           <th>Status</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody></table></div>

        <!-- '<tr id="order" title="'.$row['customer_name'].'">'.
          '<td>'.html_escape($row['bill_no']).'</td>'.
          '<td>'.html_escape($row['customer_name']).'</td>'.
          '<td>'.html_escape($row['customer_address']).'</td>'.
          '<td>'.html_escape(date('Y-m-d', $row['date_time'])).'</td>'.
          '<td>'.html_escape(date('Y-m-d', $row['net_due_date'])).'</td>'.
          '<td>'.number_format($row['net_amount'],2).'</td>'.
          '<td id="order_id" data-number="'.$row['id'].'" data-status="'.$row['paid_status'].'">'.$paid_status.'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>'; -->



<?php

echo '<a class="btn btn-info"'.anchor('order_con/add_Order', 'Add Order',array('class'=>'hidden-print')).'</a>';
?>
<script type="text/javascript">

  $(document).ready(function(){ 

        var table = $('#order_data').DataTable({
          'processing': true,
          'ajax': '<?php echo base_url()?>index.php/order_con/fetch_Data',
          'order': []

        });


        $("#order_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete order'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });

        $("[id^=order]").on('click', '#order_id',function(e){
            var order = $(this);
            var order_id = order.data('number');
            var status   = order.data('status') ^ 1;
            var base_url = "<?php echo base_url() ?>index.php/order_con/change_order_status";

            $.ajax({
                   url: base_url,
                   method: 'post',
                   data: {order_id:order_id,status:status,csrf_test_name: $.cookie('csrf_cookie_name')},
                   dataType: 'json',
                   success: function(response) {
                            $("#order_data").DataTable().ajax.reload(null, false);                       
                   }
                  
            })
        })

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

