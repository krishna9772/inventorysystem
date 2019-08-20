<div class="row">
<?php if(!empty($customer->customer_id)){ ?>
  <div class="col col-md-8 well well-sm">
    <?php echo form_open('customer_con/update_customer/'.$customer->customer_id,array("id"=>"newcustomerForm", "role"=>"form",)); ?>
      <fieldset>
        <legend>- customer Information:</legend>
        <div>
          <?php echo ( !empty($error) ? $error : '' ); ?>
                 <div class="form-group">
                    <div class="col-md-6">
                      <input type="text" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name', $customer->customer_name);?>" class='form-control' placeholder='customer' title='customer Name' required autofocus autocomplete />
                    </div>
                    </div>

           <div class="form-group">
            <div class="col-md-6">
               <textarea name="customer_address" id="customer_address" class="form-control" placeholder="Address" rows="3"><?php echo set_value('customer_address', $customer->customer_address);?></textarea>
            </div>
           </div>

            <div class="form-group">
            <div class="col-md-6">
           <input type="text"  name='customer_number' id="customer_number" value="<?php echo set_value('customer_number', $customer->customer_number);?>" class='form-control' placeholder='Number' title='Number' required autofocus />
            </div>
           </div>

                   <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="customer_status" name="customer_status" required>

                        <?php

                        if($customer->customer_status == 1)
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
                      <textarea  name="customer_description" id="customer_description" value="<?php echo set_value('customer_description', $customer->customer_description);?>" class='form-control' placeholder='Description' title='Description' autofocus row="5" ><?php echo set_value('customer_description', $customer->customer_description);?></textarea></div>
                    </div>
                  </div>

      </fieldset>
      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('customer_con/fetch_customer','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
    <?php echo form_close(); ?>
  </div>
<?php
}else{
  echo '<div class="alert alert-danger text-center"><h1>customer Not Found</h1></div><div class="pull-right" title="Go to customers">'.anchor('customer_con/fetch_customer', '<span class="glyphicon glyphicon-arrow-left"></span>').'</div>';
}
?>
</div>
<script>
  $(document).ready(function(){

  });
</script>