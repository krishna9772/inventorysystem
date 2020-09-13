<!DOCTYPE html>
  <html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Monthly Reports</title>

     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" />
     <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/ui/jquery-ui.css' media="screen"/>
      <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/print.css' media="print"/>
     <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/dataTables.bootstrap.min.css'/>
        <link rel="stylesheet" href='<?php echo base_url() ?>assets/select/css/bootstrap-select.min.css'/>
    <link rel="stylesheet" href='<?php echo base_url() ?>assets/select2/dist/css/select2.min.css'/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/morris.js/morris.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin_lte/css/AdminLTE.min.css">

     <script src="<?php echo base_url()?>assets/js/jquery-2.1.0.min.js"></script>
      <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
      <script src="<?php echo base_url()?>assets/js/jquery.cookie.js"></script>
      <script src="<?php echo base_url()?>assets/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url()?>assets/js/dataTables.bootstrap.min.js"></script>    
      <script src="<?php echo base_url()?>assets/select2/dist/js/select2.js"></script>
      <script src="<?php echo base_url()?>assets/select/js/bootstrap-select.js"></script>
      <script src="<?php echo base_url()?>assets/morris.js/morris.min.js"></script>
      <script src="<?php echo base_url()?>assets/chart.js/Chart.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

      <style>
          th{

            padding:10px;   

          }
          .first-col{

            padding-right:80px;
          }
          .second-col{
            padding-right: 40px;
          }

          body{
            background: grey;
            color: #fff;
          }
          .select2-results__options,.select2-search__field{
            color:#000;
          }

        </style>  
  </head>

  <body>
  <div class="container">
  <section>
  <div class="row">
   <?php echo form_open('monreports_con/getMultiReports/'.$this->uri->segment(3).''); ?>
     <div class="col-xs-10">
           <label><h2>Principle</h2>(<span id="date" class="badge badge-danger"><?php echo $this->uri->segment('3');?></span>)</label>
          <?php echo form_multiselect('category_id[]',$category_list,$this->input->post('category_id'),   "class='form-control' title='Principle Company' id='monreports_multiple_select' required");?>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="checkbox">
          <label class="form-check-label" for="checkbox">Select All</label>
        </div>
         <div class="form-group">
          <input type="submit" value="Submit" id="submit" class="btn btn-info">
        </div>
     </div>
  <?php echo form_close(); ?>
  </div>
  </section>
  </div>
  </body>
  </html>

  <script type="text/javascript">

        $("#checkbox").click(function(){
           if($("#checkbox").is(':checked')) {
              $("#monreports_multiple_select > option").prop("selected","selected");
              $("#monreports_multiple_select").trigger("change");
           }else{
              $("#monreports_multiple_select > option").removeAttr("selected");
              $("#monreports_multiple_select").trigger("change");
           }
        })

        $("#submit").click(function() {
              $("#checkbox").attr('checked', false);
        })

  </script>
