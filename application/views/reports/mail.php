<div>
  <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <b><h3 style="color:#000;">Enter Email Address</h3></b>
        </div>
        <div class="modal-footer">
             <?php echo form_open('monreports_con/email_report/'.$category_id.'/'.$date);?>
            <input type="text" name="email" required class="form-control" placeholder="example@gmail.com"><br>
            <input type="submit" class="btn btn-primary" value="Send">
          <?php echo form_close();?>
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script type="text/javascript">

    $(document).ready(function(){

     $('#modalConfirmDelete').modal('show');


    })
  </script>
</div>