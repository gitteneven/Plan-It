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
    <li class="nav__item nav__login <?php if($_GET['page']== 'login') {echo 'selected--login';}?>"><?php if(empty($_SESSION['id'])){echo '<a href="index.php?page=login">Log In</a>';} if(!empty($_SESSION['id'])){?><a href="index.php?page=logout">Log Out</a><?php ;} ?></li>
    <li><a class="overview button" href="index.php?page=overview">Overview</a></li>
 <li> <a class="search button" href="index.php?page=search">Search</a></li>

</header>
  <div class="container">
      <header><h1 class="pagetitle">Watcho</h1></header>
      <?php echo $content;?>
  </div>
  <?php echo $js; ?>
</body>
</html>
