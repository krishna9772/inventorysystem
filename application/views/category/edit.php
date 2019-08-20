<div class="row">
<?php if(!empty($category->category_id)){ ?>
  <div class="col col-md-8 well well-sm">
    <?php echo form_open('category_con/update_Category/'.$category->category_id,array("id"=>"newcategoryForm", "role"=>"form",)); ?>
      <fieldset>
        <legend>- Company Information:</legend>
        <div>
          <?php echo ( !empty($error) ? $error : '' ); ?>
                 <div class="form-group">
                    <div class="col-md-6">
                      <input type="text" name="category_name" id="category_name" value="<?php echo set_value('category_name', $category->category_name);?>" class='form-control' placeholder='Category' title='Category Name' required autofocus autocomplete />
                    </div>
                    </div>

                   <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="category_status" name="category_status" required>

                        <?php

                        if($category->category_status == 1)
                        {

                      echo '<option value="" disabled selected>--Select--</option>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>';

                        }else{

                      echo '<option value="" disabled selected>--Select--</option>
                        <option value="1">Active</option>
                        <option value="0" selected>Inactive</option>';

                        }

                        ?>
                       
                      </select>
                    </div>
                  </div>

                    <div class="clearfix"></div>
                  
                  <div class="form-group">
                    <div class="col-md-12">
                      <textarea  name="category_description" id="category_description" value="<?php echo set_value('category_description', $category->category_description);?>" class='form-control' placeholder='Description' title='Description' autofocus row="5" ><?php echo set_value('category_description', $category->category_description);?></textarea></div>
                    </div>
                  </div>

      </fieldset>
      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('category_con/fetch_Category','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
    <?php echo form_close(); ?>
  </div>
<?php
}else{
  echo '<div class="alert alert-danger text-center"><h1>category Not Found</h1></div><div class="pull-right" title="Go to categorys">'.anchor('category_con/fetch_Category', '<span class="glyphicon glyphicon-arrow-left"></span>').'</div>';
}
?>
</div>
<script>
  $(document).ready(function(){

  });
</script>