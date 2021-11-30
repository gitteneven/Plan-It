<article class="timeslotPlanner">

 <h1 class="subtitle">Add a timeslot</h1>
 <section class="border login__wrap">
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
<?php echo $startDate . ' - ' . $startTime; ?><br>
<?php echo $endDate . ' - ' . $endTime; ?><br>
<?php echo $availableTime; ?><br>
<?php //echo $watchSuggestions ?>

  <form class="timeslot__form" method="post" action="index.php?page=timeslot" enctype="multipart/form-data">
      <input type="hidden" name="action" value="addWatchItem">
<?php foreach($watchSuggestions as $sugg){?>
    <h3><?php echo $sugg->title ?></h3>
    <?php if($sugg->series == 1){
        $suggApi = 'https://api.themoviedb.org/3/tv/'. $sugg->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $suggCode = file_get_contents($suggApi);
        $suggInfo= json_decode($suggCode);
        $suggDate = date( 'Y', strtotime($suggInfo->first_air_date));
        echo '<p>'.$suggDate.'</p>';
        // $suggCurrent = $currentEpisodes->where('watch_id', '=', $sugg->watch_id)->first();
        $runtime= $suggInfo->episode_run_time[0];
        echo '<p>'.$runtime.' min </p>';
        // echo '<input type="submit" class="add--button button" value="ADD">';
        echo '<label>ADD<input type="checkbox" id="'.$sugg->watch_id.'" name="watchItem[]" value="'.$sugg->watch_id.'" class=" " ></label>';
      }else if($sugg->movie == 1){
        $suggApi = 'https://api.themoviedb.org/3/movie/'. $sugg->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $suggCode = file_get_contents($suggApi);
        $suggInfo= json_decode($suggCode);
        $suggDate = date( 'Y', strtotime($suggInfo->release_date));
        echo '<p>'.$suggDate.'</p>';
        $runtime= $suggInfo->runtime;
        echo '<p>'.$runtime.' min </p>';
      } ?>
<?php
} ?>
<input type="submit" class="add--button button" value="make timeslot">
</form>
<?php //echo $selectedWatchItem;?><br>
<?php foreach($watchArray as $item){
  echo $item .' ';
};?>
</section>
</article>
