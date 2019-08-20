<div>
  <div class="modal fade" id="modalConfirmDelete<?php echo $order->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          Enter Customer Email Address
        </div>
        <div class="modal-footer">
             <?php echo form_open('order_con/email_Order/'.$order->id);?>
            <input type="text" name="email" class="form-control" placeholder="example@gmail.com"><br>
            <input type="submit" class="btn btn-primary" value="Send">
          <?php echo form_close();?>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script type="text/javascript">
    $(document).ready(function(){

     $('#modalConfirmDelete<?php echo $order->id;?>').modal('show');


    })
  </script>
</div>