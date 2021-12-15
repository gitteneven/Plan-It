<article class="detail">
      <a href="index.php?page=overview" class="search__back"><i class="search__back gg-arrow-left"></i>Back to watchlist</a>

    <?php
    //api of detail
      $itemApi = 'https://api.themoviedb.org/3/'. $typeDetail.'/'. $idDetail . '?api_key=662c8478635d4f25ee66abbe201e121d';
      $itemCode = file_get_contents($itemApi);
      $itemInfo= json_decode($itemCode);
      $language = $itemInfo->spoken_languages;
      if(!empty($language)){
        $languageDetail = $language['0']->name;
      }
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
      $currentApi = 'https://api.themoviedb.org/3/tv/'.$idDetail.'/season/'.$current_ses.'/episode/' . $current_ep .'?api_key=662c8478635d4f25ee66abbe201e121d';
      $currentCode = file_get_contents($currentApi);
      $currentInfo= json_decode($currentCode);
    }
     ?>


  <section class="detail__card border <?php
           if($typeDetail === 'tv'){
            echo('border--blue');
          }else if($typeDetail === 'movie'){
            echo('border');
          }; ?>">
<?php echo  '
    <h2 class="detail__title">' . $titleDetail . '<em class="overview__list--date">   ' . $date . '</em></h2>
    <p class="detail__info"> ' . $genres . ' || '. $languageDetail .' || '. $watch_type .' || ' . $runtime .' min</p>
    <div class="detail__overview">
    <h3 class="detail__overview--title"> Overview: </h3>
    <p class="detail__overview--text">'. $itemInfo->overview .'</p>
    </div>
    <p class="detail__total">'. $itemInfo->number_of_seasons.' season(s) and '. $itemInfo->number_of_episodes .' episodes in total</p>
     <ul class="detail__provider--list"> <li>'. $serviceItem .'</li></ul>
    <div class="detail__episode">
    <p class="detail__current--text">You are currently on:</p>
    <div class="detail__episode--border border">
    <p class="detail__episode--title"> S'. $current_ses.' – Ep'. $current_ep .': '.$currentInfo->name.'</p>
    <p class="detail__episode--text">'. $currentInfo->overview.'</p>
    </div>
    </div>';
    if(!empty($itemInfo->poster_path)){
        echo '<img class="detail--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
   } else {
      echo '<p class="detail--img img__notfound dropshadow" > W </p>';
    }
   ?>
</section>
</article>


<!-- https://image.tmdb.org/t/p/original/9A1JSVmSxsyaBK4SUFsYVqbAYfW.jpg -->
