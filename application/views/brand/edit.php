<div class="row">
<?php if(!empty($brand->brand_id)){ ?>

  <div class="col col-md-8 well well-sm">
    <?php echo form_open('brand_con/update_brand/'.$brand->brand_id,array("id"=>"newbrandForm", "role"=>"form",)); ?>
      <fieldset>
        <legend>- Company Information:</legend>
        <div>
          <?php echo ( !empty($error) ? $error : '' ); ?>
                 <div class="form-group">
                    <div class="col-md-6">
                      <input type="text" name="brand_name" id="brand_name" value="<?php echo set_value('brand_name', $brand->brand_name);?>" class='form-control' placeholder='brand' title='brand Name' required autofocus autocomplete />
                    </div>
                    </div>


                   <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="brand_status" name="brand_status" required>

                        <?php

                        if($brand->brand_status == 1)
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

              <div class="form-group">
                 <div class="col-md-6">
                   <select name="category_id" id="selectize_id" class="form-control select-group">
                     <option value="<?php echo $brand->category_id;?>"><?php echo $category_name?></option>

                     <?php foreach($category_list as $cat_name):?>
     
                <option value="<?php echo $cat_name->category_id ?>"><?php echo $cat_name->category_name ?>
               </option>
               <?php endforeach; ?>

                </select>
              </div>
             </div>
                 </fieldset>
                   <fieldset>
             <legend>-Description</legend>
                  <div class="form-group">
                    <div class="col-md-12">
                      <textarea  name="brand_description" id="brand_description" value="<?php echo set_value('brand_description', $brand->brand_description);?>" class='form-control' placeholder='Description' title='Description' autofocus row="5" ><?php echo set_value('brand_description', $brand->brand_description);?></textarea></div>
                    </div>
                   </fieldset>


      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('brand_con/fetch_brand','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
    <?php echo form_close(); ?>
  </div>
<?php
}else{
  echo '<div class="alert alert-danger text-center"><h1>brand Not Found</h1></div><div class="pull-right" title="Go to brands">'.anchor('brand_con/fetch_brand', '<span class="glyphicon glyphicon-arrow-left"></span>').'</div>';
}
?>
</div>
<script>
  $(document).ready(function(){

  });
</script>