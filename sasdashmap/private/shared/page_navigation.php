<navigation>
<?php $nav_databases = fetch_distinct_libnames(); ?>
  <ul class="databases">
    <?php while($nav_database = mysqli_fetch_assoc($nav_databases)) { ?>
      <li class="<?php if ($nav_database['libname'] == $libname) { echo 'selected'; } ; ?>">
        <a href="<?php echo url_for('/staff/pages/index.php?libname='.h(u($nav_database['libname']))); ?>">
          <?php echo h($nav_database['libname']); ?>
        </a>
      </li>
      <br />
      <br />
    <?php } // while $nav_subjects ?>

  </ul>
<?php mysqli_free_result($nav_databases); ?>

</navigation>