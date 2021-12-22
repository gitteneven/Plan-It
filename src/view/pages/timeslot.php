<article class="timeslotPlanner">

 <h1 class="subtitle">Add a timeslot</h1>
 <section class="border login__wrap timeslot__wrap">
   <form class="timeslot__form" method="post" action="index.php?page=timeslot" enctype="multipart/form-data">
      <input type="hidden" name="action" value="timeslot">

      <label class="timeslot__label ">
            <span class="form__text">When do you want to watch?</span>
           
            <label class="time__label">Start:
            <input type="datetime-local" name="timeslot--start" class="timeslot__input time--start size1" value="<?php if(!empty($_POST['timeslot--start'])) echo $_POST['timeslot--start'];  ?>"></label>
            <label class="time__label"> End:
              <input type="datetime-local" name="timeslot--end" class="timeslot__input time--end size1" value="<?php if(!empty($_POST['timeslot--end'])) echo $_POST['timeslot--end'];  ?>"></label>
        </label>


        <input type="submit" class=" button" value="CREATE SUGGESTIONS"><br>
        <?php if(!empty($availableTime)){ ?>
        <p>Available Time: <?php echo $availableTime/60; ?> min</p><?php } ?><br>
         <?php if(!empty($watchDuration)){ ?>
        <p class="selected__time--php">Selected Time: <?php echo round($watchDuration/60);?> min</p><?php } ?>
        <?php if(!empty($overdueTimes)){ ?><br>
          <p class="error">You have selected too many items. Please select fewer items to fit in your timeslot</p>
        <p>Selected items:</p><ul> <?php foreach($possibleTimes as $item)echo '<li class="possible__card"><p>' . $item->title .' : '. round($item->duration/60) .' min<p></li>';?></ul>
        <p>Overdue items: <?php foreach($overdueTimes as $item)echo '<li class="overdue__card"><p>' . $item->title .' : '. round($item->duration/60) .' min<p></li>' ;?></p><?php } ?>
  </form>
  <br>
  <br>

  <form class="timeslot__form--items" method="post" action="index.php?page=timeslot" enctype="multipart/form-data">
      <input type="hidden" name="action" value="addWatchItem">
      <ul class="watchItemList">

<?php if(!empty($watchSuggestions)){
foreach($watchSuggestions as $sugg){?>

      <li class="timeslot__sugg <?php if($sugg->movie == 1)echo 'sugg--movie';?>">

    <?php if($sugg->series == 1){
        $suggApi = 'https://api.themoviedb.org/3/tv/'. $sugg->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $suggCode = file_get_contents($suggApi);
        $suggInfo= json_decode($suggCode);
        if(!empty($suggInfo->poster_path)){
        echo '<img class="sugg__img" src="https://image.tmdb.org/t/p/w500/'. $suggInfo->poster_path .'" alt="">';
      } else {
          echo '<p class="sugg__img sugg__img--letter img__notfound dropshadow" > W </p>';
      }?>

       <?php $suggDate = date( 'Y', strtotime($suggInfo->first_air_date));
        ?>
        <h3 class="sugg__title"><?php echo $sugg->title . ' <em>('. $suggDate .')</em>' ?></h3>
        <p class="sugg__ep">Se <?php echo $sugg->current_ses . ' ' . 'Ep' . ' ' .$sugg->current_ep//foreach($currentStatusArray as $status){ if($sugg->watch_id == $status['watch_id']){echo $status->current_ses . ' ' . 'Ep' . ' ' . $status->current_ep;}} ?></p>
        <?php
        $runtime= round($sugg->duration/60);
        echo '<p class="sugg__duration">'.$runtime.' min </p>';
        ?>
        <label class="sugg__add--label"><input type="checkbox" id="<?php echo $sugg->watch_id ?>" name="watchItem[]" value="<?php echo $sugg->watch_id ?>" class="sugg__add " <?php if(!empty($_POST['watchItem'])&& in_array($sugg->watch_id,$_POST['watchItem']) ) echo 'checked'; ?>></label>
        <span class="multiEps--selector">
          <label class="multiEps input form__text" for="multiEps">Select multiple episodes:
          <select  class="multiEps  id_<?php echo $sugg->watch_id?>" name="multiEps[]" size="1" required>
            <?php  if($suggInfo->seasons[0]->name =='Specials') {
            $nextEps=$suggInfo->seasons[$sugg->current_ses]->episode_count-$sugg->current_ep;
            $TotalEpsWatched=$suggInfo->seasons[$sugg->current_ses]->episode_count-$nextEps-1 ;
            $currentSes=$suggInfo->seasons[$sugg->current_ses];
            if($currentSes !==0){
              for ($i=1; $i <= $sugg->current_ses-1; $i++) {
                $prevEps=$suggInfo->seasons[$i]->episode_count;
                $TotalEpsWatched+=$prevEps;
              }
            }
            $remainingEps=$suggInfo->number_of_episodes - $TotalEpsWatched;
        } else if($suggInfo->seasons[0]->name !=='Specials') { echo 'no specials ' . $suggInfo->seasons[$sugg->current_ses-1]->episode_count ;
            $nextEps=$suggInfo->seasons[$sugg->current_ses]->episode_count-$sugg->current_ep;
            $TotalEpsWatched=$suggInfo->seasons[$sugg->current_ses]->episode_count-$nextEps-1 ;
            $currentSes=$suggInfo->seasons[$sugg->current_ses];

              for ($i=1; $i <= $sugg->current_ses-1; $i++) {
                $prevEps=$suggInfo->seasons[$i]->episode_count;
                $TotalEpsWatched+=$prevEps;
              }

            $remainingEps=$suggInfo->number_of_episodes - $TotalEpsWatched;
            }?>
          <?php for ($i=0; $i < $remainingEps; $i++) {?>
           <option value="<?php echo $sugg->watch_id?>-<?php echo $i+1; ?>"><?php echo $i+1; ?></option>
          <?php } ?>


            </select>
    </label>

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
        <label class="sugg__add--label"><input type="checkbox" id="<?php echo $sugg->watch_id ?>" name="watchItem[]" value="<?php echo $sugg->watch_id ?>" class="sugg__add add__timeslot--moment" <?php if(!empty($_POST['watchItem'])&& in_array($sugg->watch_id,$_POST['watchItem']) ) echo 'checked'; ?>></label>
        <?php
      } ?>
      </li><br>
<?php
}} ?>
</ul>
<input type="submit" class="add--button button" value="make timeslot">
</form>


</section>
</article>
