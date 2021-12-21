<article class="detail">
      <a href="index.php?page=overview" class="search__back"><i class="search__back gg-arrow-left"></i>Back to watchlist</a>

    <?php
    //api of detail

    //providers
      //var_dump($servicesList);

    if($typeDetail === 'tv'){
      $date = date( 'Y', strtotime($itemInfo->first_air_date));
      $genres = $itemInfo->genres[0]->name;
      $watch_type ='series';
      if(!empty($itemInfo->episode_run_time)){
        $runtime= $itemInfo->episode_run_time[0];
      }else{
        $runtime=45;
      }

      $current_ep = $watchlist[0]->current_ep;
      $current_ses = $watchlist[0]->current_ses;
      $totalSeason= $itemInfo->number_of_seasons;


      $currentApi = 'https://api.themoviedb.org/3/tv/'.$idDetail.'/season/'.$current_ses.'/episode/' . $current_ep .'?api_key=662c8478635d4f25ee66abbe201e121d';
      $currentCode = file_get_contents($currentApi);
      $currentInfo= json_decode($currentCode);
      //var_dump($currentInfo);
    }
      if($typeDetail === 'movie'){
      $date = date( 'Y', strtotime($itemInfo->release_date));
      $genres = $itemInfo->genres[0]->name;
      $watch_type ='movie';
      if(!empty($itemInfo->runtime)){
          $runtime= $itemInfo->runtime;
      }else{
        $runtime=125;
      }
    }
    ?>


  <section class="detail__card border <?php
           if($typeDetail === 'tv'){
            echo('border--blue');
          }else if($typeDetail === 'movie'){
            echo('border');
          }; ?>">
<?php echo  '
    <div class="detail__head">
    <h2 class="detail__title">' . $titleDetail . '<em class="detail__list--date">   ' . $date . '</em></h2>
    <p class="detail__info"> ' . $genres . ' || '. $languageDetail .' || '. $watch_type .' || ' . $runtime .' min</p>
    </div>
    <div class="detail__overview">
    <h3 class="detail__overview--title"> Overview: </h3>
    <p class="detail__overview--text">'. $itemInfo->overview .'</p>
    </div>
    <ul class="detail__provider--list"> <li>'. $serviceItem .'</li></ul>';

     if($typeDetail === 'tv'){
       echo
    '
    <p class="detail__total">'. $totalSeason.' season(s) and '. $itemInfo->number_of_episodes .' episodes in total</p>';

    if(!empty($current_ep)){
    echo'
    <div class="detail__episode">
    <p class="detail__current--text">You are currently on:</p>
    <div class="detail__episode--border border">
    <form method="post" class="detail__edit">
      <input type="hidden" name="action" value="editCurrent">
    <input type="submit" class="detail__pencil edit" name="edit" value="edit">
    </form>';
      if(!empty($_POST['action'])){
        if($_POST['action'] == 'editCurrent'){
        echo '<div class="form__season">'. $formSeason .'</div>';
        }
        if($_POST['action'] == 'submitSeason'){
        echo '<div class="form__episode">'. $formEpisode .'</div>';
        }
      }
     echo  '<div class="detail__current--info">
    <p class="detail__episode--title"> S'. $current_ses.' – Ep'. $current_ep .': '.$currentInfo->name.'</p>
    <p class="detail__episode--text">'. $currentInfo->overview.'</p>
    </div>
    </div>
    </div>';
    }
    }
    if(!empty($itemInfo->poster_path)){
        echo '<img class="detail--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
   } else {
      echo '<p class="detail--img img__notfound dropshadow" > W </p>';
    }
   ?>
</section>
</article>
