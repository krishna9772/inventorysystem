<div class="row">
<?php if(!empty($product->product_id)){ ?>

  <div class="col col-md-8 well well-sm">
    <?php echo form_open('product_con/update_Product/'.$product->product_id,array("id"=>"newproductForm", "role"=>"form",)); ?>
      <fieldset>
        <legend>- Product Information:</legend>
        <div>

          <?php echo ( !empty($error) ? $error : '' ); ?>
                 <div class="form-group">
                     <div class="col-md-6">  
                      <label>Principle Company</label>
                        <?php echo form_dropdown('category_id',$category_list,$category_name,"id='selectize_id' class='category_id form-control' placeholder='Select Principle Company' title='Prin.Com'  required");?>
                     </div>
                  </div>

                     <div class="form-group">
                       <div class="col-md-6">
                        <label>Distributor</label>
                        <select id="brand_id" class="form-control" name="brand_id">
                         <option value="" disabled>Select Distributor</option>
                          <?php
                          foreach($brand_list as $bran):
                          ?>
                          <option value="<?php echo $bran['brand_id']?>" selected><?php echo $bran['brand_name']?></option>
                        <?php endforeach;?>
                        </select>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                   <div class="form-group">
                    <div class="col-md-12">
                      <label>Product Name</label>
                      <input type="text" name='product_name' id='product_name' value="<?php echo set_value('product_name',$product->product_name)?>" class='form-control' placeholder='Product Name' title=''  required/> 
                    </div>
                   </div>
                     <div class="form-group">
                    <div class="col-md-6">
                      <label>Manufacture Date</label>
                     <input type="text" name='product_man_date' id='man_date' value="<?php echo set_value('product_man_date',$product->product_man_date);?>" class='form-control' placeholder='Manufacture Date' title='Manufacture Date'/> 
                    </div>
                    <div class="col-md-6">
                      <label>Expiry Date</label>
                     <input type="text" name='product_ex_date' id='ex_date' value="<?php echo set_value('product_ex_date',$product->product_ex_date);?>" class='form-control' placeholder='Expire Date' title='Expire Date' required/> 
                    </div>

                   </div> 
                   <div class="form-group">
                     <div class="col-md-6">
                       <input type="hidden" id='original_quantity'
                        value="<?php echo set_value('quantity',$product->product_quantity);?>" class='form-control' placeholder='Quantity' title = 'Original Quantity' required>
                      <input type="hidden" name="act_added_quantity" id='act_added_quantity'
                       class='form-control input-sm' placeholder='Quantity' title = ' ActAdded Quantity' required>
                    

                    <div class="col-md-7">
                      <input type="hidden" name="product_added_quantity" id='added_quantity'
                       class='form-control input-sm' placeholder='Quantity' title = 'Added Quantity' required>
                        <input type="hidden" id='al_added_quantity'
                       class='form-control input-sm' value="<?php echo set_value('added_quantity',$product->product_added_quantity);?>" placeholder='Quantity' title = 'already Quantity' required>
                    </div>
                      <label>Added Quantity</label>
                       <input type="text" name="product_quantity" id='product_quantity'
                        value="<?php echo set_value('product_quantity',$product->product_quantity);?>" class='form-control' placeholder='Quantity' title = 'Quantity' required>
                        <label>Unit</label>
                       <?php echo form_dropdown('product_unit',$unit_list,$product_unit,"id='selectize_id' class='form-control' placeholder='Select Unit' title='Unit' size=5 required");?>
                     </div>
                     <div class="col-md-6">
                      <label>Remain Quantity</label>
                       <input type="text" name="product_remain_quantity" id='product_remain_quantity'
                        value="<?php echo set_value('product_remain_quantity',$product->product_remain_quantity);?>" class='form-control' title="Remain Quantity" readonly >
                        <input type="hidden" id="product_used_quantity">
                     </div>
                   </div>
      </fieldset>
      <div class="clearfix"></div>
      <fieldset>
      <legend>- Price Info </legend>
       <div class="form-group">
        <div class="col-md-6">
          <label>Base Price</label>
        <input type="text" name="product_base_price" id='product_base_price' value="<?php echo set_value('product_base_price',$product->product_base_price);?>" class="form-control" placeholder='Base Price' title = 'Base Price' required /> 
        </div>
         <div class="col-md-6">
            <label>Selling Price</label>
             <input type="text" name="product_selling_price" id='product_selling_price' value="<?php echo set_value('product_selling_price',$product->product_selling_price);?>" class="form-control" placeholder='Selling Price' title = 'Selling Price' />
             <input type="hidden" name="product_profit_price" id="product_profit_price" value="100">
         </div>
       </div>
       <div class="form-group">
          <div class="col-md-6">
              <label>Tax</label>
             <input type="text" name="product_tax" id='product_tax' value="<?php echo set_value('product_tax',$product->product_tax);?>" class="form-control" placeholder='Tax (%)' title='Tax'/> 
          </div>
           <div class="form-group">
                    <div class="col-sm-6">  
                      <label>Status</label>
                      <select type="text" class="form-control" id="product_status" name="product_status" required>

                        <?php

                        if($product->product_status == 1)
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
          <div class="col-md-6">
            <label>Added By</label>
             <input type="text" name="product_enter_by" id="product_enter_by" value="<?php echo $this->session->userdata('ba_username')?>" class="form-control" title="Added By" readonly>
          </div>
       </div>
      </fieldset>
     <div class="clearfix"></div>
     <fieldset>
       <legend>-Product Description</legend>
       <div class="form-group">
         <div class="col-md-12">
                      <textarea  name="product_description" id="brand_description" value="<?php echo set_value('product_description', $product->product_description);?>" class='form-control' placeholder='Description' title='Description' autofocus row="8" ><?php echo set_value('product_description', $product->product_description);?></textarea>
                      <input type="hidden" name="is_deleted" value="0">
         </div>
       </div>
     </fieldset>
      <div class="form-group">
        <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Update' class="form-control btn btn-info" /></div>
        <div class="col-md-6"><?php echo anchor('product_con/fetch_product','Cancel',array('class'=>'form-control btn btn-info'));?></div>
      </div>
    <?php echo form_close(); ?>
  </div>
<?php
}else{
  echo '<div class="alert alert-danger text-center"><h1>product Not Found</h1></div><div class="pull-right" title="Go to products">'.anchor('product_con/fetch_product', '<span class="glyphicon glyphicon-arrow-left"></span>').'</div>';
}
?>
</div>
<script>
  $(document).ready(function(){


    var product_used_quantity = parseInt($("#product_quantity").val()) - parseInt($("#product_remain_quantity").val());

    $("#product_used_quantity").val(product_used_quantity);

    $("#added_quantity").val(parseInt($("#product_quantity").val()) - parseInt($("#original_quantity").val()) + parseInt($("#al_added_quantity").val()));

    $("#act_added_quantity").val(parseInt($("#product_quantity").val()) - parseInt($("#original_quantity").val()));

    $("#product_quantity").on('keyup',function(){

       var quantity = $("#product_quantity").val();
       var original_quantity = $("#original_quantity").val();
       
       var product_remain_quantity = parseInt($("#product_quantity").val())-parseInt($("#product_used_quantity").val());
        
         $("#product_remain_quantity").val(product_remain_quantity);

 $("#added_quantity").val(parseInt($("#product_quantity").val()) - parseInt($("#original_quantity").val()) + parseInt($("#al_added_quantity").val()));

 $("#act_added_quantity").val(parseInt($("#product_quantity").val()) - parseInt($("#original_quantity").val()));

             
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
        $.ajax({
          url    : '<?php echo base_url()?>product_con/fill_brand_list',
          method : 'post',
          data:{category_id:category_id,csrf_test_name: $.cookie('csrf_cookie_name')},
            success:function(data)
            {
              $("#brand_id").html(data);
            },

            error:function(){

              alert("Sorry");
            }

        });

       });

  });
</script>