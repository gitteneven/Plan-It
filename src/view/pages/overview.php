<article class="overview">
  <h1 class="overview__title subtitle">Watchlist</h1>
  <a class="button button--add button__search" href="index.php?page=search">Add movie/series</a>
  <section >
    <ul class="overview__list">
      <?php foreach ($watchlist as $item): ?>
        <li class="overview__list--item
         <?php if($item->series == 1){
            echo('border--blue');
          }else if($item->movie == 1 ){
            echo('border');
          }; ?>">
        <?php
      if($item->series == 1){
        $itemApi = 'https://api.themoviedb.org/3/tv/'. $item->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $itemCode = file_get_contents($itemApi);
        $itemInfo= json_decode($itemCode);
        $date = date( 'Y', strtotime($itemInfo->first_air_date));
        $itemCurrentSes = $item->current_ses;
        $itemCurrentEp = $item->current_ep;
        $watch_type= 'tv';
        $itemType= 'series';
        if(!empty($itemInfo->episode_run_time)){
           $runtime= $itemInfo->episode_run_time[0];
        }else{
          $runtime=45;
        }
      } else if($item->movie == 1){
        $itemApi = 'https://api.themoviedb.org/3/movie/'. $item->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $itemCode = file_get_contents($itemApi);
        $itemInfo= json_decode($itemCode);
        $date = date( 'Y', strtotime($itemInfo->release_date));
        $watch_type= 'movie';
        $itemType= 'movie';
        if(!empty($itemInfo->runtime)){
           $runtime= $itemInfo->runtime;
        }else{
          $runtime=125;
        }
        $itemCurrent='';
      }
      $language = $itemInfo->spoken_languages;

      echo ('
            <a class="overview__list--link" href="index.php?page=detail&id='. $item->watch_id .'&watch_type='. $watch_type .'&title='.$item->title .'">
            <h2 class="overview__list--title">' . $item->title . '<em class="overview__list--date">   ' . $date . '</em></h2>
            <input type="hidden" name="watch__name" value="'. $item->title . '">
            <p class="overview__list--type"> ' . $itemType . ' </p>
            <input type="hidden" name="watch__type" value="'. $itemType .'">');
      if($item->series == 1){
         echo '<p class="overview__list--current">S'. $itemCurrentSes . '- Ep' . $itemCurrentEp . '</p>';
      }
      if(!empty($itemInfo->poster_path)){
        echo '<img class="overview__list--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
      } else {
          echo '<p class="overview__list--img img__notfound dropshadow" > W </p>';
      }

      if(!empty($language)){
          echo  '<p class="overview__list--language">' .  $language['0']->name  . '</p>';
     }

      echo(
          '<p class="overview__list--runtime">' .  $runtime  . 'min </p></a>
          <div>
           <form class="removeButton remove__watch" method="post" action="index.php?page=overview">
          <input type="hidden" name="action" value="removeWatchItem">
          <input type="hidden" name="removedItem" value="'. $item->watch_id .'">
          <input  type="submit" class="button--bin overview__button--bin" value="">
          </form></div>');
       ?>

        </li>
  <?php endforeach ?>
    </ul>
  </section>

</article>



