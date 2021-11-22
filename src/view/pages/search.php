<section class="content">
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
  <a class="reset button" href="index.php">Reset</a>
  </div>
</form>
<ul class="search__list">

  <li> <?php
     foreach ($movies as $movie){

    }
      ?> </li>


<?php foreach ($movies as $movie): ?>
      <li>
        <?php if($_POST['type'] == 'series'){
         echo($movie->name);
        }else if($_POST['type'] == 'movie'){
          echo($movie->title);
        }
        ?> <form class="add__button "method="post"> <input type="hidden" name="action" value="addWatchlist">
		<input type="submit" name="add" value="add"/> </form> </li>
  <?php endforeach ?>


  </ul>
</section>
