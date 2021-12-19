<?php if(empty($_SESSION['id'])){?>
<section class="content intro">
<h2 class="subtitle">Watch whenever you can</h2>
<div class="line dropshadow"></div>
<div >
<p class="intro__text">Watcho helps you plan your series and movies so you don’t miss any new episodes!</p>
<p class="intro__text2">Log in to start planning! Not a member yet? Sign up!</p>
</div>
<ul class="button--wrapper">
  <li><a href="index.php?page=login" class="button button--login">Log in</a></li>
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
  <li class="border planner__column <?php if(strtotime('+'.$i . 'day', $monday)< strtotime("today")){echo 'passed';} ?>"><h3 class="column__title"><?php echo $daysOfWeekArray[$i]; ?> <?php echo date("d/m", strtotime('+'.$i . 'day', $monday));?></h3>
    <ul class="column__cards">
        <?php foreach($planning as $item){if($item->date == date("Y-m-d", strtotime('+'.$i . 'day', $monday))){?>
      <li class="card <?php if(strtotime('+'.$i . 'day', $monday)< strtotime("today") || $item->watched==1){echo 'passed--card';} ?> <?php if($item->series == 1){echo "series";} elseif($item->movie == 1){echo "movie";} ?>">
       <div class="card__title_wrapper"><p class="card__title"><?php echo ucfirst($item->title);?></p>
       <form class="removeButton" method="post" action="index.php?page=home">
          <input type="hidden" name="action" value="removeTimeslot">
          <input type="hidden" name="removedItem" value="<?php echo $item->id ?>">
          <input  type="submit" class="button--bin" value="">
        </form></div>
        <?php if($item->series == 1){ ?><p>S<?php echo $item->current_ses?> Ep<?php echo $item->current_ep?></p><?php } ?>
        <p class="card__time"><?php sscanf($item->time, "%d:%d:%d", $hours, $minutes, $seconds); echo str_pad($hours, 2, "0", STR_PAD_LEFT) . ' : ' . str_pad($minutes, 2, "0", STR_PAD_LEFT);?></p>
        <?php if($item->watched==0){?>
        <form class="checkButton" method="post" action="index.php?page=home">
          <input type="hidden" name="action" value="checkedTimeslot">
          <input type="hidden" name="plannedItem" value="<?php echo $item->id ?>">
          <input  type="submit" class="button--check button <?php if(strtotime('+'.$i . 'day', $monday)< strtotime("today")) echo 'passed--button';?>" value="watched">
        </form><?php } ?>
      </li>
      <?php }} ?>
    </ul>
  </li>
  <?php } ?>
  </ul>
  </section>
<?php } ;?>
