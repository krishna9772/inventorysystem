<div>
  <div class="modal fade" id="modalCheckDrug" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i>Products Details</h4>
        </div>
        <div class="modal-body">
          <?php foreach ($product as $pro ): ?>
            
         <div class="table-responsive">
          <table class="table table-boredered">
            <tr>
              <td>Name</td>
              <td><?php echo $pro['product_name']?></td>
            </tr>
            <tr>
              <td>Principle Company</td>
              <td><?php echo $category_name?></td>

            </tr>
            <tr>
             <td>Distributor</td>
             <td><?php echo $brand_name?></td>

            </tr>
            <tr>
             <td>Manufacture Date</td>
             <td><?php echo $pro['product_man_date']?></td>

            </tr>
            <tr>
             <td>Expire Date</td>
                          <td><?php echo $pro['product_ex_date']?></td>

            </tr>
            <tr>
             <td>Registered Qty</td>
                           <td><?php echo $pro['product_quantity']?></td>

            </tr>
            <tr>
             <td>Remain Qty</td>
                           <td><?php echo $pro['product_remain_quantity']?></td>

            </tr>
            <tr>
             <td>Used Qty</td>
                           <td><?php echo (int) $pro['product_quantity'] - (int) $pro['product_remain_quantity'];?></td>

            </tr>
            <tr>
             <td>Unit</td>
                           <td><?php echo $pro['product_unit']?></td>

            </tr>
            <tr>
             <td>Base Price</td>
                           <td><?php echo $pro['product_base_price']?></td>

            </tr>
            <tr>
             <td>Selling Price</td>
                           <td><?php echo $pro['product_selling_price']?></td>

            </tr>
            <tr>
             <td>Profit </td>
                           <td><?php echo $pro['product_profit_price']?></td>

            </tr>
            <tr>
             <td>Tax rate</td>
                           <td><?php echo $pro['product_tax']?></td>

            </tr>
            <tr>
             <td>Added By</td>
                           <td><?php echo $pro['product_enter_by']?></td>

            </tr>
            <tr>
             <td>Description</td>
                           <td><?php echo $pro['product_description']?></td>

            </tr>
            <tr>
             <td>Status</td>
                       <?php


          if($pro['product_status'] == 1) {
        $product_status = '<span class="label label-success">Active</span>'; 
      }
      else {
        $product_status = '<span class="label label-warning">Inactive</span>';
      }

                       ?>
                           <td><?php echo $product_status;?></td>

            </tr>
            <tr>
             <td>Date</td>
                           <td><?php echo $pro['product_date']?></td>

            </tr>
          </table>
         </div>
                   <?php endforeach ?>
        </div>
         <div class="modal-footer">   
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('#modalCheckDrug').modal('show');
    });
  </script>
</div>