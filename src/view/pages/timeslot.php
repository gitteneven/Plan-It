<article class="timeslotPlanner">

 <h1 class="subtitle">Add a timeslot</h1>
 <section class="border login__wrap timeslot__wrap">
   <form class="timeslot__form" method="post" action="index.php?page=timeslot" enctype="multipart/form-data">
      <input type="hidden" name="action" value="timeslot">

      <label class="timeslot__label ">
            <span class="form__text">When do you want to watch?</span>
            <!-- <span class="error"><?php if(!empty($errors['name'])){ echo $errors['name'];} ?></span> -->
            <!-- <input type="text" class="size1" name="name" class="timeslot__input timeslot--name" size="5"> -->
            <input type="datetime-local" name="timeslot--start" class="timeslot__input time--start size1" value="<?php if(!empty($_POST['timeslot--start'])) echo $_POST['timeslot--start'];  ?>">
              <input type="datetime-local" name="timeslot--end" class="timeslot__input time--end size1" value="<?php if(!empty($_POST['timeslot--end'])) echo $_POST['timeslot--end'];  ?>">
        </label>

        <label class="timeslot__label ">
            <span class="form__text">Do you want to stay within your planned limits?</span>
        </label>
        <label class="timeslot__label ">
            <span class="form__text">Do you have a preference?</span>
        </label>

        <input type="submit" class="signup--button button" value="CREATE SUGGESTIONS">
  </form>
<?php //echo $startDate . ' - ' . $startTime; ?><br>
<?php //echo $endDate . ' - ' . $endTime; ?><br>
<?php //echo $availableTime; ?><br>
<?php //echo $startDateNonFormat . ' - ' . $endDateNonFormat; ?><br>
<?php //echo $newAvailableTime; ?><br>

  <form class="timeslot__form--items" method="post" action="index.php?page=timeslot" enctype="multipart/form-data">
      <input type="hidden" name="action" value="addWatchItem">
      <ul>
<?php foreach($watchSuggestions as $sugg){?>

        <li class="timeslot__sugg <?php if($sugg->movie == 1)echo 'sugg--movie';?>">

    <?php if($sugg->series == 1){
        $suggApi = 'https://api.themoviedb.org/3/tv/'. $sugg->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $suggCode = file_get_contents($suggApi);
        $suggInfo= json_decode($suggCode);?>
        <img class="sugg__img" src="https://image.tmdb.org/t/p/w500/<?php echo $suggInfo->poster_path?>" alt="">
       <?php $suggDate = date( 'Y', strtotime($suggInfo->first_air_date));
        ?>
        <h3 class="sugg__title"><?php echo $sugg->title . ' <em>('. $suggDate .')</em>' ?></h3>
        <p class="sugg__ep">Se <?php foreach($currentStatusArray as $status){ if($sugg->watch_id == $status['watch_id']){echo $status->current_ses . ' ' . 'Ep' . ' ' . $status->current_ep;}} ?></p>
        <?php
        // $suggCurrent = $currentEpisodes->where('watch_id', '=', $sugg->watch_id)->first();
        $runtime= $suggInfo->episode_run_time[0];
        echo '<p class="sugg__duration">'.$runtime.' min </p>';
        // echo '<input type="submit" class="add--button button" value="ADD">';
        ?>
        <label class="sugg__add--label"><input type="checkbox" id="<?php echo $sugg->watch_id ?>" name="watchItem[]" value="<?php echo $sugg->watch_id ?>" class="sugg__add " <?php if(!empty($_POST['watchItem'])&& in_array($sugg->watch_id,$_POST['watchItem']) ) echo 'checked'; ?>></label>
        <?php
      }else if($sugg->movie == 1){
        $suggApi = 'https://api.themoviedb.org/3/movie/'. $sugg->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $suggCode = file_get_contents($suggApi);
        $suggInfo= json_decode($suggCode);?>
        <img class="sugg__img" src="https://image.tmdb.org/t/p/w500/<?php echo $suggInfo->poster_path?>" alt="">
       <?php
        $suggDate = date( 'Y', strtotime($suggInfo->release_date));?>
        <h3 class="sugg__title"><?php echo $sugg->title . ' <em>('. $suggDate .')</em>' ?></h3>
        <?php
        $runtime= $suggInfo->runtime;
        echo '<p class="sugg__duration duration--movie">'.$runtime.' min </p>';?>
        <label class="sugg__add--label"><input type="checkbox" id="<?php echo $sugg->watch_id ?>" name="watchItem[]" value="<?php echo $sugg->watch_id ?>" class="sugg__add " <?php if(!empty($_POST['watchItem'])&& in_array($sugg->watch_id,$_POST['watchItem']) ) echo 'checked'; ?>></label>
        <?php
      } ?>
      </li><br>
<?php
} ?>

<ul>
<input type="submit" class="add--button button" value="check time">
<input type="submit" class="add--button button" value="make timeslot">
</form>
<?php //echo $selectedWatchItem;?><br>
<?php //foreach($watchArray as $item){
  //echo $item .' ' ;
//};?>
<?php //foreach($watchTimes as $time){
  //echo $time .' ';
//};
if(!empty($overdueTimes)){
?><p>overdue:</p>
<?php foreach($overdueTimes as $time){
  echo $time .' ';
};}?>
</section>
</article>
