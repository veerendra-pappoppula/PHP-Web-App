<navigation>
  <?php $nav_dashboards = fetch_distinct_category(); ?>
  <a href="<?php echo url_for('/index.php'); ?>"> Home </a>
  <ul class="dashboards">
    <?php while($nav_dashboard = mysqli_fetch_assoc($nav_dashboards)) { ?>
      <li class="<?php if ($nav_dashboard['category'] == $category) { echo 'selected'; } ; ?>">
        <a href="<?php echo url_for('index.php?category='.h(u($nav_dashboard['category']))); ?>">
          <?php echo h($nav_dashboard['category']); ?>
        </a>
      </li>

    <?php } // while $nav_subjects ?>

  </ul>
  <?php mysqli_free_result($nav_dashboards); ?>
</navigation>
