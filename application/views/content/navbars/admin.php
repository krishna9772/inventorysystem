 <style type="text/css">
 
  ul li {
        float:left;
        font:13px helvetica;
        font-weight:bold;
        margin:3px 0;
    }

 h3 {
        display:block;
        color:#333; 
        background:#FFF;
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
        border-bottom:solid 1px rgba(100, 100, 100, .30);
    }

    p{

        line-height: 2em;
    }

      #noti_Container {
        position:relative;
        height: 100%;

    }
       
    /* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
    #noti_Button,#sec_noti_Button,#thi_noti_Button {
        width:22px;
        height:22px;
        line-height:25px;
        border-radius:50%;
        -moz-border-radius:50%; 
        -webkit-border-radius:50%;
        background:#FFF;
        margin:12px 10px 0 10px;
        cursor:pointer;
    }

    .glyphicon.glyphicon-bell,.glyphicon.glyphicon-time{

        font-size: 20px;
    }
    
    /* THE POPULAR RED NOTIFICATIONS COUNTER. */
    #noti_Counter,#sec_noti_Counter,#thi_noti_Counter {
        display:block;
        position:absolute;
        background:#E1141E;
        color:#FFF;
        font-size:12px;
        font-weight:normal;
        padding:1px 3px;
        margin:7px 0 0 25px;
        border-radius:2px;
        -moz-border-radius:2px; 
        -webkit-border-radius:2px;
        z-index:1;
    }
        
    /* THE NOTIFICAIONS WINDOW. THIS REMAINS HIDDEN WHEN THE PAGE LOADS. */
    #notifications,#sec_notifications,#thi_notifications {
        display:none;
        width:430px;
        position:absolute;
        top:30px;
        padding:5px;
        left:0;
        background:#fff;
        border:solid 1px rgba(100, 100, 100, .20);
        -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
        z-index: 5;
    }
    /* AN ARROW LIKE STRUCTURE JUST OVER THE NOTIFICATIONS WINDOW */
    #notifications:before {         
        content: '';
        display:block;
        width:0;
        height:0;
        color:transparent;
        border:10px solid #CCC;
        border-color:transparent transparent #FFF;
        margin-top:-20px;
        margin-left:10px;
    }

    #sec_notifications:before {         
        content: '';
        display:block;
        width:0;
        height:0;
        color:transparent;
        border:10px solid #CCC;
        border-color:transparent transparent #FFF;
        margin-top:-20px;
        margin-left:10px;
    }
    #thi_notifications:before {         
        content: '';
        display:block;
        width:0;
        height:0;
        color:transparent;
        border:10px solid #CCC;
        border-color:transparent transparent #FFF;
        margin-top:-20px;
        margin-left:10px;
    }
        
    .seeAll {
        background:#F6F7F8;
        padding:8px;
        font-size:12px;
        font-weight:bold;
        border-top:solid 1px rgba(100, 100, 100, .30);
        text-align:center;
    }
    .seeAll a {
        color:#3b5998;
    }
    .seeAll a:hover {
        background:#F6F7F8;
        color:#3b5998;
        text-decoration:underline;
    }
    .number{

        background: #fffa01;
        border-radius: 3px;
        padding :3px;
    }
    .number-warning{

         color: red;
    }

    a.notihr{

      text-decoration: none;
      color: #000;
    }
    a.notihr:hover{
      background: black;
    }

    #order_id:hover {
        cursor:pointer;
    }

 </style>
   <li id="noti_Container">
                <div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                
                <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                <div id="noti_Button"><span class="glyphicon glyphicon-bell"></span></div>    

                <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                <div id="notifications">
                    <h3>Expiring Products&nbsp;&nbsp;(<?php echo $exnoti;?>)</h3>
                    <div style="height:300px;padding: 5px;margin: auto;overflow-x:auto; overflow-y: auto;">

                       <?php 

                       $date = date('Y-m-d');

                      $inc_date = date('Y-m-d', strtotime("+20 day", strtotime($date))); 

                       foreach($expiryproduct as $row):

                        ?>

                        <?php

                         if($date >= $row['product_ex_date']){?>

                           <a class="notihr" href="<?php echo base_url()?>product_con/update_product/<?php echo $row['product_id']."/".$row['category_id']."/".$row['brand_id']."/".$row['product_unit']?>"><p>Product    <span class="number"><?php echo $row['product_name']?></span> has  expired on <span class="number-warning"><?php echo $row['product_ex_date'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p></a>
                        <hr> 

                    <?php }else{ ?>

                        <a class="notihr" href="<?php echo base_url()?>product_con/update_product/<?php echo $row['product_id']."/".$row['category_id']."/".$row['brand_id']."/".$row['product_unit']?>"><p>Product    <span class="number"><?php echo $row['product_name']?></span> is going to expire on <span class="number"><?php echo $row['product_ex_date'];?></span></p></a>
                        <hr> 

                    <?php } ?>

         <?php endforeach; ?>
        
                    </div>
                    <div class="seeAll"><a href="#"></a></div>
                </div>
            </li>

             <li id="noti_Container">
                <div id="sec_noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                
                <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                <div id="sec_noti_Button"><span class="glyphicon glyphicon-alert    
" style="font-size: 15px; padding: 2px;"></span></div>    

                <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                <div id="sec_notifications">
                    <h3>Out of stock&nbsp;&nbsp;(<?php echo $ofsnoti;?>)</h3>
                    <div style="height:300px;padding: 5px;margin: auto;overflow-x:auto; overflow-y: auto;">


            <?php foreach($oftproduct as $row): ?>

                <?php if($row['product_remain_quantity'] <= 0) { ?>

                      <a class="notihr" href="<?php echo base_url()?>index.php/product_con/update_product/<?php echo $row['product_id']."/".$row['category_id']."/".$row['brand_id']."/".$row['product_unit']?>"><p>Product  <span class="number"><?php echo $row['product_name']?></span> is out of stock <span class="number-warning"><?php echo $row['product_remain_quantity'];?></span></p></a>

            <hr>
                <?php }else{?>

         <a class="notihr" href="<?php echo base_url()?>index.php/product_con/update_product/<?php echo $row['product_id']."/".$row['category_id']."/".$row['brand_id']."/".$row['product_unit']?>"><p>Product  <span class="number"><?php echo $row['product_name']?></span> remains only  <span class="number"><?php echo $row['product_remain_quantity'];?></span> items in stock
        
                        <hr> 
            <?php } ?>


         <?php endforeach; ?>

          
                    </div>
                    <div class="seeAll"><a href="#"></a></div>
                </div>
            </li>


             <li id="noti_Container">
                <div id="thi_noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->
                
                <!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
                <div id="thi_noti_Button"><span class="glyphicon glyphicon-time"></span></div>    

                <!--THE NOTIFICAIONS DROPDOWN BOX.-->
                <div id="thi_notifications">
                    <h3>Duing Orders&nbsp;&nbsp;(<?php echo $ornoti;?>)</h3>
                    <div style="height:300px;padding: 5px;margin: auto;overflow-x:auto; overflow-y: auto;">


             <?php

             $date = date('m-d-Y');

            foreach($duedate as $row):

             ?>


          <?php if($date >= date('m-d-Y',$row['net_due_date'])){ ?>

            <a class="notihr" href="<?php echo base_url()?>index.php/order_con/update_order/<?php echo $row['id']?>"><p>Order Id <span class="number"><?php echo $row['id']?></span> has dued on <span class="number-warning"><?php echo date('m/d/Y',$row['net_due_date']);?></span></p></a>
                        <hr> 

            <?php }else{ ?>


         <a class="notihr      </p></a>" href="<?php echo base_url()?>index.php/order_con/update_order/<?php echo $row['id']?>"><p>Order Id <span class="number"><?php echo $row['id']?></span> is going to due on <span class="number"><?php echo date('m/d/Y',$row['net_due_date']);?></span></p></a>
                        <hr> 

           <?php } ?> 

         <?php endforeach; ?>

          
                    </div>
                    <div class="seeAll"><a href="#"></a></div>
                </div>
            </li>

      <li id="navbarReports"><?php echo anchor('report_con/','<span class="glyphicon glyphicon-signal"></span>Reports');?></li>
</ul>
<ul class="nav navbar-nav navbar-right">


