<nav id="main_nav" class="navbar navbar-inverse" role="navigation">
 <div class="container-fluid">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#" onclick="$('#main_nav').toggleClass('navbar-fixed-top');$('#fixedNavPadding').toggleClass('hidden');return false;">Ma Tue Tue (1)</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li id="navbarLiHome"><?php echo anchor('','<span class="glyphicon glyphicon-home"></span> Home');?></li>
     <?php
        if($this->bitauth->is_admin())
          include_once __DIR__ . '/navbars/admin.php';
        else
          
      ?>
      <li class="dropdown"><!-- Fixed on all users -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('ba_first_name').' '.$this->session->userdata('ba_last_name');?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><?php echo anchor('account/edit_user/'.$this->session->userdata('ba_user_id'),'<span class="glyphicon glyphicon-user"></span> Profile');?></li>
          <li class="divider"></li>
          <li><?php echo anchor('account/logout','<span class="glyphicon glyphicon-off"></span> Logout');?></li>
        </ul>
      </li>
    </ul>
  </div>
  <?php if(isset($navActiveId)){?>
    <script>
      $(document).ready(function(){
        $('#<?php echo $navActiveId?>').addClass('active');
      });
    </script>
  <?php }?>
</div>
</nav>