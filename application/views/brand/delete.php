  <div>
  <div class="modal fade" id="modalConfirmDelete<?php echo $brand->brand_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Delete <?php echo $brand->brand_name;?></h4>
        </div>
        <div class="modal-body">
          You want to delete <strong><?php echo $brand->brand_name;?></strong>.<br/>Are you sure?
        </div>
        <div class="modal-footer">
          <?php echo form_open('brand_con/delete_brand/'.$brand->brand_id);
            echo form_hidden('brand_id',$brand->brand_id);
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
      $('#modalConfirmDelete<?php echo $brand->brand_id;?>').modal('show');
      $('#modalConfirmDelete<?php echo $brand->brand_id;?> form').on('submit', function(e){
          e.preventDefault();
          $.post($(this).attr('action'),$(this).serialize(),function(data){
              if(data=='ok'){
                  $('#brand<?php echo $brand->brand_id;?>').fadeOut(2000);
              }else if(data=='nok'){
                  alert('Already Used,Cannot Delete');
              }
              $('#modalConfirmDelete<?php echo $brand->brand_id;?>').modal('hide');
          });
      });
    });
  </script>
</div> 