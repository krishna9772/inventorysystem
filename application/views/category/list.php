<legend><?php echo "-" .@$title;?></legend>

<?php

if($category)
{

   $i=0;

echo  "<div class='table-responsive'><table id='cat_data' class='table table-bordered table-striped' ><thead><tr>
           <th>ID</th>
           <th>Name</th>
           <th>Status</th>
           <th>Description</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody>";

    

       foreach($category as $cat)
       {

       	$actions = '';
       	if($this->bitauth->is_admin())
       	{

       		 $actions .= anchor('category_con/update_Category/'.$cat->category_id, '<span class="glyphicon glyphicon-edit"></span>',array('title'=>'Edit Category'));
          $actions .= anchor('category_con/delete_Category/'.$cat->category_id, '<span class="glyphicon glyphicon-remove" class="delete"></span>',array('title'=>'Delete Category'));

       	}

         if($cat->category_status == 1) {
        $category_status = '<span class="label label-success">Active</span>'; 
      }
      else {
        $category_status = '<span class="label label-warning">Inactive</span>';
      }

   	 echo '<tr id="category'.$cat->category_id.'" title="'.$cat->category_description.'">'.
          '<td>'.html_escape($cat->category_id).'</td>'.
          '<td>'.html_escape($cat->category_name).'</td>'.
          '<td>'.$category_status.'</td>'.
          '<td>'.html_escape(character_limiter($cat->category_description, 50,'...')).'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>';

   
}
  $i++;

     echo '</tbody></table></div>';

?>

<?php
}
echo '<a class="btn btn-info"'.anchor('category_con/add_Category', 'Add Company',array('class'=>'hidden-print')).'</a>';
?>
<script type="text/javascript">

  $(document).ready(function(){ 

        $("#cat_data").dataTable();

        $("#cat_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete Category'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });
    });
	
</script>

