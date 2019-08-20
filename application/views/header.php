<!DOCTYPE html>
<html>
  <head>
    <title><?php echo @$title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" />
   <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/ui/jquery-ui.css' media="screen"/>
    <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/print.css' media="print"/>
   <link rel="stylesheet" href='<?php echo base_url() ?>assets/css/dataTables.bootstrap.min.css'/>
      <link rel="stylesheet" href='<?php echo base_url() ?>assets/select/css/bootstrap-select.min.css'/>
  <link rel="stylesheet" href='<?php echo base_url() ?>assets/select2/dist/css/select2.min.css'/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/morris.js/morris.css">

     <style>
      body{font-family:tahoma}
      legend{color:rgba(10,120,180,50);}
      #sidebar {margin-bottom:10px;}
      .glyphicon { margin-right:5px; }
      .panel-body { padding:0px; }
      .panel-body table tr td { padding-left: 15px }
      .panel-body .table {margin-bottom: 0px; }
      .modal-lg{width:85%;}
      .form-group{margin-bottom:0px;}
      .form-group .form-control{margin-bottom:10px;}
      .table{margin-bottom:3px;}
      .pagination{margin:1px 0px;}
      
    </style>
   
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


  </head>
  <body>
    <div class="container"> 
      <header>
        <section>
          <?php

            if($this->bitauth->logged_in()){
              include_once __DIR__ . '/content/navbar.php';
            }else{
              include_once __DIR__ . '/account/login.php';
            }                 
            
          ?>                 
        </section>                 
        <div id="fixedNavPadding" style="margin-bottom:72px" class="hidden"></div>                 
      </header>                 
      <div class="content">                 
<?php /*
   content will be here by php 
   footer comes after content in footer.php file 
   css will be in head tag and scripts should be in footer script area 
*/ ?>
