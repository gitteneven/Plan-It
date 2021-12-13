<article class="detail">
      <a href="index.php?page=overview" class="search__back"><i class="search__back gg-arrow-left"></i>Back to watchlist</a>

    <?php
      $itemApi = 'https://api.themoviedb.org/3/'. $typeDetail.'/'. $idDetail . '?api_key=662c8478635d4f25ee66abbe201e121d';
      $itemCode = file_get_contents($itemApi);
      $itemInfo= json_decode($itemCode);
      //var_dump($itemInfo);
      $language = $itemInfo->spoken_languages;
      if(!empty($language)){
        $languageDetail = $language['0']->name;
      }


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
      $currentApi = 'https://api.themoviedb.org/3/tv/'.$idDetail.'/season/'.$current_ses.'/episode/' . $current_ep .'?api_key=662c8478635d4f25ee66abbe201e121d';
      $currentCode = file_get_contents($currentApi);
      $currentInfo= json_decode($currentCode);
    }
     ?>
    <?php echo  '
    <section class="detail__card">
    <h2 class="detail__title">' . $titleDetail . '<em class="overview__list--date">   ' . $date . '</em></h2>
    <p class="detail__info"> ' . $genres . ' || '. $languageDetail .' || '. $watch_type .' || ' . $runtime .' min</p>
    <h3 class="detail__overview--title"> Overview: </h3>
    <p class="detail__overview--text">'. $itemInfo->overview .'</p>
    <p class="detail__total">'. $itemInfo->number_of_seasons.' season(s) and '. $itemInfo->number_of_episodes .' episodes in total</p>
    <p class="detail__current--text">You are currently on:</p>
    <div class="detail__episode">
    <p class="detail__episode--title"> S'. $current_ses.' – Ep'. $current_ep .'</p>
    <p class="detail__episode--text">'. $currentInfo->overview.'</p>
    </div>';
    if(!empty($itemInfo->poster_path)){
        echo '<img class="overview__list--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
   } else {
      echo '<p class="overview__list--img img__notfound dropshadow" > W </p>';
    }
    echo '</section>' ?>

</article>
