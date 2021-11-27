<?php if(empty($_SESSION['id'])){?>
<section class="content intro">
<h2 class="subtitle">Watch whenever you can</h2>
<div class="line dropshadow"></div>
<div >
<p class="intro__text">Watcho helps you plan your series and movies so you don’t miss any new episodes!</p>
<p class="intro__text2">Log in to start planning! Not a member yet? Sign up!</p>
</div>
<ul class="button--wrapper">
  <li><a href="index.php?page=login" class="button">Log in</a></li>
  <li> <a href="index.php?page=signup" class="button button--signup">Sign Up</a></li>
</ul>
</section>
<?php } ?>

<?php if(!empty($_SESSION['id'])){?>
  <section class="planner">
    <div class="planner__nav">
      <a class="button--weeks"><</a>
      <p class="planner__week">29/11 - 1/12</p>
      <a class="button--weeks">></a>
    </div>
    <a class="button button--add">Add timeslot</a>

<?php
// Return current date from the remote server
// $date = date('d-m-y h:i:s');
// echo $date;
// $FirstDay = date("Y-m-d", strtotime('sunday last week'));
// $LastDay = date("Y-m-d", strtotime('sunday this week'));
// echo ' -- ' . $FirstDay;
// echo ' -- ' . $LastDay;
// ?><br>
   <?php
    $monday=strtotime('monday');
//   echo $watchItem;
// ?><br>

  <ul class="planner__columns">
    <li class="border planner__column"><h3>Monday <?php echo date("d/m", $monday);?></h3>
      <?php foreach($planning as $item){if($item->date == '29/11/2021'){
        echo $item->title;
      }} ?>
  </li>
    <li class="border planner__column"><h3>Tuesday <?php echo date("d/m", strtotime('+1 day', $monday));?></h3>
    <ul class="column__cards">
        <?php foreach($planning as $item){if($item->date == '2021-11-30'){?>
          <li class="card">
        <p class="card__title"><?php echo ucfirst($item->title);?></p>
        <p>S<?php echo $watchItem->current_ses?> Ep<?php echo $watchItem->current_ep?></p>
        <p class="card__time"><?php echo $item->time;?></p>
      </li>
      <?php }} ?>
      </ul>
  </li>
    <li class="border planner__column"><h3>Wednesday <?php echo date("d/m", strtotime('+2 day', $monday));?></h3> </li>
    <li class="border planner__column"><h3>Thursday <?php echo date("d/m", strtotime('+3 day', $monday));?></h3> </li>
    <li class="border planner__column"><h3>Friday <?php echo date("d/m", strtotime('+4 day', $monday));?></h3> </li>
    <li class="border planner__column"><h3>Saturday <?php echo date("d/m", strtotime('+5 day', $monday));?></h3> </li>
    <li class="border planner__column"><h3>Sunday <?php echo date("d/m", strtotime('+6 day', $monday));?></h3> </li>
  </ul>
  </section>
<?php } ?>
