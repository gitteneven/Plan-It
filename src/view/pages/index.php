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
    <a class="button button--add" href="index.php?page=timeslot">Add timeslot</a>


  <ul class="planner__columns">

  <?php for ($i=0; $i < 7; $i++) {?>
  <li class="border planner__column <?php if(strtotime('+'.$i . 'day', $monday)< strtotime("today")){echo 'passed';} ?>"><h3><?php echo $daysOfWeekArray[$i]; ?> <?php echo date("d/m", strtotime('+'.$i . 'day', $monday));?></h3>
    <ul class="column__cards">
        <?php foreach($planning as $item){if($item->date == date("Y-m-d", strtotime('+'.$i . 'day', $monday))){?>
      <li class="card <?php if(strtotime('+'.$i . 'day', $monday)< strtotime("today")){echo 'passed--card';} ?> <?php if($item->series == 1){echo "series";} elseif($item->movie == 1){echo "movie";} ?>">
        <p class="card__title"><?php echo ucfirst($item->title);?></p>
        <?php if($item->series == 1){ ?><p>S<?php echo $item->current_ses?> Ep<?php echo $item->current_ep?></p><?php } ?>
        <p class="card__time"><?php echo $item->time;?></p>
        <!-- <label class="sugg__add--label"><input type="checkbox" id="<?php echo $watchItem->watch_id ?>" name="plannedItem[]" value="<?php echo $watchItem->watch_id ?>" class="sugg__add "></label> -->
        <form class="" method="post" action="index.php?page=home">
          <input type="hidden" name="action" value="checkedTimeslot">
          <input type="hidden" name="plannedItem" value="<?php echo $item->watch_id ?>">
          <input  type="submit" class=" button" value="watched">
        </form>
      </li>
      <?php }} ?>
    </ul>
  </li>
  <?php } echo $checkedItem;?>
  </ul>
  </section>
<?php } ?>
