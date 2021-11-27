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
      <a href="index.php?page=home&week=<?php echo $currentWeek-1; ?>" class="button--weeks"></a>
      <p class="planner__week"><?php echo date("d/m", $monday) . ' - ' . date("d/m", strtotime('+6 day', $monday)); ?></p>
      <a href="index.php?page=home&week=<?php echo $currentWeek+1; ?>" class="button--weeks weeks--flipped"></a>
    </div>
    <a class="button button--add">Add timeslot</a>



  <ul class="planner__columns">
    <!-- <li class="border planner__column"><h3>Tuesday <?php echo date("d/m", strtotime('+1 day', $monday));?></h3>
    <ul class="column__cards">
        <?php foreach($planning as $item){if($item->date == date("Y-m-d", strtotime('+1 day', $monday))){?>
          <li class="card">
        <p class="card__title"><?php echo ucfirst($item->title);?></p>
        <p>S<?php echo $watchItem->current_ses?> Ep<?php echo $watchItem->current_ep?></p>
        <p class="card__time"><?php echo $item->time;?></p>
      </li>
      <?php }} ?>
      </ul>
  </li>  -->
  <?php for ($i=0; $i < 7; $i++) {?>
    <li class="border planner__column"><h3><?php echo $daysOfWeekArray[$i]; ?> <?php echo date("d/m", strtotime('+'.$i . 'day', $monday));?></h3>
       <ul class="column__cards">
        <?php foreach($planning as $item){if($item->date == date("Y-m-d", strtotime('+'.$i . 'day', $monday))){?>
          <li class="card">
        <p class="card__title"><?php echo ucfirst($item->title);?></p>
        <p>S<?php echo $watchItem->current_ses?> Ep<?php echo $watchItem->current_ep?></p>
        <p class="card__time"><?php echo $item->time;?></p>
      </li>
      <?php }} ?>
      </ul>
  </li>
  <?php } ?>
  </ul>
  </section>
<?php } ?>
