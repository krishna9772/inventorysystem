  <div>
  <div class="modal fade" id="modalConfirmDelete<?php echo $order->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          You want to delete Are you sure?
        </div>
        <div class="modal-footer">
          <?php echo form_open('order_con/delete_Order/'.$order->id);
            echo form_hidden('id',$order->id);
            echo form_hidden('del',1);?>
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <input type="submit" class="btn btn-primary" value="YES" />
          <?php echo form_close();?>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script>
    $(document).ready(function(){
      $('#modalConfirmDelete<?php echo $order->id;?>').modal('show');
      $('#modalConfirmDelete<?php echo $order->id;?> form').on('submit', function(e){
          e.preventDefault();
          $.post($(this).attr('action'),$(this).serialize(),function(data){
              if(data=='ok'){
                  $('#order<?php echo $order->id;?>').fadeOut(2000);
              }else if(data=='nok'){
                  alert('order');
              }
              $('#modalConfirmDelete<?php echo $order->id;?>').modal('hide');
          });
      });
    });
  </script>
</div> 