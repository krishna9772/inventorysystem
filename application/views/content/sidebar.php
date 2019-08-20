<div id='sidebar'>
  <div id="accordion" class="panel-group">
      
      <?php
         if($this->bitauth->is_admin())
          include_once __DIR__ . '/sidebar/admin.php';
        else
          // include_once __DIR__ . '/sidebar/admin.php';
      ?>
 
    </div>
  </div>
