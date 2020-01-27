<?php

require_once('../../../private/initialize.php');

require_login();

$column_name='';
$sas_libname='';


?>

<?php $page_title = 'Find Datasets'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Menu</a>

  <div class="find column">
    <h1>Enter the Column Name</h1>

    <form action="<?php echo url_for('/staff/pages/show.php') ?>" method="post">
      <dl>
        <dt>Column Name</dt>
        <dd><input type="text" name="column_name" value="<?php echo h($column_name) ?>" required /></dd>
      </dl>

      <dl>
        <dt>Library Name</dt>
        <dd><input type="text" name="sas_libname" value="<?php echo h($sas_libname) ?>" /></dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Find" />
      </div>
    </form>

  </div>

</div>



<?php include(SHARED_PATH . '/staff_footer.php'); ?>
