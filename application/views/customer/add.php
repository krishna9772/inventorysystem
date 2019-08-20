<div class="row">

	 <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>

  <div class="col col-md-8 well well-sm">
  	  <?php echo form_open('customer_con/add_customer',array("id"=>"newCusForm", "role"=>"form",)); ?>

  	     <fieldset>
  	   	 <legend>-Customer</legend>
         <div>
  	   	 	<?php echo ( !empty($error) ? $error : '');?>
          <div class="form-group">
            <div class="col-md-6">
           <input type="text" name='customer_name' id="customer_name" value="<?php echo $this->input->post('customer_name');?>" class='form-control' placeholder='Name' title='Name' required autofocus />
            </div>
           </div>

            <div class="form-group">
            <div class="col-md-6">
               <textarea name="customer_address" id="customer_address" class="form-control" placeholder="Address" rows="3"><?php echo $this->input->post('customer_address');?></textarea>
            </div>
           </div>

            <div class="form-group">
            <div class="col-md-6">
           <input type="text"  name='customer_number' id="customer_number" value="<?php echo $this->input->post('customer_number');?>" class='form-control' placeholder='Number' title='Number' required autofocus />
            </div>
           </div>

            <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="customer_status" name="customer_status" required>
                        <option value="" disabled selected>--Select--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                       <input type="hidden" name="created_date" id="created_date" value="<?php echo date("Y/m/d")?>">
                    </div>
                  </div>
           
          </fieldset>

          <fieldset>
           <legend>+Description</legend>	
      <div style="display: none;">
        <div class="form-group">
          <div class="col-md-12"><textarea name="customer_description" id="customer_description" class="form-control" rows="6"><?php echo $this->input->post('customer_description');?></textarea>
           
          </div>
         </div>
        </div>
  	   </fieldset>
  	   <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('customer_con/fetch_Customer','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>

      <?php echo form_close(); ?>



</div>
</div>