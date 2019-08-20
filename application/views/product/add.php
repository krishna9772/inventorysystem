 <div class="row">
  <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
      <?php endif; ?>
   <div class="col col-md-8 well well-sm">
  <?php echo form_open('product_con/add_Product',array("id"=>"addDrugForm", "role"=>"form",)); ?> 
   	 <fieldset>
   	 	<legend>- Product Info </legend>
   	 	 <div>
          <?php echo ( !empty($error) ? $error : '' ); ?>
           <div class="form-group">
            <div class="col-md-6">
             <?php echo form_dropdown('category_id',$category_list,$this->input->post('category_id'),   "class='form-control category_id' title='Principle Company' required");?>
            </div>
           
             <div class="col-md-6">
              <select id="brand_id" class="form-control" name="brand_id" required="required">
                      <option value="">Select Distributor</option>
              </select>
<!--                <input type="text" id="brand_id" class="form-control" >
 -->         </div>

          </div>
        
         
         <div class="form-group">
           <div class="col-md-12">
            <input type="text" name='product_name' id='product_name' value="<?php echo $this->input->post('product_name');?>" class='form-control' placeholder='Product Name' title='' required/> 
           </div>
         </div>

          <div class="form-group">
           <div class="col-md-6">
            <input type="text" name='product_man_date' id='man_date' value="<?php echo $this->input->post('product_man_date');?>" class='form-control' placeholder='Manufacture Date' autocomplete="off" title='Manufacture Date'/>
           </div>
           <div class="col-md-6">
            <input type="text" name='product_ex_date' id='ex_date' value="<?php echo $this->input->post('product_expire_date');?>" class='form-control' placeholder='Expire Date' title='Expire Date' autocomplete="off" required/> 
           </div>
         </div>

         <div class="form-group">
           <div class="col-md-6">
            <input type="text" name='product_quantity' id='product_quantity' value="<?php echo $this->input->post('product_quantity');?>" class='form-control' placeholder='Product Quantity' title='product_quantity' required/>
            <input type="hidden" name="product_added_quantity" id='added_quantity'
                       class='form-control input-sm' placeholder='Quantity' title = 'Added Quantity' value="0" required>
           </div>
           <input type="hidden" name="product_remain_quantity" id="product_remain_quantity"/>

           <div class="col-md-6">
             <?php echo form_dropdown('product_unit',$unit_list,''," class='form-control' title='Unit' required");?>
           </div>
         </div>

     </fieldset>

              <div class=clearfix></div>

     <fieldset>
      <legend>- Price Info </legend>
         <div class="form-group">
           <div class="col-md-6">
             <input type="text" name="product_base_price" id='product_base_price' value="<?php echo $this->input->post('product_base_price');?>" class="form-control" placeholder='Base Price' title = 'Base Price' />
         </div>
          <div class="col-md-6">
             <input type="text" name="product_selling_price" id='product_selling_price' value="<?php echo $this->input->post('product_selling_price');?>" class="form-control" placeholder='Selling Price' title = 'Selling Price' />
             <input type="hidden" name="product_profit_price" id="product_profit_price" value="<?php echo $this->input->post('product_profit_price');?>">
         </div>
         <div class="col-md-6">
             <input type="text" name="product_tax" id='product_tax' value="<?php echo $this->input->post('product_tax');?>" class="form-control" placeholder='Tax (%)' title='Tax'/>

             <input type="hidden" name="product_enter_by" id="product_enter_by" value="<?php echo $this->session->userdata('ba_username')?>">
               <input type="hidden" name="product_date" id="product_date" value="<?php echo date("y/m/d")?>">
         </div>
       </div>
        <div class="form-group">
                    <div class="col-sm-6">
                      <select type="text" class="form-control" id="product_status" name="product_status" title="Select Availabilty" required>
                        <option value="" disabled selected>--Select--</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>
   	 </fieldset>
                   <div class=clearfix></div>

     <fieldset>
      <legend>+ Product Description </legend>

      <div style="display: none;">
        <div class="form-group">
          <div class="col-md-12"><textarea name="product_description" id="product_description" class="form-control" placeholder="Product Description" rows="6"><?php echo $this->input->post('product_description');?></textarea>
            <input type="hidden" name="is_deleted" value="0">
          </div>
        </div>
        </div>
     </fieldset>
       <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('product_con/fetch_Product','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
             <?php echo form_close()?>      
   </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $("#product_quantity").on('keyup',function(){
       
        var quantity = $("#product_quantity").val()
        $("#product_remain_quantity").val(quantity);
             
    });

 $(document).on('keyup','#product_base_price',function(){
             var act_price = $("#product_base_price").val();
      var sell_price = $("#product_selling_price").val();
      var pro_price = parseInt(sell_price) - parseInt(act_price);
  var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
  var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
        $("#product_profit_price").val(output);
        });

       $(document).on('keyup','#product_selling_price',function(){
      var act_price = $("#product_base_price").val();
      var sell_price = $("#product_selling_price").val();
      var pro_price = parseInt(sell_price) - parseInt(act_price);
  var percentage = Math.round((parseInt(pro_price)/parseInt(act_price))*100);
  var output = pro_price.toString().concat("(")+percentage.toString().concat("%)");
        $("#product_profit_price").val(output);
            });

       $(".category_id").change(function(){

        var category_id = $(".category_id").val();
        var brand_id    = $("#brand_id").val();
        var url   = "<?php echo base_url()?>product_con/fill_brand_list";
        $.ajax({
          url    : url,
          method : 'post',
          data:{category_id:category_id,csrf_test_name: $.cookie('csrf_cookie_name')},
            success:function(data)
            {
              $("#brand_id").html(data);
              // alert(data);           
               },

            error:function(){

              alert("Sorry");
            }

        })


       })

  });
  
</script>