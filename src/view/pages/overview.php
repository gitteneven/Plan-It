<article class="overview">
  <h1 class="overview__title subtitle">Watchlist</h1>
  <p><a href="index.php?page=search">Add movie/series</a></p>
  <section class="overview__list">
    <ul>
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
      } else if($item->movie == 1){
        $itemApi = 'https://api.themoviedb.org/3/movie/'. $item->watch_id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $itemCode = file_get_contents($itemApi);
        $itemInfo= json_decode($itemCode);
         $date = date( 'Y', strtotime($itemInfo->release_date));
      }



      echo ('<h2 class="overview__list--title">' . $item->title . '</h2>
            <p>'. $date . '</p>
            <img src="https://image.tmdb.org/t/p/w154/'. $itemInfo->poster_path . '" alt="">');?>

        </li>
  <?php endforeach ?>
    </ul>
  </section>

</article>


