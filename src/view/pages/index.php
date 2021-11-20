<header>
  <a href="index.php?page=signup" class="button">Sign Up</a>
  <br>
  <br>
</header>
<section class="content">
<form id="form" class="form" method="get" action="index.php">
  <label class="title input" for="title"> Keyword for the movie title:
  <input type="text" class="title" name="title" id="title" placeholder="example: story" value="<?php if(!empty($_GET['title'])){ echo $_GET['title'];} ?>" size="45">

  <div class="buttons">
  <input type="submit" name="submit" value="search" class="search button">
  <a class="reset button" href="index.php">Reset</a>
  </div>
</form>
<ul class="demo-list">

<?php
   foreach ($movies as $movie){
      echo('<li>' . $movie->title . '</li>');
    }
  ?>
  </ul>
</section>
<div>
  <?php if(!empty($userLogin)){
    echo $userLogin;
  }else{
    echo 'user';
  }
  ?>
  </div>
