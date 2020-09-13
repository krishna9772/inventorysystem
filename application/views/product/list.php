<legend><?php echo "-" .@$title;?></legend>

<?php

if($product)
{

   $i=1;

echo  "<div class='table-responsive'><table id='pro_data' class='table table-bordered table-striped' ><thead><tr>
           <th>ID</th>
           <th>Name</th>
           <th>Prin.Com</th>
           <th>Dis.Com</th>
           <th>Expire Date</th>
           <th>Avaiable Qty</th>
           <th>Status</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody>";


       foreach($product as $pro)
       {

        $actions = '';
        if($this->bitauth->is_admin())
        {

           $actions .= anchor('product_con/update_product/'.$pro['product_id']."/".$pro['category_id']."/".$pro['brand_id']."/".$pro["product_unit"]."/", '<span class="glyphicon glyphicon-edit"></span>',array('title'=>'Edit product'));
          $actions .= anchor('product_con/delete_product/'.$pro['product_id'], '<span class="glyphicon glyphicon-remove" class="delete"></span>',array('title'=>'Delete product'));
          $actions .= anchor('product_con/check_Product/'.$pro['product_id']."/".$pro['category_name']."/".$pro['brand_name']."/",'<span class="glyphicon glyphicon-check"></span>',array('title'=>'Check Availability'));


        }

          if($pro['product_status'] == 1) {
        $product_status = '<span class="label label-success">Active</span>'; 
      }
      else {
        $product_status = '<span class="label label-warning">Inactive</span>';
      }

      $qty_status = '';

      if($pro['product_remain_quantity'] <=10 && $pro['product_remain_quantity'] !=0 ) {

        $qty_status = '<span class="label label-warning">Low !</span>';
      }else if($pro['product_remain_quantity'] <= 0) {
        $qty_status = '<span class="label label-danger">Out of stock !</span>';
      }

     echo '<tr id="product'.$pro['product_id'].'" title="'.$pro['product_description'].'">'.
          '<td>'.html_escape($i).'</td>'.
          '<td>'.html_escape($pro['product_name']).'</td>'.
          '<td>'.html_escape($pro['category_name']).'</td>'.
          '<td>'.html_escape($pro['brand_name']).'</td>'.
          '<td>'.html_escape($pro['product_ex_date']).'</td>'.
          '<td>'.html_escape($pro['product_remain_quantity']).'  '.$qty_status.'</td>'.
          '<td>'.$product_status.'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>';
  
    $i++;
   
}
 

     echo '</tbody></table></div>';

?>

<?php
}
echo '<a class="btn btn-info"'.anchor('product_con/add_product', 'Add product',array('class'=>'hidden-print')).'</a>';
?>
<script type="text/javascript">

  $(document).ready(function(){ 

        $("#pro_data").dataTable();

        $("#pro_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete product'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });

         $("#pro_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Check Availability'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });


    });
  
</script>

