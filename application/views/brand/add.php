<div class="row">
  
   <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>

  <div class="col col-md-8 well well-sm">
  	  <?php echo form_open('brand_con/add_Brand',array("id"=>"newCatForm", "role"=>"form",)); ?>
  	   <fieldset>
  	   	 <legend>- Distributor Company</legend>
  	   	  <div>
  	   	 	<?php echo ( !empty($error) ? $error : '');?>
          <div class="form-group">
            <div class="col-md-6">
           <input type="text" name='brand_name' id="brand_name" value="<?php echo $this->input->post('brand_name');?>" class='form-control' placeholder='Company Name' title='Company Name' required autofocus />
            </div>
           </div>
             <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="brand_status" name="brand_status" required>
                        <option value="" disabled selected>--Select--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
           <div class="form-group">
            <div class="col-md-6">
              <select name="category_id" id="selectize_id" class="form-control select-group" required>
                <option value="">Select Principle Company</option>
                <?php foreach($category_list as $cat_name):?>

               <option value="<?php echo $cat_name->category_id ?>"><?php echo $cat_name->category_name ?>
               </option>";  
             <?php endforeach; ?>
             
              </select>
            </div>
           </div>
          </fieldset>
          <fieldset>
           <legend>+ Description </legend>
        <div style="display: none;">
        <div class="form-group">
          <div class="col-md-12"><textarea name="brand_description" id="brand_description" class="form-control" rows="6"><?php echo $this->input->post('brand_description');?></textarea>
          </div>
        </div>
        </div>
  	   </fieldset>
  	   <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('brand_con/fetch_brand','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
      <?php echo form_close(); ?>
     </div>
    </div>

    
