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

        
         

        </style>  
  </head>

        
  <body>
  <div class="container">
  <section>
  <div class="row">
       <div class="col-xs-4">
        <table>
           <tr>
           <th class="first-col">Customer </th>
           <td>Matutu(1)</td>
           </tr>
           <tr>
           <th class="first-col">Location</th>
               <td>Mogok</td>
           </tr>
        </table>
       </div>
       <div class="col-xs-3">
            <div class='ajax-loader' style='visibility:hidden'>

            <img src='<?php echo base_url()?>assets/img/loading.svg'>

         </div>
       </div>
        <table class="">
           <tr>
           <th class="second-col">Principle</th>
           <td><?php echo form_dropdown('category_id',$category_list,$this->input->post('category_id'),   "class='form-control category_id' title='Principle Company' required");?></td>
           </tr>
           <tr>  
           <th class="second-col">Month</th>
               <td><span id="date"><?php echo $this->uri->segment('3');?></span></td>
           </tr>
        </table> 
       </div>
       <div class="row" id="reports">
          
       </div>
      </section>
   </div>
  </body>
  </html>


  <script type="text/javascript">
        
        $(".category_id").change(function(){

          var date = $("#date").text();
          var category_id = $(".category_id").val();

          var url = "<?php echo base_url();?>index.php/monreports_con/getSoldProduct/"+category_id+"/"+date;

          $.ajax({
             method : 'post',
                beforeSend:function(){
                 $('.ajax-loader').css("visibility", "visible");
                },
                url : url,
                data   : {category_id:category_id,date:date,csrf_test_name: $.cookie('csrf_cookie_name')},
                 success:function(data){

                  $("#reports").html(data);
                 $('.ajax-loader').css("visibility", "hidden");


                 },
                  error:function(){

                alert("Sorry");
              }
          });


        });

  </script>
