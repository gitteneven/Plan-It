<article class="search">
   <h1 class="search__title subtitle">Watchlist - Add Movie/series</h1>
  <a href="index.php?page=overview">Back to watchlist</a>
<form id="form" class="form filter-form" method="post" action="index.php?page=search" enctype="multipart/form-data" >
  <input type="hidden" name="action" value="searchWatchlist">

  <label class="title input" for="title"> Keyword for the movie title:
  <input type="text" class="title filter__field" name="title" id="title" placeholder="example: story" value="<?php if(!empty($_GET['title'])){ echo $_GET['title'];} ?>" size="45">

  <label class="type input" for="type-select"> Filter on type</label>
  <select name="type" id="type" class="type filter__field">
    <option value="movie/series">Movie/series</option>
    <option value="series">series</option>
    <option value="movie">movie</option>
  </select>

  <div class="buttons">
  <input type="submit" name="submit" value="search" class="search button">
  <a class="reset button" href="index.php?page=search">Reset</a>
  </div>
</form>
<ul class="overview__list">
<?php if(!empty($_POST['action'])):  ?>
<?php foreach ($list as $item): ?>
  <?php $itemArray = (array)$item;?>
    <!-- <form class="add__button" method="post" <?php echo('action="index.php?page=search&title='. $_POST['title'] . '"')?>  action="index.php?page=search" enctype="multipart/form-data" > -->
    <form class="add__button" method="post" <?php echo('action="index.php?page=search&title='. $titleSearch . '"')?>   enctype="multipart/form-data">
     <?php //echo ('<input type="hidden" name="filled__title" value="'. $filledTitle . '">') ?>
     <?php echo ('<input type="hidden" name="title__search" value="'. $titleSearch . '">') ?>
    <input type="hidden" name="action" value="addWatchlist">
        <li class="overview__list--item
         <?php if(array_key_exists('name', $itemArray)){
            echo('border--blue');
          }else if(array_key_exists('title', $itemArray)){
            echo('border');
          }; ?>">
        <?php

      if(array_key_exists('name', $itemArray)){
        $itemApi = 'https://api.themoviedb.org/3/tv/'. $item->id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $itemCode = file_get_contents($itemApi);
        $itemInfo= json_decode($itemCode);
        $title = $item->name;
        $date = date( 'Y', strtotime($itemInfo->first_air_date));
        if(!empty($itemInfo->episode_run_time)){
           $runtime= $itemInfo->episode_run_time[0];
        }else{
          $runtime=45;
        }
      } else if(array_key_exists('title', $itemArray)){
        $itemApi = 'https://api.themoviedb.org/3/movie/'. $item->id . '?api_key=662c8478635d4f25ee66abbe201e121d';
        $itemCode = file_get_contents($itemApi);
        $itemInfo= json_decode($itemCode);
        $title = $item->title;
        $date = date( 'Y', strtotime($itemInfo->release_date));
        if(!empty($itemInfo->runtime)){
           $runtime= $itemInfo->runtime;
        }else{
          $runtime=125;
        }
      }

      $language = $itemInfo->spoken_languages;

      if(array_key_exists('name', $itemArray)){
            echo '<h2 class="overview__list--title">' . $title . '</h2>
                  <input type="hidden" name="watch__name" value="'. $title . '">
                  <input type="hidden" name="watch__type" value="series">
                  <p class="overview__list--date">(' .  $date . ')</p>';
          if(!empty($itemInfo->poster_path)){
              echo '<img class="overview__list--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
            } else {
              echo '<p class="overview__list--img img__notfound dropshadow" > W </p>';
            }
            if(!empty($language)){
             echo  '<p class="overview__list--language">' .  $language['0']->name  . '</p>';
            }
            echo '<input type="hidden" name="runtime" value="'. $runtime . '">
            <p class="overview__list--runtime">' .  $runtime  . 'min </p>';
      }else if(array_key_exists('title', $itemArray)){
            echo '<h2 class="overview__list--title">' . $item->title . '</h2>
                  <input type="hidden" name="watch__name" value="'. $item->title . '">
                  <input type="hidden" name="watch__type" value="movie">
                  <p class="overview__list--date">(' .  $date . ')</p>
                  <input type="hidden" name="runtime" value="'. $runtime . '">
                  <p class="overview__list--runtime">' .  $runtime  . 'min </p>';
            if(!empty($itemInfo->poster_path)){
                 echo '<img class="overview__list--img" src="https://image.tmdb.org/t/p/w500/'. $itemInfo->poster_path . '" alt="">';
            } else {
                 echo '<p class="overview__list--img img__notfound dropshadow" > W </p>';

             }
            if(!empty($language)){
                  echo  '<p class="overview__list--language">' .  $language['0']->name  . '</p>';
             }

        }
        ?>
        <input type="hidden" name="watch__id" value="<?php echo $item->id?>">

        <?php
        foreach($exists as $existing){
          if($item->id == $existing->watch_id){
            $idExists= $item->id;
          }
        }

          if(!isset($idExists) || $idExists != $item->id){
              echo '<input type="submit" class="button" name="add" value="add to watchlist"/>';
          } else if($idExists = $item->id) {
            echo '<p class="button">Added to watchlist</p>';
          }

        ?>

            </form>

        </li>
  <?php endforeach ?>

   <?php endif; ?>
  </ul>


</section>
