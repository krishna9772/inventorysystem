  <section class="row">

      <aside class='col col-sm-3'>
    <?php
    if(strtolower($title)!='login')
      if (!$this->bitauth->logged_in()) 
        include_once __DIR__ . '/account/login.php';
      else
        include_once __DIR__ . '/content/sidebar.php';

      ?>
     </aside>

      <article class="col col-sm-9" id="mainContent"> 

      <?php
  
    if(@$contents)
      foreach (@$contents as $content)
        include_once $content.'.php';
      else

  ?>
     </article>

  </section>
  

  

  