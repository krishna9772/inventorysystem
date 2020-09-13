<div class="row">

      <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>

  <div class="col col-md-8 well well-sm">
  	  <?php echo form_open('category_con/add_Category',array("id"=>"newCatForm", "role"=>"form",)); ?>
  	   <fieldset>
  	   	 <legend>- Principle Company</legend>
  	   	 <div>
  	   	 	<?php echo ( !empty($error) ? $error : '');?>
          <div class="form-group">
            <div class="col-md-6">
           <input type="text" name='category_name' id="category_name" value="<?php echo $this->input->post('category_name');?>" class='form-control' placeholder='Company Name' title='Company Name' required autofocus />
            </div>
           </div>
            <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="category_status" name="category_status" required>
                        <option value="" disabled>--Select--</option>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
          </fieldset>
          <fieldset>
           <legend>+Description</legend>
      <div style="display: none;">
        <div class="form-group">
          <div class="col-md-12"><textarea name="category_description" id="category_description" class="form-control" rows="6"><?php echo $this->input->post('category_description');?></textarea>
          </div>
         </div>
        </div>
  	   </fieldset>
  	   <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('category_con/fetch_Category','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>

      <?php echo form_close(); ?>
     </div>
    </div>
