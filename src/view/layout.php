<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/svg" href="./assets/favicon.svg"/>
  <link href='https://css.gg/arrow-left.css' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <?php echo $css; ?>
  <title><?php echo $title; ?></title>
</head>
<body><?php if(!empty($_SESSION['id']) || $_GET['page'] !== 'home') {?>
  <header class="navigation">
    <ul class="nav">
    <?php if(!empty($_SESSION['id'])) { ?>
    <li><a class="nav__item <?php if($_GET['page'] == 'home') {echo 'selected';}?>" href="index.php?page=home">Home</a></li>
    <li><a class="overview nav__item <?php if($_GET['page'] == 'overview') {echo 'selected';}?>" href="index.php?page=overview">Watchlist</a></li>
    <li ><a  href="index.php?page=account" class=" nav__item">Account</a></li>
    <!-- <li> <a href="index.php?page=signup" class="nav__item">Sign Up</a></li> -->
    <li class=" <?php if($_GET['page']== 'login') {echo 'selected--login';}?>"><?php if(empty($_SESSION['id'])){echo '<a class="nav__item button" href="index.php?page=login">Log In</a>';} if(!empty($_SESSION['id'])){?><a class="nav__item button" href="index.php?page=logout">Log Out</a><?php ;} ?></li>
    <?php } ?>
  </ul>

</header><?php } ?>
  <div class="container">
      <header class="<?php if(!empty($_SESSION['id']) || $_GET['page'] !== 'home') {echo 'nav__header';}?>"><a href="index.php?" class="pagetitle <?php if(!empty($_SESSION['id']) || $_GET['page'] !== 'home') {echo 'logotitle';}?> dropshadow">Watcho</a>
      <?php if(!empty($_SESSION['id']) || $_GET['page'] !== 'home') {echo '<div class="line dropshadow logoline"></div>';}?>
      </header>
      <?php echo $content;?>
  </div>
  <?php echo $js; ?>
</body>
</html>
