<legend><?php echo "-" .@$title;?></legend>

<?php

if($customer)
{

   $i=0;

echo  "<div class='table-responsive'><table id='cat_data' class='table table-bordered table-striped' ><thead><tr>
           <th>ID</th>
           <th>Name</th>
           <th>Address</th>
           <th>Phone No</th>
           <th>Status</th>
           <th>Description</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody>";

    

       foreach($customer as $cus)
       {

       	$actions = '';
       	if($this->bitauth->is_admin())
       	{

       		 $actions .= anchor('customer_con/update_customer/'.$cus->customer_id, '<span class="glyphicon glyphicon-edit"></span>',array('title'=>'Edit customer'));
          $actions .= anchor('customer_con/delete_customer/'.$cus->customer_id, '<span class="glyphicon glyphicon-remove" class="delete"></span>',array('title'=>'Delete customer'));

       	}

         if($cus->customer_status == 1) {
        $customer_status = '<span class="label label-success">Active</span>'; 
      }
      else {
        $customer_status = '<span class="label label-warning">Inactive</span>';
      }

   	 echo '<tr id="customer'.$cus->customer_id.'" title="'.$cus->customer_description.'">'.
          '<td>'.html_escape($cus->customer_id).'</td>'.
          '<td>'.html_escape($cus->customer_name).'</td>'.
          '<td>'.html_escape($cus->customer_address).'</td>'.
          '<td>'.html_escape($cus->customer_number).'</td>'.
          '<td>'.$customer_status.'</td>'.
          '<td>'.html_escape(character_limiter($cus->customer_description, 50,'...')).'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>';

   
}
  $i++;

     echo '</tbody></table></div>';

?>

<?php
}
echo '<a class="btn btn-info"'.anchor('customer_con/add_Customer', 'Add customer',array('class'=>'hidden-print')).'</a>';
?>
<script type="text/javascript">

  $(document).ready(function(){ 

        $("#cat_data").dataTable();

        $("#cat_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete customer'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });
    });
	
</script>

