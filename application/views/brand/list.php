<legend><?php echo "-" .@$title;?></legend>

<?php 

  if($brand)
  {

  	$i = 0;

  echo  "<div class='table-responsive'><table id='bran_data' class='table table-bordered table-striped' ><thead><tr>
           <th>ID</th>
           <th>Name</th>
           <th>Principle Company</th>
           <th>Status</th>
           <th>Description</th>
           <th class='hidden_print'>Actions</th>
       </tr></thead><tbody>";

       foreach($brand as $bran)
       {

       	$actions = '';
       	if($this->bitauth->is_admin())
       	{

       		 $actions .= anchor('brand_con/update_brand/'.$bran['brand_id']."/".$bran['category_name'], '<span class="glyphicon glyphicon-edit"></span>',array('title'=>'Edit brand'));
          $actions .= anchor('brand_con/delete_brand/'.$bran['brand_id']."/", '<span class="glyphicon glyphicon-remove" class="delete"></span>',array('title'=>'Delete brand'));

       	}

       	//For Inner Joining Category Id to Category Name

    if($bran['brand_status'] == 1) {
        $brand_status = '<span class="label label-success">Active</span>'; 
      }
      else {
        $brand_status = '<span class="label label-warning">Inactive</span>';
      } 
      

   	 echo '<tr id="brand'.$bran['brand_id'].'" title="'.$bran['brand_description'].'">'.
          '<td>'.html_escape($bran['brand_id']).'</td>'.
          '<td>'.html_escape($bran['brand_name']).'</td>'.
          '<td>'.html_escape($bran['category_name']).'</td>'.
          '<td>'.$brand_status.'</td>'.
          '<td>'.html_escape(character_limiter($bran['brand_description'], 50,'...')).'</td>'.
          '<td class="hidden-print">'.$actions.'</td>'.
        '</tr>';

   
}
  $i++;

     echo '</tbody></table></div>';

?>

<?php
}
echo '<a class="btn btn-info"'.anchor('brand_con/add_brand', 'Add Company',array('class'=>'hidden-print')).'</a>';
?>

<script type="text/javascript">

  $(document).ready(function(){ 

        $("#bran_data").dataTable();

        $("#bran_data").on('click', "a" ,function(e){
            if($(this).closest('a').attr('title') == 'Delete brand'){
               e.preventDefault();
               $.get($(this).attr('href'),'',function(data){
                   $('#tmpDiv').html(data);
               });  
            }
        });
    });
	
</script>
