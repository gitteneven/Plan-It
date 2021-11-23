<article class="overview">
  <h1 class="overview__title">Overview</h1>
  <section class="overview__list">
    <ul>
      <?php foreach ($watchlist as $item): ?>
        <li><?php echo $item->title ?> </li>
    </li>
  <?php endforeach ?>
    </ul>
  </section>

</article>
