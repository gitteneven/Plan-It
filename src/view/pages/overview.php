<article class="overview">
  <h1 class="overview__title">Overview</h1>
  <a class="button" href="index.php?page=search">Search</a>
  <section class="overview__list">
    <ul>
      <?php foreach ($watchlist as $item): ?>
        <li><?php echo $item->title ?> </li>
    </li>
  <?php endforeach ?>
    </ul>
  </section>

</article>
