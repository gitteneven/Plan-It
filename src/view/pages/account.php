<article class="account">
  <section class="border account__section">
  <h2 class="subtitle">Hi, <?php echo $user->username?> !</h2>

  <div class="services">
    <p class="services__text">Your streaming providers:</p>
    <div class="services__items">
    <?php
    foreach($serviceView as $service){
      echo $service;
    }
    ?>
    </div>
  </div>
  <p class="date">You've been a member since: <em class="date__em"> <?php echo $date ?></em></p>
  </section>
</article>
