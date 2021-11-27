<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo $css; ?>
  <title><?php echo $title; ?></title>
</head>
<body>
  <header>
    <ul class="nav">
    <li><a class="nav__item <?php if($_GET['page'] == 'home') {echo 'selected';}?>" href="index.php?page=home">Home</a></li>
    <li><a class="overview nav__item <?php if($_GET['page'] == 'overview') {echo 'selected';}?>" href="index.php?page=overview">Watchlist</a></li>
    <li ><a  href="index.php?page=account" class=" nav__item">Account</a></li>
    <!-- <li> <a href="index.php?page=signup" class="nav__item">Sign Up</a></li> -->
    <li class=" <?php if($_GET['page']== 'login') {echo 'selected--login';}?>"><?php if(empty($_SESSION['id'])){echo '<a class="nav__item button" href="index.php?page=login">Log In</a>';} if(!empty($_SESSION['id'])){?><a class="nav__item button" href="index.php?page=logout">Log Out</a><?php ;} ?></li>
  </ul>

</header>
  <div class="container">
      <header><h1 class="pagetitle dropshadow">Watcho</h1></header>
      <?php echo $content;?>
  </div>
  <?php echo $js; ?>
</body>
</html>
