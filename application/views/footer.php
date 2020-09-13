
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
          
          $(window).scroll(function () {
           if ($(this).scrollTop() > 50) {
           $('#back-to-top').fadeIn();
         } else {
           $('#back-to-top').fadeOut();
         }
         });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
         $('body,html').animate({
          scrollTop: 0
          }, 400);
         return false;
         });

          $("select[id*=selectize_id]").select2({});

          $("#monreports_multiple_select").select2({
                multiple: true,
                width: '100%',
                placeholder: "-- Select --",
          });

          $('.select2[multiple]').siblings('.select2-container').append('<span class="select-all"></span>');

          $(document).on('click', '.select-all', function (e) {
            selectAllSelect2($(this).siblings('.selection').find('.select2-search__field'));
          });

          $(document).on("keyup", ".select2-search__field", function (e) {
            var eventObj = window.event ? event : e;
            if (eventObj.keyCode === 65 && eventObj.ctrlKey)
               selectAllSelect2($(this));
          });
                  
                  
          function selectAllSelect2(that) {

            var selectAll = true;
            var existUnselected = false;
            var id = that.parents("span[class*='select2-container']").siblings('select[multiple]').attr('id');
            var item = $("#" + id);

            item.find("option").each(function (k, v) {
                if (!$(v).prop('selected')) {
                    existUnselected = true;
                    return false;
                }
            });

            selectAll = existUnselected ? selectAll : !selectAll;

            item.find("option").prop('selected', selectAll).trigger('change');
          }

          $("#created_date").datepicker();
          $("#net_date").datepicker();
          $("#man_date").datepicker();
          $("#ex_date").datepicker();


        // ANIMATEDLY DISPLAY THE NOTIFICATION COUNTER.
        $('#noti_Counter')
            .css({ opacity: 0 })
            .text('<?php 

              if($exnoti !=0){

                echo $exnoti;
              }

            ?>')  // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
            .css({ top: '-10px' })
            .animate({ top: '-2px', opacity: 1 }, 500);

        $('#noti_Button').click(function () {
          $("#sec_notifications").hide();
          $("#thi_notifications").hide();

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
    <script>
  $('#sec_noti_Counter')
    .css({
      opacity: 0
    })
    .text('<?php 

        if($ofsnoti !=0){

          echo  $ofsnoti;
        }

        ?>') // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
    .css({ top: '-10px'})
    .animate({
      top: '-2px',
      opacity: 1
    }, 500);

  $('#sec_noti_Button').click(function() {
    $('#notifications').hide();
    $('#thi_notifications').hide();
    // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
    $('#sec_notifications').fadeToggle('fast', 'linear', function(e) {
      if ($('#sec_notifications').is(':hidden')) {
        $('#sec_noti_Button').css('background-color', '#2E467C');
        e.preventDefault();
      }
    });

    $('#sec_noti_Counter').fadeOut('slow'); // HIDE THE COUNTER.

    return false;
  });
 
  // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
  $(document).click(function() {
    $('#sec_notifications').hide();

  });
  $('#sec_notifications').click(function() {});
</script>

<script>
  $('#thi_noti_Counter')
    .css({
      opacity: 0
    })
    .text('<?php 

        if($ornoti !=0){

          echo  $ornoti;
        }

        ?>') // ADD DYNAMIC VALUE (YOU CAN EXTRACT DATA FROM DATABASE OR XML).
    .css({ top: '-10px'})
    .animate({
      top: '-2px',
      opacity: 1
    }, 500);

  $('#thi_noti_Button').click(function() {
    $('#notifications').hide();
    $('#sec_notifications').hide();
    // TOGGLE (SHOW OR HIDE) NOTIFICATION WINDOW.
    $('#thi_notifications').fadeToggle('fast', 'linear', function(e) {
      if ($('#thi_notifications').is(':hidden')) {
        $('#thi_noti_Button').css('background-color', '#2E467C');
        e.preventDefault();
      }
    });

    $('#thi_noti_Counter').fadeOut('slow'); // HIDE THE COUNTER.

    return false;
  });
 
  // HIDE NOTIFICATIONS WHEN CLICKED ANYWHERE ON THE PAGE.
  $(document).click(function() {
    $('#thi_notifications').hide();

  });
  $('#thi_notifications').click(function() {});
</script>

  </body>
</html> 