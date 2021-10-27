<section class="content">
<ul class="demo-list">
<?php
    foreach ($demos as $demo){
      echo('<li>' . $demo->name . '</li>');
    }
  ?>
  </ul>
</section>
