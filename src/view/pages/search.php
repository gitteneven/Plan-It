<article class="search">
<form id="form" class="form" method="post" action="index.php?page=search">
  <input type="hidden" name="action" value="searchWatchlist">

  <label class="type input" for="series"> series
  <input type="radio" class="type" name="type" id="type" value="series">

  <label class="type input" for="series"> movie
  <input type="radio" class="type" name="type" id="type" value="movie">

  <label class="title input" for="title"> Keyword for the movie title:
  <input type="text" class="title" name="title" id="title" placeholder="example: story" value="<?php if(!empty($_GET['title'])){ echo $_GET['title'];} ?>" size="45">

  <div class="buttons">
  <input type="submit" name="submit" value="search" class="search button">
  <a class="reset button" href="index.php?page=search">Reset</a>
  </div>
</form>
<ul class="search__list">
<?php foreach ($resultList as $movie): ?>
   <form class="add__button" method="post">
      <input type="hidden" name="action" value="addWatchlist">
      <li class="search__list--item">
        <?php
        
          if($movie->name){
            echo($movie->name);
          } else if($movie->title){
            echo($movie->title);
          }
          /*
          switch($movie){
            case $movie->name;
              echo($movie->name);
              break;
            case $movie->title;
          }
          */
          echo '<input type="hidden" name="watch__name" value="'. $movie->name . '">';
          echo '<input type="hidden" name="watch__type" value="series">';
        ?>
        <?php
      /*
        if($_POST['type'] == 'series'){
         echo($title = $movie->name);
          echo '<input type="hidden" name="watch__name" value="'. $movie->name . '">';
          echo '<input type="hidden" name="watch__type" value="series">';
        } else if($_POST['type'] == 'movie'){
          echo($title = $movie->title);
           echo '<input type="hidden" name="watch__name" value="'. $movie->title . '">';
            echo '<input type="hidden" name="watch__type" value="movie">';
        }*/
        ?>
        <input type="hidden" name="watch__id" value="<?php echo $movie->id?>">

        <input type="submit" name="add" value="add"/>

      </form>
    </li>
  <?php endforeach ?>


  </ul>

</section>
