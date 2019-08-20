<div id="cPanel" class="">
<?php 
     if($this->bitauth->logged_in())
    {
      if($this->bitauth->is_admin())
        include_once __DIR__ . '/cards/admin.php';
    }

?>
<style> 
    #cPanel a{width:180px;height:80px;margin-right:8px;margin-bottom:8px;border-radius:0px;font-size:medium;padding:15px}
</style>
</div>


