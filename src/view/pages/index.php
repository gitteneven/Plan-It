<header>
  <a href="index.php?page=signup" class="button">Sign Up</a>
  <a class="overview button" href="index.php?page=overview">Overview</a>
  <a class="overview button" href="index.php?page=search">Search</a>

  <br>
  <br>
</header>
<section class="content">


</section>
<div>
  <?php if(!empty($userLogin)){
    echo $userLogin;
  }else{
    echo 'user';
  }
  ?>
  </div>
