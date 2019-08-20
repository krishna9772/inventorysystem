<div class="row">
   
    <div class="col-md-12 col-xs-12">
   <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
 

     <div class="box">
    	 <?php echo ( !empty($error) ? $error : '' ); ?>

        <?php echo form_open('order_con/add_Order',array("id"=>"addDrugForm", "role"=>"form",)); ?> 
      <div class="box-body">
    	  <div class="form-group">
    	     <div class="col-md-4">
			    <label>Enter Receiver Name</label>
			   <select name="customer_name" id="selectize_id" class="form-control customer_name" required>
                <option value="">Customer Name</option>
                <?php foreach($customer_list as $cus_name):?>

               <option value="<?php echo $cus_name->customer_name?>"><?php echo $cus_name->customer_name ?>
               </option>";  
             <?php endforeach; ?>
             
         </select>
			  </div>
	          <div class="col-md-4">
				  <label>Date</label>
				  <input type="text" name="created_date" id="created_date" class="form-control" placeholder="mm/dd/YY" autocomplete="off" required />
			  </div>
			  <div class="col-md-4">
				  <label>Net Due Date</label>
				  <input type="text"  name="net_due_date" id="net_date" class="form-control" placeholder="mm/dd/YY" autocomplete="off" required />
			  </div>
		  </div>

	     <div class="form-group">
			<label>Enter Receiver Address</label>
			<textarea name="customer_address" id="customer_address" class="form-control" required rows="5"></textarea>
		   <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('ba_username')?>">
		   <input type="hidden" name="bill_no" value="<?php echo 'INVS'.strtoupper(substr(md5(uniqid(mt_rand(), true)),0, 10));?>"/>
		   </div>
						
							  <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:25%">Product</th>
                      <th style="width:10%">Remain Qty</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:15%">Rate</th>
                      <th style="width:10%">Discount</th>
                      <th style="width:15%">Amount</th>
                      <th style="width:10%">FOC</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="glyphicon glyphicon-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td>
                        <select class="form-control  product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($product_list as $k => $v): ?>
                              <option value="<?php echo $v['product_id'] ?>"><?php echo $v['product_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </td>
                       <td><input type="text" name="remain_qty[]" id="remain_qty1" readonly class="form-control"></td>
                        <td>
                        	<input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>
                         <input type="hidden" name="tax[]" id="tax_1" class="form-control" required readonly>
                         <td>
                          <input type="discount" name="discount[]" id="discount_1" class="form-control" onkeyup="getTotal(1)">  
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>

                        <td>
                        <input type="text" name="foc[]" id="foc_1" class="form-control">
                        </td>

                       
                    
                        <td><button type="button" class="btn btn-default" onclick="removeRow('1')"><i class="glyphicon glyphicon-remove"></i></button></td>
                     </tr>
                   </tbody>
                </table>
                <br/><br/>
             <div class="col-md-6 col-xs-12 pull pull-right">
                   <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Paid Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status" required>
                      	<option value="" disabled selected>--Select--</option>
                        <option value="1">Paid</option>
                        <option value="0">Unpaid</option>
                      </select>
                    </div>
                  </div>
					</div>	
        </div>	


     
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="<?php echo base_url('order_con/fetch_Order') ?>" class="btn btn-warning">Back</a>
      </div>
      <?php form_close();?>
     </div>
  </div>
</div>

  <script type="text/javascript">

    var base_url = "<?php echo base_url()?>";

    $(document).ready(function(){

      $(".customer_name").change(function(){

       var customer_name =  $(".customer_name").val();

       $.ajax({

        url: base_url + 'order_con/getCustomerData',
        data:{customer_name:customer_name,csrf_test_name: $.cookie('csrf_cookie_name')},
        type: 'post',
        success:function(data) {

             $("#customer_address").val(data);
 
        },

       });


      });
     
      $(".product").select2();

  	  $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url:  base_url + 'order_con/getTableProductRow/',
          data:{csrf_test_name: $.cookie('csrf_cookie_name')},
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control  product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.product_id+'">'+value.product_name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                   '<td><input type="text" name="remain_qty[]" id="remain_qty'+row_id+'" class="form-control" required readonly></td>'+
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<input type="hidden" name="tax[]" id="tax_'+row_id+'" class="form-control" required readonly>'+ 
                    '<td><input type="text" name="discount[]" id="discount_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                 ' <td><input type="text" name="foc[]" id="foc_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="glyphicon glyphicon-remove"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

  });


  	  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val(""); 
      $("#qty_"+row_id).val("");         
      $("#discount_"+row_id).val("");  
      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");
      $("#foc_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'order_con/getProductValueById',
        type: 'post',
        data: {product_id : product_id,csrf_test_name: $.cookie('csrf_cookie_name')},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#remain_qty"+row_id).val(response.product_remain_quantity);
          $("#tax_"+row_id).val(response.product_tax);
          $("#rate_"+row_id).val(response.product_selling_price);
          $("#rate_value_"+row_id).val(response.product_selling_price);

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);
          $("#discount_"+row_id).val("0.00");
          $("#foc_"+row_id).val("0");

          var tax = (Number(response.product_selling_price) /100) * $("#tax_"+row_id).val();
          var total = Number(response.product_selling_price) * 1;
          total = total+tax;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
          subAmount();	
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  	   // calculate the total amount of the order
  function subAmount() {

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);
    
    // total amount
    var totalAmount = (Number(totalSubAmount));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - (Number(totalAmount)/100)*discount;
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

  } // /sub total amount

   function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

   function getTotal(row = null) {
    if(row) {
      var tax = (Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val())/100) * $("#tax_"+row).val();
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      var discount =   (Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val())/100) * $("#discount_"+row).val();
      total = (total+tax)-discount;
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }


  </script>