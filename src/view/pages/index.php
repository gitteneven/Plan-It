<header>
  <a href="index.php?page=signup" class="button">Sign Up</a>

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
