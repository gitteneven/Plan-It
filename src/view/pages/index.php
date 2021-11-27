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
    <?php echo $planning ?>
  <ul class="planner__columns">
    <li class="border planner__column"><h3>Monday 29/11</h3>
      <?php foreach($planning as $item){if($item->date == '29/11/2021'){
        echo $item->title;
      }} ?>
  </li>
    <li class="border planner__column"><h3>Tuesday 30/11</h3>
        <?php foreach($planning as $item){if($item->date == '2021-11-30'){
        echo $item->title;
      }} ?>
  </li>
    <li class="border planner__column"><h3>Wednesday 1/12</h3> </li>
    <li class="border planner__column"><h3>Wednesday 1/12</h3> </li>
    <li class="border planner__column"><h3>Wednesday 1/12</h3> </li>
    <li class="border planner__column"><h3>Wednesday 1/12</h3> </li>
    <li class="border planner__column"><h3>Wednesday 1/12</h3> </li>
  </ul>
  </section>
<?php } ?>
