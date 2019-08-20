 <div id="tmpDiv"></div>
      </div>
      <footer class="footer">

      
      </footer>
    </div>
    <script src="<?php echo base_url() ?>assets/js/main.js"></script>
    <?php

     if(isset($script))

       echo $script;
     ?>

     <script type="text/javascript">

      $(document).ready(function(){

    jQuery("body").prepend('<div id="preloader">Loading...</div>');
    jQuery(document).ready(function() {
        jQuery("#preloader").remove();
    });

          $("select[id*=selectize_id]").select2({

    
          });

          $("#created_date").datepicker();
          $("#net_date").datepicker();
          $("#man_date").datepicker();
          $("#ex_date").datepicker();


        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
        $('#noti_Counter')
            .css({ opacity: 0 })
            .text('<?php 

              if($totalnoti !=0){

                echo $totalnoti;
              }

            ?>')  // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button').click(function () {

            // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
            $('#notifications').fadeToggle('fast', 'linear', function(e) {
                if ($('#notifications').is(':hidden')) {
                    $('#noti_Button').css('background-color', '#2E467C');
                    e.preventDefault();

                }
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                else $('#noti_Button').css('background-color', '#FFF');
            });

            $('#noti_Counter').fadeOut('slow');     // HIDE THE COUNTER.

            return false;
        });

        $("#edit").click(function () {



        });

        // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
        $(document).click(function () {
            $('#notifications').hide();

            // CHECK IF NOTIFICATION COUNTER IS HIDDEN.
            if ($('#noti_Counter').is(':hidden')) {
                // CHANGE BACKGROUND COLOR OF THE BUTTON.
                $('#noti_Button').css('background-color', '#fff');
            }
        });

        $('#notifications').click(function () {
        });
    });

    </script>

  </body>
</html> 